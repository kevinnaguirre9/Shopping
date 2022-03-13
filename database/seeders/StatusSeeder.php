<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'status'        => 'Por confirmar',
                'abbreviation'  => 'PC'
            ],
            [
                'status'        => 'Aceptado',
                'abbreviation'  => 'AA'
            ],
            [
                'status'        => 'Cancelado',
                'abbreviation'  => 'CC'
            ],
            [
                'status'        => 'Enviado',
                'abbreviation'  => 'ENV'
            ],
            [
                'status'        => 'Entregado',
                'abbreviation'  => 'ENT'
            ],
            [
                'status'        => 'Llegada a Ecuador',
                'abbreviation'  => 'LLE'
            ], 
            [
                'status'        => 'En Oficina',
                'abbreviation'  => 'EOF'
            ], 
            [
                'status'        => 'Llegada a Ecuador',
                'abbreviation'  => 'LLE'
            ], 
            [
                'status'        => 'En Aduana',
                'abbreviation'  => 'EAD'
            ],
        ];

        foreach($statuses as $status) 
        {
            OrderStatus::create($status);
        }
    }
}
