import React from 'react';
import AdminLayout from '../../layouts/AdminLayout';
import PageHeader from '../../components/admin/PageHeader';
import StatusBadge from '../../components/admin/StatusBadge';
import { Card, CardFrame, CardFrameHeader, CardFrameTitle, CardFrameDescription, CardFrameAction } from '../../components/ui/Card';

export default function Liquidaciones({ user, markets, market_activo, liquidaciones }) {
  return (
    <AdminLayout user={user} markets={markets} market_activo={market_activo}>
      <PageHeader
        title="Liquidaciones"
        description="Cierre semanal por proveedor"
        action={
          <button className="h-9 px-4 rounded-lg bg-primary text-primary-foreground text-xs font-bold hover:opacity-90 transition shadow-xs/5">
            Generar nueva
          </button>
        }
      />

      <CardFrame>
        <CardFrameHeader>
          <CardFrameTitle>Período actual</CardFrameTitle>
          <CardFrameDescription>Semana del 12 al 18 de mayo</CardFrameDescription>
          <CardFrameAction>
            <button className="text-foreground text-xs font-bold hover:underline">Exportar XLSX</button>
          </CardFrameAction>
        </CardFrameHeader>
        <Card>
          <div data-slot="table-container" className="overflow-x-auto">
            <table className="w-full text-sm">
              <thead>
                <tr className="text-muted-foreground text-xs uppercase tracking-wide bg-muted/40">
                  <th className="text-left font-medium px-6 py-3">ID</th>
                  <th className="text-left font-medium px-2 py-3">Proveedor</th>
                  <th className="text-left font-medium px-2 py-3">Período</th>
                  <th className="text-right font-medium px-2 py-3">Bruto</th>
                  <th className="text-right font-medium px-2 py-3">Neto</th>
                  <th className="text-left font-medium px-6 py-3">Estado</th>
                </tr>
              </thead>
              <tbody>
                {liquidaciones.map(l => (
                  <tr key={l.id} className="border-t border-border hover:bg-muted/40 transition-colors">
                    <td className="px-6 py-3 font-medium text-foreground tabular-nums">{l.id}</td>
                    <td className="px-2 py-3 text-foreground">{l.proveedor}</td>
                    <td className="px-2 py-3 text-muted-foreground">{l.periodo}</td>
                    <td className="px-2 py-3 text-right font-semibold text-foreground tabular-nums">{l.bruto}</td>
                    <td className="px-2 py-3 text-right font-semibold text-foreground tabular-nums">{l.neto}</td>
                    <td className="px-6 py-3"><StatusBadge status={l.estado} /></td>
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
