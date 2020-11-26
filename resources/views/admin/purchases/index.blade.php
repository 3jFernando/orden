@extends('layouts.app')

@section('content')
    <h2>Historial de compras</h2>

    <div class="d-flex justify-content-end">
        <a href="{{ route('purchases.create') }}" class="btn btn-sm btn-dark text-white my-2">+ Nueva compra</a>
    </div>
    
    @include('admin.purchases.fragments.list')

@endsection
