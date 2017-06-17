<?php

use App\Http\Controllers\HomeController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Translation\Loader\ArrayLoader;

$app->get('/home', HomeController::class . ':index');

$app->get('/', function (ServerRequestInterface $request, ResponseInterface $response, $args) {
    echo '<a href="/home">Check Home</a><hr>';
    echo $this->translator->transChoice('messages.advanced_count', 0) . '<br>';
    echo $this->translator->transChoice('messages.advanced_count', 1) . '<br>';
    echo $this->translator->transChoice('messages.advanced_count', 2) . '<br>';
    echo $this->translator->transChoice('messages.advanced_count', 3) . '<br>';
    echo $this->translator->transChoice('messages.advanced_count', 4) . '<br>';
    echo $this->translator->transChoice('messages.advanced_count', 9) . '<br>';
    echo $this->translator->transChoice('messages.advanced_count', 10) . '<br>';
    echo $this->translator->transChoice('messages.advanced_count', 11) . '<br>';
    echo $this->translator->transChoice('messages.advanced_count', 30) . '<br>';
    echo $this->translator->transChoice('messages.advanced_count', 100) . '<br>';
    echo $this->translator->transChoice('messages.advanced_count', 302) . '<br>';
    echo '<br><br>';
    echo $this->translator->trans('messages.new_message');
});