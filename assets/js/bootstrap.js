$(function () {
  $('.preloader').remove();

  window.resize_footer = function(){
    var content_width = $('.content').outerWidth();
    $('.footer').css('width', content_width + 'px');
  }

  resize_footer();


  $(window).resize(function(){
    resize_footer();
  });

  // switch lang  -
  var lng = $.cookie('lang');
  if(lng === null)
    lng = 'ru';
  var i18nOptions = {
    fallbackLng: false,
    useCookie: true,
    lng: lng,
    preload: ['ru', 'en']
  };


  function localizeTItle(lng) {
    var title = (lng == 'ru') ? "Медиа студия \"Тасма\"" : "Media studio \"Tasma\"";
    document.title = title;
  }


  var changePresentationFileUrl = function(lng) {
    var fileUrl = 'presentation' + (lng == 'en' ? '_eng' : '') + '.pdf';
    $('.presentation a').attr('href', fileUrl);
  };

  $.i18n.init(i18nOptions, function() {
    var lang = $.cookie('lang') || 'ru';
    if(lang === null) {
      $.cookie('lang', 'ru');
    }
    $.i18n.setLng(lang);
    localizeTItle(lang);
    changePresentationFileUrl(lang);
    $('body').i18n();
    $('.lng-switch__current').addClass('lng-switch__current--' + $.i18n.lng());
  });


  var switchLang = function (lang) {
    $.i18n.setLng(lang);
    $('body').i18n();
    $.cookie('lang', lang);
    localizeTItle(lang);
    changePresentationFileUrl(lang);
  }

  var switchLangAnimation = function (lang) {
    var lastLang = (lang == 'ru' ? 'en' : 'ru');

    if(lang == 'en') {
      $('.lng-switch__bound').addClass('lng-switch__bound--2state');
    }else{
      $('.lng-switch__bound').removeClass('lng-switch__bound--2state');
    }

    $('.lng-switch__item').each(function () {
      if($(this).text() == lastLang){
        $(this).removeClass('lng-switch__item--active');
      }else{
        $(this).addClass('lng-switch__item--active');
      }
    });

    $('')
  };

  var lang = ( $.i18n.lng() == 'ru' || $.i18n.lng() == 'ru-RU' ) ? 'ru' : 'en';
  switchLangAnimation(lang);

  $('.lng-switch__item').on('click touchstart', function () {
    var loadLang = $(this).text();
    switchLang(loadLang);
    switchLangAnimation(loadLang);
  });

  // $('.lng-switch__item').each(function () {
  //   this.onclick = function () {
  //     var loadLang = $(this).attr('switchLang');
  //     switchLang(loadLang);
  //     switchLangAnimation(loadLang);
  //   };
  // });

  $('.menu-overlay').each(function () {
    this.onclick = function () {
      $(this).removeClass('.menu-overlay--show');
      $('.sidemenu-switcher').trigger('click');
    };
  });
  
  $('.sidemenu-switcher').each(function () {
    this.onclick = function () {
      $('.con').toggleClass('active');

      var menu_speed;
      $(this).toggleClass('sidemenu-switcher--opened');
      if ($(this).attr('sm-state') == '1') {
        $(this).attr('sm-state', '2');
        menu_speed = 1000;
      } else {
        $(this).attr('sm-state', '1');
        menu_speed = 0;
      }

      $('.sidemenu').toggleClass('sidemenu--opened');
      $('.swiper-button-next').toggleClass('swiper-button-next--mobile');

      $('.sidemenu__header').fadeToggle(menu_speed);
      $('.sidemenu__footer').fadeToggle(menu_speed);

      $('.menu-overlay').toggleClass('menu-overlay--show');
    }
  });

  function makeModal(res) {
    var url = '';
    if(res.type == 'youtube') {
      url = 'https://www.youtube.com/embed/' + res.url;
    }else if(res.type == 'vimeo') {
      url = 'https://player.vimeo.com/video/' + res.url;
    } else if( res.type === 'free') {
      url = res.url;
    }

    $('<div/>').addClass('overlay')
      .appendTo('body');
    var videoContainer = $('<div/>').addClass('video-container')
      .appendTo('.overlay');
    $('<div/>').addClass('overlay__close')
      .click(function () {
        $('.overlay').remove();
      })
      .appendTo(videoContainer);

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

  $('.button-show-video').each(function () {
    var video_id = $(this).attr('video-id'),
      resource = videos[video_id];
    this.onclick = function () {
      makeModal(resource);
    };
  });

  $('.video_btn').on('click', function(event){
    event.stopImmediatePropagation();
    var url = $(event.target).data('video');
    if(url){
        makeModal({
            url: url,
            type:'free'
        });
    }
  });


  $('.presentation a').click(function(){
    location.href = $(this).attr('href');
  });

  $('body').on('scroll', function() {
    var scrolls = $('html').scrollTop() || $('body').scrollTop();
    if (scrolls > 0) {
        $('.header__logo').addClass('header__logo_short');
    } else {
        $('.header__logo').removeClass('header__logo_short');
    }
  });

  $('.content').on('scroll', function() {
      if ($('.content').scrollTop() > 0) {
          $('.header__logo').addClass('header__logo_short');
      } else {
          $('.header__logo').removeClass('header__logo_short');
      }
  });
});