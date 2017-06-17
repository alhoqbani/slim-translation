<?php

use App\Http\Controllers\HomeController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Translation\Loader\JsonFileLoader;

$app->get('/home', HomeController::class . ':index');

$app->get('/', function (ServerRequestInterface $request, ResponseInterface $response, $args) {
    $ar = ROOT . 'resources/lang/ar/greetings.json';
    
    $ar = [
        'greetings' => require ROOT . 'resources/lang/ar/greetings.php',
    ];
    
    $en = [
        'greetings' => require ROOT . 'resources/lang/en/greetings.php',
    ];
    
    // Choose on locale:
    $trnaslation = new Symfony\Component\Translation\Translator('ar');
//    $trnaslation = new Symfony\Component\Translation\Translator('en');
    
    $trnaslation->addLoader('array', new ArrayLoader());
    
    $trnaslation->addResource('array', $en, 'en');
    $trnaslation->addResource('array', $ar, 'ar');
    
    dump($trnaslation->trans('greetings.good_buy'));
});