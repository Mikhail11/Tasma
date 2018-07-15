$(function() {
  $('.preloader').remove();


  window.resize_footer = function(){
    var content_width = $('.content').outerWidth();
    $('.footer').css('width', content_width + 'px');
  }

  resize_footer();

  var switchLang = function(lang) {
    $('[data-localize]').localize('translation', { pathPrefix: 'locales', language: lang, skipLanguage: 'ru-RU' });
  };

  var switchLangAnimation = function (lang) {
    var lastLang = (lang == 'ru' ? 'en' : 'ru');

    if(lang == 'en') {
      $('.lng-switch__bound').addClass('lng-switch__bound--2state');
    }else{
      $('.lng-switch__bound').removeClass('lng-switch__bound--2state');
    }

    $('[switchLang=' + lastLang + ']').removeClass('lng-switch__item--active');
    $('[switchLang=' + lang + ']').addClass('lng-switch__item--active');
  };

  switchLang($.cookie('lang') || 'ru');
  switchLangAnimation($.cookie('lang')  || 'ru');

  function makeModal(res) {
    var url = '';
    if(res.type == 'youtube') {
      url = 'https://www.youtube.com/embed/' + res.url;
    }else if(res.type == 'vimeo') {
      url = 'https://player.vimeo.com/video/' + res.url;
    }

    $('<div/>').addClass('overlay')
      .appendTo('body');
    $('<div/>').addClass('video-container')
      .appendTo('.overlay');
    $('<div/>').addClass('overlay__close')
      .click(function () {
        $('.overlay').remove();
      })
      .appendTo('.overlay');

    $('<iframe/>').attr({
      src: url,
      width: '100%',
      height: '100%',
      frameborder: '0',
      webkitallowfullscreen: '',
      mozallowfullscreen: '',
      allowfullscreen: ''
    }).appendTo('.video-container');
  }


  $('.button-show-video').on('mousedown touchstart', function () {
    var video_id = $(this).attr('video-id'),
      resource = videos[video_id];
    makeModal(resource);
  });

  $('.con').on('click touchstart', function(){
    $(this).toggleClass('active');
  });

  $('[switchLang]').on('click touchstart', function () {
    var loadLang = $(this).attr('switchLang');
    switchLang(loadLang);
    switchLangAnimation(loadLang);

    $.cookie('lang', loadLang, { expires: 7, path: '/' });
  });

  $('.sidemenu-switcher').on('click touchstart', function () {
    var menu_speed;
    $(this).toggleClass('sidemenu-switcher--opened');
    if($(this).attr('sm-state') == '1'){
      $(this).attr('sm-state','2');
      menu_speed = 1000;
    }else{
      $(this).attr('sm-state','1');
      menu_speed = 0;
    }

    $('.sidemenu').toggleClass('sidemenu--opened');
    $('.swiper-button-next').toggleClass('swiper-button-next--mobile');

    $('.sidemenu__header').fadeToggle(menu_speed);
    $('.sidemenu__footer').fadeToggle(menu_speed);
  });

  $('.sidemenu__content__item').on('click touchstart', function () {
    $('.con').toggleClass('active');
    $('.sidemenu-switcher').trigger('click');
  });

  $('.swiper-button-next').queue(function (next) {
    $('.swiper-button-next').delay(1500).addClass('slider-next');
    $(this).dequeue();
    next();
  }).delay(2500).queue(function (next) {
    $('.swiper-button-next').delay(1500).removeClass('slider-next');
    $(this).dequeue();
    next();
  });

  $('.swiper-button-prev').queue(function (next) {
    $('.swiper-button-prev').delay(1500).addClass('slider-prev');
    $(this).dequeue();
    next();
  }).delay(2500).queue(function (next) {
    $('.swiper-button-prev').delay(1500).removeClass('slider-prev');
    $(this).dequeue();
    next();
  });

  $(window).resize(function(){
    resize_footer();
  });

});