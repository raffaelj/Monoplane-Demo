<?php

// error handling

$app->on('after', function() {

    switch($this->response->status){
        case '404':
            $this->response->body = $this->invoke('Monoplane\\Controller\\Monoplane', 'error', ['status' => $this->response->status]);
            break;
    }

});

// layout

$app->on('monoplane.nav', function($slug, $type = 'main'){

    // fields filter doesn't work with lang filter
    // to do: file issue
    $options = [
        // 'fields' => [
            // 'title' => true,
            // $this->monoplane['slug'] => true
        // ],
        'filter' => ['published' => true, 'navigation' => $type],
        'lang' => $_SESSION['lang'] ?? null
    ];

    $pages = $this->module('collections')->find($this->monoplane['pages'], $options);

    echo $this->view('views:partials/nav.php', compact('pages', 'slug'));

});

$app->on('monoplane.footer', function(){

    echo $this->view('views:partials/footer.php');

});

$app->on('monoplane.lang-chooser', function(){

    $languages = [['i18n' => 'en', 'language' => 'English']];

    foreach ($this->helper('fs')->ls('*.php', '#config:cockpit/i18n') as $file) {

        $lang     = include($file->getRealPath());
        $i18n     = $file->getBasename('.php');
        $language = $lang['@meta']['language'] ?? $i18n;

        $languages[] = ['i18n' => $i18n, 'language'=> $language];
    }

    if (count($languages) > 1) {
        echo $this->view('views:partials/lang.php', compact('languages'));
    }

});

$app->on('monoplane.theme-chooser', function(){

    $themes = [];

    $iter = new \DirectoryIterator($this->path('themes:'));

    foreach ($iter as $dir) {

        if ($dir->isDot() || $dir->isFile()) continue;
        if (!file_exists($dir->getPathName() . '/style.min.css')) continue;

        $themes[] = $dir->getFileName();

    }

    if (count($themes) > 1) {
        echo $this->view('views:partials/themes.php', compact('themes'));
    }

});

// contact form

$app->on('frontend.contactform', function($slug = ''/*, $response = []*/){

    // to do:
    // * add some logic to use slugs for e. g. multiple forms

    require_once('Controller/Forms.php');

    echo $this->invoke('Monoplane\\Controller\\Forms', 'form', ['name' => $this->monoplane['contactform']['form']/*, 'response' => $response*/]);

});
