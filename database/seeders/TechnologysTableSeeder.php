<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['HTML', 'CSS', 'JS', 'Vue JS', 'PHP', 'Laravel', 'SQL'];
        
        foreach ($names as $name) {
            $newName = new Technology();
            $newName->name = $name;
            $newName->save();
        }
    }
}
