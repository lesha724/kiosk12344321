$(document).ready(function(){

    $('#department').change(function(){
        $(this).closest('form').submit();
    });

    initDataTable('phones');


    VKI_imageURI = imageUrl;
    //var $input = $('#phones_filter input').addClass('keyboardInput');

    $('#phones_filter').hide();

    $('#customSearch').on('submitEvent', function(){
        var $that = $(this);
        var text  = $that.val();
        $('#phones_filter input').val(text).keyup();
    })

});