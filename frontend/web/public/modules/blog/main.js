$(function(){
  $('.mobile-menu').click(function(){
    $('.modal').show();
  });
   $('.modal-close').click(function(){
    $('.modal').hide();
  });

   $('.like').each(function(){
   		var id = $(this).attr('data-post-id');
   		var idLS = localStorage.getItem(id);
   		if (idLS) {
   			$(this).addClass('click-like');
   		}
   });

   $('.like').click(function(){
   	var that = $(this);
   	var id = that.attr('data-post-id');
   	var idLS = localStorage.getItem(id);
     	if (!idLS) {
  	   	$.ajax({
  	   		url: "/blog/default/add-like",
  	   		type: "POST",
          async: false,
  	   		data: {'id': id},
  	   		success: function(){
  	   			var likes = $(that).find('span').html();
  	   			likes = parseFloat(likes) + 1;
  	   			$(that).find('span').html(likes);
  	   			localStorage.setItem(id, true);
  	   			that.addClass('click-like');
  	   		}
  	   	});
     } else {
        $.ajax({
          url: "/blog/default/sub-like",
          type: "POST",
          async: false,
          data: {'id': id},
          success: function(){
            var likes = $(that).find('span').html();
            likes = parseFloat(likes) - 1;
            $(that).find('span').html(likes);
            localStorage.removeItem(id);
            that.removeClass('click-like');
          }
        });
     }
   });
});