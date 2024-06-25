<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Testing\Fakes\Fake;
use Illuminate\Support\Str;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for($i = 0; $i < 10; $i++) {
            $newProject = new Project();
            $newProject->name = $faker->sentence(2);
            $newProject->description = $faker->text(200);
            $newProject->programming_languages = $faker->randomElement(['JS', 'PYTHON', 'PHP', 'JAVA']);
            $newProject->slug = Str::slug($newProject->name);
            $newProject->save();
        }
    }

}
