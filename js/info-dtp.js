$(document).ready(function () {

    $(".comment__btn").on("click", function () {
        var comment = $(".comment__textarea").val();
        
        var article = $('.comment__btn').data('article')

        var data = '12-12-2021';

        var inProcess = false;
        $.ajax({
            url: 'add-comment.php',
            method: 'GET',
            data: {"comment": comment, "article": article, "data": data},
            beforeSend: function () {
            inProcess = true;
            }
        }).done(function (data) {
            data = jQuery.parseJSON(data);
            if (data.chack == 'OK') {         
                $(".discuss__empty").addClass('discuss__empty--dis');
                $(".discuss__comment-wrap").prepend("<div class=\"discuss__comment\"><div class=\"discuss__comment--top\"><img class=\"discuss__comment--top--img\" src=\"img/user.svg\" alt=\"icon: user profiles\"><span class=\"discuss__comment--top--name\">" + data.user_name + "</span><span class=\"discuss__comment--top--data\">" + data.data + "</span></div><div class=\"discuss__comment--down\">" + data.comment + "</div></div>");
                $(".comment__textarea").val(''); 
                $(".comment__textarea").attr("placeholder", "Комментарий успешно добавлен!")
                setTimeout(function () {
                    $(".comment__textarea").attr("placeholder", "Введите комментарий")
                },10000)

            }

            inProcess = false;
            data = null;
        });


        })


})