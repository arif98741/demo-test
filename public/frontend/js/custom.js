$(document).ready(function () {
    //load cart 
    loadCart();
    //load wishlist 
    loadWishlist();
    // increment quantity

$(document).on('click','.increment-btn', function (e) {
e.preventDefault();
var incre_value = $(this).parents('.quantity').find('.qty-input').val();
var value = parseInt(incre_value, 10);
value = isNaN(value) ? 0 : value;
if(value<10){
value++;
$(this).parents('.quantity').find('.qty-input').val(value);
}

});
//decrement quanty
$(document).on('click','.decrement-btn', function (e) {
e.preventDefault();
var decre_value = $(this).parents('.quantity').find('.qty-input').val();
var value = parseInt(decre_value, 10);
value = isNaN(value) ? 0 : value;
if(value>1){
value--;
$(this).parents('.quantity').find('.qty-input').val(value);
}
});
// add to cart
$('.addToCart').click(function (e) { 
e.preventDefault();
var prod_id = $(this).closest('.product_data').find('.prod_id').val();
var prod_qty = $(this).closest('.product_data').find('.qty-input').val();
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$.ajax({
type: "POST",
url: "/add-to-cart",
data: {
    'prod_id' : prod_id ,
    'prod_qty' : prod_qty
},
success: function (response) {
    loadCart();
    Toastify({text:response.status,duration:3000,
      style:{ background:"linear-gradient(to rigth,#00b09b,96c93d)" } 
      }).showToast();
}
});
});
//delete cart
$(document).on('click','.delete-cart-item', function (e) {
    
    e.preventDefault();
    var prod_id = $(this).closest('.product_data').find('.prod_id').val();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
    $.ajax({
        type: "POST",
        url: "delete-cart-item",
        data: {
            'prod_id':prod_id,
        },
        success: function (response) {
            $('.cartitems').load(location.href +" .cartitems");
            Toastify({text:response.status,duration:3000,
                style:{ background:"linear-gradient(to rigth,#00b09b,96c93d)" } 
                }).showToast();
                loadCart();
        }
    });
});

//change quantity
$(document).on('click','.changeQuantity', function (e) {

    e.preventDefault();
    var prod_id = $(this).closest('.product_data').find('.prod_id').val();
    var qty = $(this).closest('.product_data').find('.qty-input').val();
    var data = {
        'prod_id':prod_id,
        'qty': qty
    }
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
    $.ajax({
        type: "POST",
        url: "update-quantity",
        data: data,
        success: function (response) {
            $('.cartitems').load(location.href +" .cartitems");
        }
    });
});
//add to wishlist
$('.addToWishlist').click(function (e) { 
    e.preventDefault();
    var prod_id = $(this).closest('.product_data').find('.prod_id').val();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
        type: "POST",
        url: "/add-to-wishist",
        data: {
            'prod_id' : prod_id
        },
        success: function (response) {
            loadWishlist();
            Toastify({text:response.status,duration:3000,
                style:{ background:"linear-gradient(to rigth,#00b09b,96c93d)" } 
                }).showToast();
          
        }
        });
});
// remove wishlist 
$(document).on('click','.remove-wishlist-item', function (e) {
    
    e.preventDefault();
    var prod_id = $(this).closest('.product_data').find('.prod_id').val();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
        type: "POST",
        url: "/delete-wishlist-item",
        data: {
            'prod_id' : prod_id
        },
        success: function (response) {
            $('.mywishlist').load(location.href +" .mywishlist");
            loadWishlist();
            Toastify({text:response.status,duration:3000,
                style:{ background:"linear-gradient(to rigth,#00b09b,96c93d)" } 
                }).showToast();
       
        }
        });
});
// load cart 
function loadCart(){
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
        type: "GET",
        url: "/load-cart-data",
        success: function (response) {
            $('.cart-count').html('');
            $('.cart-count').html(response.cartcount);
            
        }
        });
}
// load wishlist 
function loadWishlist(){
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
        type: "GET",
        url: "/load-wishlist-data",
        success: function (response) {
            $('.wishlist-count').html('');
            $('.wishlist-count').html(response.wishlistcount);
        }
        });
}
//end
});