jQuery(document).ready(function($)
{
    console.log('hola ameo')
    var fruit = 'apple';
    $.post
    (
        my_ajax_handler.ajaxurl,
        {
            action : 'locations_handler',
            fruit : fruit,
            nonce : my_ajax_handler.nonce
        },
        function(response)
        {
            console.log(response);
        }
    );  
});