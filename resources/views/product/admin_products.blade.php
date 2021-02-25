@extends('layouts.main')

@section('title', 'Index')
@section('content')

@php 
  $lang =  'eng'; 
@endphp 


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
               <span>Orders</span>
            </a>    				
         </li>
         <li class="active">
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
<div class="container">
    <div class="actions-btn">
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#create_product_modal">Add Product</button>
    </div>
</div>

 <!-- add product Modal -->
 <div class="modal fade" id="create_product_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create Product</h4>
        </div>
        <div class="modal-body">
        <form id="create_product_form">
            <div class="form-group">
                <label class="label-control">Product Name: </label>
                <input type="text" class="form-control" required name="name" >
            </div>
        <div class="form-group">
                <label class="label-control">Product Name Arabic: </label>
                <input type="text" class="form-control" required name="name_ar">
            </div>
            <div class="form-group">
                <label class="label-control">Description: </label>
                <textarea  class="form-control" required name="desc" row="3"></textarea>
            </div>
            <div class="form-group">
                <label class="label-control">Description Arabic: </label>
                <textarea  class="form-control" required name="desc_ar" row="3"></textarea>
            </div>
            <div class="form-group">
                <label class="label-control">Price:</label>
                <input type="number" class="form-control" required name="price">
            </div>	
            <div class="form-group">
                <label class="label-control">Product Image:</label>
                <!-- <input type="text"  class="form-control hidden" required name="image"> -->
                <input type="file" id="product_image" accept="image/x-png,image/gif,image/jpeg" class="form-control" required name="image">
            </div>	
            <div class="form-group">
                <label class="label-control">Type Of Car:</label>
                
                <select class="form-control" name="car_id" required id="car_id">
                    <option value="0">For All Cars</option>
                </select>
            </div>	
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary"  id="create_product_submit" onclick="addProduct()">Add</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
<!-- end modal -->
</div>
      <div class="main-content-admin container">
         <table id="products" class="table table-striped table-bordered" style="width:100%">
            <thead>
               <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Car</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody></tbody>
         </table>
      </div>
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap3.4.1.min.js"></script>
      <script src="/js/jquery.dataTables.min.js"></script>
      <script src="/js/dataTables.bootstrap4.min.js"></script>
      <script src="/js/sweet-alert.min.js"></script>
      <script>

         var lang='{{$lang}}';

         $('#add_car_form input[name="name"]').on('keyup',function(){
         var car_name = $(this).val().trim();
            if(!car_name){
               $('#add_car_submit').attr('disabled', true);
            }else{
               $('#add_car_submit').removeAttr('disabled', true);
            }
         });

         function addProduct(){
            $('#create_product_form input, #create_product_form textarea, #create_product_form select').removeClass('feild_required');
            var payload =new FormData();
            var empty_feild = [];
            $('#create_product_form input, #create_product_form textarea, #create_product_form select').each(function(){
              
               if($(this).attr('id') == 'product_image'){
                  var file =document.getElementById('product_image').files[0]; 
                   payload.append( 'image', file );
               }else{
                  var feild_val = $(this).val() ? $(this).val().trim() : '';
                  payload.append( $(this).attr('name') , feild_val );
               }

               if ($(this).attr('name') != 'car_id' && !$(this).val()){
                  $(this).addClass('feild_required');
                  empty_feild.push($(this).attr('name'));
               }
            })
           
            if(empty_feild.length){
               return false;
            }


            $.ajax({
               type: "POST",
               url: '/products',
               data: payload,
               processData: false,
               contentType: false,
                  success: function() 
                  {
                     $('#create_product_modal').modal('hide');
                     getProducts('after_add');
                  },
                  error: function(){alert('failure');}
               });
         }
         function getProducts(after_add){
            if(!after_add){
               getCars();
            }
            $.ajax({
               type: "get",
               url: '/products',
               success: function(res) 
                  {
                     $('#products tbody').empty();
                      res.data.forEach(function(product){
                        $('#products tbody').append(
                           '<tr>'+
                              '<td>'+product.id+'</td>'+
                              '<td>'+product.name+'</td>'+
                              '<td>'+product.desc+'</td>'+
                              '<td>'+product.price+'</td>'+
                              '<td>'+product.car_name+'</td>'+
                              '<td> <i class="fa fa-trash btn danger" onclick="deleteProduct('+product.id+')" tooltip-title="Delete" title="Delete"></i></td>'+
                           '</tr>'
                        )
                     })
                     $('#products').DataTable();

                  },
                  error: function(){
                  $('#products').DataTable();
                     alert('failure');
                  }
               });
               
         }

function getCars(){
   // cars
   $.ajax({
      type: "get",
      url: '/cars',
      success: function(res) 
         {
            if(res.data.length){
               res.data.forEach(function(car){
                  $('#car_id').append(
                     '<option value="'+car.id+'">'+car.car_name+'</option>'
                  )
               })
            }

         },
    	});
}

function deleteProduct(){
   swal("", {
            icon:'warning',
            title:'Are you sure you wante to delete this product!',
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
         type: "delete",
         url: '/products',
         success: function(res) 
            {
               getProducts('after_add');
            },
         });
      }
   });
 
}

$(document).ready(function() {
   getProducts();
});

// $('#product_image').on('change',function(){
//    if($(this).val()){
//       getImageUrl()
//    }
// })
function getImageUrl(){
   var payload = new FormData();   
   var file =document.getElementById('product_image').files[0]; 
   payload.append( 'file', file );

   $.ajax({
   url: 'http://example.com/script.php',
   data: payload,
   processData: false,
   contentType: false,
   type: 'POST',
   success: function(data){
      alert(data);
   }
   });
}
</script>

@endsection