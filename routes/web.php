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
    
    echo $trnaslation->transChoice('messages.advanced_count', 0) . '<br>';
    echo $trnaslation->transChoice('messages.advanced_count', 1) . '<br>';
    echo $trnaslation->transChoice('messages.advanced_count', 2) . '<br>';
    echo $trnaslation->transChoice('messages.advanced_count', 3) . '<br>';
    echo $trnaslation->transChoice('messages.advanced_count', 4) . '<br>';
    echo $trnaslation->transChoice('messages.advanced_count', 9) . '<br>';
    echo $trnaslation->transChoice('messages.advanced_count', 10) . '<br>';
    echo $trnaslation->transChoice('messages.advanced_count', 11) . '<br>';
    echo $trnaslation->transChoice('messages.advanced_count', 30) . '<br>';
    echo $trnaslation->transChoice('messages.advanced_count', 100) . '<br>';
    echo $trnaslation->transChoice('messages.advanced_count', 302) . '<br>';
    echo '<br><br>';
    echo $trnaslation->trans('messages.new_message');
});