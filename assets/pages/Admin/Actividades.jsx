import React from 'react';
import { HugeiconsIcon } from '@hugeicons/react';
import { PlusSignIcon } from '@hugeicons/core-free-icons';
import AdminLayout from '../../layouts/AdminLayout';
import PageHeader from '../../components/admin/PageHeader';
import StatusBadge from '../../components/admin/StatusBadge';
import { Card, CardFrame, CardFrameHeader, CardFrameTitle, CardFrameDescription, CardFrameAction, CardFrameFooter } from '../../components/ui/Card';

export default function Actividades({ user, markets, market_activo, actividades, total }) {
  return (
    <AdminLayout user={user} markets={markets} market_activo={market_activo}>
      <PageHeader
        title="Actividades"
        description={`${total} actividades publicadas en la plataforma`}
        action={
          <button className="h-9 px-4 rounded-lg bg-primary text-primary-foreground text-xs font-bold hover:opacity-90 transition shadow-xs/5 flex items-center gap-2">
            <HugeiconsIcon icon={PlusSignIcon} className="w-4 h-4" strokeWidth={1.6} />
            Nueva actividad
          </button>
        }
      />

      <CardFrame>
        <CardFrameHeader>
          <CardFrameTitle>Catálogo</CardFrameTitle>
          <CardFrameDescription>Actividades vinculadas a proveedores y categorías</CardFrameDescription>
        </CardFrameHeader>
        <Card>
          <div data-slot="table-container" className="overflow-x-auto">
            <table className="w-full text-sm">
              <thead>
                <tr className="text-muted-foreground text-xs uppercase tracking-wide bg-muted/40">
                  <th className="text-left font-medium px-6 py-3">Actividad</th>
                  <th className="text-left font-medium px-2 py-3">Proveedor</th>
                  <th className="text-left font-medium px-2 py-3">Categoría</th>
                  <th className="text-right font-medium px-2 py-3">Precio desde</th>
                  <th className="text-left font-medium px-2 py-3">Estado</th>
                  <th className="text-right font-medium px-6 py-3">Ventas</th>
                </tr>
              </thead>
              <tbody>
                {actividades.map(a => (
                  <tr key={a.id} className="border-t border-border hover:bg-muted/40 transition-colors">
                    <td className="px-6 py-3 font-medium text-foreground">{a.nombre}</td>
                    <td className="px-2 py-3 text-muted-foreground">{a.proveedor}</td>
                    <td className="px-2 py-3 text-muted-foreground">{a.categoria}</td>
                    <td className="px-2 py-3 text-right font-semibold text-foreground tabular-nums">{a.precio_desde}</td>
                    <td className="px-2 py-3"><StatusBadge status={a.estado} /></td>
                    <td className="px-6 py-3 text-right text-foreground tabular-nums">{a.ventas}</td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </Card>
        <CardFrameFooter>
          <p className="flex-1 text-muted-foreground text-xs">Mostrando {actividades.length} de {total}</p>
          <button className="text-foreground text-xs font-bold hover:underline">Cargar más</button>
        </CardFrameFooter>
      </CardFrame>
    </AdminLayout>
  );
}
