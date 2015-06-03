var app = function() {

    var init = function() {

        tooltips();
        toggleMenuLeft();
        menu();
        togglePanel();
        datepickers();
        slugify();
        handleRemoteForms();
        toggleTranslate();
    };

    //set up tooltips
    var tooltips = function() {
        $('[data-toggle="tooltip"]').tooltip();
    };

    //init toggle bootstrap panels
    var togglePanel = function() {
        $('.actions > .fa-chevron-down').click(function() {
            $(this).parent().parent().next().slideToggle('fast');
            $(this).toggleClass('fa-chevron-down fa-chevron-up');
        });
    };

    //init toggle menu left
    var toggleMenuLeft = function() {
        $('#toggle-left').bind('click', function(e) {
            if (!$('.sidebarRight').hasClass('.sidebar-toggle-right')) {
                $('.sidebarRight').removeClass('sidebar-toggle-right');
                $('.main-content-wrapper').removeClass('main-content-toggle-right');
            }
            $('.sidebar').toggleClass('sidebar-toggle');
            $('.main-content-wrapper').toggleClass('main-content-toggle-left');
            e.stopPropagation();
        });
    };

    //set up menu
    var menu = function() {
        $("#leftside-navigation .sub-menu > a").click(function(e) {
            $("#leftside-navigation ul ul").slideUp();
            if (!$(this).next().is(":visible")) {
                $(this).next().slideDown();
            }
              e.stopPropagation();
        });
    };
    
    //set up date pickers
    var datepickers = function(){
        $('.input-group.date').datepicker({
            format: "mm/dd/yyyy",
            clearBtn: true,
            autoclose: true,
            todayHighlight: true,
        });
    };

    //sluggify url input
    var slugify = function()
    {
        $('.txt-slug').slugify('.slug-target');
    };

    //handle remote form submission
    var handleRemoteForms = function()
    {
        $('body').on('submit', 'form[data-remote]', function(e){
            e.preventDefault();
            var form = $(this);
            var method = form.find('input[name="_method"]').val() || "POST";
            var url = form.prop('action');
            var callback = form.data('callback');

            $.ajax({
                method: method,
                url: url,
                data: form.serialize(),
                success: function(response){
                    if(callback)
                        window[callback](response, form);
                }
            })
        })
    };
    //End functions

    //handle dropdown language change when translating content
    var toggleTranslate = function()
    {
        $('.toggle-language').change(function(){
             var _locale = $(this).val();
             var _url = $("#translate-url").val() + "/" + _locale;
             window.location = _url;
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



/*****************************************
 * Custom function outside the app scope *
 *****************************************/

//init click button to submit remote forms
function submitRemoteForm(elem){
    $(elem).closest("form.remote-form").submit();
};

function removeTableRow(response, form)
{
    $(form).closest('tr').fadeOut(750);
}


function customConfirm(elem, prompt_title, prompt_text, confirm_title, confirm_text)
{
    swal({   
            title: prompt_title,   
            text: prompt_text,   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, delete it!",   
            closeOnConfirm: false,   
            closeOnCancel: false
        }, 
    function(isConfirm){   
        if (isConfirm) {     
            submitRemoteForm(elem);
            swal(confirm_title, confirm_text, "success");         
        } 
        else 
        {     
            swal("Cancelled", "The operation has been cancelled :)", "error");   
        }
    });
       
}
