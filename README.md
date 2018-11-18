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

## Requirements

* Cockpit CMS
* FormValidation addon (optional, for contact forms)
* UniqueSlugs addon (optional, for unique slugs instead of id urls)


## to do

* base
  * [x] simple output
  * [x] cleanup
  * [ ] ...
* contact form
  * [x] form quote escape
  * [ ] tests, tests, tests
* i18n
  * [x] content
  * [x] site
  * [x] base
  * [x] contact form
* [x] change theme
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
* [ ] helper functions
  * [ ] getStyleUrl
  * [ ] output formats
    * [ ] md2html
    * [ ] ...
  * [ ] ...
* [ ] GUI addon
* [ ] JS mail pattern protection
* [x] UniqueSlugs addon
* [ ] custom startpage
* [ ] cache
* [x] convert md to html before output
* [ ] errors
* [ ] feed
* [ ] sitemap
* [ ] easteregg
* [x] check themes for third party requests (fonts)
* [x] defines check when mp is root OR is parallel
* [ ] register monoplane as module
  * [ ] change `$cockpit` to `$app`
  * [ ] helper functions with `$app->module('monoplane')->extend([...])`
* [ ] favicon
* [ ] ...
