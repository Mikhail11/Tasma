<?php
/*
    Template Name: Страница Портфолио
*/
?>

<?php get_header(); ?>

<div class="content">
  <div class="portfolio-header container">
      <div class=" portfolio-header__content container__item-content container_block">
        <span class="link portfolio-header__items">Все</span>
        <?php $categories = get_categories();
           if($categories) {
           foreach($categories as $cat){
                ?>
         <span class="link portfolio-header__items"><?=$cat->name?></span>
         <?php  }

           }
         ?>
        <a href="https://vimeo.com/tasmapro" target="_blank" class="link portfolio-header__items link_iconed">Больше работ на Vimeo</a>
      </div>
  </div>
  <div class="portfolio">

  <?php query_posts('post_type=post');  while ( have_posts() ) : the_post();
        $post_info = get_post();
        $image = get_field('preview_image');
  ?>
    <div class="portfolio__item">
      <div class="portfolio__item__bg"  style="background-image: url('<?= $image['url'] ?>');">
      </div>
      <div class="portfolio__item__menu-wrapper">
        <div class="portfolio__item__menu">
        <?php $category = get_the_category();
              $category_name = $category[0]->cat_name;
              ?>
          <div class="portfolio__item__menu__type" data-category="<?=$category_name ?>">
            <?=$category_name ?>
          </div>
          <div class="portfolio__item__menu__header header header_h2" data-i18new="<?php the_field('preview_header_eng'); ?>">
            <?php the_field('preview_header'); ?>
          </div>
        </div>
        <a href="<?php the_field('preview_link'); ?>" class="button-show-video" data-i18n="open-video">
          Подробнее
        </a>
      </div>
    </div>
  <?php endwhile; ?>



<?php query_posts('post_type=page&pagename=contactspage');  while ( have_posts() ) : the_post(); ?>
  <div class="portfolio-footer">
    <div class="portfolio-footer__call container">
      <span class="portfolio-footer__text header header_h3 header_white">Оставьте заявку</span>
      <a href="http://tasma.pro/breef/" class="portfolio-footer__breef-btn btn btn_red animated">Заполните бриф</a>
    </div>
    <div class="portfolio-footer__contacts container__item container container_row container_mbl_col">
      <div class="container container__item-content container__elem_25 container__elem_s_50 container__elem_s_100">
        <span class="header header_s header_red-3">Телефон</span>
        <a href="tel:<?php the_field('phone'); ?>" class="header header_h4 header_white header_bold container__item-content"><?php the_field('phone'); ?></a>
      </div>
      <div class="container container__item-content container__elem_25 container__elem_s_50 container__elem_s_100">
        <span class="header header_s header_red-3">Почта</span>
        <a href="mailto:<?php the_field('email'); ?>" class="header header_h4 header_white header_bold container__item-content"><?php the_field('email'); ?></a>
      </div>
      <div class="container container__item-content container__elem_25 container__elem_s_50 container__elem_s_100">
        <span class="header header_s header_red-3">Дополнительно</span>
        <a href="<?php the_field('presentation'); ?>" class="link_heiged link_iconed header header_bold container__item-content">Скачать презентацию</a>
      </div>
    </div>
    <div class="portfolio-footer__background">
      <span class="portfolio-footer__label   header header_h4 header_white-t">
        © Медиа Студия «Тасма»
      </span>
      <div class="container container__item-content container_row container__elem_10 container__sb container__elem_s_100">
        <a href="<?php the_field('insta_link'); ?>" class="social__link"><span class="icons instagram"></span></a>
        <a href="<?php the_field('vk_link'); ?>" class="social__link"><span class="icons vk"></span></a>
        <a href="<?php the_field('vimeo_link'); ?>" class="social__link"><span class="icons vimeo"></span></a>
        <a href="<?php the_field('fb_link'); ?>" class="social__link"><span class="icons facebook"></span></a>
      </div>
    </div>
  </div>
<?php endwhile; ?>


  <div class="preloader">
    <div class="loader">
      <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
      </svg>
    </div>
  </div>
</div>


  <script src="<?= bloginfo('template_directory'); ?>/assets/js/jquery.min.js"></script>

  <script src="<?= bloginfo('template_directory'); ?>/assets/js/jquery.cookie.js"></script>
  <script>
    $(function(){

      $('span.portfolio-header__items').on('click', function(event){
            event.stopImmediatePropagation();
            var text = $(event.target).text().trim();
            if(text === 'Все') {
                Array.prototype.forEach.call($('.portfolio__item'), function(item){
                    $(item).show();
                });
            } else {
              Array.prototype.forEach.call($('.portfolio__item__menu__type'), function(item){
                    var block = $(item).closest('.portfolio__item');
                    var itemText = $(item).text().trim();

                      if(itemText === text){
                        $(block).show();
                      } else {
                        $(block).hide();
                      }
              });
            }
      });

      $('.portfolio__item').each(function (idx) {
        var mod = idx < 3 ? 1 : 2;
        $(this).delay(mod*500).animate({opacity: '1'}, 1200);
      });

      var toMain = function () {
        location.href = "index.html#main";
      };

      $('.sidemenu__header').each(function () {
        this.onclick = toMain;
      });

      $('.sidemenu__vertical-logo').each(function () {
        this.onclick = toMain;
      });

      $('.content').on('scroll', function(event) {
          var scrollTop = $('.content').scrollTop();
          var portfolio = $('.portfolio').height()*0.5;
          if  (scrollTop > portfolio)
          {
              $('.animated').addClass('animated_active');
          }
      });

    });
  </script>

<?php get_footer(); ?>