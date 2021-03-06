<div class="subnavbar">

<div class="subnavbar-inner">

   <div class="container">

      <ul class="mainnav">
      
      
         <li class="{{Route::currentRouteName() == 'admin' ? 'active' : ''}}">
            <a href="{{route('admin')}}">
               <i class="fa fa-shopping-cart"></i>
               <span>{{ __('Orders')}}</span>
            </a>    				
         </li>
         <li class="{{Route::currentRouteName() == 'admin_products' ? 'active' : ''}}">
            <a href="{{route('admin_products')}}">
               <i class="fa fa-microchip"></i>
               <span>{{ __('Products')}}</span>
            </a>    				
         </li>
         <li class="{{Route::currentRouteName() == 'admin_cars' ? 'active' : ''}}">
            <a href="{{route('admin_cars')}}">
               <i class="fa fa-car"></i>
               <span>{{ __('Cars')}}</span>
            </a>    				
         </li>  
         <li class="{{Route::currentRouteName() == 'contactUs' ? 'active' : ''}}">
            <a href="{{route('contactUs')}}">
               <i class="fa fa-address-book"></i>
               <span>{{ __('Contacts')}}</span>
            </a>    				
         </li>  
         
          
      </ul>

   </div> <!-- /container -->

</div> <!-- /subnavbar-inner -->

</div> <!-- subnavbar -->