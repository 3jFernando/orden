@extends('layouts.app')
@section('menu-active2', 'active')

@section('content')
    <h2>Historial de ventas</h2>

    <div class="d-flex justify-content-end">
        <a href="{{ route('sales.create') }}" class="btn btn-sm btn-dark text-white my-2">+ Nueva venta</a>
    </div>
    
    @include('admin.sales.fragments.list')

@endsection
