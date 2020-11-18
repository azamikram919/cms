$(document).ready(function () {

    $('ul.nav li.dropdown').hover(function () {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
    }, function () {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
    });
    if(jQuery('#phone-number').length)
    {
        jQuery('#phone-number').intlTelInput();
    }

    $('#change-password-form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: $('#change-password-form').attr('action'),
            type: 'POST',
            data: $('#change-password-form').serialize(),
            dataType : 'JSON',
            beforeSend : function(){
                $('#change-password-btn').val('PROCESSING...');
            },
            success: function (response) {
                $('#change-password-btn').val('SAVE PASSWORD');
                $('#old_password-error,#new_password-error,#confirm_password-error').text('');
                if(response.status==false && response.statusCode == 422)
                {
                    $.each(response.errors,function(key,val){
                        $('#' + key + '-error').text(val);
                    });
                }
                else if(response.status==false && response.statusCode == 412)
                {
                    $('#change-password-alert')
                        .addClass('alert-website-color')
                        .text(response.msg).fadeIn()
                        .delay(3000).fadeOut();
                }
                else
                {
                    $('#change-password-alert')
                        .addClass('alert-website-color')
                        .text(response.msg).fadeIn()
                        .delay(2000).fadeOut();
                    setTimeout(function(){ window.location.replace(response.url); }, 3000);
                }
            }
        });
    });
});