$(document).ready(function () {
    "use strict"


    /**
     * LOGIN
     */
    cash(function () {
            async function login() {
                // Reset state
                cash('#login-form').find('.input').removeClass('border-theme-6')
                cash('#login-form').find('.login__input-error').html('')

                // Post form
                let email = cash('#input-email').val()
                let password = cash('#input-password').val()
                let rememberMe = cash('#input-remember-me').val()
                
                // Loading state
                cash('#btn-login').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
                await helper.delay(1500)

                axios.post(`login`, {
                    email: email,
                    password: password,
                    remember_me: rememberMe
                }).then(res => {
                    location.href = $('#dashboard_url').val()
                }).catch(err => {
                    cash('#btn-login').html('Login')
                    if (err.response.data.message != 'Wrong email or password.') {
                        for (const [key, val] of Object.entries(err.response.data.errors)) {
                            cash(`#input-${key}`).addClass('border-theme-6')
                            cash(`#error-${key}`).html(val)
                        }
                    } else {
                        cash(`#input-password`).addClass('border-theme-6')
                        cash(`#error-password`).html(err.response.data.message)
                    }
                })
            }

            cash('#login-form').on('keyup', function(e) {
                if (e.keyCode === 13) {
                    login()
                }
            })
            
            cash('#btn-login').on('click', function() {
                login()
            })
        });

    /**
     * Pasword Strength
     */

    $('#pwd').on('keyup', function () {
        $('#strength_message').html(checkStrength($('#pwd').val()))
    })

    function checkStrength(password) {
        var strength = 0
        if (password.length < 6) {
            $('#strength_message').removeClass()
            $('#strength_message').addClass('short')
            return 'Password is too short'
        }

        if (password.length > 7) strength += 1
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
        if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1
        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
        if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
        if (strength < 2) {
            $('#strength_message').removeClass()
            $('#strength_message').addClass('weak')
            return 'Password is weak'
        } else if (strength == 2) {
            $('#strength_message').removeClass()
            $('#strength_message').addClass('good')
            return 'Password is good'
        } else {
            $('#strength_message').removeClass()
            $('#strength_message').addClass('strong')
            return 'Password is strong'
        }
    }

    /**
     * Pasword Matching
     */

    $("#cpwd").on('keyup', function () {
        if ($("#pwd").val() != $("#cpwd").val()) {
            $("#match_msg").html("Password do not match").css("color", "red");
        } else {
            $("#match_msg").html("Password matched").css("color", "green");
        }
    });


    /**
     * REDIRECT
     */

     $('#btn-signin').on('click', function(){
        window.location = $('#login_url').val();
     });

     $('#btn-signup').on('click', function(){
        window.location = $('#signup_url').val();
     });


   



});