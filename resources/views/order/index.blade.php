<?php
/* @var $orders \App\Order */
?>

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="pull-right">
                                    <input type="text" onkeyup="onKeyUpSearch(this.value)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2">
                                Order No.
                            </div>
                            <div class="col-xs-5">
                                Description
                            </div>
                            <div class="col-xs-2">
                                Total
                            </div>
                            <div class="col-xs-3">
                                Information
                            </div>
                        </div>
                        <div id="table-show">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script language="JavaScript" type="text/javascript">
    firstFunc();

    function firstFunc(data = null) {

        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': 'j238Oqga9o8XU9rNjCeOgbuJO4tau3tGZnVFbrda'
            },
            data: {
                id: data
            },
            url: 'search-data',
            success : function(data){
                data_arrays = JSON.parse(data);
                var field = '';
                $(data_arrays).each(function (index, value) {
                    var status = '';
                    if (value.ord_status == '1') {
                        status = "<a href='{{ url('payment?order_number=') }}"+ value.ord_order_number +"' class='btn btn-xs btn-info'>Pay</a>";
                    } else if (value.ord_status == '2') {
                        status = 'Success';
                    } else if (value.ord_status == '3') {
                        status = 'Fail';
                    } else {
                        status = value.ord_status
                    }
                    var field2 = "<div class='row'>" +
                        "<div class='col-xs-2'>" +
                            value.ord_order_number +
                        "</div>" +
                        "<div class='col-xs-5'>" +
                            value.ord_description +
                        "</div>" +
                        "<div class='col-xs-2'>" +
                            value.ord_amount +
                        "</div>" +
                        "<div class='col-xs-3'>" +
                            status +
                        "</div>" +
                        "</div>";
                    field += field2;
                });
                $("#table-show").html(field);
            }
        });
    }
    
    function onKeyUpSearch(str) {
        firstFunc(str);
    }
</script>
