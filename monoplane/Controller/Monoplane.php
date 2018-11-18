<?php

namespace Monoplane\Controller;

class Monoplane extends \LimeExtra\Controller {

    protected $site;
    protected $slug;
    protected $pages;
    public $lang;

    public function __construct($cockpit){

        $this->site = $cockpit->monoplane['site'] = $cockpit->monoplane['site'] ?? null;
        $this->slug = $cockpit->monoplane['slug'] = $cockpit->monoplane['slug'] ?? '_id';
        $this->pages = $cockpit->monoplane['pages'] = $cockpit->monoplane['pages'] ?? 'pages';

        parent::__construct($cockpit);

        // extend lexy parser
        $this->app->renderer->extend(function($content){
            return preg_replace('/(\s*)@uploads\((.+?)\)/', '$1<?php $app->base("/storage/uploads" . $2); ?>', $content);
        });

        $this->app->renderer->extend(function($content){
            // to do:
            // * customizable with user variables
            // * call a helper function
            return preg_replace('/(\s*)@thumbnail\((.+?)\)/', '$1<?php echo $app->module("cockpit")->thumbnail(["src" => "#uploads:".$2, "width" => "200"]); ?>', $content);

        });

    }

    protected function before() {

        // to do: SEO-friendly i18n
        if ($this->app->param('lang')) {
            $_SESSION['lang'] = $this->param('lang');
        }
        $this->lang = $_SESSION['lang'] ?? $this->app['i18n'];

        // theme chooser only for demo
        if ($this->app->param('theme')) {
            $_SESSION['theme'] = $this->param('theme');
        }

    }

    public function index($slug = '') {

        // $collection = $this->app->module('collections')->collection($this->pages);

        $options = [
            'filter' => [
                $this->slug => $slug,
                'published' => true
            ],
            'lang' => $this->lang ?? null
        ];

        if (!$page = $this->app->module('collections')->find($this->pages, $options)) {
            return;
        }

        // needs a check if markdown or html or text
        $page[0]['content'] = $this->module('cockpit')->markdown($page[0]['content']);

        return $this->render('views:index.php', ['site' => $this->site, 'page' => $page[0]]);

    }

    public function error($status = '') {

        // To do: 401, 500

        switch ($status) {
            case '404':
                return $this->render('views:errors/404.php', ['site' => $this->site]);
                break;
        }

    }
/* 
    // helper for dev debug info, will be deleted later
    public function debugVars($app) {
        
        $vars = [
            'app_important_routes' => [
                'route' => $app['route'],
                'base_url' => $app['base_url'],
                'base_route' => $app['base_route'],
                'base_host' => $app['base_host'],
                'base_port' => $app['base_port'],
                'docs_root' => $app['docs_root'],
                'site_url' => $app['site_url'],
            ],
            'DOCUMENT_ROOT' => $_SERVER['DOCUMENT_ROOT'],
            'cockpit_DIR' => dirname(dirname(__DIR__)), // may differ from DOCUMENT_ROOT (symlinks)
            'user_constants' => get_defined_constants(true)['user'],
            'app_paths' => $app['paths'],
            'SERVER' => $_SERVER,
            'app_config' => $app->config, // config.yaml + app defaults
            // 'app' => $app, // the whole app, needs a few seconds to load/print
        ];

        echo '<pre>' . print_r($vars, true) . '</pre>';

    }
 */
}
