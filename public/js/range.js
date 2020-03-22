
$(".slidecontainer input").change(function () {

    var price = $(this).val();

    $(this).parent().find('.showPrice').html(price+'.0');
});

$('.filter input[type=range], .filter select').change(function () {
    var coord = $(this).offset();
    var width = $(this).width();


    if($(this)[0].type == 'select-one') {
        $('.filter-btn').css({'left':coord.left + width+50,'top':coord.top}).animate({'opacity':1},500);
    }else{
        $('.filter-btn').css({'left':coord.left + width+20,'top':coord.top-20}).animate({'opacity':1},500);
    }
});
