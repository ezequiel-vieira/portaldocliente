@extends('errors::illustrated-layout')

@section('title', __('401'))
@section('code', '401')
@section('message', __('Não Autorizado'))
@section('image')
<div style="background-image: url({{ asset('/images/bg-products.jpg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection
