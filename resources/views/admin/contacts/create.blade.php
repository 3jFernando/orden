@extends('layouts.app')

@section('content')
    <h2>Crear contacto</h2>

    <form 
        novalidate
        method="POST"
        action="{{ route('contacts.store')}}"
    >
        @csrf

        <div class="form-group">
            <label for="name">Nombre</label>
            <input
                type="text" 
                class="form-control @error('name') is-invalid @enderror" 
                id="name" 
                name="name"
                value="{{ old('name') }}"
            >
            @error('name')
                <div class="alert alert-danger mt-1">
                    <span>&times; {{$message}}</span>
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone">Número de teléfono</label>
            <input
                type="text" 
                class="form-control @error('phone') is-invalid @enderror" 
                id="phone" 
                name="phone"
                value="{{ old('phone') }}"
            >
            @error('phone')
                <div class="alert alert-danger mt-1">
                    <span>&times; {{$message}}</span>
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="type_id">Tipo de contacto</label>
            <select 
                class="form-control @error('type_id') is-invalid @enderror" 
                id="type_id" 
                name="type_id">
                <option value="" selected disabled>-- selecciona una categoria.</option>
                
                @foreach ($types as $type)
                    <option 
                        value="{{$type->id}}"
                        {{ old('type_id') == $type->id ? 'selected' : '' }}
                    >{{$type->name}}</option>
                @endforeach

            </select>
            @error('type_id')
                <div class="alert alert-danger mt-1">
                    <span>&times; {{$message}}</span>
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input
                type="text" 
                class="form-control @error('email') is-invalid @enderror" 
                id="email" 
                name="email"
                value="{{ old('email') }}"
            >
            @error('email')
                <div class="alert alert-danger mt-1">
                    <span>&times; {{$message}}</span>
                </div>
            @enderror
        </div>           

        <button type="submit" class="btn btn-dark text-uppercase mt-4">Guardar cambios</button>
      </form>

@endsection