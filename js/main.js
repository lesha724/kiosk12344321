$(document).ready(function(){

    initChosen();

    initSpinner('spinner1');

    initDialogSettings()

});

function initDialogSettings()
{
    if ($.ui != undefined)
        $.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
            _title: function(title) {
                var $title = this.options.title || '&nbsp;'
                if( ("title_html" in this.options) && this.options.title_html == true )
                    title.html($title);
                else title.text($title);
            }
        }));
}

function initChosen()
{
    $('.chosen-select').chosen();
}

function initSpinner(id)
{
    var opts = {
        lines:  11, // The number of lines to draw
        length: 7, // The length of each line
        width:  4,  // The line thickness
        radius: 5  // The radius of the inner circle
    };
    var target = document.getElementById(id);
    var spinner = new Spinner(opts).spin(target);
}

function addGritter(title, text, className)
{
    obj = {
        title: title,
        text: text,
        class_name: 'gritter-'+className
    }
    $.gritter.add(obj)
}

function initPopovers()
{
    $('[data-rel=popover]').popover({html:true});

    /* avoid popover to open more than one at the same time */
    $('[data-rel=popover]').click(function(){
        $('[data-rel=popover]').not(this).popover('hide'); //all but this
    });
}

function initTooltips()
{
    $('[data-rel=tooltip]').tooltip();
}

function initFilterForm($spinner)
{
    $(document).on('change', '#timeTable-form select:not(:last), #filter-form fieldset:not(.not-submit) select:not(:last)', function(){
        $spinner.show();

        var $form  = $(this).closest('form');
        var formId = $form.attr('id');
        var url    = $form.attr('action');

        $.get(url, $form.serialize(), function(data){

            var html = $('#'+formId, data).html();
            $('div', $form).replaceWith(html);
            initChosen();
            $spinner.hide();
        })

    });

    $(document).on('change', '#timeTable-form select:last, #filter-form fieldset:not(.not-submit) select:last', function(){
        $(this).closest('form').submit();
    });
}

function initDataTable(id)
{
    $('#'+id).dataTable({
        iDisplayLength: 20,
        aaSorting: [],
        bPaginate: true,
        oLanguage: {
            sSearch: 'Поиск',
            oPaginate: {
                sNext: 'След',
                sPrevious: 'Пред'
            },
            sLengthMenu: '',//'Показать _MENU_ записей',
            sInfo: 'Общее кол-во записей _TOTAL_ отображено (_START_ - _END_)',
            sInfoEmpty: 'Ничего не найдено',
            sInfoFiltered: ' - отсортировано _MAX_ записей',
            sZeroRecords: 'Ничего не найдено'
        }
    });
}

function initAutoSize()
{
    $('textarea[class*=autosize]').autosize({append: "\n"});
}


$.fn.outerHTML = function(s) {
    return s
        ? this.before(s).remove()
        : jQuery("<p>").append(this.eq(0).clone()).html();
};
