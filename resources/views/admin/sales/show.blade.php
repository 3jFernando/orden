@extends('layouts.app')
@section('menu-active2', 'active')

@section('content')
    <h2>Detalles de la VENTA::{{ $sale->id }} </h2>

    <div class="card card-body shadow-sm">
        <b>Creación: {{ $sale->created_at }}</b> {{ $sale->created_at->diffForHumans() }}
        <hr>
        <b>Contacto:</b> {{ $sale->contact->name }} Tipo {{ $sale->contact->type->name }}

        <div class="table-responsive my-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>PRODUCTO</th>
                        <th>PRESIO UNITARIO</th>
                        <th>CANTIDAD</th>
                        <th>TOTAL</th>
                        <th>UTILIDAD</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sale->products as $product)

                        <tr>
                            <td>
                                <div class="d-flex justify-content-start align-items-center">
                                    <a class="text-uppercase font-weight-bold"
                                        href="{{ route('products.edit', ['product' => $product->product_id]) }}">
                                        VER
                                    </a>
                                    <div class="mx-2">
                                        <img class="rounded-circle" width="35" height="35"
                                            src="{{ asset("storage/".$product->product->image) }}" alt="{{ $product->product->name }}">
                                    </div>
                                    <div>
                                        <b>{{ $product->product->name }}</b><br />
                                        <i>{{ $product->product->reference }}</i>
                                    </div>
                                </div>
                            </td>
                            <td>{{ number_format($product->price_sale_unit, 2) }}</td>
                            <td>{{ number_format($product->quantity, 2) }}</td>
                            <td>{{ number_format($product->total, 2) }}</td>
                            <td>{{ number_format($product->utility, 2) }}</td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end w-100 m-2 mr-2">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Cantidad de productos
                    <b class="badge badge-dark badge-pill ml-4 p-2">{{ count($sale->products) }}</b>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Total
                    <b class="badge badge-dark badge-pill ml-4 p-2">{{ number_format($sale->total, 2) }} COP</b>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Utilidad Total
                    <b class="badge badge-dark badge-pill ml-4 p-2">{{ number_format($sale->total_utility, 2) }} COP</b>
                </li>
            </ul>
        </div>

    </div>

@endsection
