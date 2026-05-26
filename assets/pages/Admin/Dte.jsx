import React from 'react';
import AdminLayout from '../../layouts/AdminLayout';
import PageHeader from '../../components/admin/PageHeader';
import StatusBadge from '../../components/admin/StatusBadge';
import { Card, CardFrame, CardFrameHeader, CardFrameTitle, CardFrameDescription, CardFrameAction } from '../../components/ui/Card';

export default function Dte({ user, markets, market_activo, dte, pendientes }) {
  return (
    <AdminLayout user={user} markets={markets} market_activo={market_activo}>
      <PageHeader
        title="DTE / Boletas"
        description={`Emisión vía bsale · ${pendientes} pendientes de reintento`}
        action={
          <button className="h-9 px-4 rounded-lg bg-primary text-primary-foreground text-xs font-bold hover:opacity-90 transition shadow-xs/5">
            Reintentar pendientes
          </button>
        }
      />

      <div className="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <Card className="p-5">
          <p className="text-muted-foreground text-xs uppercase tracking-wide">Emitidas hoy</p>
          <p className="text-foreground text-2xl font-semibold mt-2 tabular-nums">128</p>
        </Card>
        <Card className="p-5">
          <p className="text-muted-foreground text-xs uppercase tracking-wide">Rechazadas hoy</p>
          <p className="text-foreground text-2xl font-semibold mt-2 tabular-nums">3</p>
        </Card>
        <Card className="p-5">
          <p className="text-muted-foreground text-xs uppercase tracking-wide">Monto facturado</p>
          <p className="text-foreground text-2xl font-semibold mt-2 tabular-nums">$3.842K</p>
        </Card>
      </div>

      <CardFrame>
        <CardFrameHeader>
          <CardFrameTitle>Últimos documentos</CardFrameTitle>
          <CardFrameDescription>Emisión electrónica en orden cronológico</CardFrameDescription>
          <CardFrameAction>
            <button className="text-foreground text-xs font-bold hover:underline">Ver todos</button>
          </CardFrameAction>
        </CardFrameHeader>
        <Card>
          <div data-slot="table-container" className="overflow-x-auto">
            <table className="w-full text-sm">
              <thead>
                <tr className="text-muted-foreground text-xs uppercase tracking-wide bg-muted/40">
                  <th className="text-left font-medium px-6 py-3">ID</th>
                  <th className="text-left font-medium px-2 py-3">Folio</th>
                  <th className="text-left font-medium px-2 py-3">Tipo</th>
                  <th className="text-left font-medium px-2 py-3">RUT</th>
                  <th className="text-right font-medium px-2 py-3">Monto</th>
                  <th className="text-left font-medium px-2 py-3">Estado</th>
                  <th className="text-right font-medium px-6 py-3">Fecha</th>
                </tr>
              </thead>
              <tbody>
                {dte.map(d => (
                  <tr key={d.id} className="border-t border-border hover:bg-muted/40 transition-colors">
                    <td className="px-6 py-3 font-medium text-foreground tabular-nums">{d.id}</td>
                    <td className="px-2 py-3 text-muted-foreground tabular-nums">{d.folio}</td>
                    <td className="px-2 py-3 text-muted-foreground">{d.tipo}</td>
                    <td className="px-2 py-3 text-muted-foreground tabular-nums">{d.rut}</td>
                    <td className="px-2 py-3 text-right font-semibold text-foreground tabular-nums">{d.monto}</td>
                    <td className="px-2 py-3"><StatusBadge status={d.estado} /></td>
                    <td className="px-6 py-3 text-right text-muted-foreground text-xs">{d.fecha}</td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </Card>
      </CardFrame>
    </AdminLayout>
  );
}
