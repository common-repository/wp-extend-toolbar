jQuery(function($){
	
	var ua = navigator.userAgent;
	if($(window).width() < 748  ||  ua.indexOf('iPhone') > 0 || ua.indexOf('Android') > 0 ) {
		
		$('wp-admin-bar-extend-toolbar').css({'display':'none'});
	
	} else {
		
		var title       = $("title").text();
		var description = $("meta[name='description']").attr("content");
		var keyword     = $("meta[name='keywords']").attr("content");
		
		$("#wp-admin-bar-extend-toolbar-title .ab-item").html("<span class='title'>PAGE TITLE：</span>" + title);
		$("#wp-admin-bar-extend-toolbar-description .ab-item").html("<span class='title'>DESCRIPTION：</span>" + description);
		$("#wp-admin-bar-extend-toolbar-keyword .ab-item").html("<span class='title'>KEYWORD：</span>" + keyword);
		
		var total_height = 32;
		total_height += $('#wp-admin-bar-extend-toolbar-title').height();
		total_height += $('#wp-admin-bar-extend-toolbar-description').height();
		keyword_pos   = total_height;
		total_height += $('#wp-admin-bar-extend-toolbar-keyword').height();
		
		$('html').css({
			//'margin-top': total_height + 'px'
		});
		$('* html body').css({
			//'margin-top': total_height + 'px'
		});
		$('#wpadminbar').css({
			'height': total_height + 'px'
		});
		$('body.admin-bar .navbar-fixed-top').css({
			'cssText': 'top:' + total_height + 'px !important'
		});
		$('#wp-admin-bar-extend-toolbar-keyword').css({
			'top': + keyword_pos + 'px'
		})
		$('#open-close-button').css({
			'top': + ( total_height + 10 ) + 'px'
		});
		$('#open-close-button').on('click', function(){
			
			var img = $(this).attr('src');
			
			if( $(this).hasClass('open') ) {
				
				$(this).removeClass('open');
				$(this).addClass('close');
				$(this).attr('src', img.replace('btn-close.png', 'btn-open.png'));
				$(this).css({
					'cssText':'top: 10px;'
				});
				$('#wpadminbar').css({
					'cssText':'visibility: hidden;'
				});
				
			} else {
				
				$(this).removeClass('close');
				$(this).addClass('open');
				$(this).attr('src', img.replace('btn-open.png', 'btn-close.png'));
				$(this).css({
					'cssText':'top: '+ ( total_height + 10 ) + 'px;'
				});
				$('#wpadminbar').css({
					'cssText':'visibility: visible; height:' + total_height+'px;'
				});
				
			}
		});
	}
});
