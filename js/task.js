$(function () {

    // show and hide focus function

    $("[placeholder]").focus(function(){

        $(this).attr("data-text", $(this).attr("placeholder"));

        $(this).attr("placeholder", "");
    }).blur(function(){

        $(this).attr("placeholder", $(this).attr("data-text"));
    });


    // connfirmation message function

    $(".confirm").click(function() {

        return confirm("Are You Sure?");
    });
    
});


// seslect

$(document).ready(function(){

    var $cat = $('select[name=switcher]');

    $cat.change(function(){
        switch($cat.val()) {
            case '1':
                console.log("no1");
                $(".dvd").show().siblings("div").hide();
                break;
            case '2':
                $(".frnt").show().siblings("div").hide();
                break;
            case '3':
                $(".book").show().siblings("div").hide();
                break;
            default:
                $(".cascade").siblings("div").hide();

        }
    });

    $('#chk_all').click(function(){
        if(this.checked)
            $(".checkItem").prop("checked", true);
        else
            $(".checkItem").prop("checked", false);
    });


});