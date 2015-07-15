/**
 * Created by joseph.saade on 7/14/15.
 */
var app = function() {

    var init = function () {

        initializeVideoFrames();
        initNewsFilters();

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

