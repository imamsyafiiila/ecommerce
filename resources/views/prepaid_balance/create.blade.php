@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Prepaid Balance Form</div>

                    <div class="panel-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {!! Form::open(['url' => 'store-pre']) !!}
                        <div class="form-group">
                            {!! Form::label('number_label', 'Mobile Phone Number') !!}
                            {!! Form::text('number', '', ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('value_label', 'Value') !!}
                            {!! Form::select('value', ['10' => '10000', '50' => '50000', '100' => '100000'], null, ['class' => 'form-control', 'placeholder' => '-- Select Value -- ']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Submit', ['class']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
