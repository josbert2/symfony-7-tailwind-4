import React from 'react';

export default function PageHeader({ title, description, action, children }) {
  return (
    <div className="flex flex-wrap items-start justify-between gap-4">
      <div>
        <h1 className="text-foreground text-2xl font-semibold">{title}</h1>
        {description && <p className="text-muted-foreground text-sm mt-1">{description}</p>}
        {children}
      </div>
      {action && <div className="flex items-center gap-2">{action}</div>}
    </div>
  );
}
