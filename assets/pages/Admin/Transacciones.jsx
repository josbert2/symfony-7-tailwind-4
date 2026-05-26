import React from 'react';
import AdminLayout from '../../layouts/AdminLayout';
import PageHeader from '../../components/admin/PageHeader';
import StatusBadge from '../../components/admin/StatusBadge';
import { Card, CardFrame, CardFrameHeader, CardFrameTitle, CardFrameDescription, CardFrameFooter } from '../../components/ui/Card';

export default function Transacciones({ user, markets, market_activo, transacciones }) {
  return (
    <AdminLayout user={user} markets={markets} market_activo={market_activo}>
      <PageHeader
        title="Transacciones"
        description="Historial completo de pagos del market activo"
      />

      <CardFrame>
        <CardFrameHeader>
          <CardFrameTitle>Operaciones</CardFrameTitle>
          <CardFrameDescription>Pagos procesados por Webpay, OneClick y transferencia</CardFrameDescription>
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
                {transacciones.map(tx => (
                  <tr key={tx.id} className="border-t border-border hover:bg-muted/40 transition-colors">
                    <td className="px-6 py-3 font-medium text-foreground tabular-nums">{tx.id}</td>
                    <td className="px-2 py-3">
                      <p className="text-foreground font-medium">{tx.cliente}</p>
                      <p className="text-muted-foreground text-xs">{tx.actividad}</p>
                    </td>
                    <td className="px-2 py-3 text-muted-foreground">{tx.medio}</td>
                    <td className="px-2 py-3 text-right font-semibold text-foreground tabular-nums">{tx.monto}</td>
                    <td className="px-2 py-3"><StatusBadge status={tx.estado} /></td>
                    <td className="px-6 py-3 text-right text-muted-foreground text-xs">{tx.fecha}</td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </Card>
        <CardFrameFooter>
          <p className="flex-1 text-muted-foreground text-xs">Mostrando {transacciones.length} de 2.847</p>
          <button className="text-foreground text-xs font-bold hover:underline">Cargar más</button>
        </CardFrameFooter>
      </CardFrame>
    </AdminLayout>
  );
}
