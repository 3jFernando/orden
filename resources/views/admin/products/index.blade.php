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
          <th>STOCK</th>
          <th>PRECIO DE VENTA</th>
          <th>UTILIDAD</th>          
        </tr>
      </thead>
      <tbody>

        @if(count($products))

          @foreach ($products as $product)
            <tr>
              <td>
                <div class="d-flex justify-content-start align-items-center">
                  <a 
                      href="{{ route('products.edit', ['product' => $product->id]) }}" 
                      class="btn btn-sm btn-outline-dark font-weight-bold mr-2">
                      VER
                  </a>
                  <form 
                    method="POST"
                      action="{{ route('products.destroy', ['product' => $product->id]) }}"
                    >
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="btn btn-sm btn-outline-danger font-weight-bold"
                        onclick="if(!confirm('¿Seguro que deseas eliminar el item?')) return false;">
                        &times;
                    </button>
                  </form>
                </div>
              </td>
              <td>
                <img class="rounded-circle" width="35" height="35" src="{{ asset("storage/$product->image") }}" alt="{{$product->name}}">
              </td>
              <td>{{$product->name}}</td>
              <td>{{$product->reference}}</td>
              <td>{{$product->category->name}}</td>
              <td><span class="badge @if($product->quantity <= 0) badge-danger @elseif($product->quantity > 0 && $product->quantity <= 5) badge-warning @else badge-dark @endif p-2">{{$product->quantity}}</span></td>
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