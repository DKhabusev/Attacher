if (document.getElementById('mini_popup_basket_add') !== null) {
    $(document).on('click', '#mini_popup_basket_add .popup_wrapper', function () {
        $(this).removeClass('show');
    });
    $(document).on('click', '.add_basket', function () {
        let id = $(this).attr('data-id');
        let $input = $(this).siblings('.good_counter').find('.basket_good_count');
        let good_count = parseInt($input.val());
        let formData = new FormData();
        formData.append('action', 'add');
        formData.append('basket', 'basket');
        formData.append('rec', id);
        formData.append('cnt', good_count);

        axios.post('/basket_info',
            formData,
            {}
        )
            .then(response => {
                $('#basket_info').html(response.data);
                $(this).addClass('disabled').attr('href', '/basket').removeClass('add_basket')
                if (!$(this).attr('data-simple-btn')) {
                    $(this).html('В корзине');
                    $(this).attr('title', 'Перейти в корзину');
                }
                $input.addClass('update_basket_count').attr('data-value', good_count);
                $('#mini_popup_basket_add .popup_wrapper').addClass('show');
                setTimeout(() => {
                    $('#mini_popup_basket_add .popup_wrapper').removeClass('show');
                }, 2000);
            })
            .catch();

        return false;
    });

    $(document).on('click', '.add_old_order_to_basket', function () {
        let id = $(this).attr('data-id');
        let formData = new FormData();
        formData.append('action', 'add_old_order_to_basket');
        formData.append('basket', 'basket');
        formData.append('order_id', $(this).attr('data-order-id'));

        axios.post('/basket_info',
            formData,
            {}
        )
            .then(response => {
                $('#basket_info').html(response.data);
                $(this).addClass('disabled').attr('href', '/basket').removeClass('add_old_order_to_basket')
                if (!$(this).attr('data-simple-btn')) {
                    $(this).html('Добавлено в корзину');
                }
                $('#mini_popup_basket_add .popup_wrapper').addClass('show');
                setTimeout(() => {
                    $('#mini_popup_basket_add .popup_wrapper').removeClass('show');
                }, 2000);
            })
            .catch();

        return false;
    });
}

if (document.getElementsByClassName('basket_good_count') !== null) {

    $(document).on('click', '.minus_good_count', function () {
        let $input = $(this).siblings('.basket_good_count');
        let good_count = parseInt($input.val());
        if (good_count > 1) {
            $input.val(good_count - 1);

            if ($input.hasClass('update_basket_count')) {
                update_basket_count($input,good_count - 1);
            }
        }
    });

    $(document).on('click', '.plus_good_count', function () {
        let $input = $(this).siblings('.basket_good_count');
        let good_count = parseInt($input.val());
        if (good_count >= 1) {
            $input.val(good_count + 1);

            if ($input.hasClass('update_basket_count')) {
                update_basket_count($input, good_count + 1);
            }
        }
    });

    $(document).on('input keypress paste change', '.basket_good_count', function () {
        let good_count = parseInt($(this).val());
        if (good_count >= 1) {
            if ($(this).hasClass('update_basket_count')) {
                update_basket_count($(this), good_count);
            }
        } else {
            good_count = $(this).attr('data-value');
        }
        $(this).val(good_count);
    });

    function update_basket_count($count_element, cnt) {
        let id = $count_element.attr('data-id');
        let formData = new FormData();
        formData.append('action', 'basket_update');
        formData.append('basket', 'basket');
        formData.append('rec', id);
        formData.append('cnt', cnt);

        axios.post('/basket_info',
            formData,
            {}
        )
            .then(response => {
                $('#basket_info').html(response.data);
                console.log($count_element);
                $count_element.addClass('update_basket_count').attr('data-value', cnt);
            })
            .catch();
    }
}
