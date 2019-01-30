<?php

namespace App\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return app('twig')->render('di.twig');
    }
}