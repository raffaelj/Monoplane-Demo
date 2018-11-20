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
            return preg_replace('/(\s*)@uploads\((.+?)\)/', '$1<?php echo BASE_URL; $app->base("#uploads:" . $2); ?>', $content);
        });
        
        $this->app->renderer->extend(function($content){
            return preg_replace('/(\s*)@style\((.+?)\)/', '$1<?php echo BASE_URL; $app->base("themes:" . ($_SESSION["theme"] ?? $app->monoplane["theme"]) . "/" . $2); ?>', $content);
        });
        

        $this->app->renderer->extend(function($content){
            // to do:
            // * customizable with user variables
            return preg_replace('/(\s*)@thumbnail\((.+?)\)/', '$1<?php echo $app->module("monoplane")->thumbnail(["src" => "#uploads:".$2, "width" => $app->monoplane["featured_image_width"] ?? "200"]); ?>', $content);

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

}
