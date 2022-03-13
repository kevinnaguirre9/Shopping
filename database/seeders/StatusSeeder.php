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
            'Por confirmar', 
            'Aceptado', 
            'Cancelado', 
            'Enviado', 
            'Entregado', 
            'Llegada a Ecuador', 
            'En Oficina', 
            'En Aduana'
        ];

        foreach($statuses as $status) 
        {
            OrderStatus::create([
                'status' => $status
            ]);
        }
    }
}
