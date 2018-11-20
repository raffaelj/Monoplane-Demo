<p>@lang('Choose a theme')</p>
<ul>
    @foreach($themes as $theme)
    <li><a href="?theme={{ $theme }}">{{ $theme }}</a></li>
    @endforeach
</ul>
