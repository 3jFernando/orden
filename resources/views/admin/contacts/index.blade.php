@extends('layouts.app')

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
                
                <a href="{{ route('contacts.edit', ['contact' => $contact->id]) }}" class="text-info font-weight-bold">Detales</a>
                <form 
                  action="{{ route('contacts.destroy', ['contact' => $contact->id]) }}"
                  method="POST"
                  >
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger" type="submit">&times;</button>
                </form>
                
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