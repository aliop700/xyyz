@extends('layouts.main')

@section('title', __('Home'))
@section('content')

@if(!auth()->user() ||  !auth()->user()->isAdmin())
   <script>
      window.location.replace('/')
   </script>
@endif
<!--header-->
<div class="header2 text-center"></div>
<!--header//-->
      
@include('components.admin_sub_nav')

      <div class="main-content-admin container">
       <table id="orders" class="table table-striped table-bordered dt-responsive" style="width:100%">
            <thead>
               <tr>
                  <th>Id</th>
                  <th>{{ __('Products') }}</th>
                  <th>{{ __('Email') }}</th>
                  <th>{{ __('Mobile Number') }}</th>
                  <th>{{ __('Location') }}</th>
                  <th>{{ __('Delivery Method') }}</th>
                  <th>{{ __('id(Paypal)') }}</th>
                  <th>{{ __('Order Status') }}</th>
                  <th>{{ __('Date') }}</th>
               </tr>
            </thead>
            <tbody></tbody>
         </table>
      </div>
      <script>
      var ordersList;
         getOrders();
         function getOrders(){
            $.ajax({
               type: "get",
               url: '/orders',
               success: function(res) 
                  {
                     $('#orders tbody').empty();
                     ordersList = res.data;
                      res.data.forEach(function(order){
                        $('#orders tbody').append(
                           '<tr>'+
                              '<td>'+order.id+'</td>'+
                              '<td><button class="btn btn-primary" onclick="orderDetails('+order.id+')">{{__("Details")}}</td>'+
                              '<td>'+order.email+'</td>'+
                              '<td>'+order.phone+'</td>'+
                              '<td>'+order.location+'</td>'+
                              '<td>'+order.delievery_method+'</td>'+
                              '<td>'+order.payment_id+'</td>'+
                              '<td>'+order.status+'</td>'+
                              '<td>'+order.created_at+'</td>'+
                              // '<td><button class="btn btn-primary" onclick="orderDetails('+order.id+')">{{__("Details")}}</td>'+
                           '</tr>'
                        )
                     })
                     $('#orders').DataTable({
                        "initComplete": function(settings, json) {
                           $('table#orders').parent().addClass('dataTableFirstWrapper')
                        }
                     });

                  },
                  error: function(){
                  $('#orders').DataTable({
                        "initComplete": function(settings, json) {
                           $('table#orders').parent().addClass('dataTableFirstWrapper')
                        }
                     });
                     alert('failure');
                  }
               });
               
         }
         function orderDetails(id){
            $('#order_datails_modal .modal-body').empty();
            var order = ordersList.filter(function(order){
               return order.id == id;
            })[0];
            var order_items = order.items;
            var items_table = document.createElement('tbody');

            order_items.forEach(function(item){
            
               $('<tr>'+
               '<td>'+(lang =='en' ? item.product.name : item.product.name_ar )+'</td>'+
               '<td>'+item.quantity+'</td>'+
               '<td>'+(item.product.file ? '<img width="100px" alt="img" src="'+ item.product.file.path+'"/>'  : '')+'</td>'+
               '</tr>').appendTo(items_table);
            })
            $('#order_datails_modal .modal-body').html(
            '<div class="card">'+
               '<dl class="">'+
                  '<dt>id</dt>'+
                  '<dd>'+order.id+'</dd>'+
               '</dl>'+
               '<dl class="full">'+
                  '<dt>{{__("Order items")}}</dt>'+
                  '<dd>'+
                  '<table class="table table-striped table-bordered ">'+
                  '<thead><th>Name</th><th>Qouantity</th><th>image</th></thead>'+
                  '</table>'+
                  '</dd>'+
               '</dl>'+
               '</div>');
               $('#order_datails_modal table').append(items_table);
               
            $('#order_datails_modal').modal('show');
         }
      </script>

<!-- Order details Modal -->
 <div class="modal fade" id="order_datails_modal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{ __('Order Details')}}</h4>
        </div>
        <div class="modal-body">
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close')}}</button>
        </div>
      </div>
      
    </div>
  </div>
@endsection