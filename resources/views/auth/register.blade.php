@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    @if(session('name'))
                                        <input id="name" type="text" class="form-control" name="name" value="{{ session('name') }}">
                                    @else
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                                    @endif

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('mac') ? ' has-error' : '' }}">
                                <label for="mac" class="col-md-4 control-label">Mac Address</label>

                                <div class="col-md-6">
                                    <input id="mac" type="text" class="form-control" name="mac" value="{{ $mac }}" readonly>

                                    @if ($errors->has('mac'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('mac') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
