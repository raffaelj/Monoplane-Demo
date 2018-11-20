# Monoplane Demo

Place the files in this structure:

```
./
  cockpit/
  monoplane/
  yourCustomDir/
  .htaccess
  index.php
  yourCustomFiles...
```

Content of `.htaccess`:

```
<IfModule mod_rewrite.c>
  RewriteEngine On
  
  # rules for Cockpit
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteRule ^(.*)$ index.php/$1 [QSA,L]
</IfModule>
```

Content of `index.php`:

```
<?php
session_start();

// load monoplane
require_once('./monoplane/monoplane.php');

// run app
$cockpit->run();
```

## Requirements

* Cockpit CMS
* FormValidation addon (optional, for contact forms)
* UniqueSlugs addon (optional, for unique slugs instead of id urls)


## to do

* contact form
  * [ ] tests, tests, tests
  * [ ] split into separate module
  * [ ] clear form button
* [ ] install script
* content
  * [ ] imprint
  * [ ] privacy
  * [ ] docs
  * [ ] about me
  * [ ] credits
  * [ ] ...
* [ ] docs
* [ ] donation options
* [ ] custom views
* [ ] GUI addon
* [ ] JS mail pattern protection
* [ ] custom startpage
* [ ] cache
* [ ] errors
* [ ] feed --> write XML API addon as Feed addon replacement
* [ ] sitemap
* [ ] favicon
* [ ] fix black background of transparent png thumbnail
* [ ] nested nav
* [ ] ...
