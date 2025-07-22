<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $medico = Categoria::create(['nome' => 'Médico']);
        $medico->subcategorias()->createMany([
            ['nome' => 'Otorrino'], ['nome' => 'Cardiologista']
        ]);

        $rep = Categoria::create(['nome' => 'Representante']);
        $rep->subcategorias()->createMany([
            ['nome' => 'de Telhas'], ['nome' => 'de Tijolos']
        ]);
    }
}
