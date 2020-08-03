<?php

use Illuminate\Database\Seeder;
use App\Models\Configuration;

class ConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configuration::create([
            'code' => 'estado',
            'label' => 'Estado general',
            'values' => '{"5":"Excelente","4":"Bueno","3":"Regular","2":"Malo","1":"Inservible"}'
        ]);

        Configuration::create([
            'code' => 'normativa',
            'label' => 'Normativa',
            'values' => '{"1":"INEM 004-2012","2":"Otro"}'
        ]);

        Configuration::create([
            'code' => 'forma',
            'label' => 'Forma',
            'values' => '{"1":"Octógono","2":"Triángulo","3":"Rectángulo V","4":"Círculo","5":"Rombo","6":"Rectángulo H","7":"Escudo","8":"Pentágono","9":"Cuadrado","10":"Rectángulo","11":"Otro"}'
        ]);

        Configuration::create([
            'code' => 'color',
            'label' => 'Color',
            'values' => '{"1":"Rojo","2":"Negro","3":"Blanco","4":"Amarillo","5":"Naranja","6":"Azul","7":"Verde limón","8":"Café","9":"Otro"}'
        ]);

        Configuration::create([
            'code' => 'signal_fasteners',
            'label' => 'Fijación de señales',
            'values' => '{"1":"Poste concreto","2":"Poste metálico","3":"Tubo circular","4":"Tubo cuadrado","5":"Barra","6":"Barra L","8":"Barra omega","8":"Otro"}'
        ]);

        Configuration::create([
            'code' => 'light_fasteners',
            'label' => 'Fijación de semáforos',
            'values' => '{"1":"Cabezales tensores","2":"Brazos","3":"Hardware","4":"Otro"}'
        ]);

        Configuration::create([
            'code' => 'material',
            'label' => 'Material',
            'values' => '{"1":"Hierro","2":"Plástico","3":"Aluminio","4":"Concreto","5":"Otro"}'
        ]);

        Configuration::create([
            'code' => 'fondo',
            'label' => 'Fondo',
            'values' => '{"1":"Reflectivo","2":"Mate","3":"Otro"}'
        ]);

        Configuration::create([
            'code' => 'direction',
            'label' => 'Puntos cardinales',
            'values' => '{"N":"Norte","NE":"Noreste","E":"Este","SE":"Sureste","S":"Sur","SO":"Suroeste","O":"Oeste","NO":"Noroeste"}'
        ]);

        Configuration::create([
            'code' => 'light_brands',
            'label' => 'Fabricantes de semáforos',
            'values' => '{"1": "Peek","2": "Siemens","3": "EDI","4": "Eagle","5": "Fisheye","6": "Bullet","7": "TrippLite","8": "QTC","9": "Goia","10": "Iteris","11": "VTN","12": "Otro"}'
        ]);

        Configuration::create([
            'code' => 'regulator_brands',
            'label' => 'Fabricantes de reguladoras',
            'values' => '{"1": "Peek","2": "Siemens","3": "Otro"}'
        ]);

        Configuration::create([
            'code' => 'ups_brands',
            'label' => 'Fabricantes de UPS',
            'values' => '{"1": "TrippLite","2": "Computer power","3": "General Electric","4": "Otro","5": "No existe"}'
        ]);

        Configuration::create([
            'code' => 'energy_brands',
            'label' => 'Fabricantes de fuentes de poder',
            'values' => '{"1": "Peek","2": "Siemens","3": "EDI","4": "Eagle","5":"Otro"}'
        ]);

        Configuration::create([
            'code' => 'mmu_brands',
            'label' => 'Fabricantes de MMU',
            'values' => '{"1": "Peek","2": "EDI","3": "Otro"}'
        ]);

        Configuration::create([
            'code' => 'travel_brands',
            'label' => 'Fabricantes de medidores de tiempo de viaje',
            'values' => '{"1": "Iteris","2": "Otro"}'
        ]);

        Configuration::create([
            'code' => 'controller_brands',
            'label' => 'Fabricantes de controladores',
            'values' => '{"1": "Peek","2": "Siemens","3": "QTC","4": "Eagle","5": "Goia","6": "Otro"}'
        ]);

        Configuration::create([
            'code' => 'camera_brands',
            'label' => 'Fabricantes de cámaras',
            'values' => '{"1": "Fisheye","2": "Bullet","3": "Otro"}'
        ]);
    }
}
