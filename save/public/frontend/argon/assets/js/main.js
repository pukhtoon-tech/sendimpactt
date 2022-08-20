/**
   * subscribe
   */

$('#newsletter').on('submit', function (e) {

    e.preventDefault();
    var url = $('#subscription_url').val();
    var email = $('#email').val();

    if (email.length == 0) {
        alert('Email field is required');
    }
    else {

        if (url == null) {
            location.reload()
        } else {
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    email: email,
                },
                beforeSend: function () {
                    $('#newsletterBtnSubmit').addClass('d-none');
                    $('#newsletterBtnSending').removeClass('d-none');
                    $('#newsletterAlertSuccess').addClass('d-none');
                    $('#newsletterAlertError').addClass('d-none');
                },
                success: function () {
                    $('#newsletterBtnSending').addClass('d-none');
                    $('#newsletterBtnSubmit').removeClass('d-none');
                    $('#newsletterAlertSuccess').removeClass('d-none');
                },
                error: function () {
                    $('#newsletterBtnSending').addClass('d-none');
                    $('#newsletterBtnSubmit').removeClass('d-none');
                    $('#newsletterAlertError').removeClass('d-none');
                }
            });
        }
    }
});

// Scroll to specific values
// scrollTo is the same
window.scroll({
    top: 2500,
    left: 0,
    behavior: 'smooth'
});

// Scroll certain amounts from current position 
window.scrollBy({
    top: 100, // could be negative value
    left: 0,
    behavior: 'smooth'
});

// Scroll to a certain element
document.getElementById('pricing').scrollIntoView({
    behavior: 'smooth'
});

// Select all links with hashes
$('a[href*="#"]')
    // Remove links that don't actually link to anything
    .not('[href="#"]')
    .not('[href="#0"]')
    .click(function (event) {
        // On-page links
        if (
            location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
            &&
            location.hostname == this.hostname
        ) {
            // Figure out element to scroll to
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            // Does a scroll target exist?
            if (target.length) {
                // Only prevent default if animation is actually gonna happen
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 1000, function () {
                    // Callback after animation
                    // Must change focus!
                    var $target = $(target);
                    $target.focus();
                    if ($target.is(":focus")) { // Checking if the target was focused
                        return false;
                    } else {
                        $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                        $target.focus(); // Set focus again
                    };
                });
            }
        }
    });

window.scrollTo({ top: 0, behavior: 'smooth' });

// Scroll To Top
function scrollToTop() {

    window.scrollTo({ top: 0, behavior: 'smooth' });

}