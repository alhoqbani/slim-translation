<?php

use App\Http\Controllers\HomeController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Translation\Loader\ArrayLoader;

$app->get('/home', HomeController::class . ':index');

$app->get('/', function (ServerRequestInterface $request, ResponseInterface $response, $args) {

    $trnaslation = new Symfony\Component\Translation\Translator('en');
    $trnaslation->addLoader('array', new ArrayLoader());
    $trnaslation->addResource('array', [
        'welcome' => 'Welcome'
    ], 'en');
    
    dump($trnaslation->trans('welcome'));
});