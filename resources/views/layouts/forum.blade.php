@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 35px">
        @yield('forum-heading')

        <table class="table forum table-striped">
            @yield('forum-content')
        </table>
    </div>
@endsection