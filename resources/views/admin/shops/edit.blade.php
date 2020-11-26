@extends('layouts.app')

@section('content')
    <h2>Detalles de la tienda</h2>

<h3 class="text-info">{{ Auth::user()->shop()->name }}</h3>
    
@endsection