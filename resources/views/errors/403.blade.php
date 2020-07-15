@extends('errors::illustrated-layout')

@section('title', __('403'))
@section('code', '403')
@section('message', __('Acesso Proibido'))
@section('image')
<div style="background-image: url({{ asset('/images/bg-products.jpg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection
