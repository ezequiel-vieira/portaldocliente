@extends('errors::illustrated-layout')

@section('title', __('419'))
@section('code', '419')
@section('message', __('Página Expirou'))
@section('image')
<div style="background-image: url({{ asset('/images/bg-products.jpg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection
