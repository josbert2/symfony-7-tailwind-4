import React from 'react';
import AdminLayout from '../../layouts/AdminLayout';
import PageHeader from '../../components/admin/PageHeader';
import { Card, CardFrame, CardFrameHeader, CardFrameTitle, CardFrameDescription } from '../../components/ui/Card';

const secciones = [
  {
    titulo: 'General',
    items: [
      { label: 'Markets y dominios',        detalle: 'Hostname, slug, branding por market' },
      { label: 'Roles y permisos',          detalle: 'Jerarquía de roles del sistema' },
      { label: 'Notificaciones',            detalle: 'Mails transaccionales y push' },
    ],
  },
  {
    titulo: 'Integraciones',
    items: [
      { label: 'bsale (DTE)',                detalle: 'Tokens y endpoints por proveedor' },
      { label: 'Webpay / OneClick',          detalle: 'Credenciales de Transbank' },
      { label: 'Multivende',                 detalle: 'Sync de inventario y ventas' },
      { label: 'Enviame',                    detalle: 'Cotización y tracking de despachos' },
    ],
  },
  {
    titulo: 'Avanzado',
    items: [
      { label: 'Variables de entorno',       detalle: 'Configuración por ambiente' },
      { label: 'Logs y auditoría',           detalle: 'Historial de cambios sensibles' },
      { label: 'API Keys',                   detalle: 'Tokens públicos y secretos' },
    ],
  },
];

export default function Configuracion({ user, markets, market_activo }) {
  return (
    <AdminLayout user={user} markets={markets} market_activo={market_activo}>
      <PageHeader
        title="Configuración"
        description="Ajustes globales de la plataforma"
      />

      <div className="space-y-6">
        {secciones.map(s => (
          <CardFrame key={s.titulo}>
            <CardFrameHeader>
              <CardFrameTitle>{s.titulo}</CardFrameTitle>
              <CardFrameDescription>{s.items.length} ajustes disponibles</CardFrameDescription>
            </CardFrameHeader>
            <Card>
              <div className="divide-y divide-border">
                {s.items.map(it => (
                  <button key={it.label} className="w-full flex items-center gap-4 px-6 py-4 hover:bg-muted/40 transition text-left">
                    <div className="flex-1 min-w-0">
                      <p className="text-foreground font-medium text-sm">{it.label}</p>
                      <p className="text-muted-foreground text-xs mt-0.5">{it.detalle}</p>
                    </div>
                    <span className="text-muted-foreground text-xs">Configurar →</span>
                  </button>
                ))}
              </div>
            </Card>
          </CardFrame>
        ))}
      </div>
    </AdminLayout>
  );
}
