<?php
namespace raiz;
//error_reporting(E_ALL  );


use Slim\Views\PhpRenderer;

include "vendor/autoload.php";


/*
$app = new App( array(
    'debug' => true,
    'templates.path' => './templates'
) );
*/
$app = new \Slim\App(['settings' => ['displayErrorDetails' => true]]);

$container = $app->getContainer();
$container['renderer'] = new PhpRenderer("./templates");



$app->get('/healthcheck/', function ($request, $response, $args)  use ($app )   {
    require_once("health-check/healthcheck.php");

    $HealthCheck = new HealthCheck();

    $retorno = $HealthCheck->check($response, $request->getParsedBody() );
    return $retorno;
}  );


$app->post('/Auth/', function ($request, $response, $args)  use ($app )   {
      require_once("include/class_auth.php");

     $Auth = new Auth();


   // $response->getBody()->write("It works! This is the default welcome page.");
 //   var_dump($request->getParsedBody() );
//    $retorno = $Auth->Autenticar($response, $request->getQueryParams() );
    $retorno = $Auth->Autenticar($response, $request->getParsedBody() );

  //  var_dump($retorno);

   return $retorno;

   // return $retorno;
//    return $this->renderer->render($response, "/hello.php", $args);

}  );


$app->post('/NewUser/', function ($request, $response, $args)  use ($app )   {
    require_once("include/class_auth.php");

    $Auth = new Auth();
    $retorno = $Auth->NovoUsuario($response, $request->getParsedBody() );

    return $retorno;


}  );


$app->run();

