import React from 'react';
import { HugeiconsIcon } from '@hugeicons/react';
import {
  ArrowUp01Icon,
  ArrowDown01Icon,
  UserMultiple02Icon,
  PercentSquareIcon,
  CoinsDollarIcon,
  Alert02Icon,
} from '@hugeicons/core-free-icons';
import AdminLayout from '../../layouts/AdminLayout';
import {
  Card,
  CardFrame,
  CardFrameHeader,
  CardFrameTitle,
  CardFrameDescription,
  CardFrameAction,
  CardFrameFooter,
} from '../../components/ui/Card';

const metricIcons = {
  cupos:      UserMultiple02Icon,
  descuentos: PercentSquareIcon,
  totales:    CoinsDollarIcon,
};

const tones = {
  success:     { bg: 'bg-success/15',     text: 'text-success-foreground',     dot: 'bg-success' },
  destructive: { bg: 'bg-destructive/15', text: 'text-destructive-foreground', dot: 'bg-destructive' },
  warning:     { bg: 'bg-warning/15',     text: 'text-warning-foreground',     dot: 'bg-warning' },
  info:        { bg: 'bg-info/15',        text: 'text-info-foreground',        dot: 'bg-info' },
  feature:     { bg: 'bg-feature-lighter',     text: 'text-feature-dark',      dot: 'bg-feature-base' },
  verified:    { bg: 'bg-verified-lighter',    text: 'text-verified-dark',     dot: 'bg-verified-base' },
  highlighted: { bg: 'bg-highlighted-lighter', text: 'text-highlighted-dark',  dot: 'bg-highlighted-base' },
};

const estadoTone = {
  pagada:    'success',
  pendiente: 'warning',
  rechazada: 'destructive',
};

function MetricCard({ titulo, subtitulo, items, valor, destacado }) {
  if (destacado) {
    return (
      <Card className="p-6 flex flex-col items-center justify-center text-center bg-primary text-primary-foreground">
        <p className="text-xs uppercase tracking-wide opacity-80 font-bold">{titulo}</p>
        <p className="text-3xl font-semibold mt-2 tabular-nums">{valor}</p>
      </Card>
    );
  }
  return (
    <Card className="p-5 flex flex-col">
      <div>
        <h3 className="text-foreground font-semibold text-sm">{titulo}</h3>
        {subtitulo && <p className="text-muted-foreground text-xs mt-0.5">{subtitulo}</p>}
      </div>
      {items && (
        <div className="mt-4 space-y-2.5">
          {items.map(it => (
            <div key={it.label} className="flex items-center gap-2.5 text-sm">
              <span className="w-7 h-7 rounded-lg bg-muted flex items-center justify-center shrink-0">
                <HugeiconsIcon icon={metricIcons[it.icon] ?? CoinsDollarIcon} className="w-3.5 h-3.5 text-muted-foreground" strokeWidth={1.6} />
              </span>
              <span className="flex-1 text-muted-foreground">{it.label}</span>
              <span className="text-foreground font-semibold tabular-nums">{it.valor}</span>
            </div>
          ))}
        </div>
      )}
      {!items && valor && (
        <p className="text-foreground text-2xl font-semibold mt-4 tabular-nums">{valor}</p>
      )}
    </Card>
  );
}

function BannerAlerta({ mensaje }) {
  if (!mensaje) return null;
  return (
    <div className="rounded-2xl border border-destructive/25 bg-destructive/5 p-4 flex gap-3">
      <span className="w-8 h-8 rounded-lg bg-destructive/10 flex items-center justify-center shrink-0">
        <HugeiconsIcon icon={Alert02Icon} className="w-4 h-4 text-destructive" strokeWidth={1.8} />
      </span>
      <div className="min-w-0 text-sm leading-relaxed">
        <span className="font-semibold text-destructive uppercase tracking-wide text-xs mr-1">Alertas o notificaciones importantes:</span>
        <span className="text-foreground">{mensaje}</span>
      </div>
    </div>
  );
}

function VentasChart({ data }) {
  const max = Math.max(...data.map(d => d.valor));
  const total = data.reduce((acc, d) => acc + d.valor, 0);
  return (
    <CardFrame className="col-span-2">
      <CardFrameHeader>
        <CardFrameTitle>Ventas últimos 7 días</CardFrameTitle>
        <CardFrameDescription>Comparativo con la semana anterior</CardFrameDescription>
        <CardFrameAction>
          <div className="flex items-center gap-3 text-xs text-muted-foreground">
            <span className="flex items-center gap-1.5">
              <span className="w-2.5 h-2.5 rounded-sm bg-foreground" />
              Esta semana
            </span>
            <span className="flex items-center gap-1.5">
              <span className="w-2.5 h-2.5 rounded-sm bg-muted" />
              Anterior
            </span>
          </div>
        </CardFrameAction>
      </CardFrameHeader>
      <Card>
        <div className="p-6">
          <div className="flex items-end gap-3 h-48">
            {data.map((d, i) => {
              const h = (d.valor / max) * 100;
              const hPrev = h * (0.7 + (i % 3) * 0.08);
              return (
                <div key={d.dia} className="flex-1 flex flex-col items-center gap-2">
                  <div className="w-full flex items-end gap-1 h-full">
                    <div className="flex-1 bg-muted rounded-md" style={{ height: `${hPrev}%` }} />
                    <div className="flex-1 bg-foreground rounded-md relative group" style={{ height: `${h}%` }}>
                      <span className="absolute -top-7 left-1/2 -translate-x-1/2 text-[10px] font-semibold text-foreground bg-popover border border-border px-1.5 py-0.5 rounded opacity-0 group-hover:opacity-100 whitespace-nowrap shadow-xs/5">
                        ${(d.valor / 1000).toFixed(0)}K
                      </span>
                    </div>
                  </div>
                  <span className="text-muted-foreground text-xs">{d.dia}</span>
                </div>
              );
            })}
          </div>
        </div>
      </Card>
      <CardFrameFooter>
        <p className="flex-1 text-muted-foreground text-xs">Total semana: <span className="text-foreground font-semibold tabular-nums">${(total / 1000).toFixed(0)}K</span></p>
        <button className="text-foreground text-xs font-bold hover:underline">Ver detalle</button>
      </CardFrameFooter>
    </CardFrame>
  );
}

function TransaccionesTable({ transacciones }) {
  return (
    <CardFrame className="col-span-2">
      <CardFrameHeader>
        <CardFrameTitle>Transacciones recientes</CardFrameTitle>
        <CardFrameDescription>Últimas 6 operaciones del market activo</CardFrameDescription>
        <CardFrameAction>
          <button className="text-foreground text-xs font-bold hover:underline">Ver historial</button>
        </CardFrameAction>
      </CardFrameHeader>
      <Card>
        <div data-slot="table-container" className="overflow-x-auto">
          <table className="w-full text-sm">
            <thead>
              <tr className="text-muted-foreground text-xs uppercase tracking-wide bg-muted/40">
                <th className="text-left font-medium px-6 py-3">ID</th>
                <th className="text-left font-medium px-2 py-3">Cliente · Actividad</th>
                <th className="text-left font-medium px-2 py-3">Medio</th>
                <th className="text-right font-medium px-2 py-3">Monto</th>
                <th className="text-left font-medium px-2 py-3">Estado</th>
                <th className="text-right font-medium px-6 py-3">Fecha</th>
              </tr>
            </thead>
            <tbody>
              {transacciones.map(tx => {
                const tone = tones[estadoTone[tx.estado]] ?? tones.info;
                return (
                  <tr key={tx.id} className="border-t border-border hover:bg-muted/40 transition-colors">
                    <td className="px-6 py-3 font-medium text-foreground tabular-nums">{tx.id}</td>
                    <td className="px-2 py-3">
                      <p className="text-foreground font-medium">{tx.cliente}</p>
                      <p className="text-muted-foreground text-xs">{tx.actividad}</p>
                    </td>
                    <td className="px-2 py-3 text-muted-foreground">{tx.medio}</td>
                    <td className="px-2 py-3 text-right font-semibold text-foreground tabular-nums">{tx.monto}</td>
                    <td className="px-2 py-3">
                      <span className={`inline-flex items-center gap-1.5 text-xs font-medium px-2 py-1 rounded-lg ${tone.bg} ${tone.text}`}>
                        <span className={`w-1.5 h-1.5 rounded-full ${tone.dot}`} />
                        {tx.estado}
                      </span>
                    </td>
                    <td className="px-6 py-3 text-right text-muted-foreground text-xs">{tx.fecha}</td>
                  </tr>
                );
              })}
            </tbody>
          </table>
        </div>
      </Card>
      <CardFrameFooter>
        <p className="flex-1 text-muted-foreground text-xs">Mostrando {transacciones.length} de 2.847</p>
        <button className="text-foreground text-xs font-bold hover:underline">Cargar más</button>
      </CardFrameFooter>
    </CardFrame>
  );
}

function TopProveedores({ proveedores }) {
  const max = Math.max(...proveedores.map(p => p.entradas));
  return (
    <CardFrame>
      <CardFrameHeader>
        <CardFrameTitle>Top proveedores</CardFrameTitle>
        <CardFrameDescription>Ranking semanal por entradas vendidas</CardFrameDescription>
        <CardFrameAction>
          <button className="text-foreground text-xs font-bold hover:underline">Ver todos</button>
        </CardFrameAction>
      </CardFrameHeader>
      <Card>
        <div className="p-6 space-y-5">
          {proveedores.map((p, i) => {
            const up = p.tendencia >= 0;
            const pct = (p.entradas / max) * 100;
            return (
              <div key={p.nombre}>
                <div className="flex items-center justify-between mb-1.5">
                  <div className="flex items-center gap-2 min-w-0">
                    <span className="text-muted-foreground text-xs w-4 tabular-nums">{i + 1}</span>
                    <p className="text-foreground text-sm font-medium truncate">{p.nombre}</p>
                  </div>
                  <span className={`text-xs font-medium flex items-center gap-0.5 ${up ? 'text-success-foreground' : 'text-destructive-foreground'}`}>
                    <HugeiconsIcon icon={up ? ArrowUp01Icon : ArrowDown01Icon} className="w-3 h-3" strokeWidth={2} />
                    {Math.abs(p.tendencia).toFixed(1)}%
                  </span>
                </div>
                <div className="flex items-center gap-3">
                  <div className="flex-1 h-1.5 rounded-full bg-muted overflow-hidden">
                    <div className="h-full bg-foreground rounded-full" style={{ width: `${pct}%` }} />
                  </div>
                  <span className="text-foreground text-xs font-semibold tabular-nums w-20 text-right">{p.ventas}</span>
                </div>
                <p className="text-muted-foreground text-[11px] mt-1">{p.entradas} entradas vendidas</p>
              </div>
            );
          })}
        </div>
      </Card>
    </CardFrame>
  );
}

export default function Dashboard({ user, markets, market_activo, banner_alerta, metricas, serie_ventas, transacciones, top_proveedores }) {
  const market = markets.find(m => m.slug === market_activo) ?? markets[0];

  return (
    <AdminLayout user={user} markets={markets} market_activo={market_activo}>
      <div className="flex flex-wrap items-center justify-between gap-4">
        <div>
          <p className="text-muted-foreground text-xs">Lunes 26 de mayo · {market.nombre}</p>
          <h1 className="text-foreground text-2xl font-semibold mt-1">Buenas, {user.nombre}</h1>
          <p className="text-muted-foreground text-sm mt-1">Acá tenés un resumen de cómo viene el día en tu market.</p>
        </div>
        <div className="flex items-center gap-2">
          <div className="h-9 px-3 rounded-lg border border-border bg-card flex items-center gap-2 text-sm text-muted-foreground shadow-xs/5">
            <span className="w-2 h-2 rounded-full bg-success animate-pulse" />
            Sincronizado hace 12 min
          </div>
          <button className="h-9 px-4 rounded-lg bg-primary text-primary-foreground text-xs font-bold hover:opacity-90 transition shadow-xs/5">
            Generar reporte
          </button>
        </div>
      </div>

      <BannerAlerta mensaje={banner_alerta} />

      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        <MetricCard {...metricas.publicaciones} />
        <MetricCard {...metricas.reservas} />
        <MetricCard {...metricas.cuentas_por_cobrar} />
        <MetricCard {...metricas.cuenta_total} />
        <MetricCard {...metricas.nota} />
      </div>

      <VentasChart data={serie_ventas} />

      <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <TransaccionesTable transacciones={transacciones} />
        <TopProveedores proveedores={top_proveedores} />
      </div>
    </AdminLayout>
  );
}
