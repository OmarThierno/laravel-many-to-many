@extends('layouts.my-admin')

@section('content')
  <div class="container">
    <h1>{{$project->name}}</h1>
    <p>{{$project->description}}</p>
    <p>{{ $project->programming_languages }}</p>
    <p>{{$project->slug}}</p>
  </div>
@endsection