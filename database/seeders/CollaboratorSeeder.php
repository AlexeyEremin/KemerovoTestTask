<?php

namespace Database\Seeders;

use App\Models\Collaborator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollaboratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Collaborator::factory(10)->hasWorkTime(10)->create();
    }
}
