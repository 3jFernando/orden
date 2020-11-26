@extends('layouts.app')

@section('content')
    <h2>Detalles de la COMPRA::{{$purchase->id}} </h2>

    <div class="card card-body shadow-sm">
      <b>Creación: {{$purchase->created_at}}</b> {{$purchase->created_at->diffForHumans()}}
      <hr>
      <b>Contacto:</b> {{$purchase->contact->name}} Tipo {{$purchase->contact->type->name}}

      <div class="table-responsive my-4">
        <table class="table">
          <thead>
              <tr>
                  <th>PRODUCTO</th>
                  <th>PRESIO DE COMPRA</th>
                  <th>CANTIDAD</th>
                  <th>TOTAL</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($purchase->products as $product)
                
              <tr>
                  <td>
                      <b>{{ $product->product->name }}</b
                      ><br />
                      <i>{{ $product->product->reference }}</i>
                  </td>
                  <td>{{ number_format($product->price_purchase, 2) }}</td>
                  <td>{{ number_format($product->quantity, 2) }}</td>
                  <td>{{ number_format($product->total, 2) }}</td>
              </tr>

            @endforeach              
          </tbody>
      </table>
      </div>

      <div class="d-flex justify-content-end w-100 m-2 mr-2">
        <ul class="list-group">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Cantidad de productos
            <b class="badge badge-dark badge-pill ml-4 p-2">{{ count($purchase->products) }}</b>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Total
            <b class="badge badge-dark badge-pill ml-4 p-2">{{ number_format($purchase->total, 2) }} COP</b>
          </li>
        </ul>
      </div>

    </div>

@endsection