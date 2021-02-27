@extends('layouts.main')

@section('title', __('Home'))
@section('content')
<div class="header">
	<div class="caption">
		<h1> {{ __('SOFTWARES & CARS KIT') }}</h1>	 
		<p>{{ __('Take care of your car, your car is our priority.') }}  </p>
	</div>
</div>
<div class="features" id="features">
	 <div class="container">
	 <ul class="tabs-menu cars_tabs unvisible">
				<li class="active"><a id="allCars" onclick="filterByCar('allCars')">{{ __('All Cars')}}</a></li>
	</ul>
		 <div class="tabs-box market_gellary">
		 
			 @foreach($products as $product)
					<div class="tab-grids product-box" data-car-id="{{$product->car_id}}">
						<div>
									   				  
							<a href="{{route('product_view',['id' => $product->id])}}"><div class="product-grid">					  
									<div class="product-img b-link-stripe-market b-animate-go  thickbox">						   
										<img src="{{$product->file->path}}" class="img-responsive" alt=""/>
										<div class="b-wrapper">
										<h4 class="b-animate b-from-left  b-delay03">							
										<button class="btns">{{ __('Shop now') }}</button>
										</h4>
										</div>
									</div>
									<div class="image-caption">
										<h3><p>{{App::getLocale() == 'en'  ? $product->name : $product->name_ar}}</p> </h3>
										<span class="meta">{{App::getLocale() == 'en' ? $product->desc : $product->desc_ar}}</span> </div>
									</div>
							</a>						
						</div>		
					</div>
				@endforeach
</div>
</div>

<script>
	var linked_cars = [];
	getLinkedCars()
	function getLinkedCars(){
		$('.product-box').each(function(){
			linked_cars.push(Number($(this).attr('data-car-id')));
		})
		getCars();
	}
	
	
	function getCars(){
		$.ajax({
			type: "get",
			url: '/cars',
			success: function(res) 
			{
				if(res.data.length){
					res.data.forEach(function(car){
						if(linked_cars.indexOf(car.id) > -1)
						$('.cars_tabs').append(
							'<li><a  onclick="filterByCar('+car.id+')" id="'+car.id+'">'+car.car_name+'</a></li>'
						)
					})
					$('.cars_tabs').removeClass('unvisible');
				}
			}
		});
	}

	function filterByCar(id){
		$('.cars_tabs li').removeClass('active');
		$('.cars_tabs a[id="'+id+'"]').parent().addClass('active');

		if(id == 'allCars'){
			$('.product-box').removeClass('hidden');
		}else{
			$('.product-box[data-car-id !="'+id+'"]').addClass('hidden');
			$('.product-box[data-car-id ="'+id+'"]').removeClass('hidden');
			$('.product-box[data-car-id ="'+id+'"]').addClass('shake');
			setTimeout(function(){
			  $('.product-box[data-car-id ="'+id+'"]').removeClass('shake');
			}, 300);
		}
	}
</script>
@endsection
