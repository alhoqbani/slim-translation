<?php

use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\Translator;

$container = $app->getContainer();

$container['view'] = function ($c) {
    $config = $c['settings']['twig'];
    $view = new \Slim\Views\Twig(
        $config['viewsPath'],
        [
            'cache' => $config['enableCache'] ? $config['viewsCachePath'] : false,
        ]);
    
    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $c['request']->getUri()));
    
    return $view;
};

$container['db'] = function ($c) {
    $config = $c['settings']['database'];
    $dsn = $config['driver'] . ':dbname=' . $config['dbname'] . ';host=' . $config['host'];
    
    $pdo = new \PDO($dsn, $config['username'], $config['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    
    return $pdo;
};

$container['translator'] = function ($c) {
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
    $translator = new Translator('ar');
    
    $translator->setFallbackLocales(['ar', 'en']);
    
    $translator->addLoader('array', new ArrayLoader());
    
    $translator->addResource('array', $en, 'en');
    $translator->addResource('array', $ar, 'ar');
    
    return $translator;
};