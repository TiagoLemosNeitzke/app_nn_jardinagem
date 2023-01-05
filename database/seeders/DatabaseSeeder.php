<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Customer::factory(10)->create();

        \App\Models\Customer::factory()->create([
            'user_id',
            'name',
            'email',
            'phone',
            'street',
            'street_number',
            'district',
            'city',
            'state'
        ]);
        //\App\Models\Task::factory(50)->create();
    }
}
