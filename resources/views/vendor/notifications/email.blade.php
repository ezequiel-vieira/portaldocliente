@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Olá!')
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Melhores cumprimentos'),
<br>
Portal do Cliente | ANNII
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(

    //"If you’re having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
    //'into your web browser: [:actionURL](:actionURL)',
    "Se está tendo problemas em clicar no botão \"Verificar seu Endereço de Email\", copie e cole o link apresentado abaixo\n".
    'em seu browser: [:actionURL](:actionURL)',
    [
        'actionText' => $actionText,
        'actionURL' => 'http://portaldocliente.gruponobrega.pt/',
    ]
    /*[
        'actionText' => $actionText,
        'actionURL' => $actionUrl,
    ]*/
)
@endslot
@endisset
@endcomponent
