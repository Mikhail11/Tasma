<?php
/*
    Template Name: Страница О нас
*/
?>

<?php get_header(); ?>
<div class="content">
<?php query_posts('post_type=page&pagename=about');  while ( have_posts() ) : the_post(); ?>
<div class="container container_row container_mbl_col">
    <div class="container container__item container__elem_40 container_not-margin container__elem_s_100 clients_content container_clear">
        <div class="container__item-content container container__items-mbl-downed">
            <h4 class="header header_h4 header_white">Мы медиа - студия "Тасма"</h4>
        </div>
        <div class="container__item-content container container__elem_s_100">
            <span class="container__quots container__quots_red">
                Компания, которая выполняет полный объем работ по созданию медиапродукта высого качества
            </span>
        </div>
        <div class="container__item-content container container__elem_s_100 container__elem_s_100">
            <ul class="iconed-list">
            <?php
                        $service = get_field('service');

                        foreach($service as $serv) {
                     ?>
                <li class="iconed-list__item" data-i18new="<?= $serv['service_name_eng']?>"><?= $serv['service_name']  ?></li>
            <?php } ?>
            </ul>
        </div>
        <div class="container__item-content container container__elem_s_100">
            <p class="header header_p header_red-2" data-i18new="<?php the_field('description_eng'); ?>">
                <?php the_field('clients_description'); ?>
            </p>
        </div>
        <div class="container__item-content container container__elem_s_100">
        <span class="container__quots container__quots_white">
            Мы не боимся сложных проектов. <br/>
            Мы с удовольствием за них беремся.
        </span>
    </div>
    </div>
    <div class="container container__item container__elem_80 container_not-margin container__item_align-stretch container_mbl_col container__elem_s_100">
        <div class="container__item-content container container__items-mbl-downed">
            <h4 class="header header_h4 header_white">Наши клиенты</h4>
        </div>
        <div class="container container__item container_not-margin container_row container__wrap container__item_align-top container__elem_s_100">
        <?php
            $images = get_field('partners_image');

            foreach($images as $img) {
         ?>
            <img class="container__image" src="<?=$img['image'] ?>" alt="">
          <?php } ?>
        </div>
    </div>
</div>
<?php endwhile; ?>
</div>
<script src="<?= bloginfo('template_directory'); ?>/assets/js/jquery.min.js"></script>
<script src="<?= bloginfo('template_directory'); ?>/assets/js/jquery.cookie.js"></script>

<?php get_footer(); ?>