@extends('layouts.my-admin')

@section('content')
  <div class="container">
    <div class="d-flex justify-content-between align-items-center">
      <h1>Project</h1>
      <a href="{{route('admin.projects.create')}}" class="btn btn-primary">Created</a>
    </div>
    <div>
      <form action="{{route('admin.projects.index')}}" method="GET">
        @csrf
        <label for="per_page">Pagination</label>
        <select class="" aria-label="Default select example" name="per_page">
          {{-- <option>Select pagination</option> --}}
          <option @selected($projects->perPage() === '5') value="5">5</option>
          <option @selected($projects->perPage() === '10') value="10">10</option>
          <option @selected($projects->perPage() === '15') value="15">15</option>
        </select>

        <button type="submit" class="btn btn-primary">Applica</button>
      </form>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">name</th>
          <th scope="col">Type</th>
          <th scope="col">description</th>
          <th scope="col">programming_languages</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($projects as $project)
          <tr>
            <th scope="row">{{$project->id}}</th>
            <td>{{$project->name}}</td>
            <td>{{$project->type?->name}}</td>
            <td>{{$project->description}}</td>
            <td>{{$project->programming_languages}}</td>
            <td>
              <a href="{{route('admin.projects.show', ['project' => $project->slug])}}" class="btn btn-success">SHOW</a>
              <a href="{{route('admin.projects.edit', ['project' => $project->slug])}}" class="btn btn-warning">Modify</a>
              <form action="{{route('admin.projects.destroy', $project->slug)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </td>
          </tr>
            
        @endforeach

      </tbody>
    </table>

    <div>
      {{$projects->appends(['per_page'=> $projects->perPage()])->links()}}
    </div>
  </div>


@endsection