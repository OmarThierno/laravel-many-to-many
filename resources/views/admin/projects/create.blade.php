@extends('layouts.my-admin')

@section('content')
    <div class="container my-5">
      <h1>Creaded</h1>

      <form action="{{route('admin.projects.store')}}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Inserisci il nome</label>
          <input type="text" class="form-control" id="name" placeholder="laraverl controller" name="name">
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Inserisci una descrizione</label>
          <textarea class="form-control" id="description" rows="3" name="description"></textarea>
        </div>
        <div class="mb-3">
          <label for="programming-languages" class="form-label">Inserisci il linguaggio</label>
          <input type="text" class="form-control" id="programming-languages" placeholder="JS" name="programming_languages">
        </div>
        <div class="mb-3">
          <label for="slug" class="form-label">Inserisci lo slug</label>
          <input type="text" class="form-control" id="slug" placeholder="laraverl-controller" name="slug">
        </div>
        <button class="btn btn-success">Crea</button>
      </form>
    </div>
@endsection