@extends('layouts.forum')

@section('forum-heading')
    <div class="page-header page-heading">
        <h1 class="pull-left">Forums</h1>
        <ol class="breadcrumb pull-right where-am-i">
            <li><a href="#">Forums</a></li>
            <li class="active">List of topics</li>
        </ol>
        <div class="clearfix"></div>
    </div>
    <p class="lead">
        This forum is for requesting information that does not require real-time communications. Please be Guided Accordingly.
    </p>
@endsection

@section('forum-content')
    <thead>
    <tr>
        <th class="cell-stat"></th>
        <th>
            <h3>Important</h3>
        </th>
        <th class="cell-stat-2x hidden-xs hidden-sm">Last Post</th>
        <th class="cell-stat text-center hidden-xs hidden-sm">Posts</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="text-center"><i class="fa fa-exclamation fa-2x text-danger"></i></td>
        <td>
            <h4><a href="/forum/rations-request">Rations Request</a><br><small>Some description</small></h4>
        </td>
        <td class="hidden-xs hidden-sm">{{ $rlast['post_title'] }}<br>by {{ $rlast['username'] }}</td>
        <td class="text-center hidden-xs hidden-sm">{{ $rations_count }}</td>
    </tr>
    <tr>
        <td class="text-center"><i class="fa fa-exclamation fa-2x text-danger"></i></td>
        <td>
            <h4><a href="/forum/rescue-efforts">Rescue Efforts</a><br><small>Category description</small></h4>
        </td>
        <td class="hidden-xs hidden-sm">{{ $rclast['post_title'] }}<br>by {{ $rclast['username'] }}</td>
        <td class="text-center hidden-xs hidden-sm">{{ $rescue_count }}</td>
    </tr>
    </tbody>
@endsection