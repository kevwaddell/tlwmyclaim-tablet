(function($){
	var event_type = 'touchstart';
	
	$(document).ready(function (){
		
		$('body').on(event_type,'button#nav-btn', function(){
	
		$('#page').toggleClass('nav-open');
		$('.pg-nav').toggleClass('nav-open nav-closed');
		
		return false;
		
		});	
		
		$('body').on(event_type,'button#close-nav-btn', function(){
	
		$('#page').removeClass('nav-open');
		$('.pg-nav').toggleClass('nav-open nav-closed');
		
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