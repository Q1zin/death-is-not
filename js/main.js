$(document).ready(function () {
    var loginButton = $(".header-right__logining--btn");
    loginButton.on("click", openModalLogin);

    function openModalLogin(event) {
        event.preventDefault();
        var loginDialog = $(".modal-login");
        loginDialog.addClass("modal-login--active");
        var coverUpDialog = $(".cover-up");
        coverUpDialog.addClass("cover-up--active");
        var body = $("body");
        body.addClass("body--stop")
    }

    var loginRegButton = $(".modal-login__btn--reg");
    loginRegButton.on("click", openModalLoginReg);

    function openModalLoginReg(event) {
        event.preventDefault();
        var loginDialog = $(".modal-login");
        loginDialog.removeClass("modal-login--active");
        var regDialog = $(".modal-reg")
        regDialog.addClass("modal-reg--active");
        var body = $("body");
        body.addClass("body--stop")
    }

    var regLoginButton = $(".modal-reg__btn--log");
    regLoginButton.on("click", openModalRegLogin);

    function openModalRegLogin(event) {
        event.preventDefault();
        var regDialog = $(".modal-reg")
        regDialog.removeClass("modal-reg--active");
        var loginDialog = $(".modal-login");
        loginDialog.addClass("modal-login--active");
        var body = $("body");
        body.addClass("body--stop")
    }

    var closeModalLink = $(".modal-close__link");
    closeModalLink.on("click", closeModal)

    var closeModalLinkBtn = $(".modal-don-mini__btns--sub-not");
    closeModalLinkBtn.on("click", closeModal)

    function closeModal(event) {
        event.preventDefault();
        var regDialog = $(".modal-reg")
        regDialog.removeClass("modal-reg--active");
        var loginDialog = $(".modal-login");
        loginDialog.removeClass("modal-login--active");
        var donDialog = $(".modal-don");
        donDialog.removeClass("modal-don--active");
        var donDialogMini = $(".modal-don-mini");
        donDialogMini.removeClass("modal-don-mini--active");
        var coverUpDialog = $(".cover-up");
        coverUpDialog.removeClass("cover-up--active");
        var body = $("body");
        body.removeClass("body--stop")
    }

    var loginButton = $(".header-right__donation--button");
    loginButton.on("click", openModalDon);

    function openModalDon(event) {
        event.preventDefault();
        var donDialog = $(".modal-don");
        donDialog.addClass("modal-don--active");
        var coverUpDialog = $(".cover-up");
        coverUpDialog.addClass("cover-up--active");
        var donDialogMini = $(".modal-don-mini");
        donDialogMini.removeClass("modal-don-mini--active");
        var body = $("body");
        body.addClass("body--stop")
    }

    function get_cookie(cookie_name) {
        var results = document.cookie.match('(^|;) ?' + cookie_name + '=([^;]*)(;|$)');

        if (results)
            return (unescape(results[2]));
        else
            return null;
    }

    function openDonMini() {
        var donDialogMini = $(".modal-don-mini");
        donDialogMini.addClass("modal-don-mini--active");
        var coverUpDialog = $(".cover-up");
        coverUpDialog.addClass("cover-up--active");
        document.cookie = "donDialogMini=true; path=/; max-age=864000";
        var body = $("body");
        body.addClass("body--stop")
    }

    var x = get_cookie("donDialogMini")

    if (!x) {
        setTimeout(openDonMini, 10000);
    }

    var num = 3;
    var inProcess = false;
    var mynum = $('div.hidden').data('num');

    $("#content__video--btn").on("click", function(){
      if (num < mynum){
        $.ajax({
          url: 'loading_content/load.php',
          method: 'GET',
          data: {"num" : num},
          beforeSend: function(){
            inProcess = true;
          }
        }).done(function(data){
          data = jQuery.parseJSON(data);
          if (data != null) {
            $.each(data,function(index, data){
              $("#content__video--wrap-video").append("<div class=\"content__card\"><img class=\"content__card--img\" src=\"http://img.youtube.com/vi/" + data.link + "/mqdefault.jpg\" alt=\"img: превью видео\"><span class=\"content__card--text\">" + data.content + "</span><span class=\"content__card--more\"><a class=\"content__card--link\" target=\"_blank\" href=\"https://www.youtube.com/watch?v=" + data.link + "\">Подробнее</a></span></div>");
            });
            num += 3;
          };
          inProcess = false;
          data = null;
          if (num >= mynum){
            var btnMore = $(".content__video--btn");
            btnMore.addClass("content__video--btn-dis");
          }

        });
      }
      
    });

    var donMiniBtns = $(".modal-don-mini__btns--sub");
    donMiniBtns.on("click", openModalDon);

    var g = 2;

    $(".register__glass").on("click", function () {
      $(this).toggleClass("register__glass--active");
      g++;
      if(g & 1){
        $(".modal-login__input-pass").attr("type", "text");
      } else {
        $(".modal-login__input-pass").attr("type", "password");
      }
    })

    $(".register__glass2").on("click", function () {
      $(this).toggleClass("register__glass2--active");
      g++;
      if(g & 1){
        $(".modal-reg__input-pass").attr("type", "text");
      } else {
        $(".modal-reg__input-pass").attr("type", "password");
      }
    })



    $(".modal-login__input--sub").on("click", function () {
      var inputLogin = $(".modal-login__input--log").val();
      var inputPassword = $(".modal-login__input-pass").val();
      console.log(inputLogin);
      console.log(inputPassword);

      $.ajax({
          url: 'sign-in.php',
          method: 'POST',
          data: {"password" : inputPassword,"login" : inputLogin},
          beforeSend: function(){
            inProcess = true;
          }
        }).done(function(data){
          data = jQuery.parseJSON(data);
          console.log(data);
          if (data.err_login == false && data.err_password == false) {
            location.reload();
          } else {
            var modalLoginError = $(".modal-login__error");
            modalLoginError.addClass("modal-login__error--active");
          }
          inProcess = false;
          data = null;
        });
    });

    var tablet1 = $('.num_summ_1');
    var tablet2 = $('.num_summ_2');
    var tablet3 = $('.num_summ_3');
    var tablet4 = $('.num_summ_4');
    var tablet5 = $('.num_summ_5');

    var numTablet = 300;

    tablet1.on("click", function () {
      tablet2.removeClass('num_summ--active');
      tablet3.removeClass('num_summ--active');
      tablet4.removeClass('num_summ--active');
      tablet5.removeClass('num_summ--active-inp');
      tablet1.addClass('num_summ--active');
      numTablet = 300
    })

    tablet2.on("click", function () {
      tablet1.removeClass('num_summ--active');
      tablet3.removeClass('num_summ--active');
      tablet4.removeClass('num_summ--active');
      tablet5.removeClass('num_summ--active-inp');
      tablet2.addClass('num_summ--active');
      numTablet = 500;
    })

    tablet3.on("click", function () {
      tablet1.removeClass('num_summ--active');
      tablet2.removeClass('num_summ--active');
      tablet4.removeClass('num_summ--active');
      tablet5.removeClass('num_summ--active-inp');
      tablet3.addClass('num_summ--active');
      numTablet = 1000;
    })

    tablet4.on("click", function () {
      tablet1.removeClass('num_summ--active');
      tablet3.removeClass('num_summ--active');
      tablet2.removeClass('num_summ--active');
      tablet5.removeClass('num_summ--active-inp');
      tablet4.addClass('num_summ--active');
      numTablet = 2000;
    })

    tablet5.on("click", function () {
      tablet1.removeClass('num_summ--active');
      tablet2.removeClass('num_summ--active');
      tablet3.removeClass('num_summ--active');
      tablet4.removeClass('num_summ--active');
      tablet5.addClass('num_summ--active-inp');
      numTablet = 'chack';
    })


    

    $('.modal-don-big__sub').on("click", function () {
      if (numTablet != 'chack'){
      var a = "http://www.free-kassa.ru/merchant/forms.php?gen_form=1&m=286526&default-sum="+ numTablet +"&button-text=Оплатить&encoding=CP1251&type=v3&id=1668101";
      } else {
        var inputPrise = $(".num_summ_5").val()
        numTablet = inputPrise;
        if (numTablet < 10){
          numTablet = 10;
        }
        var a = "http://www.free-kassa.ru/merchant/forms.php?gen_form=1&m=286526&default-sum="+ numTablet +"&button-text=Оплатить&encoding=CP1251&type=v3&id=1668101";
      }
      window.open(a);
    })







    $(".modal-reg__input--sub").on("click", function () {
      var inputName = $(".modal-reg__input--name").val();
      var inputLastName = $(".modal-reg__input--last-name").val();
      var inputLogin = $(".modal-reg__input--log").val();
      var inputPassword = $(".modal-reg__input-pass").val();

      $.ajax({
          url: 'sign-up.php',
          method: 'POST',
          data: {"password" : inputPassword,"login" : inputLogin,"last_name" : inputLastName,"name" : inputName},
          beforeSend: function(){
            inProcess = true;
          }
        }).done(function(data){
          data = jQuery.parseJSON(data);
          console.log(data);
          if (data.registred == 1) {
            location.reload();
          } else {
            var modalLoginError = $(".modal-reg__error");
            modalLoginError.addClass("modal-reg__error--active");
          }
          inProcess = false;
          data = null;
        });
    });









})
