<?php
/*
    Template Name: Страница Проекта
*/
?>

<?php get_header(); ?>
<?php  get_post(); ?>
<div class="content">
<div class="container container__openwork">
    <div class="container__item container__items_downed container">
        <h3 class="header header_h3 header_white header_bold" data-i18new="<?php the_field('header_eng'); ?>"><?php the_field('header'); ?></h3>
        <div class="container__item-content-half container__elem_s_100">
            <p class="header header_h4 header_white-t" data-i18new="<?php the_field('category_eng'); ?>"><?php the_field('category'); ?></p>
        </div>
    </div>

    <?php if(get_field('video_link')) { ?>
    <div class="container__item container ">
        <div class="container__item-content container_block video_block" data-url="<?php the_field('video_link'); ?>">

        </div>
        <div class="container__item container__items_downed container container_row container_mbl_col">
            <span class="container__elem_50 container__elem_s_100 header header_h3 header_white container__item_align-top" data-i18new="<?php the_field('video_header_eng') ?>">
                <?php the_field('video_header') ?>
            </span>
            <div class="container__elem_50 container__elem_s_100 container container__item-content container_not-margin">
                <span class="header header_p header_white mbl_marged" data-i18new="<?php the_field('video_description_eng'); ?>">
                    <?php the_field('video_description_1'); ?>
                </span>
                <span class="header header_p header_white mbl_marged" data-i18new="<?php the_field('video_description_eng_2'); ?>">
                    <?php the_field('video_description_eng_2'); ?>
                </span>

            </div>
        </div>
    </div>
    <?php } ?>
<?php if(get_field('galery_descr')) { ?>
    <div class="container__item container" >
        <div id="carousel" class="openwork__content_carousel outer">
            <div class="openwork__content_slider">
                <div id="slider_main" class="slider_main">
                   <?php
                        $images = get_field('gallery');
                        foreach($images as $img){
                   ?>
                        <div  class="openwork__content_slider_item" style="background-image: url('<?=$img['image'] ?>')"></div>
                     <?php } ?>
                </div>
            </div>
            <div class="openwork__content_carousel_area container__elem_100 inner">
                <div class="swipe-left">
                </div>
                <div class="swipe-right">
                </div>
            </div>
        </div>
        <div id="progress-bar" class="progress-bar container_block "></div>
        <div id="progress-bar-add" class="progress-bar-add"></div>
    </div>
    <div class="container__item-content container ">
        <span id="imgNum" class="header header_p header_white-t">
            1/4
        </span>
    </div>
    <div class="container__item container__items_downed container container_row container_mbl_col">
        <span class="container__elem_50 container__elem_s_100 header header_h3 header_white container__item_align-top" data-i18new="<?php the_field('video_description_eng_2'); ?>">
            <?php the_field('gallery_header'); ?>
        </span>
        <div class="container__elem_50 container__elem_s_100 container container__item-content container_not-margin">
                <span class="header header_p header_white mbl_marged" data-i18new="<?php the_field('descr_gallery_eng'); ?>">
                    <?php the_field('galery_descr'); ?>
                </span>
        </div>
    </div>
    <?php } ?>
</div>

<?php
$next_post = get_next_post();
if( ! empty($next_post) ){
	?>
	<div class="container">
        <div class="container_bordered-top"></div>
        <div class="container__item-content container">
            <a href="<?php echo get_permalink( $next_post ); ?>" class="header header_h4 header_red-1-t" style="color:#f43d48 !important; opacity:0.5;">Следующий проект</a>
        </div>
        <div class="container__item container__items_downed container">
            <h3 class="header header_h3 header_white header_bold"><?php echo esc_html($next_post->post_title); ?></h3>
        </div>
    </div>
	<?php
}
?>


<div class="openwork__content__swipe">
    <a
        <?php
        $prev_post = get_previous_post();
        if( ! empty($prev_post) ){
        	?>
        	 href="<?php echo get_permalink( $prev_post ); ?>"

        	<?php
        }
        ?>
        class="openwork__content__swipe_arrow-left header_white">
        <img class="nav_arrow" src="<?= bloginfo('template_directory'); ?>/assets/images/arrow-right.png"/>
                </a>
    <div class="openwork__content__swipe_text header_white header_h4"> <?php the_field('header'); ?></div>
    <a
    <?php
    $next_post = get_next_post();
    if( ! empty($next_post) ){
    	?>
    	 href="<?php echo get_permalink( $next_post ); ?>"

    	<?php
    }
    ?>
    class="openwork__content__swipe_arrow-right header_white">
    <img class="nav_arrow" src="<?= bloginfo('template_directory'); ?>/assets/images/arrow-right.png"/>
            </a>
</div>
</div>
<!-- Swiper JS -->

<script src="<?= bloginfo('template_directory'); ?>/assets/js/jquery.min.js"></script>
<script src="<?= bloginfo('template_directory'); ?>/assets/js/jquery.vide.js"></script>
<script src="<?= bloginfo('template_directory'); ?>/assets/js/jquery.cookie.js"></script>

<!-- Initialize Swiper -->
<script>
    $(function () {
        var url = $('.video_block').data('url');

        if(url) {
            $('<iframe/>').attr({
                src: url,
                width: '100%',
                height: '100%',
                frameborder: '0',
                webkitallowfullscreen: '',
                mozallowfullscreen: '',
                allowfullscreen: ''
            }).appendTo('.video_block');
        }

        // carousel


        /* конфигурация  карусели  */
        var width = $('.openwork__content_slider').width(); // ширина изображения
        var carouselList = $('.openwork__content_slider_item');
        var stepWidth = 100/carouselList.length;
        var step = 1;
        var progress = document.getElementById('progress-bar-add');
        var imgNum  = $('#imgNum');

        imgNum.text(1 + '/' + carouselList.length);


        progress.style.width = (step * stepWidth) +'%';

        Array.prototype.forEach.call(carouselList, function(item, i){
            $(item).width(width);
            $(item).attr('data-num', i + 1);
        });
        var count = 1; // количество изображений
        var count_all = 4;  // общее кол-во изображений  (задать вручную + смотри в css ) // хардкод


        var carousel = document.getElementById('carousel');
        var list = document.getElementById('slider_main');

        list.style.width = (width*carouselList.length) + 'px';

        var position = 0; // текущий сдвиг влево


        var basic_width = window.innerWidth;

        $('.swipe-left').on('click', function() {
            if (step === 1) return;
            step--;

            imgNum.text(step + '/' + carouselList.length);
            // сдвиг влево
            position = Math.min(position + width * count, 0);
            list.style.marginLeft = position + 'px';

            // заполнение полоски
            progress.style.width = (step * stepWidth) +'%';

        });

        $('.swipe-right').on('click',function() {
            if (step === carouselList.length) return;
            step++;
            imgNum.text(step + '/' + carouselList.length);
            // сдвиг вправо
            position = Math.max(position - width * count, -width * (carouselList.length - count));
            list.style.marginLeft = position + 'px';

            progress.style.width = (step * stepWidth) +'%';
        });
    });
</script>


<?php get_footer(); ?>