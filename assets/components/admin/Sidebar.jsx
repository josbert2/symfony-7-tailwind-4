import React from 'react';
import { Link, usePage } from '@inertiajs/react';
import { HugeiconsIcon } from '@hugeicons/react';
import {
  DashboardSquare01Icon,
  Store01Icon,
  Calendar01Icon,
  CreditCardAcceptIcon,
  Invoice01Icon,
  File01Icon,
  UserMultiple02Icon,
  Chart01Icon,
  Settings01Icon,
  ArrowDown01Icon,
  Logout01Icon,
} from '@hugeicons/core-free-icons';
import { cn } from '../../lib/cn';

const navGroups = [
  {
    label: 'General',
    items: [
      { icon: DashboardSquare01Icon,  label: 'Dashboard',     href: '/admin' },
    ],
  },
  {
    label: 'Operación',
    items: [
      { icon: Store01Icon,           label: 'Proveedores',   href: '/admin/proveedores',   badge: '47' },
      { icon: Calendar01Icon,        label: 'Actividades',   href: '/admin/actividades' },
      { icon: CreditCardAcceptIcon,  label: 'Transacciones', href: '/admin/transacciones', badge: '12' },
    ],
  },
  {
    label: 'Finanzas',
    items: [
      { icon: Invoice01Icon,         label: 'Liquidaciones', href: '/admin/liquidaciones' },
      { icon: File01Icon,            label: 'DTE / Boletas', href: '/admin/dte', badge: '3', badgeTone: 'warning' },
    ],
  },
  {
    label: 'Sistema',
    items: [
      { icon: UserMultiple02Icon,    label: 'Usuarios',      href: '/admin/usuarios' },
      { icon: Chart01Icon,           label: 'Reportes',      href: '/admin/reportes' },
      { icon: Settings01Icon,        label: 'Configuración', href: '/admin/configuracion' },
    ],
  },
];

function isActive(currentUrl, href) {
  if (href === '/admin') return currentUrl === '/admin' || currentUrl === '/admin/';
  return currentUrl === href || currentUrl.startsWith(href + '/');
}

export default function Sidebar({ user, marketActivo, markets }) {
  const { url } = usePage();
  const market = markets.find(m => m.slug === marketActivo) ?? markets[0];

  return (
    <aside className="w-64 shrink-0  bg-[#FAFAFA] flex flex-col">
      <div className="px-6 py-5 ">
        <div className="flex items-center gap-2.5">
          <div className="w-9 h-9 rounded-xl bg-primary text-primary-foreground flex items-center justify-center font-bold">B</div>
          <div>
            <p className="text-foreground font-semibold text-sm leading-tight">Bookforce</p>
            <p className="text-muted-foreground text-xs">Admin</p>
          </div>
        </div>
      </div>

      <div className="px-3 py-3 border-b border-sidebar-border">
        <button className="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-sidebar-accent transition">
          <span className="w-7 h-7 rounded-lg flex items-center justify-center text-white text-xs font-bold" style={{ background: market.color }}>
            {market.nombre.slice(0, 2).toUpperCase()}
          </span>
          <div className="flex-1 text-left">
            <p className="text-foreground text-sm font-medium leading-tight">{market.nombre}</p>
            <p className="text-muted-foreground text-[11px]">Market activo</p>
          </div>
          <HugeiconsIcon icon={ArrowDown01Icon} className="w-4 h-4 text-muted-foreground" strokeWidth={1.6} />
        </button>
      </div>

      <nav className="flex-1 px-3 py-4 overflow-y-auto">
        {navGroups.map(group => (
          <div key={group.label} className="mb-5 last:mb-0">
            <p className="px-3 mb-1.5 text-[10px] font-semibold uppercase tracking-wider text-muted-foreground">{group.label}</p>
            <div className="space-y-0.5">
              {group.items.map(item => {
                const active = isActive(url, item.href);
                return (
                  <Link
                    key={item.href}
                    href={item.href}
                    className={cn(
                      'flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-bold transition',
                      active
                        ? 'bg-card text-foreground shadow-xs/5 border border-border'
                        : 'text-sidebar-foreground hover:bg-sidebar-accent hover:text-foreground',
                    )}
                  >
                    <HugeiconsIcon icon={item.icon} className="w-5 h-5" strokeWidth={1.6} />
                    <span className="flex-1">{item.label}</span>
                    {item.badge && (
                      <span className={cn(
                        'text-[11px] font-semibold px-1.5 py-0.5 rounded-md',
                        item.badgeTone === 'warning'
                          ? 'bg-warning/15 text-warning-foreground'
                          : active
                            ? 'bg-primary text-primary-foreground'
                            : 'bg-muted text-muted-foreground',
                      )}>{item.badge}</span>
                    )}
                  </Link>
                );
              })}
            </div>
          </div>
        ))}
      </nav>

      <div className="p-3 border-t border-sidebar-border">
        <div className="rounded-2xl bg-card border border-border p-3 flex items-center gap-3 shadow-xs/5">
          <div className="w-9 h-9 rounded-full bg-primary text-primary-foreground flex items-center justify-center text-sm font-semibold">
            {user.nombre.slice(0, 1).toUpperCase()}
          </div>
          <div className="flex-1 min-w-0">
            <p className="text-foreground text-sm font-medium truncate">{user.nombre}</p>
            <p className="text-muted-foreground text-[11px] truncate">{user.rol}</p>
          </div>
          <button className="text-muted-foreground hover:text-foreground" title="Salir">
            <HugeiconsIcon icon={Logout01Icon} className="w-4 h-4" strokeWidth={1.6} />
          </button>
        </div>
      </div>
    </aside>
  );
}
