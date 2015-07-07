var template = function() {

    var _placeholder = $("#sections");

    var init = function() 
    {
        addSection();
        bindEditables();
        bindSortables();
        bindRemovals();
        loadRichTextEditor();
    };


    //binds the click event on the add section
    var addSection = function() 
    {
        $('li#add-section').click(function()
        {
            $.ajax({
                method: "POST",
                url: $("#add-section-url").val(),
                data: {  },
                success: function(response){
                   _placeholder.append(response);
                   bindSortables();
                   $(".section_title").editable({});
                }
                //failed sweet alert something went wrong
            });
        });
    };


    //bind the edit in place inputs
    var bindEditables = function()
    {
        $.fn.editable.defaults.mode = 'popup';
        //updates the SECTION (model) title in the builder ui
        $(".section_title").editable({});
        $(".component-title").editable({});
        $(".component-options").editable({
            display: function(value) {
              $(this).text('Options');
            } 
        });
    };


    //bind the sortables divisions
    var bindSortables = function()
    {
       //dragging components type
       $(".component-type").draggable({
            appendTo: "body",
            helper: "clone"
        });
       //sorting sections
       $("#sections").sortable({
            items: "div.section", //"div.block:not(.placeholder)",
            handle: '.drag-section i',
            sort: function() {
              $(this).removeClass("ui-state-default");
            },
            update: function(event, ui) {
                var data = $(this).sortable('toArray');
                updateSectionsOrder(data);
            }
        });
       //sections droppables and sortable
       $(".section").droppable({
            accept: ".component-type",
            drop: function(event, ui) {
                var component_type = ui.draggable;
                var section = $(this);
                addComponent(component_type.data('component-type-id'), section.data('section-id'));
            }
        }).sortable({
            items: "div.component",
            sort: function() {
                $(this).removeClass("ui-state-default");
            },
            update: function(event, ui) {
                var data = $(this).sortable('toArray');
                updateComponentsOrder(data);
            }
        });
    }


    var bindRemovals = function()
    {
        $("body").on("click", ".remove-component", function(){
            var elem = $(this);
            $.ajax({
                method: "POST",
                url: elem.data('url'),
                data: { id: elem.data('component-id') },
                success: function(response){
                   elem.closest('.component').fadeOut();
                }
            });
        });

        $("body").on("click", ".remove-section", function(){
            var elem = $(this);
            $.ajax({
                method: "POST",
                url: elem.data('url'),
                data: { id: elem.data('section-id') },
                success: function(response){
                   elem.closest('.section').fadeOut();
                }
            });
        });
    }


    var loadRichTextEditor = function()
    {
        $(".richtexteditor").each(function(){
            var id = $(this).attr('id');
            bkLib.onDomLoaded(function() {
                new nicEditor({iconsPath : '/admin/img/nicEditorIcons.gif', fullPanel : true}).panelInstance(id);
            });
        })
    }


    //return functions
    return {
        init: init
    };
}();


//Load global functions
$(document).ready(function() {
    template.init();
});


/*
 * Update the sections order  
 */
function updateSectionsOrder(data)
{
    $.ajax({
        method: "POST",
        url: $("#reorder-sections-url").val(),
        data: {data},
        success: function(response){
           
        }
    });
}


/*
 * Add component into a section
 */
function addComponent(componentTypeId, sectionId)
{
     $.ajax({
        method: "POST",
        url: $("#add-component-url").val(),
        data: { component_type_id: componentTypeId,  section_id: sectionId },
        success: function(response){
           $("div.section#" + sectionId+" .section-components").append(response);
           $(".component-title").editable({});
           $(".component-options").editable({
            display: function(value) {
              $(this).text('Options');
            } 
        });
        }
    });

}


/*
 * Update the components order
 */
function updateComponentsOrder(data)
{
    $.ajax({
        method: "POST",
        url: $("#reorder-components-url").val(),
        data: {data},
        success: function(response){
           
        }
    });
}







