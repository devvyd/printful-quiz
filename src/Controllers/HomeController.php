<?php

namespace App\Controllers;

use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $tests = Category::all();

        return app('twig')->render('index.twig', ['tests' => $tests]);
    }
}