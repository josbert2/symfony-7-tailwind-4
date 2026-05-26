import React from 'react';
import { cn } from '../../lib/cn';

const map = {
  activo:     { bg: 'bg-success/15',     text: 'text-success-foreground',     dot: 'bg-success' },
  publicada:  { bg: 'bg-success/15',     text: 'text-success-foreground',     dot: 'bg-success' },
  pagada:     { bg: 'bg-success/15',     text: 'text-success-foreground',     dot: 'bg-success' },
  emitida:    { bg: 'bg-success/15',     text: 'text-success-foreground',     dot: 'bg-success' },
  pausado:    { bg: 'bg-muted',          text: 'text-muted-foreground',       dot: 'bg-muted-foreground' },
  borrador:   { bg: 'bg-muted',          text: 'text-muted-foreground',       dot: 'bg-muted-foreground' },
  pendiente:  { bg: 'bg-warning/15',     text: 'text-warning-foreground',     dot: 'bg-warning' },
  descuadre:  { bg: 'bg-warning/15',     text: 'text-warning-foreground',     dot: 'bg-warning' },
  rechazada:  { bg: 'bg-destructive/15', text: 'text-destructive-foreground', dot: 'bg-destructive' },
};

export default function StatusBadge({ status, className }) {
  const t = map[status] ?? map.borrador;
  return (
    <span className={cn(
      'inline-flex items-center gap-1.5 text-xs font-medium px-2 py-1 rounded-lg',
      t.bg, t.text, className,
    )}>
      <span className={cn('w-1.5 h-1.5 rounded-full', t.dot)} />
      {status}
    </span>
  );
}
