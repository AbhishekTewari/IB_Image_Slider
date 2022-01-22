(function( $ ) {
	'use strict';

$(document).ready(function(){
	
	$("#ib-add-slider").on("click", function(){
		$(".ib-add-slider-modal").addClass("show");
	});

	$(document).on('click','.ib-close-modal',function(){
		$(".ib-add-slider-modal").removeClass("show");
		$(document).find(".ib-slider-name").val('');
		$(document).find(".ib-display-images").html('');
	});

	var file_frame="";
	var set_to_post_id = "";
	$(document).on('click','#ib-add-images', function( ){
		if ( file_frame ) {
			file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
			file_frame.open();
			return;
		} else {
			wp.media.model.settings.post.id = set_to_post_id;
		}
		file_frame = wp.media.frames.file_frame = wp.media({
			title: 'Select Images to upload',
			button: {
				text: 'Upload',
			},
			multiple: true,
			library: {
				type: 'image'
			},
		});
		file_frame.on( 'select', function() {
			var selection = file_frame.state().get('selection');
			var ib_html = "";
			selection.map( function( attachment ) {
				attachment = attachment.toJSON();
				ib_html += '<div class="ib-slide-image-show">\
								<img class="ib-slide-images"  data-image_id="'+attachment.id+'" src="'+attachment.url+'">\
							</div>'; 	
			});		
			if(ib_html != "")
			{
				$(document).find(".ib-save-slider-setting").css('display','block');
			}
			$(".ib-display-images").append(ib_html );
		});
			file_frame.open();
	});

	$(document).on('click',".ib-save-slider-setting",function(){
		var ib_Slider_name = $(document).find(".ib-slider-name").val();
		var ib_image_id = $(document).find(".ib-slide-images");
		var ib_id_array = [];
		ib_image_id.each( function() {
			ib_id_array.push($(this).data('image_id'));
		});
		if(!ib_Slider_name)
		{
			alert(ib_global_params.ib_sli_name_err);
		}
		else if(ib_id_array.length === 0){
			alert(ib_global_params.ib_select_img);
		}
		else
		{
			var data = {
				action : 'ib_add_slider_details',
				ib_security_check : ib_global_params.ib_nonce,
				ib_id_array	: ib_id_array,
				ib_Slider_name : ib_Slider_name
			};
			$.blockUI({ message: '' });
			$.ajax({
				url 		: ib_global_params.ib_ajaxurl,
				type 		: "POST",
				data 		: data,
				dataType 	: 'json',
				success 	: function(response)
				{
					if(response.ib_status)
					{
						window.location.reload();
					}
					else{
						alert(response.ib_message);
					}
					$.unblockUI();
				}
			});
		}
	});
	$('.owl-carousel').owlCarousel({
		loop:true,
		responsiveClass:true,
		items:1,
		animateOut: 'slideOutDown',
		animateIn: 'flipInX',
		autoplay:true,
		autoplayTimeout:2000,
		autoplayHoverPause:false,
	});

	$(document).on('click','.ib-delete-img',function(){
		var ib_img_id = $(this).parent().data('image_id');
		var ib_img_key = $(this).data('img_key');

		if(ib_img_id)
		{
			var data = {
				action : 'ib_delete_img',
				ib_security_check : ib_global_params.ib_nonce,
				ib_img_id	: ib_img_id,
				ib_img_key : ib_img_key
			};
			$.blockUI({ message: '' });
			$.ajax({
				url 		: ib_global_params.ib_ajaxurl,
				type 		: "POST",
				data 		: data,
				dataType 	: 'json',
				success 	: function(response)
				{
					if(response.ib_status)
					{
						window.location.reload();
					}
					else{
						alert(response.ib_message);
					}
					$.unblockUI();
				}
			});
		}
	});

	$(document).on('click','#ib-add-more-img', function( ){
		var ib_sli_name = $(this).data('name');
		console.log(ib_sli_name);
		if (ib_sli_name) {
			$(document).find('.ib-slider-name').val(ib_sli_name);
			$(document).find('.ib-slider-name').attr("disabled", true);
		}
		$(".ib-add-slider-modal").addClass("show");
	});

	$(".id-image-prev-wrapper").sortable({
		update: function() 
		{
			var ib_suffled_ids = [];
			$('.id-image-prev').each(function(index) {
				ib_suffled_ids.push($(this).data("image_id"));
			});
			if(ib_suffled_ids.length > 0)
			{
				var data = {
					action : 'ib_suffel_id',
					ib_security_check : ib_global_params.ib_nonce,
					ib_suffled_ids	: ib_suffled_ids,
				};
				$.ajax({
					url 		: ib_global_params.ib_ajaxurl,
					type 		: "POST",
					data 		: data,
					dataType 	: 'json',
					success 	: function(response)
					{
						if(response.ib_status == false)
						{
							alert(response.ib_message);
						}
					}
				});
			}

		}      
	});

	$(document).on('click','#ib-copy-short',function(){

		$(document).find('.ib-tooltiptext').css({
            "visibility": "visible",
            "opacity": "1"
        });
		$(document).find('.ib-short-mess').css('margin-left','130px');
		setInterval(function () {
			$('.ib-tooltiptext').css({
            "visibility": "hidden",
            "opacity": "0"
        })
		$(document).find('.ib-short-mess').css('margin-left','0px');
		;}
		, 2000);
		var $temp = $("<input>");
		$("body").append($temp);
		$temp.val($('.ib-shortcode').val()).select();
		document.execCommand("copy");
		$temp.remove();
	});

});
})( jQuery );
