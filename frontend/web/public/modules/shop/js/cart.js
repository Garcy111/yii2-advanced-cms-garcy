$(function(){
	$('.update-quantity').click(function(){
		var id = $(this).attr('data-cart-id');
		var quantity = $('#row_' + id).val();
		$.ajax({
			url: '/shop/default/update-quantity-product',
			type: 'POST',
			data: {'id': id, 'quantity': quantity},
			success: function(){
				window.location.reload();
			}
		});
	});

	$('.delete-product').click(function(){
		var id = $(this).attr('data-cart-id');
		$.ajax({
			url: '/shop/default/delete-product',
			type: 'POST',
			data: {'id': id},
			success: function(){
				window.location.reload();
			}
		});
	});

	$('.make-order').click(function(){
		$('#make-order-modal').arcticmodal();
	});
});