var App = (function ($) {
    var App = {
        spinner:
                '<div class="spinner-overlay">' +
                '<svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">' +
                '<circle class="path" fill="none" stroke-width="1" stroke-linecap="round" cx="33" cy="33" r="30"></circle>' +
                '</svg>' +
                '</div>',
        showLoader: function (el, zIndex) {
            el.append(App.spinner);
            if (typeof zIndex == 'undefined') {
                zIndex = 10000;
            }
            $('body').find('.spinner-overlay').css('z-index', zIndex);
            if (zIndex !== 3) {
                $('body').find('.card-header').css('z-index', '10001');
            }
        },
        hideLoader: function () {
            $('body').find('.spinner-overlay').remove();
            $('body').find('.card-header').css('z-index', '10000');
        },
        slideTo: function (el) {
            $('html,body').animate({
                scrollTop: $("#"+el.attr('href')).offset().top},'slow');
        },
        slideToAlert() {
            $('html,body').animate({
                scrollTop: $(".alert").offset().top},'fast');
        }
    }
    return $.extend(App, {});
}($));

$(document).ready(function () {
    $('body').on('click', '.smooth-scroll', function (e) {
        e.preventDefault();
        e.stopPropagation();
        App.slideTo($(this));
    })
    
    if($('.alert').length > 0) {
        App.slideToAlert()
    }
})

$(document).on('submit', 'form', function(e) {
    App.showLoader($('body'));
    
})