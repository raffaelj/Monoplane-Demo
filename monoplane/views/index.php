@if(!isset($page['displaytitle']) || $page['displaytitle'] !== false)
<h1>{{ $page['title'] }}</h1>
@endif

@if(!empty($page['image']))
<img src="@thumbnail($page['image']['path'])" alt="{{ $image['title'] ?? 'image' }}" class="featured" />
@endif

{{ $page['content'] }}

@if(isset($page['contactform']) && $page['contactform'] === true)
    @trigger('frontend.contactform', [$app->monoplane['slug'] => $page[$app->monoplane['slug']]])
@endif
