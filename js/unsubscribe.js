$(function() {

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const token = urlParams.get('t');    

    $('#unsubscribe-form').submit(function(e) {
        
        const form = $(this);
        const submitButton = $(form).find('#unsubscribe-btn');
        e.preventDefault();        

        $.ajax({
            type: "POST",
            url: $(form).attr('action'),
            data: {token: token},

            beforeSend: function (xhr) {
                submitButton.prop('disabled', true);
            },
            success: function (response) {
                                                                
                if (typeof response !== 'object' ) {
                    var response = JSON.parse(response);                    
                }

                window.location.href = '/';
            },
            complete: function (xhr) {
                submitButton.prop('disabled', false);
            }
        });
    })
})