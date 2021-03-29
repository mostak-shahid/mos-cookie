jQuery(document).ready(function($){	
	$('.button-mos-cookie').click(function(e){        
        $.ajax({
            url: ajax_obj.ajax_url, // or example_ajax_obj.ajaxurl if using on frontend
            type:"POST",
            dataType:"json",
            data: {
                'action': 'set_mos_cookie',
                'days' : 30,
            },
            success: function(result){
                console.log(result);
                if (result) {
                    $('.cookie-d-flex').hide();
                }
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
	});
});