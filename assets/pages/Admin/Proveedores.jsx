import React from 'react';
import { HugeiconsIcon } from '@hugeicons/react';
import { PlusSignIcon } from '@hugeicons/core-free-icons';
import AdminLayout from '../../layouts/AdminLayout';
import PageHeader from '../../components/admin/PageHeader';
import StatusBadge from '../../components/admin/StatusBadge';
import { Card, CardFrame, CardFrameHeader, CardFrameTitle, CardFrameDescription, CardFrameAction, CardFrameFooter } from '../../components/ui/Card';

export default function Proveedores({ user, markets, market_activo, proveedores, total }) {
  return (
    <AdminLayout user={user} markets={markets} market_activo={market_activo}>
      <PageHeader
        title="Proveedores"
        description={`${total} proveedores registrados en la plataforma`}
        action={
          <button className="h-9 px-4 rounded-lg bg-primary text-primary-foreground text-xs font-bold hover:opacity-90 transition shadow-xs/5 flex items-center gap-2">
            <HugeiconsIcon icon={PlusSignIcon} className="w-4 h-4" strokeWidth={1.6} />
            Nuevo proveedor
          </button>
        }
      />

      <CardFrame>
        <CardFrameHeader>
          <CardFrameTitle>Listado</CardFrameTitle>
          <CardFrameDescription>Filtrá por market, plan o estado desde la topbar</CardFrameDescription>
          <CardFrameAction>
            <button className="text-foreground text-xs font-bold hover:underline">Importar CSV</button>
          </CardFrameAction>
        </CardFrameHeader>
        <Card>
          <div data-slot="table-container" className="overflow-x-auto">
            <table className="w-full text-sm">
              <thead>
                <tr className="text-muted-foreground text-xs uppercase tracking-wide bg-muted/40">
                  <th className="text-left font-medium px-6 py-3">Proveedor</th>
                  <th className="text-left font-medium px-2 py-3">RUT</th>
                  <th className="text-left font-medium px-2 py-3">Market</th>
                  <th className="text-left font-medium px-2 py-3">Plan</th>
                  <th className="text-left font-medium px-2 py-3">Estado</th>
                  <th className="text-right font-medium px-2 py-3">Actividades</th>
                  <th className="text-right font-medium px-6 py-3">Ventas mes</th>
                </tr>
              </thead>
              <tbody>
                {proveedores.map(p => {
                  const m = markets.find(mk => mk.slug === p.market);
                  return (
                    <tr key={p.id} className="border-t border-border hover:bg-muted/40 transition-colors">
                      <td className="px-6 py-3 font-medium text-foreground">{p.nombre}</td>
                      <td className="px-2 py-3 text-muted-foreground tabular-nums">{p.rut}</td>
                      <td className="px-2 py-3">
                        <span className="inline-flex items-center gap-1.5 text-xs">
                          <span className="w-2 h-2 rounded-full" style={{ background: m?.color ?? '#999' }} />
                          <span className="text-muted-foreground">{m?.nombre ?? p.market}</span>
                        </span>
                      </td>
                      <td className="px-2 py-3 text-muted-foreground">{p.plan}</td>
                      <td className="px-2 py-3"><StatusBadge status={p.estado} /></td>
                      <td className="px-2 py-3 text-right text-foreground tabular-nums">{p.actividades}</td>
                      <td className="px-6 py-3 text-right font-semibold text-foreground tabular-nums">{p.ventas_mes}</td>
                    </tr>
                  );
                })}
              </tbody>
            </table>
          </div>
        </Card>
        <CardFrameFooter>
          <p className="flex-1 text-muted-foreground text-xs">Mostrando {proveedores.length} de {total}</p>
          <button className="text-foreground text-xs font-bold hover:underline">Cargar más</button>
        </CardFrameFooter>
      </CardFrame>
    </AdminLayout>
  );
}
