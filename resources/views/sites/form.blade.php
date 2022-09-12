@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $site->id ? 'Edit ' . $site->name : 'New Site' }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="/sites/{{ $site->id ?: ''}}" method="post">
                            {{ csrf_field() }}
                            @if($site->id)
                                {{ method_field('PUT')}}
                            @endif
                            <div class="form-group">
                                <label for="siteName">Site name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="siteName"
                                    name="name"
                                    value="{{old('name', $site->name)}}"
                                    placeholder="{{ $namePlaceholder ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="siteType">Site type</label>
                                <select
                                    id="siteType"
                                    class="form-control"
                                    name="type">
                                    @foreach($default_types as $type)
                                        <option value="{{$type}}" {{$site->type == $type ? 'selected' : ''}}>{{$type}}</option>
                                    @endforeach
{{--                                    <option value="Vessel">Vessel</option>--}}
{{--                                    <option value="Power plant">Power plant</option>--}}
{{--                                    <option value="Utility structure">Utility structure</option>--}}
{{--                                    <option value="Manufacturing facility">Manufacturing facility</option>--}}
{{--                                    <option value="Mining facility">Mining facility</option>--}}
{{--                                    <option value="Oil and gas production facility">Oil and gas production facility--}}
{{--                                    </option>--}}
{{--                                    <option value="Data Center">Data Center</option>--}}
{{--                                    <option value="Tall building">Tall building</option>--}}
{{--                                    <option value="Hotels and resorts">Hotels and resorts</option>--}}
{{--                                    <option value="Amusement park">Amusement park</option>--}}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="siteName">AirTable Access key</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="airtableAccessKey"
                                    name="airtable_access_key"
                                    value="{{old('airtable_access_key', $site->airtable_access_key)}}"

                                >
                            </div>
                            <div class="form-group">
                                <label for="siteName">AirTable Base ID</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="airtableBaseId"
                                    name="airtable_base_id"
                                    value="{{old('airtable_base_id', $site->airtable_base_id)}}"

                                >
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
