$('.my-alert').delay(2000).fadeOut();


//
// $('#placeButton').onclick(function () {
//     fadeOut($('.placeText'));
// });

$( "#placeButton" ).click(function() {
    if($('#placeText').css("display") === "block"){
        $('#placeText').hide();
        $('#placeFrom').show();
    }else{
        $('#placeText').show();
        $('#placeFrom').hide();
    }
});

$( "#dateButton" ).click(function() {
    if($('#dateText').css("display") === "block"){
        $('#dateText').hide();
        $('#dateForm').show();
    }else{
        $('#dateText').show();
        $('#dateForm').hide();
    }
});

$( "#descriptionButton" ).click(function() {
    if($('#descriptionText').css("display") === "block"){
        $('#descriptionText').hide();
        $('#descriptionForm').show();
    }else{
        $('#descriptionText').show();
        $('#descriptionForm').hide();
    }
});

$( "#nameButton" ).click(function() {
    if($('#nameText').css("display") === "block"){
        $('#nameText').hide();
        $('#nameFrom').show();
    }else{
        $('#nameText').show();
        $('#nameFrom').hide();
    }
});