<?php

use App\Core\Config;
use App\Seeder;
use eftec\bladeone\BladeOne;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\EventServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\RoutingServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\View;
use Illuminate\View\ViewServiceProvider;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Windwalker\Edge\Edge;
use Windwalker\Edge\Loader\EdgeFileLoader;
use Windwalker\Edge\Loader\EdgeStringLoader;

require_once 'vendor/autoload.php';
require_once 'vendor/illuminate/support/helpers.php';

$app = app();
Illuminate\Support\Facades\Facade::setFacadeApplication($app);
$app->singleton('app', 'Illuminate\Container\Container');
class_alias('Illuminate\Support\Facades\App', 'App');

$app->bind('app', $app);
$app['env'] = 'development';

$config = new Config;
$capsule = new Capsule;

// Establish connection to database.
$capsule->addConnection(
    $config->get('database')
);

$capsule->setAsGlobal();
$capsule->bootEloquent();

// Bootstrap Blade
$loader = new Twig_Loader_Filesystem(__DIR__ . '/views');
$twig = new Twig_Environment($loader, [
    'cache' => __DIR__ . '/cache'
]);

$app['twig'] = $twig;

// Registering providers
with(new EventServiceProvider($app))->register();
with(new RoutingServiceProvider($app))->register();

// Routes file
require 'routes.php';

// Setting Request and Response
$request = Request::createFromGlobals();

try {
    $response = $app['router']->dispatch($request);
    $response->send();
} catch (NotFoundHttpException $e) {
    with(new Response('Whoopsie! This page does not exist!',404))->send();
}

// Creating & seeding database
(new Seeder)->seed();

