const $ = jQuery.noConflict()

const menuBurger = () => {
  $('.burger-menu__button, .header-menu li a').on('click', function () {
    $('body').toggleClass('menu-opened')
  })

  $('.js-contact-open, .modal-close').on('click', function () {
    $('body').toggleClass('modal-open')
  })
}

window.addEventListener('DOMContentLoaded', (event) => {
  menuBurger();
});
