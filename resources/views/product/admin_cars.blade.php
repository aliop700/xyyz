@extends('layouts.main')

@section('title', 'Index')
@section('content')
<!--header-->
<div class="header2 text-center"></div>
<!--header//-->
<div class="subnavbar">

<div class="subnavbar-inner">
   <div class="container">
      <ul class="mainnav">
         <li>
            <a href="{{route('admin')}}">
               <i class="fa fa-shopping-cart"></i>
               <span>{{ __('Orders')}}</span>
            </a>    				
         </li>
         <li>
            <a href="{{route('admin_products')}}">
               <i class="fa fa-microchip"></i>
               <span>{{ __('Products')}}</span>
            </a>    				
         </li>  
         <li class="active">
            <a href="{{route('admin_cars')}}">
               <i class="fa fa-car"></i>
               <span>{{ __('Cars')}}</span>
            </a>    				
         </li>  
      </ul>
   </div> <!-- /container -->
</div> <!-- /subnavbar-inner -->

<div class="container">
    <div class="actions-btn">
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#add_car_modal">{{ __('Add Car')}}</button>
    </div>
</div>


 <!-- add car Modal -->
 <div class="modal fade" id="add_car_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{ __('Add Car')}}</h4>
        </div>
        <div class="modal-body">
        <form id="add_car_form">
            <div class="form-group">
                <label class="label-control">{{ __('Car Name')}}: </label>
                <input type="text" class="form-control" required name="name" >
            </div>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" disabled ="true" class="btn btn-primary" onclick="addCar()" id="add_car_submit">{{ __('Add')}}</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close')}}</button>
        </div>
      </div>
      
    </div>
  </div>
  
<!-- end modal -->
</div>
      <div class="main-content-admin container">
         <table id="cars" class="table table-striped table-bordered dt-responsive" style="width:100%">
            <thead>
               <tr>
                  <th>Id</th>
                  <th>{{ __('Car Name')}}</th>
                  <th>{{ __('Remove')}}</th>
               </tr>
            </thead>
            <tbody></tbody>
         </table>
      </div>
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap3.4.1.min.js"></script>
      <script src="/js/jquery.dataTables.min.js"></script>
      <script src="/js/dataTables.bootstrap4.min.js"></script>
      <script src="js/sweet-alert.min.js"></script>
<!--fotter-->
<script>

$('#add_car_form input[name="name"]').on('keyup',function(){
   var car_name = $(this).val().trim();
   if(!car_name){
      $('#add_car_submit').attr('disabled', true);
   }else{
      $('#add_car_submit').removeAttr('disabled', true);
   }
});

function addCar(firstLoad){
   var carName= $('#add_car_form input[name="name"]').val().trim();
   $.ajax({
      type: "POST",
      url: '/cars',
      data: {car_name:carName },
			success: function() 
         {
            $('#add_car_modal').modal('hide');
            // location.reload(true);
            getCars();
         },
			error: function(){alert('failure');}
    	});
}
function getCars(firstLoad){
   // cars
   $.ajax({
      type: "get",
      url: '/cars',
      success: function(res) 
         {
            if(res.data.length){
               $('#cars tbody').empty();
               res.data.forEach(function(car){
                  $('#cars tbody').append(
                     '<tr>'+
                     '<td>'+car.id+'</td>'+
                     '<td>'+car.car_name+'</td>'+
                     '<td> <i class="fa fa-trash btn danger" onclick="deleteCar('+car.id+')"  title="Delete"></i></td>'+
                     '</tr>'
                  )
               })
            }
            if ( $.fn.dataTable.isDataTable( '#cars' ) ) {
               cars_table = $('#cars').DataTable();
            }
            else {
               cars_table = $('#cars').DataTable({
                  "initComplete": function(settings, json) {
                     $('table#cars').parent().addClass('dataTableFirstWrapper')
                  }
               });
            }
        

         },
			error: function(){
           $('#cars').DataTable({
               "initComplete": function(settings, json) {
                  $('table#cars').parent().addClass('dataTableFirstWrapper')
               }
            });
            alert('failure');
         }
    	});
       
}

function deleteCar(id){
   swal("", {
            icon:'warning',
            title:'Are you sure you wante to delete this car!',
            buttons: {
               catch: {
                  text: "Delete",
                  value: true,
               },
               cancel: true,
            },
   })
   .then(function(value) {
      if(value == true){
         $.ajax({
         method: "delete",
         url: '/cars/'+id,
         success: function(res) 
            {
               getCars();
            },
         });
      }
   });
 
}

$(document).ready(function() {
   getCars(true);
});
  
</script>

@endsection