@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Site: <strong>{{ $site->name }}</strong></div>

                    <div class="card-body">
                        <ul>
                            <li><strong>Name: </strong> {{ $site->name }}</li>
                            <li><strong>Type:</strong> {{ $site->type }}</li>
                            <li><strong> Owner: </strong> {{ $site->user->name }}</li>
                            <li><strong>Created : </strong> {{ $site->created_at }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
