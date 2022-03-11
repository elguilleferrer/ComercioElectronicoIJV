<?php

namespace Database\Seeders;

use App\Models\TipoUnidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'nombre' => 'Cafeterias',
                'descripcion' => 'cafeterias'
            ],
            (object)[
                'nombre' => 'Restaurants',
                'descripcion' => 'Restaurants'
            ],
            (object)[
                'nombre' => 'Mais',
                'descripcion' => 'mais'
            ],
            (object)[
                'nombre' => 'UEB-DEC-28',
                'descripcion' => 'Ueb empresariales de base'
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
