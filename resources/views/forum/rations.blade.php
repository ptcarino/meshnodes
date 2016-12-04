@extends('forum.rations')

@section('forum-heading')
    <div class="page-header page-heading">
        <h1 class="pull-left">Ration Requests</h1>
        <ol class="breadcrumb pull-right where-am-i">
            <li><a href="#">Forums</a></li>
            <li><a href="/forum">List of topics</a></li>
            <li class="active">Ration Requests</li>
        </ol>
        <div class="clearfix"></div>
    </div>
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
        <td class="hidden-xs hidden-sm"><br>by </td>
        <td class="text-center hidden-xs hidden-sm"></td>
    </tr>
    <tr>
        <td class="text-center"><i class="fa fa-exclamation fa-2x text-danger"></i></td>
        <td>
            <h4><a href="/forum/rescue-efforts">Rescue Efforts</a><br><small>Category description</small></h4>
        </td>
        <td class="hidden-xs hidden-sm"><br>by </td>
        <td class="text-center hidden-xs hidden-sm"></td>
    </tr>
    </tbody>
@endsection