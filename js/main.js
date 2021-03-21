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

    // function openDonMini() {
    //     var donDialogMini = $(".modal-don-mini");
    //     donDialogMini.addClass("modal-don-mini--active");
    //     var coverUpDialog = $(".cover-up");
    //     coverUpDialog.addClass("cover-up--active");
    //     document.cookie = "donDialogMini=true; path=/; max-age=864000";
    //     var body = $("body");
    //     body.addClass("body--stop")
    // }

    // var x = get_cookie("donDialogMini")

    // if (!x) {
    //     setTimeout(openDonMini, 3000);
    // }

    $(".header-menu").on("click", function (event) {
      event.preventDefault();
      var menu = $(".menu");
      menu.addClass("menu--active");
    })

    $(".menu-close").on("click", function (event) {
      event.preventDefault();
      var menu = $(".menu");
      menu.removeClass("menu--active");
    })

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
          console.log(data);
          if (data != null) {
            $.each(data,function(index, data){
              $("#content__video--wrap-video").append("<div class=\"content__card\"><img class=\"content__card--img\" src=\"http://img.youtube.com/vi/" + data.link + "/mqdefault.jpg\" alt=\"img: превью видео\"><span class=\"content__card--text\">" + data.content + "</span><span class=\"content__card--more\"><a class=\"content__card--link\" target=\"_blank\" href=\"https://www.youtube.com/watch?v=" + data.link + "\">Подробнее</a></span></div>");
            });
            num += 6;
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

      $.ajax({
          url: 'sign-in.php',
          method: 'POST',
          data: {"password" : inputPassword,"login" : inputLogin},
          beforeSend: function(){
            inProcess = true;
          }
        }).done(function(data){
          data = jQuery.parseJSON(data);
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


    

    // $('.modal-don-big__sub').on("click", function () {
    //   if (numTablet != 'chack'){
    //   var a = "http://www.free-kassa.ru/merchant/forms.php?gen_form=1&m=286526&default-sum="+ numTablet +"&button-text=Оплатить&encoding=CP1251&type=v3&id=1668101";
    //   } else {
    //     var inputPrise = $(".num_summ_5").val()
    //     numTablet = inputPrise;
    //     if (numTablet < 10){
    //       numTablet = 10;
    //     }
    //     var a = "http://www.free-kassa.ru/merchant/forms.php?gen_form=1&m=286526&default-sum="+ numTablet +"&button-text=Оплатить&encoding=CP1251&type=v3&id=1668101";
    //   }
    //   window.open(a);
    // })


    $('.modal-don-big__sub').on("click", function () {
      if (numTablet == 'chack'){
      var inputPrise = $(".num_summ_5").val()
        numTablet = inputPrise;
        if (numTablet < 10){
          numTablet = 10;
        }
      }

      var login = $(".modal-don-big__information--item--email").val();
      var us_name = $(".modal-don-big__information--item--name").val();
      var us_last_name = $(".modal-don-big__information--item--last-name").val();

      $.ajax({
          url: 'pay.php',
          method: 'GET',
          data: {"oa" : numTablet, "o" : login, "us_name" : us_name, "us_last_name" : us_last_name},
          beforeSend: function(){
            inProcess = true;
          }
        }).done(function(data){
          var a = data;
          inProcess = false;
          data = null;
          window.open(a);
        });

    })







    var swiper = new Swiper(".swiper-container", {
          slidesPerView: 'auto',
          // centeredSlides: true,
          spaceBetween: 10,
          initialSlide: 0,
          grabCursor: true
    });



    var num2 = 3;
    var inProcess = false;
    var mynum2 = $('div.hidden').data('num');

    $(".swiper__more-slide").on("click", function (params) {
      if (num2 < mynum2){
        $.ajax({
          url: 'loading_content/load.php',
          method: 'GET',
          data: {"num" : num2},
          beforeSend: function(){
            inProcess = true;
          }
        }).done(function(data){
          data = jQuery.parseJSON(data);
          if (data != null) {
            $.each(data,function(index, data){
              swiper.appendSlide("<div class=\"content__card swiper-slide\"><img class=\"content__card--img\" src=\"http://img.youtube.com/vi/" + data.link + "/mqdefault.jpg\" alt=\"img: превью видео\"><span class=\"content__card--text\">" + data.content + "</span><span class=\"content__card--more\"><a class=\"content__card--link\" target=\"_blank\" href=\"https://www.youtube.com/watch?v=" + data.link + "\">Подробнее</a></span></div>");
            });
            // $(".swiper__more-slide").remove();
            // swiper.appendSlide("<button class=\"swiper-slide swiper__more-slide\"><img src=\"img/circle_chevron_right.svg\" alt=\"icon: more content\"></button>");
            num2 += 6;
            if (num2 >= mynum2){
            $(".swiper__more-slide").remove()
          }
          };
          inProcess = false;
          data = null;
        });
      }
    })


    function allLetter1(uname) { 
      var unameLeng = uname.length;
        if (unameLeng >=3 && unameLeng <=14){
          var letters = /^[A-Za-zА-Яа-я]+$/;
          if (uname.match(letters)){
            return true;
          } else {
            return 'errTokenName';
          }
        } else {
          return 'errLengName';
        }
      }

      function allLetter2(uname) { 
        var unameLeng = uname.length;
        if (unameLeng >=3 && unameLeng <=32){
          var letters = /^[A-Za-zА-Яа-я]+$/;
          if (uname.match(letters)){
            return true;
          } else {
            return 'errTokenName';
          }
        } else {
          return 'errLengName';
        }
      }

      function allLetter3(uname) { 
        var unameLeng = uname.length;
        if (unameLeng >=3 && unameLeng <=32){
          var letters = /^[A-Za-zА-Яа-я\s]+$/;
          if (uname.match(letters)){
            return true;
          } else {
            return 'errTokenName';
          }
        } else {
          return 'errLengName';
        }
      }

      function passid_validation(passid) {
        var passid_len = passid.length;
        if (passid_len == 0 || passid_len >= 32 || passid_len < 4) {
          return false;
        }
        return true;
      }

      function ValidateEmail(uemail) {
        var mailformat = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if(uemail.match(mailformat)) {
          return true;
        } else {
          return false;
        }
      }


    $(".modal-reg__input--sub").on("click", function () {
      var inputName = $(".modal-reg__input--name").val();
      var inputLastName = $(".modal-reg__input--last-name").val();
      var inputLogin = $(".modal-reg__input--log").val();
      var inputPassword = $(".modal-reg__input-pass").val();

      var chackName = allLetter1(inputName);
      var chackLastName = allLetter2(inputLastName);
      var chackLogin = ValidateEmail(inputLogin);
      var chackPass = passid_validation(inputPassword);

      if (chackName && chackLastName && chackLogin && chackPass){
        $('.error-reg-name').text('');
        $('.error-reg-last-name').text('');
        $('.error-reg-email').text('');
        $('.error-reg-pass').text('');
        $.ajax({
          url: 'sign-up.php',
          method: 'POST',
          data: {"password" : inputPassword,"login" : inputLogin,"last_name" : inputLastName,"name" : inputName},
          beforeSend: function(){
            inProcess = true;
          }
        }).done(function(data){
          data = jQuery.parseJSON(data);
          if (data.registred == 1) {
            location.reload();
          } else {
            var modalLoginError = $(".modal-reg__error");
            modalLoginError.addClass("modal-reg__error--active");
          }
          inProcess = false;
          data = null;
        });
      } else {
        switch (chackName) {
          case 'errLengName':
            var errName = 'Имя должно быть от 3 до 14 символов';
          break;

          case 'errTokenName':
            var errName = 'Имя может содержать только латинские и русские буквы';
          break;

          case true:
            var errName = '';
          break;
        }
        $('.error-reg-name').text(errName);

        switch (chackLastName) {
          case 'errLengName':
            var errLastName = 'Фамилия должна быть от 4 до 32 символов';
          break;

          case 'errTokenName':
            var errLastName = 'Фамилия может содержать только латинские и русские буквы';
          break;

          case true:
            var errLastName = '';
          break;
        }
        $('.error-reg-last-name').text(errLastName);

        if (!chackLogin){
          $('.error-reg-email').text('Введите валидный email');
        } else {
          $('.error-reg-email').text('');
        }

        if (!chackPass){
          $('.error-reg-pass').text('Пароль должен быть от 4 до 32 сомволов');
        } else {
          $('.error-reg-pass').text('');
        }

      }
    });

    $(".modal-don-big__sub-full").on("click", function (event) {
      event.preventDefault();
      var inputName2 = $(".modal-don-big__information--item--name").val();
      var inputLastName2 = $(".modal-don-big__information--item--last-name").val();
      var inputLogin2 = $(".modal-don-big__information--item--email").val();

      var chackName2 = allLetter1(inputName2);
      var chackLastName2 = allLetter2(inputLastName2);
      var chackLogin2 = ValidateEmail(inputLogin2);

      if (chackName2 && chackLastName2 && chackLogin2){
        $('.error-support-name').text('');
        $('.error-support-last-name').text('');
        $('.error-support-email').text('');

        if (numTablet == 'chack'){
      var inputPrise = $(".num_summ_5").val()
        numTablet = inputPrise;
        if (numTablet < 10){
          numTablet = 10;
        }
      }

      var login = $(".modal-don-big__information--item--email").val();
      var us_name = $(".modal-don-big__information--item--name").val();
      var us_last_name = $(".modal-don-big__information--item--last-name").val();

      $.ajax({
          url: 'pay.php',
          method: 'GET',
          data: {"oa" : numTablet, "o" : login, "us_name" : us_name, "us_last_name" : us_last_name},
          beforeSend: function(){
            inProcess = true;
          }
        }).done(function(data){
          var a = data;
          inProcess = false;
          data = null;
          window.open(a);
        });
      
      } else {
        
        switch (chackName2) {
          case 'errLengName':
            var errName = 'Имя должно быть от 3 до 14 символов';
          break;

          case 'errTokenName':
            var errName = 'Имя может содержать только латинские и русские буквы';
          break;

          case true:
            var errName = '';
          break;
        }
        $('.error-support-name').text(errName);

        switch (chackLastName2) {
          case 'errLengName':
            var errLastName = 'Фамилия должна быть от 4 до 32 символов';
          break;

          case 'errTokenName':
            var errLastName = 'Фамилия может содержать только латинские и русские буквы';
          break;

          case true:
            var errLastName = '';
          break;
        }
        $('.error-support-last-name').text(errLastName);

        if (!chackLogin2){
          $('.error-support-email').text('Введите валидный email');
        } else {
          $('.error-support-email').text('');
        }
      }

    })


    $(".profile__tablet-item-1").on("click", function (event) {
      $(".profile__tablet-item-1").addClass("profile__tablet-item--active");
      $(".profile__tablet-item-2").removeClass("profile__tablet-item--active");
      $(".profile__tablet-item-3").removeClass("profile__tablet-item--active");
      $(".profile__my-donations").removeClass("profile-content--active");
      $(".profile__added-accidents").removeClass("profile-content--active");
      $(".profile__info").addClass("profile-content--active");
    })
    $(".profile__tablet-item-2").on("click", function (event) {
      $(".profile__tablet-item-2").addClass("profile__tablet-item--active");
      $(".profile__tablet-item-1").removeClass("profile__tablet-item--active");
      $(".profile__tablet-item-3").removeClass("profile__tablet-item--active");
      $(".profile__added-accidents").removeClass("profile-content--active");
      $(".profile__info").removeClass("profile-content--active");
      $(".profile__my-donations").addClass("profile-content--active");
    })
    $(".profile__tablet-item-3").on("click", function (event) {
      $(".profile__tablet-item-3").addClass("profile__tablet-item--active");
      $(".profile__tablet-item-1").removeClass("profile__tablet-item--active");
      $(".profile__tablet-item-2").removeClass("profile__tablet-item--active");
      $(".profile__my-donations").removeClass("profile-content--active");
      $(".profile__info").removeClass("profile-content--active");
      $(".profile__added-accidents").addClass("profile-content--active");
    })

    $(".profile__info--save-btn").on("click", function () {
      var inputProName = $(".profile__input--name").val();
      var inputProLastName = $(".profile__input--last-name").val();
      var inputProRegion = $(".profile__input--region").val();
      var inputProCity = $(".profile__input--city").val();

      var inputProNameChack = allLetter2(inputProName);
      var inputProLastNameChack = allLetter2(inputProLastName);

      if (inputProRegion != ''){
        var inputProRegionChack = allLetter3(inputProRegion);
      } else {
        inputProRegionChack = true;
      }

      if (inputProCity != ''){
        var inputProCityChack = allLetter3(inputProCity);
      } else {
        inputProCityChack = true;
      }

      
      

      if ((inputProNameChack == true) && (inputProLastNameChack == true) && (inputProRegionChack == true) && (inputProCityChack == true)){
        $('.profile__error').text('');

        $.ajax({
          url: 'edit-profile.php',
          method: 'GET',
          data: {"name" : inputProName, "last-name" : inputProLastName, "region" : inputProRegion, "city" : inputProCity, "loginHash" : getCookie('loginHash'), "userHash" : getCookie('userHash'), "userId" : getCookie('userId')},
          beforeSend: function(){
            inProcess = true;
          }
        }).done(function(data){
          if (data == 'good'){
            $(".profile__info--save-text").text('Настройки успешно изменены');
            $(".user-link__text").text(inputProName);
            setTimeout(function () {
              $(".profile__info--save-text").text('');
            }, 6000);
          } else {
            $(".profile__info--save-text").text('Что-то пошло не по плану');
            setTimeout(function () {
              $(".profile__info--save-text").text('');
            }, 6000);
          }
          inProcess = false;
          data = null;
        });

      } else {
        switch (inputProNameChack) {
          case 'errLengName':
            var errLastName = 'Имя должна быть от 3 до 32 символов';
          break;

          case 'errTokenName':
            var errLastName = 'Имя может содержать только латинские и русские буквы';
          break;

          case true:
            var errLastName = '';
          break;
        }

        $('.profile__error--name').text(errLastName);

        switch (inputProLastNameChack) {
          case 'errLengName':
            var errLastName = 'Фамилия должна быть от 3 до 32 символов';
          break;

          case 'errTokenName':
            var errLastName = 'Фамилия может содержать только латинские и русские буквы';
          break;

          case true:
            var errLastName = '';
          break;
        }

        $('.profile__error--last-name').text(errLastName);

        switch (inputProRegionChack) {
          case 'errLengName':
            var errLastName = 'Регион должна быть от 3 до 32 символов';
          break;

          case 'errTokenName':
            var errLastName = 'Регион может содержать только латинские и русские буквы';
          break;

          case true:
            var errLastName = '';
          break;
        }

        $('.profile__error--region').text(errLastName);

        switch (inputProCityChack) {
          case 'errLengName':
            var errLastName = 'Город должна быть от 3 до 32 символов';
          break;

          case 'errTokenName':
            var errLastName = 'Город может содержать только латинские и русские буквы';
          break;

          case true:
            var errLastName = '';
          break;
        }

        $('.profile__error--city').text(errLastName);

      }
    })


  function getCookie(name) {
  let matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
  }

})
