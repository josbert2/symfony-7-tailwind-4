<?php

namespace App\Service;

/**
 * Datos mock para el panel admin mientras no hay backend real.
 * Cada método devuelve los props que consume una page Inertia específica.
 */
class AdminMockDataService
{
    public function sharedProps(string $marketActivo = 'entrekids'): array
    {
        return [
            'user' => [
                'nombre' => 'Josbert',
                'rol' => 'Super Admin',
                'avatar' => null,
            ],
            'markets' => $this->markets(),
            'market_activo' => $marketActivo,
        ];
    }

    public function dashboard(): array
    {
        return [
            'banner_alerta' => 'Hay 3 DTE pendientes de emisión, 1 liquidación con descuadre y 47 entradas próximas a vencer su período de canje. Revisar antes del cierre de mes para evitar reprocesos manuales y bloqueos en la conciliación con bsale.',
            'metricas' => [
                'publicaciones' => [
                    'titulo' => 'Publicaciones',
                    'subtitulo' => 'próximos 7 días',
                    'items' => [
                        ['icon' => 'cupos',      'label' => 'cupos',      'valor' => '5.500'],
                        ['icon' => 'descuentos', 'label' => 'descuentos', 'valor' => '0%'],
                        ['icon' => 'totales',    'label' => 'totales',    'valor' => '$181.800.000'],
                    ],
                ],
                'reservas' => [
                    'titulo' => 'Reservas',
                    'subtitulo' => 'próximos 7 días',
                    'items' => [
                        ['icon' => 'cupos',      'label' => 'cupos',      'valor' => '1.284'],
                        ['icon' => 'descuentos', 'label' => 'descuentos', 'valor' => '4%'],
                        ['icon' => 'totales',    'label' => 'totales',    'valor' => '$42.380.000'],
                    ],
                ],
                'cuentas_por_cobrar' => [
                    'titulo' => 'Cuentas por cobrar',
                    'subtitulo' => 'al cierre de hoy',
                    'items' => [
                        ['icon' => 'totales', 'label' => 'pendiente', 'valor' => '$3.842.500'],
                        ['icon' => 'totales', 'label' => 'vencido',   'valor' => '$642.800'],
                    ],
                ],
                'cuenta_total' => [
                    'titulo' => 'Cuenta total',
                    'valor' => '$4.821K',
                    'destacado' => true,
                ],
                'nota' => [
                    'titulo' => 'Nota 4,8',
                    'subtitulo' => 'reseña entrekids',
                ],
            ],
            'serie_ventas' => [
                ['dia' => 'Lun', 'valor' => 2840000],
                ['dia' => 'Mar', 'valor' => 3120000],
                ['dia' => 'Mié', 'valor' => 2950000],
                ['dia' => 'Jue', 'valor' => 4210000],
                ['dia' => 'Vie', 'valor' => 5180000],
                ['dia' => 'Sáb', 'valor' => 6240000],
                ['dia' => 'Dom', 'valor' => 4821300],
            ],
            'transacciones' => array_slice($this->transacciones(), 0, 6),
            'top_proveedores' => [
                ['nombre' => 'Granja Educativa Las Vertientes', 'ventas' => '$2.140.300', 'entradas' => 412, 'tendencia' => 18.2],
                ['nombre' => 'Museo Interactivo Mirador',       'ventas' => '$1.680.500', 'entradas' => 305, 'tendencia' => 9.4],
                ['nombre' => 'Cine en el Parque',               'ventas' => '$1.120.000', 'entradas' => 248, 'tendencia' => 5.1],
                ['nombre' => 'Taller La Rueda',                 'ventas' => '$642.800',   'entradas' => 84,  'tendencia' => -3.2],
            ],
            'alertas' => [
                ['tono' => 'warning', 'titulo' => '3 DTE pendientes de emisión',         'detalle' => 'bsale rechazó la última corrida automática'],
                ['tono' => 'error',   'titulo' => 'Liquidación semanal con descuadre',   'detalle' => 'Diferencia de $48.200 entre Webpay y caja'],
                ['tono' => 'success', 'titulo' => 'Sync Multivende OK',                  'detalle' => 'Última corrida hace 12 min, 0 errores'],
            ],
        ];
    }

    public function proveedores(): array
    {
        return [
            'proveedores' => [
                ['id' => 1,  'nombre' => 'Granja Educativa Las Vertientes', 'rut' => '76.123.456-7', 'market' => 'entrekids',    'plan' => 'Plus',     'estado' => 'activo',    'actividades' => 12, 'ventas_mes' => '$8.420.300'],
                ['id' => 2,  'nombre' => 'Museo Interactivo Mirador',       'rut' => '70.456.789-2', 'market' => 'entrekids',    'plan' => 'Pro',      'estado' => 'activo',    'actividades' => 8,  'ventas_mes' => '$5.180.500'],
                ['id' => 3,  'nombre' => 'Cine en el Parque',               'rut' => '76.789.012-1', 'market' => 'entreadultos', 'plan' => 'Básico',   'estado' => 'activo',    'actividades' => 4,  'ventas_mes' => '$2.340.000'],
                ['id' => 4,  'nombre' => 'Taller La Rueda',                 'rut' => '77.234.567-8', 'market' => 'entrekids',    'plan' => 'Pro',      'estado' => 'activo',    'actividades' => 6,  'ventas_mes' => '$1.842.800'],
                ['id' => 5,  'nombre' => 'Evenclub Bookforce',              'rut' => '76.987.654-3', 'market' => 'evenclub',     'plan' => 'Plus',     'estado' => 'pausado',   'actividades' => 0,  'ventas_mes' => '$0'],
                ['id' => 6,  'nombre' => 'Estudio Bilingüe Norte',          'rut' => '78.345.678-9', 'market' => 'entrekids',    'plan' => 'Básico',   'estado' => 'pendiente', 'actividades' => 2,  'ventas_mes' => '$340.000'],
            ],
            'total' => 47,
        ];
    }

    public function actividades(): array
    {
        return [
            'actividades' => [
                ['id' => 1,  'nombre' => 'Visita guiada · Tarde familiar',   'proveedor' => 'Granja Educativa Las Vertientes', 'categoria' => 'Educativo', 'precio_desde' => '$8.900',  'estado' => 'publicada', 'ventas' => 412],
                ['id' => 2,  'nombre' => 'Función 19:30 · Sala 2',           'proveedor' => 'Cine en el Parque',               'categoria' => 'Cine',      'precio_desde' => '$4.500',  'estado' => 'publicada', 'ventas' => 248],
                ['id' => 3,  'nombre' => 'Pack familiar Mirador',            'proveedor' => 'Museo Interactivo Mirador',       'categoria' => 'Museos',    'precio_desde' => '$12.800', 'estado' => 'publicada', 'ventas' => 305],
                ['id' => 4,  'nombre' => 'Taller de cerámica · Sábado AM',   'proveedor' => 'Taller La Rueda',                 'categoria' => 'Talleres',  'precio_desde' => '$18.000', 'estado' => 'publicada', 'ventas' => 84],
                ['id' => 5,  'nombre' => 'Cumpleaños temático · 10 niños',   'proveedor' => 'Granja Educativa Las Vertientes', 'categoria' => 'Cumpleaños','precio_desde' => '$182.500','estado' => 'borrador',  'ventas' => 0],
            ],
            'total' => 184,
        ];
    }

    public function transacciones(): array
    {
        return [
            ['id' => 'TX-48291', 'cliente' => 'María Fernanda Soto',    'actividad' => 'Granja Educativa · Visita guiada', 'monto' => '$28.900',  'estado' => 'pagada',    'medio' => 'Webpay',   'fecha' => 'hace 4 min'],
            ['id' => 'TX-48290', 'cliente' => 'Diego Castro',           'actividad' => 'Cine en el Parque · Función 19:30', 'monto' => '$12.500',  'estado' => 'pagada',    'medio' => 'OneClick', 'fecha' => 'hace 11 min'],
            ['id' => 'TX-48289', 'cliente' => 'Camila Pérez',           'actividad' => 'Taller de cerámica · Sábado AM',    'monto' => '$45.000',  'estado' => 'pendiente', 'medio' => 'Transfer', 'fecha' => 'hace 18 min'],
            ['id' => 'TX-48288', 'cliente' => 'Joaquín Vidal',          'actividad' => 'Museo Interactivo · Pack familiar', 'monto' => '$36.800',  'estado' => 'pagada',    'medio' => 'Webpay',   'fecha' => 'hace 27 min'],
            ['id' => 'TX-48287', 'cliente' => 'Antonia Rojas',          'actividad' => 'Entreadultos · Cata de vinos',      'monto' => '$54.000',  'estado' => 'rechazada', 'medio' => 'Webpay',   'fecha' => 'hace 34 min'],
            ['id' => 'TX-48286', 'cliente' => 'Felipe Mardones',        'actividad' => 'Granja Educativa · Cumpleaños',     'monto' => '$182.500', 'estado' => 'pagada',    'medio' => 'OneClick', 'fecha' => 'hace 52 min'],
            ['id' => 'TX-48285', 'cliente' => 'Valentina Núñez',        'actividad' => 'Taller bilingüe · Inglés A2',       'monto' => '$24.000',  'estado' => 'pagada',    'medio' => 'Webpay',   'fecha' => 'hace 1 h'],
            ['id' => 'TX-48284', 'cliente' => 'Tomás Aguilera',         'actividad' => 'Granja Educativa · Tour escolar',   'monto' => '$8.900',   'estado' => 'pagada',    'medio' => 'OneClick', 'fecha' => 'hace 1 h'],
        ];
    }

    public function liquidaciones(): array
    {
        return [
            'liquidaciones' => [
                ['id' => 'LIQ-2026-21', 'proveedor' => 'Granja Educativa Las Vertientes', 'periodo' => '12 al 18 may', 'bruto' => '$2.140.300', 'neto' => '$1.926.270', 'estado' => 'pagada'],
                ['id' => 'LIQ-2026-22', 'proveedor' => 'Museo Interactivo Mirador',       'periodo' => '12 al 18 may', 'bruto' => '$1.680.500', 'neto' => '$1.512.450', 'estado' => 'pagada'],
                ['id' => 'LIQ-2026-23', 'proveedor' => 'Cine en el Parque',               'periodo' => '12 al 18 may', 'bruto' => '$1.120.000', 'neto' => '$1.008.000', 'estado' => 'descuadre'],
                ['id' => 'LIQ-2026-24', 'proveedor' => 'Taller La Rueda',                 'periodo' => '12 al 18 may', 'bruto' => '$642.800',   'neto' => '$578.520',   'estado' => 'borrador'],
            ],
        ];
    }

    public function dte(): array
    {
        return [
            'dte' => [
                ['id' => 'DTE-39281', 'folio' => 'B-128492', 'tipo' => 'Boleta',  'rut' => '12.345.678-9', 'monto' => '$28.900',  'estado' => 'emitida',   'fecha' => 'hoy 14:32'],
                ['id' => 'DTE-39280', 'folio' => 'B-128491', 'tipo' => 'Boleta',  'rut' => '11.234.567-8', 'monto' => '$12.500',  'estado' => 'emitida',   'fecha' => 'hoy 14:21'],
                ['id' => 'DTE-39279', 'folio' => '-',         'tipo' => 'Boleta',  'rut' => '15.987.654-3', 'monto' => '$45.000',  'estado' => 'rechazada', 'fecha' => 'hoy 14:08'],
                ['id' => 'DTE-39278', 'folio' => 'F-12849',  'tipo' => 'Factura', 'rut' => '76.123.456-7', 'monto' => '$182.500', 'estado' => 'emitida',   'fecha' => 'hoy 13:14'],
            ],
            'pendientes' => 3,
        ];
    }

    public function usuarios(): array
    {
        return [
            'usuarios' => [
                ['id' => 1, 'nombre' => 'María Fernanda Soto', 'email' => 'maria@example.com',   'rol' => 'Cliente',   'markets' => ['entrekids'],                 'ultimo_login' => 'hace 5 min'],
                ['id' => 2, 'nombre' => 'Diego Castro',        'email' => 'diego@example.com',   'rol' => 'Cliente',   'markets' => ['entrekids', 'entreadultos'], 'ultimo_login' => 'hace 12 min'],
                ['id' => 3, 'nombre' => 'Carla Reyes',         'email' => 'carla@granja.cl',     'rol' => 'Proveedor', 'markets' => ['entrekids'],                 'ultimo_login' => 'hace 1 h'],
                ['id' => 4, 'nombre' => 'Josbert',             'email' => 'hola@bookforce.io',   'rol' => 'Super Admin','markets' => ['*'],                        'ultimo_login' => 'activo'],
            ],
            'total' => 28492,
        ];
    }

    private function markets(): array
    {
        return [
            ['id' => 1, 'slug' => 'entrekids',       'nombre' => 'Entrekids',        'color' => '#fb4ba3'],
            ['id' => 2, 'slug' => 'entreadultos',    'nombre' => 'Entreadultos',     'color' => '#7d52f4'],
            ['id' => 3, 'slug' => 'evenclub',        'nombre' => 'Evenclub',         'color' => '#22d3bb'],
            ['id' => 4, 'slug' => 'bookforce',      'nombre' => 'Bookforce',         'color' => '#335cff'],
            ['id' => 5, 'slug' => 'granjaeducativa','nombre' => 'Granja Educativa', 'color' => '#1fc16b'],
            ['id' => 6, 'slug' => 'ticketlab',       'nombre' => 'Ticketlab',        'color' => '#ff9147'],
        ];
    }
}
