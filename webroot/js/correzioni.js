var STAGGING_SERVER = "http://correzioni.218vig.purvey.hostingrails.com/";
//var DEVELOPMENT_SERVER = "http://localhost/robproject/Correzioni/";
var DEVELOPMENT_SERVER = window.location.href;
var PRODUCTION_SERVER = "";
var ROOT = DEVELOPMENT_SERVER;

$(document).ready(function() {
//    //load featured products
//    if ($('#bannerFeature').size() > 0) {
//        $.get(ROOT + "pages/ajax_recent", function(content) {
//            $('#bannerFeature').html(content);
//        });
//    }

//    //load big image on home page if contain main pic
//    if (window.location.href == ROOT && $('#mainPic').size() > 0) {
//        $.get(ROOT + "pages/ajax_picture", function(content){
//            $('#mainPic').html(content);
//        });
//    }

    $menuAnchor = $('#menu a');
    if ($menuAnchor.length) {
        $menuAnchor.click(function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('href'),
                beforeSend: function() {
                    if ( !$('#subNav').length ) {
                        $('#mainContent').prepend('<div id="subNav"></div>');
                        $('#subNav').css({backgroundColor: '#2F373A'});
                    }
                    $('#subNav').html('<img src="./img/ajax-loader-small.gif">');
                },
                complete: function(data) {
                    $('#subNavContainer').remove();
                    $('#subNav').remove();
                    $('#mainContent').prepend(data.responseText);
                    $('#bannerFeature').hide();
                    $('#mainPicText').hide();
                }
            });
        });
    }

//    $('#menu a').click(function() {
//        var toLoad = $(this).attr('href');
//        $('#subNav')[0].style.backgroundColor = this.style.backgroundColor;
//        $('#subNav').html('<img src="./img/ajax-loader-small.gif">');
//        $('#subNav').fadeIn('normal');
//        $('#subNavContainer').slideUp('normal', showSubMenus());

//        function showSubMenus() {
//            $.get(toLoad,function(submenu){
//                $('#subNav').html(submenu);
//            });
//        }
//        return false;
//    });
});

