$(document).ready(function () {
    // console.log('veikia');
    // $('.wrapper').submit(function (e) {
    //     e.preventDefault();
    //     var url = $('.wrapper').attr('action');
    //
    //     $.ajax({
    //         type: "POST",
    //         url: url,
    //         data: $(this).serialize(),
    //         success: function (response) {
    //             window.location.replace("http://194.5.157.92/phpObjektinis/index.php/post");
    //             var obj = JSON.parse(response);
    //             if (obj.code == 200) {
    //                 $('.msg-block').slideDown(500).text(obj.msg);
    //             }
    //             console.log(response);
    //         }
    //     });
    // });
    $('.wrapperReg').change(function () {
        $('.msg-block').slideUp(500).text(obj.msg);
    });
    $('.password2').change(function () {
        var pass1 = $('.password').val();
        var pass2 = $('.password2').val();
        if (pass1 != pass2) {

            $('.password').addClass('red');
            $('.password2').addClass('red');
        } else {
            $('.password').removeClass('red');
            $('.password2').removeClass('red');
        }
    });

    $('.email').change(function () {
        $.ajax({
            type: "POST",
            url: 'http://194.5.157.92/phpObjektinis/index.php/account/verify',
            data: {belekoks_email: $(this).val()},
            success: function (response) {
                var obj = JSON.parse(response);
                if (obj.code == 200) {
                    $(this).addClass('red')
                } else {
                    $('.msg-block').slideDown(500).text('Toks email jau egzistuoja');

                }
                // console.log(response);
            }
        });
    });
    function delay(callback, ms) {
        var timer = 0;
        return function(){
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function(){
                callback.apply(context, args);
            }, ms || 0);
        };
    }


    $('#search').keyup(delay(function() {
    var url = $('.wrapper-search').attr('action');
        $.ajax({
            type: "GET",
            url: url,
            data: {keyword: $(this).val()},
            success: function (response)
                {
                    // var obj = JSON.parse(response)
                    $('.post-wrapper').html(response);
                }
        });
    }, 500));

    $('.search-form').submit(function(e) {
        e.preventDefault();
    });

    $('.dropdown').click(function(){
       $('.dropdown-content').toggle();
    });

});