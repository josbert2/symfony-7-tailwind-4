import React from 'react';
import { usePage } from '@inertiajs/react';
import { HugeiconsIcon } from '@hugeicons/react';
import {
  Search01Icon,
  Notification01Icon,
  PlusSignIcon,
  FilterHorizontalIcon,
  Download01Icon,
} from '@hugeicons/core-free-icons';

const routeLabels = {
  '':              'Dashboard',
  'proveedores':   'Proveedores',
  'actividades':   'Actividades',
  'transacciones': 'Transacciones',
  'liquidaciones': 'Liquidaciones',
  'dte':           'DTE / Boletas',
  'usuarios':      'Usuarios',
  'reportes':      'Reportes',
  'configuracion': 'Configuración',
};

function getBreadcrumb(url) {
  const path = url.replace(/^\/admin\/?/, '').replace(/\/$/, '').split('/').filter(Boolean);
  if (path.length === 0) return [{ label: 'Dashboard', href: '/admin' }];
  return [
    { label: 'Admin', href: '/admin' },
    ...path.map((seg, i) => ({
      label: routeLabels[seg] ?? seg,
      href: '/admin/' + path.slice(0, i + 1).join('/'),
    })),
  ];
}

export default function Topbar() {
  const { url } = usePage();
  const breadcrumb = getBreadcrumb(url);

  return (
    <header className="h-14 px-6 border-b border-border bg-background flex items-center gap-4">
      <nav className="flex items-center gap-1.5 text-sm">
        {breadcrumb.map((b, i) => (
          <React.Fragment key={b.href}>
            {i > 0 && <span className="text-muted-foreground">/</span>}
            <span className={i === breadcrumb.length - 1 ? 'text-foreground font-medium' : 'text-muted-foreground'}>
              {b.label}
            </span>
          </React.Fragment>
        ))}
      </nav>

      <div className="flex-1 max-w-sm ml-auto">
        <div className="relative">
          <HugeiconsIcon icon={Search01Icon} className="w-4 h-4 text-muted-foreground absolute left-3 top-1/2 -translate-y-1/2" strokeWidth={1.6} />
          <input
            type="text"
            placeholder="Buscar…"
            className="w-full h-9 pl-9 pr-3 rounded-lg bg-muted border border-transparent focus:bg-background focus:border-input focus:outline-none focus:ring-2 focus:ring-ring/30 text-sm text-foreground placeholder:text-muted-foreground"
          />
        </div>
      </div>

      <div className="flex items-center gap-2">
        <button className="h-9 px-3 rounded-lg text-xs font-bold text-muted-foreground hover:bg-muted hover:text-foreground flex items-center gap-2 transition">
          <HugeiconsIcon icon={FilterHorizontalIcon} className="w-4 h-4" strokeWidth={1.6} />
          Filtros
        </button>
        <button className="h-9 px-3 rounded-lg text-xs font-bold text-muted-foreground hover:bg-muted hover:text-foreground flex items-center gap-2 transition">
          <HugeiconsIcon icon={Download01Icon} className="w-4 h-4" strokeWidth={1.6} />
          Exportar
        </button>
        <span className="w-px h-5 bg-border mx-1" />
        <button className="h-9 w-9 rounded-lg text-muted-foreground hover:bg-muted hover:text-foreground flex items-center justify-center relative transition" title="Notificaciones">
          <HugeiconsIcon icon={Notification01Icon} className="w-5 h-5" strokeWidth={1.6} />
          <span className="absolute top-1.5 right-2 w-2 h-2 rounded-full bg-destructive ring-2 ring-background" />
        </button>
        <button className="h-9 px-3 rounded-lg bg-primary text-primary-foreground text-xs font-bold flex items-center gap-2 hover:opacity-90 transition shadow-xs/5">
          <HugeiconsIcon icon={PlusSignIcon} className="w-4 h-4" strokeWidth={1.6} />
          Nuevo
        </button>
      </div>
    </header>
  );
}
