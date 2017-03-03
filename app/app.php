<?php

    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/brand.php';
    require_once __DIR__.'/../src/store.php';

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), ["twig.path" => __DIR__."/../views"]);

    $server = 'mysql:host=localhost:8889;dbname=shoe_store';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();
    $app['debug'] = true;

    $app->get('/', function() use ($app) {
        $stores = Store::getAll();
        return $app['twig']->render('homepage.html.twig', ['store' => $store]);
    });


    $app->get('/stores', function($id) use ($app) {
        $stores = Store::getAll();
        $brands = Brand::getAll();
        return $app['twig']->render('store.html.twig', ['stores' => $stores, 'brands' => $brands]);
    });

    $app->post('/add_store', function() use ($app) {
        $name = $_POST['name'];
        $new_store = new Store ($name);
        $new_store->save();
        return $app->redirect('/stores');
    });

    $app->get('/stores/{id}', function($id) use ($app) {
        $stores = Store::find($id);
        $brands = Brand::getAll();
        return $app['twig']->render('store.html.twig', ['stores' => $stores, 'brands' => $brands]);
    });

    $app->post('/stores/{id}/edit', function($id) use ($app) {
        $store = Store::find($id);
        $new_name = $_POST['new-name'];

        $store->updateName($new_name);

        return $app->redirect('/stores/'.$id);
    });

    $app->delete('/stores/{id}/delete', function($id) use ($app) {
        $store = Store::find($id);
        $store->delete();

        return $app->redirect('/stores');
    });






return $app;
?>
