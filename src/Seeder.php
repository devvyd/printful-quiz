<?php

namespace App;

use Illuminate\Database\Capsule\Manager as Capsule;

class Seeder
{
    /**
     * Run seeders.
     */
    public function seed()
    {
        $this->seedTables();
        $this->seedQuizzes();
    }

    /**
     * Seed the necessary tables for quiz application.
     */
    private function seedTables()
    {
        if (!Capsule::schema()->hasTable('questions')) {
            Capsule::schema()->create('questions', function ($table) {
                $table->increments('id');
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
                $table->integer('question_id')->unsigned()->index();
                $table->integer('category_id')->unsigned()->index();
                $table->timestamps();

//                $table->foreign('question_id')
//                        ->references('id')->on('questions')
//                        ->onDelete('cascade');
            });
        }

        if (!Capsule::schema()->hasTable('options')) {
            Capsule::schema()->create('options', function ($table) {
                $table->increments('id');
                $table->integer('question_id')->unsigned();
                $table->integer('option');
                $table->boolean('is_correct');
                $table->timestamps();

//                $table->foreign('question_id')
//                    ->references('id')->on('questions')
//                    ->onDelete('cascade');
            });
        }

        if (!Capsule::schema()->hasTable('answers')) {
            Capsule::schema()->create('answers', function ($table) {
               $table->increments('id');
               $table->integer('question_id')->index();
               $table->integer('user_id')->index();
               $table->integer('option_id')->index();
               $table->timestamps();

//                $table->foreign('question_id')
//                    ->references('id')->on('questions')
//                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Seed database with default quizzes.
     */
    private function seedQuizzes()
    {
        $quizzes = require_once 'Seeds/quizzes.php';

        $categories = [];
        $questions = [];

        collect($quizzes['quizzes'])->each(function ($item, $key) {
           $categories[] = $key;
        });

        dump($categories);
    }
}