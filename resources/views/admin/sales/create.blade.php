@extends('layouts.app')
@section('menu-active2', 'active')

@section('content')
    <h2>Crear venta</h2>

    <form 
        novalidate
        method="POST"
        action="{{ route('sales.store')}}"
        enctype="multipart/form-data"
    >
        @csrf

        <div class="form-group">
            <label for="contact_id">Selecciona el contacto</label>
            <select 
                class="form-control @error('contact_id') is-invalid @enderror" 
                id="contact_id" 
                name="contact_id">
                <option value="" selected disabled>-- Selecciona el contacto.</option>
                
                @foreach ($contacts as $contact)
                    <option 
                        value="{{$contact->id}}"
                        {{ old('contact_id') == $contact->id ? 'selected' : ( session('contact_id') ? ( session('contact_id') == $contact->id ? 'selected' : '' ) : '' ) }}
                    >{{ $contact->name }}</option>
                @endforeach

            </select>
            @error('contact_id')
                <div class="alert alert-danger mt-1">
                    <span>&times; {{$message}}</span>
                </div>
            @enderror
        </div>

        <v-products--sales-carshop></v-products--sales-carshop>

        <input
            type="hidden" 
            id="total"
            value="{{ old('total') ? old('total') : ( session('total') ? session('total') : 0 ) }}" 
            name="total" >
        <input
            type="hidden" 
            id="products"
            value="{{ old('products') ? old('products') : ( session('products') ? session('products') : json_encode([]) ) }}" 
            name="products" >

        <button type="submit" class="btn btn-dark text-uppercase">Generar venta</button>
      </form>

@endsection