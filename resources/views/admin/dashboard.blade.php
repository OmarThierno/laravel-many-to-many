@extends('layouts.my-admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-4">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        Hi {{$user->name}} {{ __('You are logged in!') }}
                        <hr>
                        <div>
                            <dl>
                                <dt>Address</dt>
                                <dd>{{$user->userDetail->address}}</dd>
                                <dt>Phone number</dt>
                                <dd>{{$user->userDetail->phone_number}}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
