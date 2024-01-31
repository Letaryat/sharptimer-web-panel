var modalexit = function(){
    $('.modal').addClass('fadeout');
    $('.modal-container').addClass("slidedown");
    setTimeout(function(){
    $('.modal').removeClass('active fadein fadeout');
    $('.modal-container').removeClass('slideup slidedown');
    $(document.body).removeClass('modalactive');
    $('.modal-content').remove();
    }, 500);
    $("input:checked").each(function(){
        $('input:checkbox').prop('checked', false);
    })
}

$('.modal-exit').click(modalexit);
$(document).keyup(function(e){
    if(e.key === "Escape"){
        if($('.modal').hasClass("active")){
            modalexit();
        }
    }
})

$('.donate').click(function(){
    var widthdonate = $('.donate-content').width() + 'px';
    $('.donate').toggleClass('active');
    if($('.donate').hasClass('active')){
        $('.donate').css('transform','translateX(0px)');
    }else{
        $('.donate').css('transform','translateX(-'+widthdonate+')');
    }
})

$(document).ready(function() {
    var widthdonate = $('.donate-content').width() + 'px';
    $('.donate').css('transform','translateX(-'+widthdonate+')');
});
