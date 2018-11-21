<p>@lang('Choose a language'):</p>
<ul>
    @foreach($languages as $lang)
    <li><a title="{{ $lang['language'] }}" class="lang {{ $lang['i18n'] }}{{ $lang['i18n'] == $app('i18n')->locale ? ' active' : '' }}" href="?lang={{ $lang['i18n'] }}">{{ $lang['i18n'] }}</a></li>
    @endforeach
</ul>
