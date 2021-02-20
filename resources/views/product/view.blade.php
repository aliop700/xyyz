@extends('layouts.main')

@section('title', 'Index')
@section('content')
<!--header-->
<div class="header2 text-center">
	
</div>
<!--header//-->

<form class="custom" onsubmit="return false" method="post" action="/product/square-it">
		<div class="container-fluid" id="product-page">
		<div class="container product-detail-top">
   <div class="row">
      
<div class="col-md-7 slider_parrent">
	<img src="images/product-6.jpg">
</div>
      <div class="col-md-5 row product-detail">
<!-- ============================= Product name and price -->      
        <div class="col-md-12">
          <h1>Product name 
         	 <span> $139.55</span>
          </h1>
          <h2>Nambo Inc</h2>
          <hr>
          <p></p><p>Your product will be shipped in: 2 business days
The shipping fee changes according to the shipping country and the quantity of items ordered. You can see the shipping fee in your basket or on the checkout page after you select the shipping country. Please select the shipping country to see your shipping fee for this item.</p><p></p>
        </div>
<!-- ============================= Product Quantity -->
 
        
      <div class="attribute-group">   
              <div class="product-options col-md-6">
      <p class="title" for="option-0">options</p>
      <span class="col-md-12 custom-dropdown">
      <select id="option-0" name="options[8]" class="select-option" data-ajax-handler="shop:product" data-ajax-update="#product-page=shop-product">
                  <option value="27">option-1</option>
                  <option value="28">option-2</option>
              </select>
      </span>
    </div>
  
      </div>
      <div class="attribute-group">
        
      </div>
      <div class="attribute-group">
        
      </div>

        <div class="col-md-12 attribute-group">
          <input type="hidden" name="productId" value="14">
          <div class="add-cart-holder form-group">
            <div class="quantity-selector">
              <p class="title">Quantity</p>
              <input class="form-control quantity item_quantity" type="text" value="1" name="quantity">
            </div>
          </div>
          <div class="add-to-cart-div">
            <a  class="item_add" href="{{route('checkout')}}"> Add
          </a>
          </div>
        </div>

     
      
        <div class="to-cart-flash col-md-12">
          <p class="custome-msg" style="font-size:0;visibility:hidden;"> successful add </p>
          
        </div>   
      </div>
   </div>
</div>

	</div>
	</form>
		 <div class="clearfix"></div>

<!--fotter-->

@include('components.footer');

@endsection
