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
    $config = $c['settings'];
    
    $langPath = ROOT . 'resources/lang/';
    $locals = array_diff(scandir($langPath), ['.', '..']);
    $files = [];
    foreach ($locals as $local) {
        $files[$local] = array_diff(scandir($langPath . $local), ['.', '..']);
    };
    
    $translator = new Translator($config['app']['locale']);
    $translator->setFallbackLocales([$config['app']['locale'], $config['app']['default_locale']]);
    $translator->addLoader('array', new ArrayLoader());
    
    foreach ($files as $local => $localeFiles) {
        foreach ($localeFiles as $file) {
            $array[trim($file, '.php')] = include "{$langPath}{$local}/{$file}";
            $translator->addResource('array', $array, $local);
        }
    }
    
    return $translator;
};