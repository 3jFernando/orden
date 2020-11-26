@extends('layouts.app')

@section('content')
    <h2>Historial de products</h2>

    <div class="d-flex justify-content-end">
      <a href="{{ route('products.create') }}" class="btn btn-sm btn-dark text-white my-2">+ Nuevo producto</a>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th>ACCIONES</th>
          <th></th>
          <th>PRODUCTO</th>
          <th>REFERENCIA</th>
          <th>CATEGORIA</th>
          <th>CANTIDAD EN STOCK</th>
          <th>PRECIO DE VENTA</th>
          <th>UTILIDAD</th>          
        </tr>
      </thead>
      <tbody>

        @if(count($products))

          @foreach ($products as $product)
            <tr>
              <td>
              <a 
                  href="{{ route('products.edit', ['product' => $product->id]) }}" 
                  class="text-info font-weight-bold">
                  Detalles
              </a>
              <form 
                method="POST"
                  action="{{ route('products.destroy', ['product' => $product->id]) }}"
                >
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="btn btn-light text-danger font-weight-bold"
                    onclick="if(!confirm('¿Seguro que deseas eliminar el item?')) return false;">
                    &times;
                </button>
              </form>
              </td>
              <td>
                <img class="rounded-circle" width="40" height="40" src="{{ asset("storage/$product->image") }}" alt="{{$product->name}}">
              </td>
              <td>{{$product->name}}</td>
              <td>{{$product->reference}}</td>
              <td>{{$product->category->name}}</td>
              <td>{{$product->quantity}}</td>
              <td>{{number_format($product->price_sale, 2)}}</td>
              <td>{{number_format($product->utility, 2)}}</td>
            </tr>
          @endforeach

        @else
          <td colspan="6">No hay resultados</td>
        @endif
        
      </tbody>
    </table>

    <div class="d-flex justify-content-center">
      {{ $products->links() }}
    </div>

@endsection