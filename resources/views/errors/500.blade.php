@extends('errors::illustrated-layout')

@section('title', __('500'))
@section('code', '500')
@section('message', __('Erro de Servidor'))
@section('image')
<div style="background-image: url({{ asset('/images/bg-products.jpg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection
