<?php

namespace Database\Seeders;

use App\Models\TipoUnidad;
use Illuminate\Database\Seeder;

class TipoUnidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos_unidad  = [
            (object)[
                'nombre' => 'Bodegas',
                'descripcion' => 'Bodegas'
            ],
            (object)[
                'nombre' => 'Mercados Ideales',
                'descripcion' => 'Mercados Ideales'
            ],
            (object)[
                'nombre' => 'Punto de Venta Materiales de la Construccion',
                'descripcion' => 'Punto de Venta Materiales de la Construccion'
            ],
            (object)[
                'nombre' => 'Servicios tecnicos',
                'descripcion' => 'Servicios tecnicos'
            ],
            (object)[
                'nombre' => 'Sistema de alojamiento',
                'descripcion' => 'Sistema de alojamiento'
            ],
            (object)[
                'nombre' => 'Restaurantes',
                'descripcion' => 'Restaurantes'
            ],
            (object)[
                'nombre' => 'Cafeterias',
                'descripcion' => 'Cafeterias'
            ],
            (object)[
                'nombre' => 'UEB Perfeccionadas',
                'descripcion' => 'CafeteriasUEB Perfeccionadas'
            ],
        ];

        foreach ($tipos_unidad as $tipo_unidad) {
            TipoUnidad::create([
                'nombre' => $tipo_unidad->nombre,
                'descripcion' => $tipo_unidad->descripcion,
            ]);
        }

    }
}