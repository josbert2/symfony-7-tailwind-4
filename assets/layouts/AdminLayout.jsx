import React from 'react';
import Sidebar from '../components/admin/Sidebar';
import Topbar from '../components/admin/Topbar';

export default function AdminLayout({ user, markets, market_activo, children }) {
  return (
    <div className="min-h-screen bg-[#FAFAFA] flex">
      <Sidebar user={user} markets={markets} marketActivo={market_activo} />
      <div className="flex-1 flex flex-col min-w-0 p-2 pl-0">
        <main className="flex-1 overflow-y-auto p-6 space-y-6 rounded-2xl border border-border bg-background shadow-xs/5">
          {children}
        </main>
      </div>
    </div>
  );
}
