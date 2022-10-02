$(document).ready(function () {
    //load cart 
    loadCart();
    //load wishlist 
    loadWishlist();
    // increment quantity
$('.increment-btn').click(function (e) {
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
$('.decrement-btn').click(function (e) {
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
    swal(response.status,"" ,"success");
    window.location.reload();
}
});
});
//delete cart
$('.delete-cart-item').click(function (e) { 
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
            swal(response.status,"" ,"success");
            window.location.reload();
        }
    });
});

//change quantity

$('.changeQuantity').click(function (e) { 
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
         window.location.reload();
        }
    });
    // window.location.reload();
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
            swal(response.status,"" ,"success");
            window.location.reload();
        }
        });
});
// remove wishlist 
$('.remove-wishlist-item').click(function (e) { 
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
            swal(response.status,"" ,"success");
            window.location.reload();
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