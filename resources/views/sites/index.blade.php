@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <ol class="breadcrumb breadcrumb-style1 mg-b-0">
                            <li class="breadcrumb-item active" aria-current="page">
                                Sites
                            </li>
                        </ol>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(count($sites))
                                <div class="mb-3">
                                    <a class="btn btn-primary" href="{{route('export', ['type' => 'all_sites'])}}">Export to CSV</a>
                                </div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sites as $site)
                                    <tr>
                                        <td>{{ $site->id }}</td>
                                        <td>
                                            <a href="/sites/{{ $site->id }}">{{ $site->name }}</a>
                                        </td>
                                        <td>{{ $site->type }}</td>
                                        <td>
                                            <a href="/sites/{{ $site->id }}/edit">Edit</a> ,

                                            <a href="{{route('view-airtable', ['site_id' => $site->id])}}">View Airtable</a>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                                <div class="text-center">
                                {{ $sites->links() }}
                                </div>
                        @else
                            <div class="text-center">
                                <p>You have not created any sites yet.</p>
                            </div>
                        @endif
                        <hr>
                        <div class="text-center">
                            <a class="btn btn-primary" href="/sites/create">New site</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

