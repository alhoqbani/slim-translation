<?php

use App\Http\Controllers\HomeController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Translation\Loader\ArrayLoader;

$app->get('/home', HomeController::class . ':index');

$app->get('/', function (ServerRequestInterface $request, ResponseInterface $response, $args) {
    $ar = ROOT . 'resources/lang/ar/greetings.json';
    
    $ar = [
        'greetings' => require ROOT . 'resources/lang/ar/greetings.php',
        'messages'  => require ROOT . 'resources/lang/ar/messages.php',
    ];
    
    $en = [
        'greetings' => require ROOT . 'resources/lang/en/greetings.php',
        'messages'  => require ROOT . 'resources/lang/en/messages.php',
    ];
    
    // Choose on locale:
    $trnaslation = new Symfony\Component\Translation\Translator('ar');
    
    $trnaslation->setFallbackLocales(['ar', 'en']);
    
    $trnaslation->addLoader('array', new ArrayLoader());
    
    $trnaslation->addResource('array', $en, 'en');
    $trnaslation->addResource('array', $ar, 'ar');
    
    dump($trnaslation->trans('greetings.good_buy'));
    
    echo $trnaslation->trans('messages.count', ['%count%' => 10]);
    echo '<br><br>';
    echo $trnaslation->trans('messages.new_message');
});