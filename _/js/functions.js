(function($){
	var event_type = 'touchstart';
	
	$(document).ready(function (){
		
		$('body').on(event_type,'button#nav-btn', function(){	
			
			if (!$('body').hasClass('nav-open')) {
				$('body').addClass('nav-open');
				$('#page').animate( {left: '-300px', opacity: 0.5}, 'fast');
				$(this).addClass('disabled');
				
				$('#main-nav').animate( {right: '0px', opacity: 1}, 'fast', function(){
					$(this).toggleClass('nav-closed nav-open').removeAttr('style');
				});
			}
						
			return false;
		});	
		
		$('body').on(event_type,'button#close-nav-btn', function(){
			
			$('#page').animate( {left: '0px', opacity: 1}, 'fast', function(){
				$('body').toggleClass('nav-open nav-closed');
				$(this).removeAttr('style');	
			});
			
			$('#main-nav').animate( {right: '-300px', opacity: 0}, 'fast', function(){
				$(this).toggleClass('nav-open nav-closed').removeAttr('style');
			});
			
			return false;
		
		});	
		
		$('body').on(event_type, 'button#contact-handler-btn', function(){
			
			$('#message-handler-form').toggleClass('form-closed form-open');
			
			return false;
			
		});
		
		$('body').on(event_type, 'button#message-handler-btn', function(){
			
			$('#message-handler-form').toggleClass('form-closed form-open');
			
			return false;
			
		});
		
		$('body').on(event_type, 'button.wp-generate-pw', function() {
			if ( $('button#update-profile').hasClass('hidden') ) {
				$('button#update-profile').removeClass('hidden');
			}
		});
		
		$('body').on(event_type, 'button.wp-cancel-pw', function() {
			if ( !$('button#update-profile').hasClass('hidden') ) {
				$('button#update-profile').addClass('hidden');
			}
		});

	});
	
})(window.jQuery);