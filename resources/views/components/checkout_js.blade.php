<script>
var products_in_basket = localStorage.getItem('basket') != null ? JSON.parse(localStorage.getItem('basket')) : [];

function payWithPaypal(){
            var prices_arr = products_in_basket.map(function(item) {
                return Number(item.product_price) * Number(item.quantity)
            })
            var amount_ = prices_arr.length ? prices_arr.reduce(function(total, amount) {
                return total + amount;
            }) : 0;
            var items_ = products_in_basket.map(function(item){
                return {
                    "name": item.product_name,
                    "unit_amount": {value :item.product_price ,currency_code: "USD"},
                    "id": item.product_id,
                    "price": item.product_price,
                    "currency": "USD",
                    "quantity": item.quantity
                }
            });
        $('#payment-form #items_list').val(JSON.stringify(items_));
        $('#payment-form #amount').val(amount_);
        $('#payment-form').submit();
}
function addOrder(paypalResp){
    var products = products_in_basket.map(function(item){
        return {product_id: item.product_id , quantity : item.quantity}
    })
    var payload ={
        products: products,
        delievery_method:$('#delivery_method_input').val(),
        phone:$('#phone_input').val(),
        location:$('#location_input').val(),
        email:$('#email_input').val(),
        paypal_response: paypalResp
    }

    $.ajax({
           type: "POST",
           url: '/orders',
           data: payload,
           success: function(res) 
              {
                // alert('success')
              },
              error: function(){
                swal({
                    title: "{{ __('Oops!') }}", 
                    text: "{{ __('Something wrong, contact with us at info@autorepairskit.com')}}",
                    buttons: {
                                cancel: false,
                                catch: {
                                text: "{{ __ ('Ok')}}",
                                value: true,
                                },
                    },
                    icon: "error"
                });
              }
           });
}

function cleanBasket(){
    localStorage.removeItem('basket');
}

function removeProduct(product_id){
    var index;
    var product = products_in_basket.filter(function(item,key){
        index = key;
        return item.product_id == product_id;
    })[0];
    products_in_basket.splice(index, 1);
    localStorage.setItem('basket', JSON.stringify(products_in_basket))

    drawProducts();

}

function drawProducts(){
    $('.products-list-table tbody').empty();
    if(products_in_basket.length){
        
        $('.checkout-view').removeClass('hidden');
        products_in_basket.forEach(function(item){
                $('.products-list-table tbody').append(
                '<tr id="'+item.product_id+'" >'+
                '<td>'+item.product_name+'</td>'+
                '<td>'+item.product_price+'</td>'+
                '<td>'+item.quantity+'</td>'+
                '<td><button onclick="removeProduct('+item.product_id+')" class="danger btn">{{ __("Remove") }} &nbsp;<i class="fa fa-remove danger"></i> </button></td>'
            )
        })
    }else{
        $('.no-data-to-checkout').removeClass('hidden');
        $('.checkout-view').addClass('hidden');
         $('.basket_icon_nav').removeClass('flusher-checkout');
         $('.simpleCart_quantity').html(0)
    }
    

}
// getDebugger()
// function getDebugger(){
// setTimeout(function() {
// 		debugger;	
// 		getDebugger()
// 	}, 100);
// }
$(document).ready(function(){
    drawProducts();
})
    // Render the PayPal button into #paypal-button-container
    // paypal.Buttons({

    //     style: {
    //         color:  'blue',
    //         shape:  'pill',
    //         label:  'pay',
    //         height: 40
    //     },
    // 	createOrder: function(data,actions){
    // 		var prices_arr = products_in_basket.map(function(item) {
    // 			return Number(item.product_price) * Number(item.quantity)
    // 		})
    // 		var amount_ = prices_arr.length ? prices_arr.reduce(function(total, amount) {
    // 			return total + amount;
    // 		}) : 0;
    // 		var items_ = products_in_basket.map(function(item){
    // 			return {
    // 				"name": item.product_name,
    // 				"unit_amount": {value :item.product_price ,currency_code: "USD"},
    // 				"id": item.product_id,
    // 				"price": item.product_price,
    // 				"currency": "USD",
    // 				"quantity": item.quantity
    // 			}
    // 		})
    // 		return actions.order.create({
    // 			purchase_units:[{
    // 				amount:{
    // 					breakdown: {
    // 						item_total: {value: amount_, currency_code: 'USD'}
    // 					},
    // 					value: amount_
    // 				},
    // 				items:items_
    // 			}]
    // 		})
    // 	},
    // 	onApprove: function(data,actions){
    // 		return actions.order.capture().then(function(details){
    // 			// window.location.replace('success_checkout.html')
    // 			var paypalRes = JSON.stringify(details);
    // 			addOrder(paypalRes);
    // 			cleanBasket();
    // 			swal("{{ __('Successfully') }}", {
    // 				icon:'success',
    // 				text: "{{ __('You will receive an email with the details') }}",
    // 				buttons: {
    // 					cancel: false,
    // 					catch: {
    // 					text: "{{ __ ('Ok')}}",
    // 					value: true,
    // 					},
    // 				},
    // 			})
    // 			.then(function(value) {
    // 				if(value)
    // 				window.location.replace('/')
    // 			});
    // 		})
    // 	},
    // 	onCancel: function(data){
    // 		swal({
    // 			title: "{{ __('Oops!') }}", 
    // 			text: "{{ __('Something wrong, Please try again') }}",
    // 			buttons: {
    // 						cancel: false,
    // 						catch: {
    // 						text: "{{ __ ('Ok')}}",
    // 						value: true,
    // 						},
    // 			},
    // 			icon: "error"
    // 		});
    // 	},

    // }).render('#paypal-button-container');

    function askToLogin(){
        // swal("Oops!", "Something wrong, Please try again", "error");
        swal("Info", {
                    icon:'warning',
                    title:'{{ __("You are not logged in")}}!',
                    text: "{{ __('If you do not have an account, create an account in one minute')}}!",
                    buttons: {
                        cancel: false,
                        catch: {
                            text: "{{ __('Login')}}",
                            value: 'login',
                        },
                        defeat:  {
                            text: "{{ __('Register')}}",
                            value: 'register',
                        },
                    },
        })
        .then(function(value) {
            if(value == 'login'){
                window.location.replace('/login?checkout:true');
            }else if(value == 'register'){
                window.location.replace('/register?checkout:true');

            }
        });
    }

    window.oncontextmenu = (e) => {
        e.preventDefault();
    }
    </script>