@extends('layouts.main')

@section('title', 'Index')
@section('content')

@if(!auth()->user() ||  !auth()->user()->isAdmin())
   <script>
      window.location.replace('/')
   </script>
@endif
<!--header-->
<div class="header2 text-center"></div>
<!--header//-->
<div class="subnavbar">

<div class="subnavbar-inner">

   <div class="container">

      <ul class="mainnav">
      
      
         <li class="active">
            <a href="{{route('admin')}}">
               <i class="fa fa-shopping-cart"></i>
               <span>Orders</span>
            </a>    				
         </li>
         <li class="">
            <a href="{{route('admin_products')}}">
               <i class="fa fa-microchip"></i>
               <span>Products</span>
            </a>    				
         </li>
         <li>
            <a href="{{route('admin_cars')}}">
               <i class="fa fa-car"></i>
               <span>Cars</span>
            </a>    				
         </li>  
         
          
      </ul>

   </div> <!-- /container -->

</div> <!-- /subnavbar-inner -->

</div>
      <div class="main-content-admin container">
       <table id="orders" class="table table-striped table-bordered dt-responsive" style="width:100%">
            <thead>
               <tr>
                  <th>Id</th>
                  <th>Product Name</th>
                  <th>Quantity</th>
                  <th>User Name</th>
                  <th>Phone Number</th>
                  <th>Order Method</th>
               </tr>
            </thead>
            <tbody></tbody>
         </table>
      </div>
      <script src="js/jquery.min.js"></script>
      <script src="/js/jquery.dataTables.min.js"></script>
      <script src="/js/dataTables.bootstrap4.min.js"></script>
      <script src="js/main.js"></script>
      <script>
      
         getOrders();
         function getOrders(){
            $.ajax({
               type: "get",
               url: '/orders',
               success: function(res) 
                  {
                     $('#orders tbody').empty();
                      res.data.forEach(function(order){
                        $('#orders tbody').append(
                           '<tr>'+
                              '<td>'+order.id+'</td>'+
                              '<th> Product Name</th>'+
                              '<td>'+order.total+'</td>'+
                              '<td>'+order.delievery_method+'</td>'+
                              '<td>'+order.status+'</td>'+
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
      </script>

@endsection