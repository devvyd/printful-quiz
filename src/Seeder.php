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
        if (!Capsule::schema()->hasTable('quizzes')) {
            Capsule::schema()->create('quizzes', function ($table) {
                $table->increments('id');
                $table->string('name')->unique();
                $table->timestamps();
            });
        }

        if (!Capsule::schema()->hasTable('users')) {
            Capsule::schema()->create('users', function ($table) {
                $table->increments('id');
                $table->string('full_name');
                $table->timestamps();
            });
        }

        if (!Capsule::schema()->hasTable('users_quizzes')) {
            Capsule::schema()->create('users_quizzes', function ($table) {
               $table->increments('id');
               $table->integer('user_id');
               $table->integer('quiz_id');
               $table->timestamps();
            });
        }
    }

    /**
     * Seed database with default quizzes.
     */
    private function seedQuizzes()
    {
        $quizzes = require 'Seeds/quizzes.php';
    }
}