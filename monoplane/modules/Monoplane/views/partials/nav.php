<ul>
    @foreach($pages as $p)
    <li><a class="{{ $slug == $p[$app->monoplane['slug']] ? 'active' : '' }}" href="{{ BASE_URL . '/' . $p[$app->monoplane['slug']] }}">{{ $p['title'] }}</a></li>
    @endforeach
</ul>
