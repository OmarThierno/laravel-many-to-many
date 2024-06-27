@extends('layouts.my-admin')

@section('content')
    <div class="container my-5">
      @include('partials.errors')
        <h1>Creaded</h1>

        <form action="{{ route('admin.projects.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Inserisci il nome</label>
                <input type="text" class="form-control" id="name" placeholder="laraverl controller" name="name" value="{{old('name')}}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Inserisci una descrizione</label>
                <textarea class="form-control" id="description" rows="3" name="description">{{old('description')}}</textarea>
            </div>
            {{-- <div class="mb-3">
                <label for="slug" class="form-label">Inserisci lo slug</label>
                <input type="text" class="form-control" id="slug" placeholder="laraverl-controller" name="slug">
            </div> --}}
            <h4>Technologies</h4>
            <div class="mb-3">
                <ul class="list-group">
                    @foreach ($technologies as $technology)
                        <li class="list-group-item col-3">
                            <input @checked(in_array($technology->id, old('technologies', []))) class="form-check-input me-1" type="checkbox" value="{{$technology->id}}" id="technology-{{$technology->id}}" name="technologies[]">
                            <label class="form-check-label" for="technology-{{$technology->id}}">{{$technology->name}}</label>
                        </li>
                    @endforeach
                </ul>
            </div>
            <button class="btn btn-success">Crea</button>
        </form>
    </div>
@endsection
