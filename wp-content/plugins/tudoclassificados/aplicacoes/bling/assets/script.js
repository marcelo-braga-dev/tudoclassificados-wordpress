$('.check-ingaia').change(function () {
    if( $(this).is(":checked") == true ) {
        $(this).parent().parent().parent().find('select').attr('required', true);
    }
    else {
        $(this).parent().parent().parent().find('select').attr('required', false);
    }    
});



