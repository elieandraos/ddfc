/**
 * Created by joseph.saade on 7/14/15.
 */
var app = function() {

    var init = function () {

        initializeVideoFrames();
        initNewsFilters();
        initTabIndex();
        initGallery();
    };

    //set up tooltips
    var initializeVideoFrames = function() 
    {

        $("#videoFrame").click(function(){
            $('#videoFrame').hide();
            $('#ytplayer').fadeIn();
            $("#ytplayer").attr("src",$("#ytplayer").attr("src")+"&autoplay=1");
            return false;;
        });
    };


     
    //set up news filters ajax
    var initNewsFilters = function()
    {
        $("a.btn-filter-news").click(function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            $.ajax({
                method: "GET",
                url: url,
                success: function(response){
                    console.log(response);
                    $(".news-listing").html(response).fadeIn();
                }
            })
            return false;
        })


        $("#blueimp-gallery").on('opened', function (event) {
            $("a.prev, a.next, a.close, h3.title").css('display', 'block');
        });

        $("#blueimp-gallery").on('slideend', function (index, slide) {
            var currentSlide = $("div.slide")[slide];
            var currentImg   = $(currentSlide).find('img');
            var positionImg = $(currentImg).offset();
            var left = getOffsetCaption(currentImg);

            // Already loaded, call the handler directly
            $("h3.title").css({
                'top': positionImg.top - 40,
                'left': left,
                'position' : 'absolute',
                'display' : 'block'
            });

            if(currentImg.complete) {
                var positionImg = $(currentImg).offset();
                left = getOffsetCaption(currentImg);
                // Already loaded, call the handler directly
                $("h3.title").css({
                    'top': positionImg.top - 40,
                    'left': left,
                    'position' : 'absolute',
                    'display' : 'block'
                });
            }
            else {
                $(currentImg).load(function(){
                    var positionImg = $(currentImg).offset();
                    left = getOffsetCaption(currentImg);

                    $("h3.title").css({
                        'top': positionImg.top - 40,
                        'left': left,
                        'position' : 'absolute',
                        'display' : 'block'
                    });
                });
            }
        });

    }


    var initTabIndex = function()
    {
        $("#skip-link").click(function(){
            $("#main-content").attr("tabindex","-1").focus()
        })
    }

    var initGallery = function()
    {
        var totalItemsWidth = ($(".gallery-thumb").length) * 73.75;
    
        var left = 0;
        $("#gallery_left").click(function(){
            var width = ($("#links").width());
            var max = totalItemsWidth - width;
            if(left <= -max) return false;

            left -= 70;
            $("#gallery_items").animate({marginLeft:left});
            return false;
        });

        $("#gallery_right").click(function(){
            if(left >= 0) return false;
            left += 70;
            $("#gallery_items").animate({marginLeft:left});
            return false;
        });
    }


    //return functions
    return {
        init: init
    };
}();

//Load global functions
$(document).ready(function() {

    app.init();
});


function getOffsetCaption( currentImg )
{
    var _lang = $('html').attr('lang');
    var positionImg = $(currentImg).offset();       
    
    if(_lang == 'ar')
       return ( $(window).width() - ( positionImg.left + $(currentImg).width() ) );
    else
       return positionImg.left;
}

