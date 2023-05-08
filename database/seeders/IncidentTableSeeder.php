<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Incident;


class IncidentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   

        $incident = new Incident();
        $incident->user_id = "1";
        $incident->type = "Sistema";
        $incident->description = 'Cualquier problema';
        $incident->state = "EN ESPERA";
        $incident->answer = "";
        $incident->save();

             
    }
}
