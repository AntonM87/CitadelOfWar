$(document).ready(function () {

//валидация полей формы регистрации
    $('.main-content-block').on('input', function (event) {

        var regFormEmail = $('#reg-form-email');
        var regFormPass = $('#reg-form-pass');
        var regFormPassSecond = $('#reg-form-pass-second');
        var captchaInput = $('input[role="captcha"]');

        if ($(event.target).attr('type') === 'email') {

            //поиск совпадений email в бд прямо в поле
            if($(event.target).val().length > 5) {

                $.ajax({
                    url: '../controller/controller.php',
                    data: 'emailEmptyPlace=' + $(event.target).val(),
                    contentType: 'Content-Type: text/plain; charset=utf-8',
                    success: function (data) {

                        //вывод сообщения
                        $('#searchDBStatusEmail').remove();
                        if (data === '') {

                            $('.input-container-required #reg-form-email').after(function () {
                                var p = '<p id="searchDBStatusEmail">Свободен</p>';
                                return $(p).css('color','green');
                            }).fadeIn('fast');
                        } else {
                            $('.input-container-required #reg-form-email').after(function () {
                                var p = '<p id="searchDBStatusEmail">Занят</p>';
                                return $(p).css('color','red');
                            }).fadeIn('fast');
                        }
                    }
                });
            }
            else if ($(event.target).val().length <= 5) {
                $('#searchDBStatusEmail').remove();
            }

            if ($(event.target).val().search(/[a-zA-z0-9\._]+?@{1,1}[a-z0-9]+?\.\w{2,4}/i) !== -1) {
                $(event.target)
                    .css('background', '#b3ffcc')
                    .attr('data-valid', 'true');
            } else {
                $(event.target)
                    .css('background', '#ffcccc')
                    .attr('data-valid', 'false');
            }
            inputValidLength(event.target);
        }

        if ($(event.target).attr('role') === 'nick') {

            if($(event.target).val().length >= 3) {
                // код поиска ника

                $.ajax({
                    url: '../controller/controller.php',
                    data: 'nickEmptyPlace=' + $(event.target).val(),
                    contentType: 'Content-Type: text/plain; charset=utf-8',
                    success: function (data) {

                        //вывод сообщения
                        $('#searchDBStatusNick').remove();
                        if (data === '') {

                            $('.input-container-required #reg-form-nick').after(function () {
                                var p = '<p id="searchDBStatusNick">Свободен</p>';
                                return $(p).css('color','green');
                            }).fadeIn('fast');

                        } else {
                            $('.input-container-required #reg-form-nick').after(function () {
                                var p = '<p id="searchDBStatusNick">Занят</p>';
                                return $(p).css('color','red');
                            }).fadeIn('fast');
                        }

                        if ($(event.target).val().length === 0) {
                            $('#searchDBStatusNick').fadeOut('fast').remove();
                        }
                    }
                });
            }
            else if ($(event.target).val().length <= 5) {
                $('#searchDBStatusNick').remove();
            }

            if ($(event.target).val().search(/[а-яa-zA-z0-9_]{3,}/i) !== -1) {
                $(event.target)
                    .css('background', '#b3ffcc')
                    .attr('data-valid', 'true');
            } else {
                $(event.target)
                    .css('background', '#ffcccc')
                    .attr('data-valid', 'false');
            }
            inputValidLength(event.target);
        }

        if ($(event.target).attr('type') === 'password' &&
            $(event.target).attr('id') === 'reg-form-pass') {
            if ($(event.target).val().search(/(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}/g) !== -1) {
                $(event.target)
                    .css('background', '#b3ffcc')
                    .attr('data-valid', 'true');
            } else {
                $(event.target)
                    .css('background', '#ffcccc')
                    .attr('data-valid', 'false');
            }
            inputValidLength(event.target);
        }

        if ($(event.target).attr('type') === 'password' &&
            $(event.target).attr('id') === 'reg-form-pass-second') {
            if ($(event.target).val().search(/(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}/g) !== -1) {
                $(event.target)
                    .css('background', '#b3ffcc')
                    .attr('data-valid', 'true');
            } else {
                $(event.target)
                    .css('background', '#ffcccc')
                    .attr('data-valid', 'false');
            }
            inputValidLength(event.target);
        }
        if ($(event.target).attr('id') === 'captchaInput') {
            if ($(event.target).val().length >= 4 && $(event.target).val().length <= 6) {
                $(event.target)
                    .css('background', '#b3ffcc')
                    .attr('data-valid', 'true');
            } else {
                $(event.target)
                    .css('background', '#ffcccc')
                    .attr('data-valid', 'false');
            }
            inputValidLength(event.target);
        }

        if ($(regFormEmail).attr('data-valid') === 'true' &&
            $(regFormEmail).attr('data-valid') === 'true' &&
            $(regFormPassSecond).attr('data-valid') === 'true' &&
            $(regFormPass).val() === $(regFormPassSecond).val() &&
            $(captchaInput).val().length >= 4 &&
            $(captchaInput).val().length <= 6) {
            $('#btnReg').removeClass('not-active').removeAttr('disabled');
        } else {
            $('#btnReg').addClass('not-active').attr('disabled', 'true');
        }
    });

// отправка на сервер значений формы регистрации
    $('.main-content-block').on('click', function (event) {

        //отслеживание новых элементов в DOM
        var observer = new MutationObserver(function () {
            $('#systemErrMsg').fadeIn('fast',function () {
                setTimeout(function () {
                    $('#systemErrMsg').fadeOut('fast',function () {
                        $(this).remove();
                    });
                },5000);
            });
        });

        observer.observe(document.documentElement,{
            attributes: true,
            childList: true,
            subtree: true,
            characterData: true,
            characterDataOldValue: true
        });


        if ($(event.target).attr('id') === 'btnReg') {
            event.preventDefault();

            //защита кнопки от повторного нажатия
            $('#btnReg').attr('disabled','true');
            setTimeout(function () {
                $('#btnReg').removeAttr('disabled');
            },5000);
            //рестарт каптчи при нажатии на кнопку рег. на случай если регистрация не удачная
            captchaRestart();

            $('#loadingAction').show();

            $.ajax({
                url: '../controller/controller.php',
                method: 'POST',
                data: 'regJSON' + '=' + JSON.stringify({
                    'email': $('#reg-form-email').val(),
                    'nick': $('input[role="nick"]').val(),
                    'passwordFirst': $('#reg-form-pass').val(),
                    'passwordSecond': $('#reg-form-pass-second').val(),
                    'sex': $('select[name="sex"]').val(),
                    'birth_date': [
                        $('select[name="dateBirthDay"]').val(),
                        $('select[name="dateBirthMonth"]').val(),
                        $('select[name="dateBirthYear"]').val()
                    ],
                    'captcha': $('input#captchaInput').val()
                }),
                success: function (data) {

                    $('#loadingAction').hide();

                    if (data.search(/id='systemErrMsg'/) >= 0) {
                        $('.main-content-block').append(data);
                        observer.disconnect();
                    } else {
                        $('.main-content-block').html(data);
                    }

                    //прекратить отслежить появление элементов в DOM
                    observer.disconnect();
                }
            });
        }
        // рестарт каптчи

        if ($(event.target).attr('id') === 'captchaRestart') {
            captchaRestart()
        }
    });

//выход из регистрации  по esc
    $(document).on('keydown', function (event) {
        if (event.which === 27) $('#authForm').fadeOut('fast');
    });
// обработчик input формы входа
    $('#authForm').on('input', function (event) {

        var email = $('#authForm input[type="email"]');
        var password = $('#authForm input[type="password"]');

        if ($(event.target).attr('type') === 'email') {
            if ($(email).val().search(/[a-zA-Z0-9\._]+?@{1,1}[a-z0-9A-Z]+?\.\w{2,4}/i) !== -1) {
                $(email)
                    .css('background', '#b3ffcc')
                    .attr('data-valid', 'true');
            } else {
                $(email)
                    .css('background', '#ffcccc')
                    .attr('data-valid', 'false');
            }
            inputValidLength(event.target);
        }
        if ($(event.target).attr('type') === 'password') {
            if ($(password).val().search(/(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{3,}/g) !== -1) {
                $(password)
                    .css('background', '#b3ffcc')
                    .attr('data-valid', 'true');
            } else {
                $(password)
                    .css('background', '#ffcccc')
                    .attr('data-valid', 'false');
            }
            inputValidLength(event.target);
        }

        //включение кнопки при заполненой почте
        if ($(email).attr('data-valid') === 'true' && $(password).attr('data-valid') === 'true') {
            $('#btnEnter').removeClass('not-active').removeAttr('disabled');
        } else {
            $('#btnEnter').addClass('not-active').attr('disabled', 'true');
        }


    });

//появление меню регистрации авторизации
    $('span#enterReg, span#enterReg>i#enterReg, li#enterReg').on('click', function () {
        $('#authForm').fadeIn('fast');
        $('.falshBackground').fadeIn('fast').on('click', function () {
            $('#authForm').fadeOut('fast');
            $('.falshBackground').fadeOut('fast');
        });
        $('#closeRegAuthForm').on('click', function () {
            $('#authForm').fadeOut('fast');
            $('.falshBackground').fadeOut('fast');
        })
    });

//mob menu
    $('#mobMenuToggler').on('click', function () {
        $('#mobMenu').css("display", "flex").hide().fadeIn('fast');
    });
    $('#closeMobMenu').on('click', function () {
        $('#mobMenu').fadeOut('fast');
    });

//кнопка на верх
    $('#up').on('click', function () {
        var step = - Math.round(pageYOffset / 15);
        var interval = setInterval(function () {
            scrollBy(0, step);
            if (pageYOffset <= 0) clearInterval(interval);
        }, 10);
    });

// вывод формы регистрации
    $('#registration').on('click', function (event) {
        event.preventDefault();
        $('#authForm').fadeOut('fast');
        $('#loadingAction').show();
        $('.falshBackground').hide();

        $.ajax({
            url: '../controller/controller.php',
            data: 'registrationForm',
            contentType: 'Content-Type: text/html; charset=utf-8',
            success: function (data) {
                $('#loadingAction').hide();
                $('.main-content-block').html(data);
            }
        });

    });

//tooltip
// document.addEventListener('mouseover',function (event) {
//
//     var target = event.target;
//     if (target.hasAttribute('data-tooltip')){
//         var tooltip = getId('tooltip');
//         var tooltip = target.getAttribute('data-tooltip');
//         var coord = target.getBoundingClientRect();
//         // console.dir(coord);
//     }
// });

//cookie
    if (document.cookie.search(/cookie_info=true/) === -1) {
        setTimeout(function () {
            $('#cookie-message').css('marginBottom', '0px');
        }, 3000);
    }
    $('#closeCookie').click(function () {
        $('#cookie-message, #cookie-message + a').css('marginBottom', '-300px');
        var date = new Date(new Date().getTime() + (3600 * 24 * 1000 * 7));
        document.cookie = "cookie_info=true; expires=" + date.toUTCString();
    });
});

////////////////////////////////////////////////////////////////////////////////////////
//рестарт каптчи
function captchaRestart() {
    $('.captcha').html('<img style="width: 30px;height: 30px; margin-top: 7%; margin-left: 30%;" src="../img/loading.gif">');
    $.ajax({
        url: '../controller/controller.php',
        method: 'GET',
        headers: ["Content-type", "text/html"],
        data: 'captchaRestart',
        success: function (data) {
            $('#loadingAction').hide();
            $('.captcha').html(data);
        }
    });
}
//отображение белого фона для input
function inputValidLength(elem) {
    if ($(elem).val().length === 0){
        $(elem).css('background', '#ffffff');
    }
}
