@extends('layouts.app')

@section('content')

    <h4 class="text-dark font-weight-bold text-uppercase card-title">Filtros</h4>
    <v-home-filters ref="filter" since="{{ $since }}" until="{{ $until }}"></v-home-filters>

@endsection
