@extends('layouts.app', ['current'=>'home'])

@section('content')
    <div id="app">
        <schedule-component></schedule-component>
        {{-- <router-view></router-view> --}}
    </div>
@endsection
