<?php
$form = new Monoplane\Controller\Forms($app);
?>
<form id="contact" method="post" action="{{ BASE_URL . '/submit/' . $app->monoplane['contactform']['form'] }}">
    <fieldset>
        <legend>@lang('Contact Form')</legend>

        @if($error = $form->seriousError($fields, $response))
        <p class="message error alarm">
            <strong>@lang('Something went wrong').</strong><br>
            {{ $error }}
        </p>
        @endif
        
        @if(!empty($_GET['success']))
        <p class="message success">@lang($form->message['success'])</p>
        @endif

        @if(!empty($_GET['notice']))
        <p class="message error">@lang($form->message['notice'])</p>
        @endif

        @foreach($fields as $field)
        {{ $form->renderField($field, $response) }}
        @endforeach

        <input name="submit" type="submit" value="@lang($form->message['submit'])" />

    </fieldset>
</form>
