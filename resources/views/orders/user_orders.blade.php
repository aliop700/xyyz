@extends('layouts.main')

@section('title', 'Index')
@section('content')
<!--header-->
<div class="header2 text-center">
	
</div>
<!--header//-->
<div class="container">
    <div class="row">
        <div class="my_orders_main">
            <table id="orders" class="table table-striped table-bordered dt-responsive" style="width:100%">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>{{ __('id(Paypal)') }}</th>
                        <th>{{ __('Order Status') }}</th>
                        <th>{{ __('Date') }}</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
        </div>
    </div>
</div>
@include('components.datatable')
<script>
      var ordersList;
         getOrders();
         function getOrders(){
            $.ajax({
               type: "get",
               url: '/userOrders',
               success: function(res) 
                  {
                     $('#orders tbody').empty();
                     ordersList = res.data;
                      res.data.length ? res.data.forEach(function(order){
                        $('#orders tbody').append(
                           '<tr>'+
                              '<td>'+order.id+'</td>'+
                              '<td>'+order.payment_id+'</td>'+
                              '<td>'+order.status+'</td>'+
                              '<td>'+order.created_at+'</td>'+
                           '</tr>'
                        )
                     }) : '';
                     drawDataTable('orders');   

                  },
                  error: function(){
                     drawDataTable('orders');   

                     alert('failure');
                  }
               });
               
         }
      </script>
@endsection
