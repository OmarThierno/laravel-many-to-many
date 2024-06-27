@extends('layouts.my-admin')

@section('content')
    <div class="container">
        @include('partials.errors')
        <h1>Edit</h1>

        <form action="{{ route('admin.projects.update', ['project' => $project->slug]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Modifica il nome</label>
                <input type="text" class="form-control" id="name" placeholder="laraverl controller" name="name"
                    value="{{ old('name', $project->name) }}">
            </div>
            <div>
                <label for="type_id"></label>
                <select id="type_id" class="form-select" aria-label="Default select example" name="type_id">
                    <option selected>Selecte</option>
                    @foreach ($types as $type)
                        <option @selected($project->type?->name === $type->name) value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Modifica la descrizione</label>
                <textarea class="form-control" id="description" rows="3" name="description">{{ old('description', $project->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Modifica lo slug</label>
                <input type="text" class="form-control" id="slug" placeholder="laraverl-controller" name="slug"
                    value="{{ old('slug', $project->slug) }}">
            </div>
            <div class="btn-group mb-3" role="group" aria-label="Basic checkbox toggle button group">
                @foreach ($technologies as $technology)
                    @if (old('technologies') === null)
                        <input @checked($project->technologys->contains($technology)) type="checkbox" class="btn-check"
                            id="technology-{{ $technology->id }}" autocomplete="off" value="{{ $technology->id }}"
                            name="technologies[]">
                    @else
                        <input @checked(in_array($technology->id, old('technologies'))) type="checkbox" class="btn-check"
                            id="technology-{{ $technology->id }}" autocomplete="off" value="{{ $technology->id }}"
                            name="technologies[]">
                    @endif
                    <label class="btn btn-outline-primary"
                        for="technology-{{ $technology->id }}">{{ $technology->name }}</label>
                @endforeach
            </div>
            <div>
                <button class="btn btn-success">Modify</button>

            </div>
        </form>
    </div>
@endsection
