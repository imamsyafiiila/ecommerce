@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Product Ecommerce Form</div>

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
                        {!! Form::open(['url' => 'store-pro']) !!}
                        <div class="form-group">
                            {!! Form::label('product_label', 'Product') !!}
                            {!! Form::textarea('product', '', ['class' => 'form-control', 'size' => '30x5']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('address_label', 'Shipping Address') !!}
                            {!! Form::textarea('address', '', ['class' => 'form-control', 'size' => '30x5']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('price_label', 'Price') !!}
                            {!! Form::text('price', '', ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Submit', ['class' => 'btn']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
