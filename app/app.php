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

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

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

    $app->get('/stylist/{id}/edit', function($id) use($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render("edit.html.twig", array('stylist' => $stylist));
    });

    $app->patch('/stylist/{id}/updated', function($id) use($app) {
        Stylist::update($id, $_POST['name']);
        $clients = Stylist::findStylistsClients($id);
        $stylist = Stylist::find($id);
        return $app['twig']->render("stylist.html.twig", array('clients' => $clients, 'stylist' => $stylist));
    });

    $app->delete('/stylists/delete-all', function() use($app) {
        Stylist::deleteAll();
        Client::deleteAll();
        $stylists = Stylist::getAll();
        return $app['twig']->render("index.html.twig", array('stylists' => $stylists));
    });

    $app->delete('/stylist/{stylist_id}/delete/client/{client_id}', function($stylist_id, $client_id) use($app) {
        Client::deleteClient($client_id);
        $clients = Stylist::findStylistsClients($stylist_id);
        $stylist = Stylist::find($stylist_id);
        return $app['twig']->render("stylist.html.twig", array('clients' => $clients, 'stylist' => $stylist));
    });


    return $app;
?>
