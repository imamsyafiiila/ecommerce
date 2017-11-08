<?php
$description = '';
if ($params[0] ==  config('constant.TYPE_ORDER_PREPAID')) {
    $description = 'Your Mobile Phone '.$params[3].' will be topped up for '.$params[4].'.000';
} else {
    $description = $params[3].' that costs '.$params[4].' will be shipped to '.$params[5];
}
?>

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <center>
                            Your Order Number<br>
                            {{ $params[1] }}
                            <br>
                            <br>
                            Total<br>
                            {{ $params[2] }}
                            <br>
                            <br>
                            {{ $description }}<br>
                            after you pay<br>
                            {!! Form::open(['url' => 'payment']) !!}
                            {!! Form::hidden('order_number', $params[1]) !!}
                            {!! Form::submit('PayHere', ['class' => 'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
