import React from 'react';
import { HugeiconsIcon } from '@hugeicons/react';
import { Chart01Icon } from '@hugeicons/core-free-icons';
import AdminLayout from '../../layouts/AdminLayout';
import PageHeader from '../../components/admin/PageHeader';
import { Card } from '../../components/ui/Card';

const reportes = [
  { titulo: 'Ventas por proveedor',  detalle: 'Detalle semanal con comisiones y descuadres' },
  { titulo: 'Conversión de carrito', detalle: 'Funnel de checkout y abandono por paso' },
  { titulo: 'Cohortes de clientes',  detalle: 'Retención y LTV por mes de registro' },
  { titulo: 'Inventario de cupos',   detalle: 'Disponibilidad por actividad y horario' },
  { titulo: 'Cashback acumulado',    detalle: 'Saldo vigente y por vencer en 30 días' },
  { titulo: 'DTE rechazados',        detalle: 'Detalle de motivos y reintentos' },
];

export default function Reportes({ user, markets, market_activo }) {
  return (
    <AdminLayout user={user} markets={markets} market_activo={market_activo}>
      <PageHeader
        title="Reportes"
        description="Análisis y exportaciones del market activo"
      />

      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        {reportes.map(r => (
          <Card key={r.titulo} className="p-5 hover:bg-muted/30 transition cursor-pointer">
            <div className="flex items-start gap-3">
              <div className="w-10 h-10 rounded-xl bg-muted flex items-center justify-center shrink-0">
                <HugeiconsIcon icon={Chart01Icon} className="w-5 h-5 text-foreground" strokeWidth={1.6} />
              </div>
              <div className="min-w-0">
                <h3 className="text-foreground font-semibold text-sm">{r.titulo}</h3>
                <p className="text-muted-foreground text-xs mt-1">{r.detalle}</p>
              </div>
            </div>
          </Card>
        ))}
      </div>
    </AdminLayout>
  );
}
