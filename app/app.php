<?php
    date_default_timezone_set("America/Los_Angeles");
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Client.php';
    require_once __DIR__.'/../src/Stylist.php';

    $server = 'mysql:host=localhost:8889;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();
    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get('/', function() use($app) {
        $stylists = Stylist::getAll();
        return $app['twig']->render("index.html.twig", array('stylists' => $stylists));
    });

    $app->post('/add-stylist', function() use($app) {
        $new_stylist = new Stylist($_POST['name']);
        $new_stylist->save();
        $stylists = Stylist::getAll();
        return $app['twig']->render("index.html.twig", array('stylists' => $stylists));
    });

    $app->get('/stylist/{id}', function($id) use($app) {
        $clients = Stylist::findStylistsClients($id);
        $stylist = Stylist::find($id);
        return $app['twig']->render("stylist.html.twig", array('clients' => $clients, 'stylist' => $stylist));
    });

    $app->post('/add-client/{id}', function($id) use($app) {
        $new_client = new Client($_POST['name'], $id);
        $new_client->save();
        $clients = Stylist::findStylistsClients($id);
        $stylist = Stylist::find($id);
        return $app['twig']->render("stylist.html.twig", array('clients' => $clients, 'stylist' => $stylist));
    });


    return $app;
?>
