<?php

namespace App;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Database\Capsule\Manager as Capsule;

class Seeder
{
    /**
     * Run seeders.
     */
    public function seed()
    {
        $this->seedTables();

        // Generally, if there are questions, consider it seeded.
        if (!Question::count() < 1) {
            $this->seedQuizzes();
        }
    }

    /**
     * Seed the necessary tables for quiz application.
     */
    private function seedTables()
    {
        if (!Capsule::schema()->hasTable('questions')) {
            Capsule::schema()->create('questions', function ($table) {
                $table->increments('id');
                $table->integer('category_id')->unsigned()->index();
                $table->text('question');
                $table->timestamps();

            });
        }

        if (!Capsule::schema()->hasTable('categories')) {
            Capsule::schema()->create('categories', function ($table) {
                $table->increments('id');
                $table->string('category')->unique();
                $table->timestamps();
            });
        }

        if (!Capsule::schema()->hasTable('question_categories')) {
            Capsule::schema()->create('question_categories', function ($table) {
                $table->increments('id');
                $table->integer('question_id')->unsigned();
                $table->integer('category_id')->unsigned();
                $table->timestamps();

                $table->index(['question_id', 'category_id']);
                $table->foreign('question_id')
                        ->references('id')->on('questions')
                        ->onDelete('cascade');
            });
        }

        if (!Capsule::schema()->hasTable('options')) {
            Capsule::schema()->create('options', function ($table) {
                $table->increments('id');
                $table->integer('question_id')->unsigned()->index();
                $table->integer('option');
                $table->boolean('is_correct');
                $table->timestamps();

                $table->foreign('question_id')
                    ->references('id')->on('questions')
                    ->onDelete('cascade');
            });
        }

        if (!Capsule::schema()->hasTable('answers')) {
            Capsule::schema()->create('answers', function ($table) {
               $table->increments('id');
               $table->integer('question_id')->unsigned();
               $table->integer('user_id')->unsigned();
               $table->integer('option_id')->unsigned();
                $table->timestamps();

                $table->index(['question_id', 'user_id', 'option_id']);
                $table->foreign('question_id')
                    ->references('id')->on('questions')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Seed database with default quizzes.
     */
    private function seedQuizzes()
    {
        $quizzes = require_once 'Seeds/quizzes.php';

        collect($quizzes['quizzes'])->each(function ($item, $key) {
            $category = Category::updateOrCreate([
                'category' => $key
            ]);
//            dump($item);
        });
    }
}