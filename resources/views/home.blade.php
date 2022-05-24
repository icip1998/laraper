@extends('layouts.main')

@section('container')
    <h1>Home</h1>

    @can('isAdmin')
        Selamat datang Admin
    @elsecan('isManager')
        Selamat datang Manager
    @endcan
@endsection