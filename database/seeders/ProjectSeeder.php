<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $types = Type::all()->pluck('id');
        $types[] = null;

        for ($i = 0; $i < 100; $i++) {
            $type_id = $faker->randomElement($types);

            $project = new project;
            $project->title = $faker->catchPhrase();
            $project->content = $faker->paragraphs(2, true);
            $project->slug = Str::slug($project->title);
            $project->save();
        }
    }
}
