@extends('layouts.app')
@section('menu-active5', 'active')

@section('content')
    <h2>Historial de contactos</h2>

    <div class="d-flex justify-content-end">
      <a href="{{ route('contacts.create') }}" class="btn btn-sm btn-dark text-white my-2">+ Nuevo contacto</a>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th>ACCIONES</th>          
          <th>CONTACTO</th>
          <th>RELACION</th>
          <th>TELEFONO</th>
          <th>CORREO</th>
        </tr>
      </thead>
      <tbody>

        @if(count($contacts))

          @foreach ($contacts as $contact)
            <tr>
              <td>
                <div class="d-flex justify-content-start align-items-center">
                  <a href="{{ route('contacts.edit', ['contact' => $contact->id]) }}" 
                    class="btn btn-sm btn-outline-dark font-weight-bold mr-2">Detales</a>
                  <form 
                    action="{{ route('contacts.destroy', ['contact' => $contact->id]) }}"
                    method="POST"
                    >
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger font-weight-bold" type="submit">&times;</button>
                  </form>
                </div>
              </td>
              <td>{{$contact->name}}</td>
              <td>{{$contact->type->name}}</td>
              <td>{{$contact->phone}}</td>
              <td>{{$contact->email}}</td>
            </tr>
          @endforeach

        @else
          <td colspan="6">No hay resultados</td>
        @endif
        
      </tbody>
    </table>

    <div class="d-flex justify-content-center">
      {{ $contacts->links() }}
    </div>

@endsection