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
               <span>Orders</span>
            </a>    				
         </li>
         <li class="active">
            <a href="{{route('admin_products')}}">
               <i class="fa fa-shopping-cart"></i>
               <span>Products</span>
            </a>    				
         </li>  
         <li>
            <a href="{{route('admin_cars')}}">
               <i class="fa fa-shopping-cart"></i>
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
                <label class="label-control">Type Of Car:</label>
                
                <select class="form-control" name="car_id" required id="car_id">
                    <option value="1">Hyndai</option>
                    <option value="2">BMW</option>
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
         <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
               <tr>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Office</th>
                  <th>Age</th>
                  <th>Start date</th>
                  <th>Salary</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                  <td>Edinburgh</td>
                  <td>61</td>
                  <td>2011/04/25</td>
                  <td>$320,800</td>
               </tr>
               <tr>
                  <td>Garrett Winters</td>
                  <td>Accountant</td>
                  <td>Tokyo</td>
                  <td>63</td>
                  <td>2011/07/25</td>
                  <td>$170,750</td>
               </tr>
               <tr>
                  <td>Ashton Cox</td>
                  <td>Junior Technical Author</td>
                  <td>San Francisco</td>
                  <td>66</td>
                  <td>2009/01/12</td>
                  <td>$86,000</td>
               </tr>
               <tr>
                  <td>Cedric Kelly</td>
                  <td>Senior Javascript Developer</td>
                  <td>Edinburgh</td>
                  <td>22</td>
                  <td>2012/03/29</td>
                  <td>$433,060</td>
               </tr>
               <tr>
                  <td>Airi Satou</td>
                  <td>Accountant</td>
                  <td>Tokyo</td>
                  <td>33</td>
                  <td>2008/11/28</td>
                  <td>$162,700</td>
               </tr>
            </tbody>
            <tfoot>
               <tr>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Office</th>
                  <th>Age</th>
                  <th>Start date</th>
                  <th>Salary</th>
               </tr>
            </tfoot>
         </table>
      </div>
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap3.4.1.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
      <script src="js/main.js"></script>
      <script>
         $('#add_car_form input[name="name"]').on('keyup',function(){
         var car_name = $(this).val().trim();
            if(!car_name){
               $('#add_car_submit').attr('disabled', true);
            }else{
               $('#add_car_submit').removeAttr('disabled', true);
            }
         });

         function addProduct(){
            var payload ={};
            $('#create_product_form input, #create_product_form textarea, #create_product_form select').each(function(){
               payload[$(this).attr('name')] = $(this).val() ? $(this).val().trim() : '';
            })
            $.ajax({
               type: "POST",
               url: '/products',
               data: payload,
                  success: function() 
                  {
                     $('#create_product_modal').modal('hide');
                     alert("success");
                  },
                  error: function(){alert('failure');}
               });
         }
         function getProducts(){
            // cars
            $.ajax({
               type: "get",
               url: '/cars',
               success: function(res) 
                  {
                     console.log(res.data)
                     if(res.data.length){
                     }
                     $('#products').DataTable();

                  },
                  error: function(){
                  $('#products').DataTable();
                     alert('failure');
                  }
               });
               
         }

         $(document).ready(function() {
            getProducts();
         });
      </script>
<!--fotter-->

@include('components.admin_footer');

@endsection