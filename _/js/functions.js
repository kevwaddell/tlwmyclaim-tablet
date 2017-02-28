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
	});
	
})(window.jQuery);