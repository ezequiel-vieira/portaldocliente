@extends('errors::illustrated-layout')

@section('title', __('404'))
@section('code', '404')
@section('message', __('Página não encontrada'))
@section('image')
<div style="background-image: url({{ asset('/images/bg-products.jpg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection
