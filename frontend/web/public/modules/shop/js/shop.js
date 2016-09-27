$(function(){
	$('.addCart').click(function(){
		var id = $(this).attr('data-product-id');
		$.ajax({
			url: '/shop/default/add-cart',
			type: 'POST',
			data: {'id': id},
			success: function(){
				alert('The product has been added');
			}
		});
	});
});