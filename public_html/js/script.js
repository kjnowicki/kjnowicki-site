$(document).ready(function(){
  $(".btn-sm").click(function()
  {
	$(".active-link").removeClass("active-link");
	$(this).addClass("active-link");
  });
});