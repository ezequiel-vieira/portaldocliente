@extends('errors::illustrated-layout')

@section('title', __('503'))
@section('code', '503')
@section('message', __('Serviço Indisponível'))
@section('image')
<div style="background-image: url({{ asset('/images/bg-products.jpg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection
