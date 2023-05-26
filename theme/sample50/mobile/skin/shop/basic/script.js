
 
  $(function() {
$('.btn_wish').on('click', function(){
    $(this).addClass('button_on');
    })
 $(".btn_share").on("click", function() {
		$(this).parent("div").children(".sct_sns_wrap").show();
	});
    $('.sct_sns_bg, .sct_sns_cls').click(function(){
	    $('.sct_sns_wrap').hide();
	});
$('.btn_wish').on('click', function(){
$(this).addClass('button_on');
})

  });