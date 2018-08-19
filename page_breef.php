<?php
/*
    Template Name: Страница Брифа
*/
?>

<?php get_header(); ?>

<div class="content">
<?php query_posts('post_type=page&pagename=breef');  while ( have_posts() ) : the_post(); ?>
<div class="container">
    <div class="container__item container__items_downed container">
        <h3 class="header header_h3 header_white header_bold">Заполните бриф</h3>
        <div class="container__item-content-half container__elem_s_100">
            <p class="header header_p header_white-t" data-i18new="<?php the_field('breef_description_eng'); ?>"><?php the_field('breef_description'); ?>&nbsp<a class="link" href="tel:+7(843)226-55-57">+7(843)226-55-57</a></p>
        </div>
    </div>
    <div class="container__item container">
        <h4 class="header header_h4 header_white header_bold">Тип проекта</h4>
        <div class="container__item-content container_block">
            <span class="btn btn_grey btn_small">Корпаративный фильм</span>
            <span class="btn btn_grey btn_small">Рекламный</span>
            <span class="btn btn_grey btn_small">Анимационный</span>
            <span class="btn btn_grey btn_small">Видеоинсталляция</span>
            <span class="btn btn_grey btn_small">Моушн-дизайн</span>
            <span class="btn btn_grey btn_small">3D видео графика</span>
            <span class="btn btn_grey btn_small">Интерактивный (VR&AR)</span>
            <span class="btn btn_grey btn_small btn_last">Другое</span>
        </div>
    </div>
    <div class="container__item container">
        <h4 class="header header_h4 header_white header_bold">Хронометраж</h4>
        <div class="container__item-content container_block">
            <span class="btn btn_grey btn_small">15 сек</span>
            <span class="btn btn_grey btn_small">30 сек</span>
            <span class="btn btn_grey btn_small">до 1 мин</span>
            <span class="btn btn_grey btn_small">до 3 мин</span>
            <span class="btn btn_grey btn_small">5-10 мин</span>
            <span class="btn btn_grey btn_small">более 10 мин</span>
        </div>
    </div>
    <div class="container__item container__items_downed container">
        <h4 class="header header_h4 header_white header_bold">Подробная информация</h4>
        <div class="container__item-content-half container__elem_s_100">
            <input type="text" class="inpt" placeholder="Опишите задачу"/>
        </div>
        <div class="container__item container container__elem container_row">
            <span class="btn btn_default">Прикрепить файл</span>
        </div>
    </div>
    <div class="container__item container__items_downed container">
        <h4 class="header header_h4 header_white header_bold">Контактная информация</h4>
        <div class="container__item-content-half container__elem_s_100 container container_row mbl_not_padded container_mbl_col container__items_semi-downed">
            <input type="text" class="inpt container__elem_50 container__elem_s_100 inpt_mbl" placeholder="Контактное лицо"/>
            <input type="text" class="inpt container__elem_50 container__elem_s_100 inpt_mbl" placeholder="Организация"/>
        </div>
        <div class="container__item-content-half container__elem_s_100 container container_row container_mbl_col container_clear container__items_semi-downed">
            <input type="text" class="inpt container__elem_50 container__elem_s_100 inpt_mbl" placeholder="Электронная почта"/>
            <input type="text" class="inpt container__elem_50 container__elem_s_100 inpt_mbl" placeholder="Телефон"/>
        </div>
    </div>
    <div class="container__item container container_row container_mbl_col-rev">
        <span class="btn btn_red">Отправить заявку</span>
        <div class="container__elem_50 container__elem_s_100">
            <p class="header header_s header_white-t">Эта страница защищена функцией reCAPTCHA и попадает под <a class="link" href="">Политику конфедициальности</a>
            и <a class="link" href="">Условия использования Google</a>
            </p>
        </div>
    </div>
</div>
<?php endwhile; ?>
</div>

<script src="<?= bloginfo('template_directory'); ?>/assets/js/jquery.min.js"></script>
<script src="<?= bloginfo('template_directory'); ?>/assets/js/jquery.vide.js"></script>
<script src="<?= bloginfo('template_directory'); ?>/assets/js/jquery.cookie.js"></script>


<?php get_footer(); ?>