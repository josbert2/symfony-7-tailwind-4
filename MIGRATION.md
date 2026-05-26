# Plan de migración Entrekids → Symfony 7 + Inertia

Plan formal para migrar el monolito Symfony 3.4 de entrekids al stack moderno (Symfony 7.2, React 19 + Inertia, Tailwind 4, JWT), reusando este repo (`symfony-7-tailwind-4`) como destino.

**Origen:** `/home/jos/root/bookforce/entrekids` (Sf 3.4, AppBundle único, ~150 entidades, ~74 controllers, ~44 commands, multi-market).
**Destino:** este repo.
**Estrategia:** Strangler fig — incremental, módulo por módulo, sin big bang.
**Primer módulo:** Auth + Usuarios.
**Multi-market:** sí, todos los markets (ENTREKIDS, ENTREADULTOS, B2B, EVENCLUB, GRANJAEDUCATIVA, TICKETLAB, BOOKFORCE).

---

## Tabla de contenidos

- [Decisión de stack: Twig vs Inertia](#decisión-de-stack-twig-vs-inertia)
- [Fase 0 — Cimientos](#fase-0--cimientos)
- [Fase 1 — Entidad Usuario + Cliente](#fase-1--entidad-usuario--cliente-schema)
- [Fase 2 — Security moderno (reemplazo de FOSUserBundle)](#fase-2--security-moderno-reemplazo-de-fosuserbundle)
- [Fase 3 — OAuth (reemplazo de HWIOAuthBundle)](#fase-3--oauth-reemplazo-de-hwioauthbundle)
- [Fase 4 — API JWT](#fase-4--api-jwt)
- [Fase 5 — Frontend (mapa Twig vs Inertia)](#fase-5--frontend-mapa-twig-vs-inertia)
- [Fase 6 — Migración de data](#fase-6--migración-de-data)
- [Fase 7 — Cutover](#fase-7--cutover)
- [Orden de ejecución sugerido](#orden-de-ejecución-sugerido)
- [Riesgos y disciplina del proyecto](#riesgos-y-disciplina-del-proyecto)

---

## Decisión de stack: Twig vs Inertia

**Regla única:** si la URL la abre Google o WhatsApp y necesita preview → **Twig**. Si la URL solo se abre logueado o post-click → **React + Inertia**.

Twig vive solo en:
- Páginas SEO-críticas del cliente público (landings, listados, fichas).
- Forms one-shot (login, register, password reset).
- Mails transaccionales (`templates/mails/`).
- PDFs (`templates/pdf/`) — input para wkhtmltopdf.

Todo lo demás → React + Inertia.

Esto evita meter Node SSR en producción, da SEO completo, y deja React donde brilla (apps internas y flujos post-login).

---

## Fase 0 — Cimientos

Sin esto la migración acumula deuda desde el día uno.

| Tarea | Detalle |
|---|---|
| Sacar `.env` del repo | Está commiteado con `JWT_PASSPHRASE=12345` y password de MySQL. Mover a `.env.local`, agregar al `.gitignore`, rotar la passphrase JWT. |
| Tailwind a estable | Subir de `4.0.0-beta.8` a la 4.x estable más reciente. |
| Limpiar legacy | Borrar `assets/app.js`, `assets/bootstrap.js`, `controllers/hello_controller.js`, `controllers/csrf_protection_controller.js`. Solo Inertia. |
| Sacar AssetMapper | El `composer.json` tiene `symfony/asset-mapper` que duplica a Vite. Sacarlo. |
| `MarketService` | Resuelve market activo desde el host del request. Service trivial pero crítico — lo necesita Auth, Cliente, casi todo. |
| Componentes base | Sacar a `assets/components/` los sub-componentes que aparezcan en más de una vista: `<Button>`, `<Input>`, `<Card>`, `<Modal>`, `<Sidebar>`, `<Topbar>`, `<Table>`, `<Badge>`, `<Icon>`. Lo nuevo usa esto, sin excepciones. |
| Iconografía única | Hugeicons (`@hugeicons/react` + `@hugeicons/core-free-icons`). No mezclar con Heroicons / Lucide / SVG inline. |

**Criterio de hecho:** repo limpio, `.env` rotado, componentes base usados por el dashboard refactorizado.

---

## Fase 1 — Entidad Usuario + Cliente (schema)

| Tarea | Detalle |
|---|---|
| Auditar `src/Entity/Usuario.php` actual | Tiene base UserInterface pero faltan campos del viejo: `facebookId`, `googleId`, `facebookAccessToken`, `googleAccessToken`, `confirmationToken`, `passwordRequestedAt`, `enabled`, `lastLogin`, `nombre`, `apellido`, `telefono`, `dateJoined`, `isActive`, `isStaff`, `isSuperuser`. |
| Auditar `Cliente` | Confirmar que tiene `market_id` y FK a Usuario. Es la entidad multi-market clave. |
| Password hasher | Configurar `bcrypt` (no `auto`) para conservar compatibilidad con los hashes existentes de FOSUserBundle. |
| Migración | Una sola migración que agrega los campos faltantes a `usuario`. NO regenerar todo el schema desde cero — la DB tiene data viva. |

**Criterio de hecho:** `Usuario` y `Cliente` matchean el modelo viejo en campos relevantes, sin perder data.

---

## Fase 2 — Security moderno (reemplazo de FOSUserBundle)

FOSUserBundle está muerto, no tiene soporte Sf 7. Hay que reescribir la lógica que FOS daba. Es menos de lo que parece — Symfony Security moderno cubre casi todo nativo.

| Tarea | Detalle |
|---|---|
| `security.yaml` | Dos firewalls: `main` (sesión + form login para cliente público) y `api` (JWT, ya está). Roles: `ROLE_USER`, `ROLE_CLIENTE`, `ROLE_PROVEEDOR`, `ROLE_ADMIN`, `ROLE_SUPER_ADMIN`. Jerarquía igual al viejo. |
| `LoginFormAuthenticator` | Custom authenticator que además del email+password valida que el `Cliente` del market activo existe y está activo. Replica la lógica del `/usuario/authenticate` viejo en código moderno. |
| `RegistrationController` | Form Symfony, crea `Usuario` + `Cliente` del market actual + `Acompañante` por defecto. |
| `PasswordResetService` | Genera token, expira en 2h, envía mail. Replica `FOSListener::onPasswordResettingEmailStart`. |
| `EmailConfirmationService` | Token de confirmación post-registro. |
| `LoginEventSubscriber` | Limpia session vars (`emailInvitado`, `clienteInvitado`) en `InteractiveLoginEvent`. |
| `RegistrationEventSubscriber` | Procesa referidos, suma puntos de bienvenida, dispara mail. |

**Criterio de hecho:** login con email/pass funciona contra DB real, registro crea Usuario+Cliente, password reset envía mail con link funcional.

---

## Fase 3 — OAuth (reemplazo de HWIOAuthBundle)

HWIOAuth también está muerto en Sf 7. La pieza moderna es `knpuniversity/oauth2-client-bundle`.

| Tarea | Detalle |
|---|---|
| Instalar `knpuniversity/oauth2-client-bundle` | + providers de Facebook y Google. |
| `OAuth2Authenticator` para cada provider | Reproduce `FOSUBUserProvider::loadUserByOAuthUserResponse` viejo: busca por `facebookId`/`googleId`, si no existe busca por email, si no existe crea Usuario + Cliente + Acompañante con password aleatorio. |
| Rutas | `/connect/facebook`, `/connect/facebook/check`, idem Google. |
| Marcado `facebookFirst`/`googleFirst` | Mantenido como en el viejo para distinguir cuentas creadas por OAuth de las verificadas con password. |

**Criterio de hecho:** podés loguear con Google y Facebook, te crea Usuario+Cliente correctamente y vincula al market activo.

---

## Fase 4 — API JWT

Ya hay base. Hay que rematarla.

| Tarea | Detalle |
|---|---|
| `/api/auth/login_check` | Ya configurado en `config/packages/security.yaml`. Validar que devuelve token + user info. |
| `/api/auth/me` | Endpoint para que el frontend logueado obtenga su user actual con roles y cliente del market. |
| `/api/auth/refresh` | Opcional, refresh token con TTL largo. |
| `/api/auth/oauth/exchange` | Para apps móviles eventualmente: recibe OAuth code, devuelve JWT. |

**Criterio de hecho:** Postman/curl pueden loguear y consumir endpoints protegidos.

---

## Fase 5 — Frontend (mapa Twig vs Inertia)

| Ruta | Stack | Razón |
|---|---|---|
| `/` (home del market) | **Twig** | SEO crítico, Google indexa. Cada market tiene su home. |
| `/buscar`, `/categoria/{x}` | **Twig** | SEO crítico, filtros con progressive enhancement. |
| `/actividad/{slug}` | **Twig** | SEO crítico, se comparte en WhatsApp/redes (Open Graph). |
| `/proveedor/{slug}` | **Twig** | SEO crítico. |
| `/login` | **Twig** | One-shot, sin shell de app. |
| `/register` | **Twig** | Idem. |
| `/password/forgot`, `/password/reset/{token}` | **Twig** | One-shot. |
| `/email/confirm/{token}` | **Twig** (redirect) | Server-side only. |
| `/connect/{provider}` y callbacks | **Twig** (redirect) | Server-side. |
| `/cuenta` (perfil) | **Inertia** | Post-login, app shell. |
| `/cuenta/seguridad` (cambio password) | **Inertia** | Post-login. |
| `/cuenta/entradas`, `/cuenta/historial` | **Inertia** | Post-login, tablas interactivas. |
| `/cuenta/acompanantes` | **Inertia** | Post-login, CRUD inline. |
| `/checkout/*` (carrito, pago, confirmación) | **Inertia** | Multi-step, validaciones en vivo. |
| `/admin/*` | **Inertia** | App interna. |
| `/proveedor/*` (panel) | **Inertia** | App interna. |
| Mails (`templates/mails/`) | **Twig** | HTML estático server-rendered. |
| PDFs (`templates/pdf/`) | **Twig** | Input para wkhtmltopdf. |

---

## Fase 6 — Migración de data

| Tarea | Detalle |
|---|---|
| Comando `bin/console migrar:usuarios` | Lee `usuario` de la DB vieja de entrekids (Sf3.4) e inserta en la nueva. Mantiene hashes bcrypt (compatibles). |
| Comando `bin/console migrar:clientes` | Idem para `cliente`, preservando `market_id`. |
| Validación | Probar login con cuenta real importada. Probar password reset. Probar OAuth con cuenta vinculada. |

---

## Fase 7 — Cutover

Cómo conviven Sf3.4 viejo y Sf7 nuevo en producción durante la migración:

1. **Subdominio**: `nuevo.entrekids.cl` al Sf7, `entrekids.cl` sigue en Sf3.4. Migrás features y vas redirigiendo URLs cuando estén listas.
2. **Path routing en Nginx**: ciertos paths (`/cuenta/*`, `/admin/*`) van al Sf7, el resto al Sf3.4. Más complejo pero transparente para el usuario.
3. **Cookie/feature flag**: 10% de usuarios al nuevo, ir subiendo. Ambos contra la misma DB.

**Problema crítico de auth:** un usuario logueado en Sf3.4 no está logueado en Sf7 (sesiones distintas). Soluciones:
- Compartir sesión Redis con mismo cookie name + secret (si ambos están en el mismo dominio).
- Hacer que el nuevo emita JWT y el viejo aprenda a validarlo.

Esto se decide cerca del cutover, no ahora.

---

## Orden de ejecución sugerido

1. Fase 0 esta semana (cimientos).
2. Fase 1 + 2 las dos siguientes (entidad + security básico con form login).
3. Fase 3 después (OAuth, una vez que form login anda).
4. Fase 4 en paralelo con 3 (API JWT, es independiente).
5. Fase 5 viene saliendo natural mientras hacés 2-4 (cada controller necesita su vista).
6. Fase 6 al final, antes del cutover.
7. Fase 7 cuando esté todo verde en staging.

**Estimación realista:** 4-6 semanas para tener Auth end-to-end andando en producción. La migración completa (74 controllers + 150 entidades + integraciones) es 6 meses mínimo con 1-2 personas full time.

---

## Riesgos y disciplina del proyecto

Reglas no negociables para no terminar con un monstruo peor que el actual:

- **Strangler fig estricto**: un módulo se migra entero o no se toca. Nada de "migré la lista pero el detalle sigue en Twig viejo".
- **Twig solo en**: mails, PDFs y páginas SEO-críticas del cliente público. Cualquier otra pantalla nueva es React.
- **Componentes base primero, features después**: `<Sidebar>`, `<Table>`, `<Form>`, `<Modal>`, `<Card>` viven en `assets/components/` y son la única forma de armar UI nueva.
- **Iconografía única**: solo Hugeicons. Sin mezclar Heroicons / Lucide / SVG inline.
- **Tokens semánticos, no Tailwind raw**: usar `bg-primary-base`, `text-strong-950`, `border-stroke-soft-200`. Nunca `bg-blue-500`, `bg-emerald-400`, etc.
- **No reescribir comandos CLI todavía**: los 44 `bin/console` de entrekids (liquidaciones, DTE, cashback, sync Multivende) siguen andando en Sf3.4 contra la misma DB hasta el final. Migrá UI primero, jobs después.
- **No agregar Node SSR**: el frontend público SEO va en Twig. Inertia sin SSR para el resto.
- **Eliminar el viejo cuando el nuevo está estable**, no antes ni después.

---

## Estado actual

- Stack del destino verificado y andando: Symfony 7.2 + React 19 + Inertia 2 + Tailwind 4.
- Bugs del boilerplate corregidos (DocumentRoot Apache, namespace `Rompetomp`, preamble React Refresh, variable Twig `app_owner`).
- Vista de referencia: `assets/pages/Admin/Dashboard.jsx` + `src/Controller/AdminController.php` con mocks del dominio entrekids. Sirve de semilla para extraer componentes base en Fase 0.

**Próximo paso concreto:** Fase 0, empezando por refactorizar el dashboard con Hugeicons y componentes extraídos.
