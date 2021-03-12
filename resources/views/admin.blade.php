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
                  <th>{{ __('Amount') }}</th>
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

        const statusLocalization= {
                                 "pending": "{{__('pending')}}",
                                 "canceled": "{{__('canceled')}}",
                                 "delivered": "{{__('delivered')}}",
                              };
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
                              '<td>'+order.total+'</td>'+
                              '<td>'+order.payment_id+'</td>'+
                              '<td id="status_col_'+order.id+'">'+
                               '<button onclick="changeStatus('+order.id+')" class="btn status '+order.status+'">'+statusLocalization[order.status]+'</button>'+
                              '</td>'+
                              '<td>'+order.created_at+'</td>'+
                           '</tr>'
                        )
                     })
                     drawDataTable('orders'); 

                  },
                  error: function(){
                     drawDataTable('orders'); 
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

      function changeStatus(id){
            var order = ordersList.filter(function(order){
               return order.id == id;
            })[0];
            var currentStatus = order.status;
            var statusList = document.createElement('select');
            statusList.classList.add('form-control');
            Object.keys(statusLocalization).forEach(function(status){
               var opt = document.createElement('option');
               opt.appendChild( document.createTextNode(statusLocalization[status]) );
               opt.value = status; 
               if(currentStatus == status){
                  opt.setAttribute('selected','selected');
               }
               statusList.appendChild(opt); 
            })
            swal({
                  text: '{{__("Choose order status")}}',
                  content: statusList,
                  buttons: {
    					cancel: '{{__("Close")}}',
    					catch: {
    					text: "{{ __ ('Ok')}}",
    					value: true,
                   closeModal: false,
    					},
    				},
               })
               .then(function (value) {
                  console.log(value , statusList.value);

                  if(value &&  statusList.value != currentStatus){
                     return $.ajax({
                        url: '/orders/change/'+id,
                        data:{status: statusList.value},
                        method:'POST'
                     })
                  }else{
                     swal.stopLoading();
                     swal.close();
                  }
               }).then(function(res){
                  console.log(res);
                  if(res && res.success){
                     $('td[id="status_col_'+id+'"]').html(
                        '<button onclick="changeStatus('+id+')" class="btn status '+statusList.value+'">'+statusLocalization[statusList.value]+'</button>'
                     );
                     ordersList.forEach(function(order, key){
                        if(order.id == id){
                           ordersList[key].status = statusList.value;
                        }
                     })
                     order
                     swal({
                        title: "{{__('Successfully')}}",
                        icon: 'success',
                     });
                  }
               })
            
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