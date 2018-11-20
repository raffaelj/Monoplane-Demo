<?php

// contact form submit redirect
// to do: redirect to itself and skip this step

$app->bind('/submit/:form', function($params){

    // to do:
    // should be handled in Monoplane class without extra bind
    require_once('Controller/Forms.php');
    return $this->invoke('Monoplane\\Controller\\Forms', 'submit', ['form' => $params['form']]);

});

// base

$app->bind('/', function($params){

    $slug = $this->monoplane['startpage'];

    return $this->invoke('Monoplane\\Controller\\Monoplane', 'index', ['slug' => $slug]);

});

$app->bind('/*', function($params){

    return $this->invoke('Monoplane\\Controller\\Monoplane', 'index', ['slug' => $params[':splat']]);

});
