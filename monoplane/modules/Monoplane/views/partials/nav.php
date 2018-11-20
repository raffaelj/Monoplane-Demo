<ul>
    @foreach($pages as $p)
    <li><a class="{{ $slug == $p[$app->monoplane['slug']] ? 'active' : '' }}" href="@route($p[$app->monoplane['slug']])">{{ $p['title'] }}</a></li>
    @endforeach
</ul>
