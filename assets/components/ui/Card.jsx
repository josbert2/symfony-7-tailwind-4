import React from 'react';
import { cn } from '../../lib/cn';

export function Card({ className, ...props }) {
  return (
    <div
      data-slot="card"
      className={cn(
        "relative flex flex-col rounded-2xl border border-border bg-card not-dark:bg-clip-padding text-card-foreground shadow-xs/5 before:pointer-events-none before:absolute before:inset-0 before:rounded-[calc(var(--radius-2xl)-1px)] before:shadow-[0_1px_--theme(--color-black/4%)] dark:before:shadow-[0_-1px_--theme(--color-white/6%)]",
        className,
      )}
      {...props}
    />
  );
}

export function CardFrame({ className, ...props }) {
  return (
    <div
      data-slot="card-frame"
      className={cn(
        "relative flex flex-col rounded-2xl border border-border bg-card not-dark:bg-clip-padding text-card-foreground shadow-xs/5 [--clip-bottom:-1rem] [--clip-top:-1rem] before:pointer-events-none before:absolute before:inset-0 before:rounded-[calc(var(--radius-2xl)-1px)] before:bg-muted/72 before:shadow-[0_1px_--theme(--color-black/4%)] has-data-[slot=table-container]:overflow-hidden *:data-[slot=card]:-m-px *:data-[slot=table-container]:-m-px *:data-[slot=table-container]:w-[calc(100%+2px)] *:not-first:data-[slot=card]:rounded-t-xl *:not-last:data-[slot=card]:rounded-b-xl *:data-[slot=card]:bg-clip-padding *:data-[slot=card]:shadow-none *:data-[slot=card]:before:hidden *:not-first:data-[slot=card]:before:rounded-t-[calc(var(--radius-xl)-1px)] *:not-last:data-[slot=card]:before:rounded-b-[calc(var(--radius-xl)-1px)] dark:before:shadow-[0_-1px_--theme(--color-white/6%)] *:data-[slot=card]:[clip-path:inset(var(--clip-top)_1px_var(--clip-bottom)_1px_round_calc(var(--radius-2xl)-1px))] *:data-[slot=card]:last:[--clip-bottom:1px] *:data-[slot=card]:first:[--clip-top:1px] after:pointer-events-none after:absolute after:-inset-[5px] after:-z-1 after:rounded-[calc(var(--radius-xl)+4px)] after:border after:border-border/64 dark:bg-background",
        className,
      )}
      {...props}
    />
  );
}

export function CardFrameHeader({ className, ...props }) {
  return (
    <div
      data-slot="card-frame-header"
      className={cn(
        "relative grid auto-rows-min grid-rows-[auto_auto] items-start gap-x-4 px-6 py-4 has-data-[slot=card-frame-action]:grid-cols-[1fr_auto]",
        className,
      )}
      {...props}
    />
  );
}

export function CardFrameTitle({ className, ...props }) {
  return (
    <div
      data-slot="card-frame-title"
      className={cn("self-center font-semibold text-sm", className)}
      {...props}
    />
  );
}

export function CardFrameDescription({ className, ...props }) {
  return (
    <div
      data-slot="card-frame-description"
      className={cn("self-center text-muted-foreground text-sm", className)}
      {...props}
    />
  );
}

export function CardFrameAction({ className, ...props }) {
  return (
    <div
      data-slot="card-frame-action"
      className={cn(
        "col-start-2 nth-3:row-span-2 nth-3:row-start-1 inline-flex self-center justify-self-end gap-1.5",
        className,
      )}
      {...props}
    />
  );
}

export function CardFrameFooter({ className, ...props }) {
  return (
    <div
      data-slot="card-frame-footer"
      className={cn("flex items-center gap-3 p-2", className)}
      {...props}
    />
  );
}

export function CardHeader({ className, ...props }) {
  return (
    <div
      data-slot="card-header"
      className={cn(
        "grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 p-6 in-[[data-slot=card]:has(>[data-slot=card-panel])]:pb-4 has-data-[slot=card-action]:grid-cols-[1fr_auto]",
        className,
      )}
      {...props}
    />
  );
}

export function CardTitle({ className, ...props }) {
  return (
    <div
      data-slot="card-title"
      className={cn("font-semibold text-lg leading-none", className)}
      {...props}
    />
  );
}

export function CardDescription({ className, ...props }) {
  return (
    <div
      data-slot="card-description"
      className={cn("text-muted-foreground text-sm", className)}
      {...props}
    />
  );
}

export function CardPanel({ className, ...props }) {
  return (
    <div
      data-slot="card-panel"
      className={cn(
        "flex-1 p-6 in-[[data-slot=card]:has(>[data-slot=card-header]:not(.border-b))]:pt-0 in-[[data-slot=card]:has(>[data-slot=card-footer]:not(.border-t))]:pb-0",
        className,
      )}
      {...props}
    />
  );
}

export function CardFooter({ className, ...props }) {
  return (
    <div
      data-slot="card-footer"
      className={cn(
        "flex items-center p-6 in-[[data-slot=card]:has(>[data-slot=card-panel])]:pt-4",
        className,
      )}
      {...props}
    />
  );
}

export { CardPanel as CardContent };
