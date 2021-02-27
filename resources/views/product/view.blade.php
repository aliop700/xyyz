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
	<img src="{{$product->file->path}}">
</div>
      <div class="col-md-5 row product-detail">
<!-- ============================= Product name and price -->      
        <div class="col-md-12">
          <h1> {{App::getLocale() == "en" ? $product->name : $product->name_ar}}
         	 <span> {{$product->price}}$ </span>
          </h1>
          <h2>{{$product->car_name}}</h2>
          <hr>
          <p></p><p>{{App::getLocale() == "en" ? $product->desc : $product->desc_ar}}.</p><p></p>
        </div>
<!-- ============================= Product Quantity -->
 
        
      <div class="attribute-group">   
              <div class="product-options col-md-6">
      <p class="title" for="quantity">{{ __('QUANTITY') }}</p>
      <span>
         <input name="quantity" class="form-control" id="quantity" type="number" onkeyup="if(this.value<1){this.value= this.value * -1}" min="1" value="1"/>
      </span>
    </div>
  
      </div>
      <div class="attribute-group">
        
      </div>
      <div class="attribute-group">
        
      </div>
      @if(!auth()->user() || (auth()->user() &&  !auth()->user()->isAdmin()))
        <div class="col-md-12 attribute-group">
          <a  class="item_add add_item_to_basket" onclick="addItemToBasket()" > {{ __('Add To Basket') }}
            </a>
        </div>
        @endif

          
      </div>
   </div>
</div>

	</div>
	</form>
<div class="clearfix"></div>
<script src="/js/sweet-alert.min.js"></script>
<script>
  function addItemToBasket(){
    var product_id ='{{$product->id}}';
    var product_name ='{{App::getLocale() == "en" ? $product->name : $product->name_ar}}';
    var product_price ='{{$product->price}}';
    var quantity_val = $('#quantity').val();
    var product_added = [];
    var product= {product_id: product_id , quantity : quantity_val, product_name: product_name , product_price:product_price };
    var basket_count= 1;
    var basket_items= localStorage.getItem('basket') ? JSON.parse(localStorage.getItem('basket')) : null ;
    if(basket_items == null){
      localStorage.setItem('basket', JSON.stringify ([product]) )
    }else{
      var product_added_index;
        product_added = basket_items.filter(function(item ,index){
        if(item.product_id == product_id){
          product_added_index = index;
           return item;
        }
      })

      if(product_added.length){ // if item has been added 
        basket_items[product_added_index]['quantity'] = Number(basket_items[product_added_index]['quantity']) + Number(quantity_val);
      }else{
        basket_items.push(product);
      }
      basket_count = basket_items.length;
      localStorage.setItem('basket',JSON.stringify (basket_items));
    }
    swal("{{ __('Successfully') }}", {
            title: '{{__("Successfully") }}',
            text: product_added.length ? '{{__("You have successfully increased the quantity") }}' : '{{__("You have successfully added the product") }}',
						icon:'success',
						buttons: {
							cancel: false,
							catch: {
							text: "{{ __('Ok') }}",
							value: true,
							},
						},
					});
   $('.basket-count').html( basket_count);
   $('.simpleCart_quantity').html( basket_count);
   $('.checkout-container').addClass('show')
   
  }
</script>

@endsection
