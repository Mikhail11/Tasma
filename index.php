<?php get_header(); ?>
<div class="content">
    <div class="swiper-container">
      <div class="swiper-wrapper">

<?php query_posts('post_type=page&pagename=main');  while ( have_posts() ) : the_post(); ?>

        <div class="swiper-slide slide-page" id="mainpage" data-hash="main">
          <div class="slide-page__grid-layer"></div>
          <div class="slide-page__content">
            <div class="slide-page__content__header header header_bold header_h1" data-i18new="<?php the_field('main_header_eng'); ?>">
                <?php the_field('main_header'); ?>
            </div>
            <div class="btn btn_default btn_small video_btn" data-video="<?php the_field('main_link'); ?>"  data-i18n="play-video" video-id="0">
              Посмотреть шоурил
            </div>
          </div>
        </div>
        <?php
            $slides = get_field('main_sliders');
            foreach($slides as $value) {
        ?>
        <div class="swiper-slide slide-page">
          <div class="slide-page__bg" style="background-image: url('<?= $value['project_slider']['url'] ?>')"></div>
          <div class="slide-page__grid-layer"></div>
          <div class="slide-page__content">
            <div class="slide-page__content__type"  data-i18new="<?= $value['project_category_eng'] ?>">
              <?= $value['project_category'] ?>
            </div>
            <div class="slide-page__content__header header header_bold header_h1" data-i18new="<?= $value['project_header_eng'] ?>">
              <?= $value['project_header'] ?>
            </div>
            <div class="btn btn_default btn_small video_href" data-video="<?= $value['project_link'] ?>" data-i18n="open-video" video-id="0">
              Подробнее
            </div>
          </div>
        </div>
        <?php } ?>
<?php endwhile; ?>



        <div class="swiper-slide slide-page slide-page--contacts" data-hash="contacts" id="contacts">
        <?php query_posts('post_type=page&pagename=contactspage');  while ( have_posts() ) : the_post(); ?>

          <div class="container">
            <div class="container__item container__items_downed container">
              <h3 class="header header_h3 header_white header_bold">Свяжитесь с нами</h3>
            </div>
            <div class="container__item container container_row container_mbl_col container_clear">
              <div class="container container__item-content container__elem_25 container__elem_s_50 container__elem_s_100">
                <span class="header header_s header_red-3">Телефон</span>
                <a href="tel:<?php the_field('phone'); ?>" class="header header_h4 header_white header_bold container__item-content"><?php the_field('phone'); ?></a>
              </div>
              <div class="container container__item-content container__elem_25 container__elem_s_50 container__elem_s_100">
                <span class="header header_s header_red-3">Дополнительно</span>
                <a href="<?php the_field('presentation'); ?>" class="link_heiged link_iconed header header_bold header_h4 container__item-content">Скачать презентацию</a>
              </div>
            </div>
            <div class="container__item container container_row container_mbl_col container_clear">
              <div class="container container__item-content container__elem_25 container__elem_s_50 container__elem_s_100">
                <span class="header header_s header_red-3">Почта</span>
                <a href="mailto:<?php the_field('email'); ?>" class="header header_h4 header_white header_bold container__item-content"><?php the_field('email'); ?></a>
              </div>
              <div class="container container__item-content container__elem_25 container__elem_s_50">
                <span class="header header_s header_red-3">Социальные сети</span>
                <div class="container container__item-content container_row container__elem_50 container__sb container__elem_s_100">
                  <a href="<?php the_field('insta_link'); ?>" class="social__link"><span class="icons instagram"></span></a>
                  <a href="<?php the_field('vk_link'); ?>" class="social__link"><span class="icons vk"></span></a>
                  <a href="<?php the_field('vimeo_link'); ?>" class="social__link"><span class="icons vimeo"></span></a>
                  <a href="<?php the_field('fb_link'); ?>" class="social__link"><span class="icons facebook"></span></a>
                </div>
              </div>
            </div>
            <div class="container__item container container_row container_clear">
              <a class="btn btn_red btn__breef animated">Заполнить бриф</a>
            </div>
          </div>
        <?php endwhile; ?>
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



<script src="<?= bloginfo('template_directory'); ?>/assets/js/jquery.min.js"></script>
<script src="<?= bloginfo('template_directory'); ?>/assets/js/jquery.vide.js"></script>
<script src="<?= bloginfo('template_directory'); ?>/assets/js/jquery.cookie.js"></script>

<!-- Swiper JS -->
<script src="<?= bloginfo('template_directory'); ?>/assets/js/swiper.min.js"></script>


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

        window.location.href = 'http://tasma.pro/breef/';
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

    $('.social__link').on('click', function(event){
        event.stopImmediatePropagation();

        window.location.href = event.target.href;
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