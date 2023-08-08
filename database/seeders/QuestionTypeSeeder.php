<?php

namespace Database\Seeders;

use App\Models\QuestionType;
use Illuminate\Database\Seeder;

class QuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuestionType::updateOrCreate([
            'name'=>'Written Question',
        ]);
        QuestionType::updateOrCreate([
            'name'=>'MCQ Question',
        ]);
        QuestionType::updateOrCreate([
            'name'=>'Combined',
        ]);
    }
}
