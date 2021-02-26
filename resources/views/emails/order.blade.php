@component('mail::message')

Dear {{$user->name}},

Thank you for usingour service,

you have succesfully purchased 

<ul>
@foreach($order->items as $item)
<li>{{$item->product->name}}</li>
@endforeach
</ul>

and thoose costed you {{$order->total}} JD 

They will be shipped to ur address very soon . 



Thanks,<br>
{{ config('app.name') }}
@endcomponent
