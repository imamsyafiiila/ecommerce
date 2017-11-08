@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="col-xs-3">Hello, {{ Auth::user()->name }}</div>
                    <div class="col-xs-3"><a href="{{ url('prepaid-balance') }}" class="btn btn-xs btn-info"> Need a prepaid Balance ? </a></div>
                    <div class="col-xs-3"><a href="{{ url('product') }}" class="btn btn-xs btn-info"> Want to buy something ? </a></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
