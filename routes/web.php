<?php

use App\Http\Controllers\HomeController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Translation\Loader\JsonFileLoader;

$app->get('/home', HomeController::class . ':index');

$app->get('/', function (ServerRequestInterface $request, ResponseInterface $response, $args) {
    $ar = ROOT . 'resources/lang/ar/greetings.json';
    
    $en = ROOT . 'resources/lang/en/greetings.json';
    
    // Choose on locale:
    $trnaslation = new Symfony\Component\Translation\Translator('ar');
//    $trnaslation = new Symfony\Component\Translation\Translator('en');
    
    $trnaslation->addLoader('json', new JsonFileLoader());
    
    $trnaslation->addResource('json', $en, 'en', 'greetings');
    $trnaslation->addResource('json', $ar, 'ar', 'greetings');
    
    dump($trnaslation->trans('good_buy', [], 'greetings'));
});
