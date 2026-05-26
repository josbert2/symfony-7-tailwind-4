import React from 'react';
import AdminLayout from '../../layouts/AdminLayout';
import PageHeader from '../../components/admin/PageHeader';
import { Card, CardFrame, CardFrameHeader, CardFrameTitle, CardFrameDescription, CardFrameFooter } from '../../components/ui/Card';

export default function Usuarios({ user, markets, market_activo, usuarios, total }) {
  return (
    <AdminLayout user={user} markets={markets} market_activo={market_activo}>
      <PageHeader
        title="Usuarios"
        description={`${total.toLocaleString('es-CL')} cuentas registradas en la plataforma`}
      />

      <CardFrame>
        <CardFrameHeader>
          <CardFrameTitle>Cuentas</CardFrameTitle>
          <CardFrameDescription>Clientes, proveedores y staff interno</CardFrameDescription>
        </CardFrameHeader>
        <Card>
          <div data-slot="table-container" className="overflow-x-auto">
            <table className="w-full text-sm">
              <thead>
                <tr className="text-muted-foreground text-xs uppercase tracking-wide bg-muted/40">
                  <th className="text-left font-medium px-6 py-3">Nombre</th>
                  <th className="text-left font-medium px-2 py-3">Email</th>
                  <th className="text-left font-medium px-2 py-3">Rol</th>
                  <th className="text-left font-medium px-2 py-3">Markets</th>
                  <th className="text-right font-medium px-6 py-3">Último login</th>
                </tr>
              </thead>
              <tbody>
                {usuarios.map(u => (
                  <tr key={u.id} className="border-t border-border hover:bg-muted/40 transition-colors">
                    <td className="px-6 py-3">
                      <div className="flex items-center gap-2.5">
                        <span className="w-7 h-7 rounded-full bg-muted text-foreground flex items-center justify-center text-xs font-semibold">
                          {u.nombre.slice(0, 1).toUpperCase()}
                        </span>
                        <span className="font-medium text-foreground">{u.nombre}</span>
                      </div>
                    </td>
                    <td className="px-2 py-3 text-muted-foreground">{u.email}</td>
                    <td className="px-2 py-3">
                      <span className="inline-flex text-xs font-medium px-2 py-1 rounded-lg bg-muted text-muted-foreground">{u.rol}</span>
                    </td>
                    <td className="px-2 py-3">
                      <div className="flex items-center gap-1">
                        {u.markets[0] === '*'
                          ? <span className="text-xs text-muted-foreground italic">todos</span>
                          : u.markets.map(slug => {
                              const m = markets.find(mk => mk.slug === slug);
                              return (
                                <span key={slug} className="w-2 h-2 rounded-full" style={{ background: m?.color ?? '#999' }} title={m?.nombre ?? slug} />
                              );
                            })}
                      </div>
                    </td>
                    <td className="px-6 py-3 text-right text-muted-foreground text-xs">{u.ultimo_login}</td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </Card>
        <CardFrameFooter>
          <p className="flex-1 text-muted-foreground text-xs">Mostrando {usuarios.length} de {total.toLocaleString('es-CL')}</p>
          <button className="text-foreground text-xs font-bold hover:underline">Cargar más</button>
        </CardFrameFooter>
      </CardFrame>
    </AdminLayout>
  );
}
