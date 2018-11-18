<?php

// contact form submit redirect
// to do: redirect to itself and skip this step

$cockpit->bind('/submit/:form', function($params){

    // to do:
    // should be handled in Monoplane class without extra bind
    require_once('Controller/Forms.php');
    return $this->invoke('Monoplane\\Controller\\Forms', 'submit', ['form' => $params['form']]);

});

// base

$cockpit->bind('/', function($params){
    
    // $slug = '5bed483433386215d8000260';
    $slug = 'about';
    
    return $this->invoke('Monoplane\\Controller\\Monoplane', 'index', ['slug' => $slug]);

});

$cockpit->bind('/*', function($params){

    return $this->invoke('Monoplane\\Controller\\Monoplane', 'index', ['slug' => $params[':splat']]);

});
