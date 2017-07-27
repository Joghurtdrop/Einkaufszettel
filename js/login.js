
$('.tab a').on('click', function (e) {
  
  e.preventDefault();
  
  $(this).parent().addClass('active');
  $(this).parent().siblings().removeClass('active');
  
  target = $(this).attr('href');

  $('.tab-content > div').not(target).hide();
  
  $(target).fadeIn(600);
  
});

function openForgotPw(){
	document.getElementById("forgotpw").style.cssText = "display: block!important";
}

function closeForgotPw(){
	document.getElementById("forgotpw").style.cssText = "display: none!important";
}