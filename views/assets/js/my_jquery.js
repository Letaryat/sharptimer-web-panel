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
var widthdonate = $('.donate-content').width();
$('.donate').click(function(){
    $('.donate').toggleClass('active');
    if($('.donate').hasClass('active')){
        $('.donate').css('transform','translateX(0px)');
    }else{
        $('.donate').css('transform','translateX(-'+widthdonate+'px)');
    }
})

$(document).ready(function() {
    $('.donate').css('transform','translateX(-'+widthdonate+'px)');
    var countli = $('.donate-content > li').length;
    if(countli > 1){
        $('.donate-content').css('border-radius','0px 10px 10px 0px')
    }
    $('.donate-button').on("mouseenter",function(){
        widthdonate -= 5;
        $('.donate').css('transform','translateX(-'+widthdonate+'px)');
    }).on("mouseleave", function(){
        widthdonate += 5;
        $('.donate').css('transform','translateX(-'+widthdonate+'px)');
    })

});

