<?php get_header(); ?>
<div class="content">
    <div class="swiper-container">
      <div class="swiper-wrapper">
        <div class="swiper-slide slide-page" id="mainpage" data-hash="main">
          <div class="slide-page__grid-layer"></div>
          <div class="slide-page__content">
            <div class="slide-page__content__header header header_bold header_h1" data-i18new="[html]slides.mainpage.header">
                Придумываем и воплощаем идеи в видео
            </div>
            <div class="btn btn_default btn_small video_btn" data-video="https://player.vimeo.com/video/177988917"  data-i18n="play-video" video-id="0">
              Посмотреть шоурил
            </div>
          </div>
        </div>

        <div class="swiper-slide slide-page" data-hash="thrones">
          <div class="slide-page__bg" style="background-image: url('<?= bloginfo("template_directory"); ?>/assets/images/portfolio/Thrones.png');"></div>
          <div class="slide-page__grid-layer"></div>
          <div class="slide-page__content">
            <div class="slide-page__content__type"  data-i18n="slides.thrones.type">
              3D видео графика
            </div>
            <div class="slide-page__content__header header header_bold header_h1" data-i18n="[html]slides.thrones.header">
              Казань в стиле сериала “Игра престолов”
            </div>
            <div class="btn btn_default btn_small video_href" data-video="" data-i18n="open-video" video-id="0">
              Подробнее
            </div>
          </div>
        </div>

        <div class="swiper-slide slide-page" data-hash="sarmanovo">
          <div class="slide-page__bg" style="background-image: url('<?= bloginfo("template_directory"); ?>/assets/images/portfolio/sarman.png');"></div>
          <div class="slide-page__grid-layer"></div>
          <div class="slide-page__content">
            <div class="slide-page__content__type"  data-i18n="slides.sarmanovo.type">
              Имиджевый
            </div>
            <div class="slide-page__content__header header header_bold header_h1" data-i18n="[html]slides.sarmanovo.header">
              Сармановский район
            </div>
            <div  class="btn btn_default btn_small video_href" data-video="openwork.html"  data-i18n="open-video" video-id="0">
              Подробнее
            </div>
          </div>
        </div>


        <div class="swiper-slide slide-page slide-page--contacts" data-hash="contacts" id="contacts">
          <div class="container">
            <div class="container__item container__items_downed container">
              <h3 class="header header_h3 header_white header_bold">Свяжитесь с нами</h3>
            </div>
            <div class="container__item container container_row container_mbl_col container_clear">
              <div class="container container__item-content container__elem_25 container__elem_s_50 container__elem_s_100">
                <span class="header header_s header_red-3">Телефон</span>
                <a href="tel:+7(843)226-55-57" class="header header_h4 header_white header_bold container__item-content">+7 (843) 226-55-57</a>
              </div>
              <div class="container container__item-content container__elem_25 container__elem_s_50 container__elem_s_100">
                <span class="header header_s header_red-3">Дополнительно</span>
                <a href="" class="link_heiged link_iconed header header_bold header_h4 container__item-content">Скачать презентацию</a>
              </div>
            </div>
            <div class="container__item container container_row container_mbl_col container_clear">
              <div class="container container__item-content container__elem_25 container__elem_s_50 container__elem_s_100">
                <span class="header header_s header_red-3">Почта</span>
                <a href="mailto:arttasms@gmail.com" class="header header_h4 header_white header_bold container__item-content">arttasms@gmail.com</a>
              </div>
              <div class="container container__item-content container__elem_25 container__elem_s_50">
                <span class="header header_s header_red-3">Социальные сети</span>
                <div class="container container__item-content container_row container__elem_50 container__sb container__elem_s_100">
                  <a href="" class="social__link"><span class="icons instagram"></span></a>
                  <a href="" class="social__link"><span class="icons vk"></span></a>
                  <a href="" class="social__link"><span class="icons vimeo"></span></a>
                  <a href="" class="social__link"><span class="icons facebook"></span></a>
                </div>
              </div>
            </div>
            <div class="container__item container container_row container_clear">
              <a class="btn btn_red btn__breef animated">Заполнить бриф</a>
            </div>
          </div>
        </div>

      </div>

      <div class="swiper-button-next">
        <img src="<?= bloginfo('template_directory'); ?>/assets/images/arrow-right.png" />
      </div>
      <div class="swiper-button-prev">
        <img src="<?= bloginfo('template_directory'); ?>/assets/images/arrow-right.png"  style="float: right; transform: rotateY(180deg);"/>
      </div>
    </div>
  </div>

<div class="preloader">
  <div class="loader">
    <svg class="circular" viewBox="25 25 50 50">
      <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
    </svg>
  </div>
</div>

<!-- Swiper JS -->
<script src="<?= bloginfo('template_directory'); ?>/assets/js/swiper.min.js"></script>

<script src="<?= bloginfo('template_directory'); ?>/assets/js/jquery.min.js"></script>
<script src="<?= bloginfo('template_directory'); ?>/assets/js/jquery.vide.js"></script>
<script src="<?= bloginfo('template_directory'); ?>/assets/js/jquery.cookie.js"></script>

<!-- Initialize Swiper -->
<script>
  $(function () {

    $('.video_href').on('click', function(event){
        event.stopImmediatePropagation();
        var video = $(event.target).data('video');
        if(video){
            window.location.href = video;
        }
    });

    $('#mainpage').vide('<?= bloginfo("template_directory"); ?>/assets/video/tasma',{
      posterType: 'jpg',
      autoplay: true
    });

      $(window).bind( 'hashchange', function(e) {
        if(window.location.hash === '#main') {
            swiper.slideTo(0, 100);
        }

        if(window.location.hash === '#contacts'){
            $('.swiper-button-prev').removeClass('swiper-button_visible');
            $('.swiper-button-next').removeClass('swiper-button_visible');
        }


        if($('.sidemenu--opened').length > 0) {
            $('.sidemenu-switcher').trigger('click');
        }

    });

    $('.btn__breef').on('click', function(event){
        event.stopImmediatePropagation();

        window.location.href = 'breef.html';
    });



    $('.swiper-wrapper').on('mousemove', function(event) {
        var width = document.documentElement.clientWidth;
        var clientX = event.clientX;

        if(window.location.hash !== '#contacts') {
            if (clientX < (width*0.2)) {
                $('.swiper-button-next').removeClass('swiper-button_visible');
                $('.swiper-button-prev').addClass('swiper-button_visible');
            } else if(clientX > (width*0.8)) {
                $('.swiper-button-prev').removeClass('swiper-button_visible');
                $('.swiper-button-next').addClass('swiper-button_visible');
            } else {
                $('.swiper-button-prev').removeClass('swiper-button_visible');
                $('.swiper-button-next').removeClass('swiper-button_visible');
            }
        }

    });


      $('.swiper-wrapper').on('click', function(event) {
          var width = document.documentElement.clientWidth/2;
          var clientX = event.clientX;
          if (clientX < width) {
              swiper.slidePrev(100);
          } else {
              swiper.slideNext(100);
          }
      });

    var swiper = new Swiper('.swiper-container', {
      nextButton: '.swiper-button-next',
      prevButton: '.swiper-button-prev',
      spaceBetween: 30,
      hashnav: true,
      keyboardControl: true,
      onSlideChangeEnd: function () {

      }
    });


    $('#goto-contacts').on('click touchstart', function () {
      swiper.slideTo(13, 100);
      $('.sidemenu-switcher').trigger('click');
    });

    $('#goto-main').on('click touchstart', function () {
      swiper.slideTo(0, 100);
      $('.sidemenu-switcher').trigger('click');
    });

    window.nextSlide = function () {
      swiper.slideTo(1,100);
    };


  });

</script>
<?php get_footer(); ?>