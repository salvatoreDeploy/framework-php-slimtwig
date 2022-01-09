<?php

session_start();

require "vendor/autoload.php";

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

/*Configurando erros no Slim*/

$config['displayErrorDetails'] = true;

$app = new App(['settings' => $config]);

/*$app->group("/admin", function() use ($app){
    $app->get('/login', function (){
        echo 'logado';
    });
});*/


/*Rotas de Controller*/
$app->get('/', 'namespaceController:metodo');

$app->run();