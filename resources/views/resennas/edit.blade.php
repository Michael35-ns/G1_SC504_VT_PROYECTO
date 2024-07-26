@extends('layouts.app')

@section('titulo', 'Editar Reseña')

@section('contenido')
    <form action="{{ route('resennas.update', $resenna->ID_RESENNA) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="detalle">Detalle</label>
            <input type="text" id="detalle" name="detalle" value="{{ $resenna->DETALLE }}" required>
        </div>
        <div>
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" required>{{ $resenna->DESCRIPCION }}</textarea>
        </div>
        <div>
            <button type="submit">Actualizar</button>
        </div>
    </form>
@endsection
