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
      
      
         <li class="active">
            <a href="{{route('admin')}}">
               <i class="fa fa-shopping-cart"></i>
               <span>Orders</span>
            </a>    				
         </li>
         <li class="">
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
      <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
      <script src="js/main.js"></script>
      <script>
         $(document).ready(function() {
           $('#example').DataTable();
         } );
      </script>
<!--fotter-->

@include('components.admin_footer');

@endsection