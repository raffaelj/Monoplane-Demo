<p>@lang('Choose a theme'):</p>
<ul>
    @foreach($themes as $theme)
    <li><a href="?theme={{ $theme }}" class="{{ $theme == ($_SESSION['theme'] ?? $app->monoplane['theme']) ? 'active' : '' }}">{{ $theme }}</a></li>
    @endforeach
</ul>
