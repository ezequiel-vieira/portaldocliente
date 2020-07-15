@extends('errors::illustrated-layout')

@section('title', __('429'))
@section('code', '429')
@section('message', __('Demasiados Pedidos'))
@section('image')
<div style="background-image: url({{ asset('/images/bg-products.jpg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection
