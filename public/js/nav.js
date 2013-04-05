// JavaScript Document
$(document).ready(function()
{

$('.subnav li a').mouseover(function() {
									 $(this).stop().animate({textIndent: "30px"}, 500);
									 });
$('.subnav li a').mouseout(function() {
									 $(this).delay(5050).stop().animate({textIndent: "20px"}, 500);
									 });

	
	$('#nav li.second').mouseover(function(){
									   $(this).find('.subnav').css('width','150px');
									   
									   $(this).find('.subnav').stop().animate({height: '185px'
},'slow');
							   });
	$('#nav li.second').mouseout(function() {
									   
									   $(this).find('.subnav').stop().animate({ height: '0px'
},'slow');
									 
									   
  });
						
			

});
