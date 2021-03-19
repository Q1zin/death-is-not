$(document).ready(function () {

    $(".admin__input-btn-chack").on("click", function () {
      var inputId = $(".admin__input-id").val();
      var inputText = $(".admin__input-text").val();
      $(".admin-content").empty()
      $(".admin-content").append("<div class=\"content__card\"><img class=\"content__card--img\" src=\"http://img.youtube.com/vi/" + inputId + "/mqdefault.jpg\" alt=\"img: превью видео\"><span class=\"content__card--text\">" + inputText + "</span><span class=\"content__card--more\"><a class=\"content__card--link\" target=\"_blank\" href=\"https://www.youtube.com/watch?v=" + inputId + "\">Подробнее</a></span></div>");
    })

    $(".admin__input-btn-send").on("click", function () {
        var inputId = $(".admin__input-id").val();
        var inputViews = $(".admin__input-views").val();
        var inputText = $(".admin__input-text").val();
        var inProcess = false;

        console.log(123123);

        $.ajax({
            url: 'loading_content/send.php',
            method: 'GET',
            data: {"id" : inputId, "views" : inputViews, "text" : inputText},
            beforeSend: function(){
                inProcess = true;
            }
            }).done(function(data){
            // if (data != null) {
            //     alert(data.info);
            // } else {
            //     alert('error');
            // }

            alert(data);

            inProcess = false;
            data = null;
            });
        })

})

