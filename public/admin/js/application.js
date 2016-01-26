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
        initNestedCategories();
        initRichTextEditor();
        initMetaAutoFill();
        initDropzone();
        initGallerySortables();
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


    var initNestedCategories = function()
    {
        if($("#nestable").length)
        {
            $('#nestable').nestable({
                'expandBtnHTML': '-',
                'collapseBtnHTML': '+',
                'group': 1,
                'listNodeName': 'ul' 
            })
            .on('change', sortCategories);
        }   
    }

    //handle dropdown language change when translating content
    var toggleTranslate = function()
    {
        $('.toggle-language').change(function(){
             var _locale = $(this).val();
             var _url = $("#translate-url").val() + "/" + _locale;
             window.location = _url;
        })
    }

    //init the rich text editors
    var initRichTextEditor = function()
    {

         $(".richtexteditor").each(function(){
            var id = $(this).attr('id');
            bkLib.onDomLoaded(function() {
                new nicEditor({iconsPath : '/admin/img/nicEditorIcons.gif',fullPanel : true, uploadURI:"/upload", uploadToken:$('meta[name="csrf-token"]').attr('content')}).panelInstance(id);
            });
        })

        $(".nicEdit-main").css('overflow','scroll');
    }

    //autofill facebook meta title and desc
    var initMetaAutoFill = function()
    {
        $("input[name=title]").keyup(function(){
           value = $(this).val();
           $("input[name=facebook_title]").val(value);
           $("input[name=meta_title]").val(value);
           $("input[name=twitter_title]").val(value);
        })

        $("textarea[name=excerpt]").keyup(function(){
           value = $(this).val();
           $("textarea[name=facebook_description]").val(value);
           $("textarea[name=meta_description]").val(value);
           $("textarea[name=twitter_description]").val(value);
        })
    }

    var initDropzone = function() 
    {
        if(!$("#gallery-uploads").length)
            return;
        
        updateDzOrder();

        //Dropzone.autoDiscover = false;
        $("#gallery-uploads").dropzone({ 
            url: "/admin/upload-gallery-photo",
            autoProcessQueue: true, //uploads will be processed on drop 
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            maxFilesize: 1, //in MB
            previewTemplate: document.querySelector('#preview-template').innerHTML,
            dictDefaultMessage: '',
            dictRemoveFile: 'Delete',
            thumbnailWidth: 150
        });

        currentDropzone = $('#gallery-uploads').get(0).dropzone;

        currentDropzone.on("sending", function(file, xhr, formData) {
            var csrftoken = $('meta[name="csrf-token"]').attr('content');
            formData.append('_token', csrftoken);
        });

        currentDropzone.on("uploadprogress",function(file,progress,bytesSent){
            filePreview = file.previewElement;
            //$(filePreview).find(".dz-upload").css('width',progress + '%');
        });

        currentDropzone.on("success", function(file, response) {
            filePreview = file.previewElement;
            $(filePreview).find('.dz-file').val( response.filename);
            updateDzOrder();
        });

    }


    var initGallerySortables = function(){
        $("#gallery-uploads").sortable({
            items:'.dz-preview',
            cursor: 'move',
            opacity: 0.5,
            containment: '#gallery-uploads',
            distance: 20,
            tolerance: 'pointer',
            update: function (event, ui) {
               var data = $('#gallery-uploads').sortable('toArray').toString()
               updateDzOrder();
            }
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


/*******************************
 * Nested Categories Functions *
 *******************************/

function removeCategory(response, form)
{
    $(form).closest('li').fadeOut(750);
}

function sortCategories(e)
{
   var str = window.JSON.stringify($('#nestable').nestable('serialize'));
   var request_url = $("#sort-url").val();
 
   $.ajax({
        url: request_url,
        type: "POST",
        data: { "json_string" : str},
        success: function(data){
            // ...
        }
    })
}


function updateDzOrder()
{
    if( $("#gallery-uploads .dz-preview").length )
    {
        $("#gallery-uploads .dz-preview").each(function(index){
            $(this).find('.dz-order').val(index);
       })
    }
}

