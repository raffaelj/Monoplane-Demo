<?php
/*
  To do: cleanup, $title etc. should be in Monoplane class
*/
if (empty($site)) {
    $site = $app->site;
}

$title = isset($page['title']) && trim($page['title']) != '' ? $page['title'] . ' - ' : '';
$title .= $site['site_name'] ?? $app['app.name'];
$title = htmlspecialchars($title);
$title = str_replace('&nbsp;', ' ', $title);

$description = isset($page['description']) && trim($page['description']) != '' ? $page['description'] : $site['site_description'];
$description = htmlspecialchars($description);

?>
<!DOCTYPE html>
<html lang="{{ $_SESSION['lang'] ?? $app['i18n'] }}">
    <head>
        <meta charset="utf-8" />
        <meta content='text/html; charset=utf-8' http-equiv='Content-Type'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0'>
        
        <title>{{ !empty($page['title']) ? $page['title'] . ' - ' : '' }}{{ $site['site_name'] ?? $app['app.name'] }}</title>
        <meta name="description" content="{{ $description }}" />
        
        <meta property="og:description" content="{{ $description }}" />
        <meta property="og:title" content="{{ $title }}" />
        <meta property="twitter:title" content="{{ $title }}" />

        <link rel="stylesheet" type="text/css" href="@base('themes:' . ($_SESSION['theme'] ?? $app->monoplane['theme']) . '/style.min.css')?v=' . $app->monoplane['theme'] . $app->monoplane['version'] . '" />

        @if($app->monoplane['customcss'])
        <style>
        {{ $app->monoplane['customcss'] }}
        </style>
        @endif

        @trigger('monoplane.head.favicon')
    </head>
    
    <body id="top">
        <header>
            <a class="logo" href="{{ BASE_URL }}/">
                <img alt="{{ $site['logo']['title'] ?? 'logo' }}" src="@uploads($site['logo']['path'])" />
            </a><h1><a href="{{ BASE_URL }}/">{{ $site['site_name'] ?? $app['app.name'] }}</a></h1>

            @if(!empty($site['slogan']))
            <p class="slogan">{{ $site['slogan'] }}</p>
            @endif
            
            @if(isset($site['contactinfo']))
            <aside>
                @if(!empty($site['contactinfo']['name']))
                <p class="name">{{ str_replace(" ","&nbsp;",$site['contactinfo']['name']) }}</p>
                @endif
                
                @if(!empty($site['contactinfo']['telephone']))
                <p class="phone"><a href="tel:{{ str_replace([' ','-'], '', $site['contactinfo']['telephone']) }}">{{ str_replace(' ', '&nbsp;', $site['contactinfo']['telephone']) }}</a></p>
                @endif
                
                @if(!empty($site['contactinfo']['mail']))
                <p class="mail"><a href="mailto:{{ $site['contactinfo']['mail'] }}">{{ $site['contactinfo']['mail'] }}</a></p>
                @endif
            </aside>
            @endif
          
            @trigger('monoplane.header')

        </header>

        <nav>
            @trigger('monoplane.nav', [$page['_id'] ?? '', 'main'])
        </nav>
        <aside>
            <nav>
                @trigger('monoplane.lang-chooser')
            </nav>
        </aside>

        <main id="main">
            <article>
                <div>
                    {{ $content_for_layout }}
                </div>
            </article>
        </main>
        <footer>
            <nav>
                @trigger('monoplane.nav', [$page['slug'] ?? '', 'secondary'])
            </nav>
            <nav>
                @trigger('monoplane.theme-chooser')
            </nav>
            @trigger('monoplane.footer')
        </footer>
    </body>
</html>
