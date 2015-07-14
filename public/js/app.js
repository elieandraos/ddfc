/**
 * Created by joseph.saade on 7/14/15.
 */
var app = function() {

    var init = function () {

        initializeVideoFrames();

    };

    //set up tooltips
    var initializeVideoFrames = function() {

        $("#videoFrame").click(function(){
            $('#videoFrame').hide();
            $('#ytplayer').fadeIn();
            $("#ytplayer").attr("src",$("#ytplayer").attr("src")+"&autoplay=1");
            return false;;
        });
    };

    //return functions
    return {
        init: init
    };
}();

//Load global functions
$(document).ready(function() {

    app.init();
});

