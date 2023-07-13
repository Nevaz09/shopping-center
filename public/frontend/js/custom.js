$(document).ready(function(){
    loadcart();
    loadwishlist();
    loadpesanan();
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function loadcart(){
       
        $.ajax({
            method: "GET",
            url: "/load-cart",
            success: function (response) {
                $('.cart-count').html('');
                $('.cart-count').html(response.count);
                // console.log(response.count);
            }
        });
    }

    function loadwishlist(){
       
        $.ajax({
            method: "GET",
            url: "/load-wishlist",
            success: function (response) {
                $('.wishlist-count').html('');
                $('.wishlist-count').html(response.count);
                // console.log(response.count);
            }
        });
    }
    
    function loadpesanan(){
       
        $.ajax({
            method: "GET",
            url: "/load-pesanan",
            success: function (response) {
                $('.pesanan-count').html('');
                $('.pesanan-count').html(response.count);
                // console.log(response.count);
            }
        });
    }
    
});
