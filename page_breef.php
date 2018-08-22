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
        <h4 class="header header_h4 header_white header_bold ">Тип проекта</h4>
        <div class="container__item-content container_block project_type">
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
        <div class="container__item-content container_block project_time">
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
            <input type="text" id="comment" class="inpt" placeholder="Опишите задачу"/>
        </div>
        <div class="container__item container container__elem container_row">
             <div class="btn btn_default" id="fileBtn">
                <label>
                    <input id="breefFile" type="file" name="file" style="display: none">
                    <span>Прикрепить файл</span>
                </label>
             </div>

             <span class="header header_s header_white" id="fileText" hidden></span>
             <span class="close_btn" hidden></span>
        </div>
    </div>
    <div class="container__item container__items_downed container">
        <h4 class="header header_h4 header_white header_bold">Контактная информация</h4>
        <div class="container__item-content-half container__elem_s_100 container container_row mbl_not_padded container_mbl_col container__items_semi-downed">
            <input type="text" id="contactFace" class="inpt container__elem_50 container__elem_s_100 inpt_mbl" placeholder="Контактное лицо"/>
            <input type="text" id="organisation" class="inpt container__elem_50 container__elem_s_100 inpt_mbl" placeholder="Организация"/>
        </div>
        <div class="container__item-content-half container__elem_s_100 container container_row container_mbl_col container_clear container__items_semi-downed">
            <input type="text" id="email" class="inpt container__elem_50 container__elem_s_100 inpt_mbl" placeholder="Электронная почта"/>
            <input type="text" id="phone" class="inpt container__elem_50 container__elem_s_100 inpt_mbl" placeholder="Телефон"/>
        </div>
    </div>
    <div class="container__item container container_row container_mbl_col-rev">
        <span id="sendBtn" class="btn btn_red">Отправить заявку</span>
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

<script>
    $(document).ready( function() {
        $('.close_btn').on('click', function() {
                $("#fileText").text('');
                $("#fileText").hide();
                $(".btn_default input[type=file]").val('');
                $(this).hide();
        });

        $('.btn_grey').on('click', function(event){
                event.preventDefault();
                $(event.target).toggleClass('btn_active');
            });
        $(".btn_default input[type=file]").change(function(){
            var filename = $(this).val().replace(/.*\\/, "");
            $("#fileText").text(filename);
            $("#fileText").show();
            $(".close_btn").show();

            var file_data = $("#breefFile").prop("files")[0];
            var form_data = new FormData();
            form_data.append("file", file_data);
            $.ajax({
                url: "<?= bloginfo('template_directory'); ?>/upload.php",
                dataType: 'script',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                complete: function(response) {
                    if(response.status === 200) {
                        $('#fileBtn').attr('data-file', response.responseText);
                    }
                }
            });
        });


        $('#sendBtn').on('click', function(event){
            event.preventDefault();
            event.stopImmediatePropagation();

            var project_type = getLabels('project_type');
            var project_time = getLabels('project_time');
            var comment = $('#comment').val();
            var contactFace = $('#contactFace').val();
            var organisation = $('#organisation').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var filename = $('#fileBtn').data('file');

            if(comment && contactFace && email && phone ) {
                send({
                        name: contactFace,
                        filename: filename,
                        number: phone,
                        organisation: organisation,
                        comment: comment,
                        project_type: project_type,
                        project_time: project_time,
                        email: email
                    },
                    function (response) {
                        $.message(response, 'success');

                    },
                    function (response) {
                        $.message(response, 'error');
                    }
                );
            } else {
                $.message('Заполните все обязательные поля: Контактное лицо, Опишите задачу, Почта, Телефон', 'error');
            }

        });

        function getLabels(name) {
            var arr = [];
            var $elems = $('.' + name + ' .btn_active');

            Array.prototype.forEach.call($elems, function(item){
                arr.push($(item).text());
            });

            return arr.join(',');
        }

        function send(obj, callback, error) {
            $.ajax({
                url: "<?= bloginfo('template_directory'); ?>/send.php",
                method: 'POST',
                data: obj,
                success:callback,
                error: error
            });
        }
    });
</script>


<?php get_footer(); ?>