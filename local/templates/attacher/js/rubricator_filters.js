$((function () {
    function price_range() {
        let html5Slider = document.getElementById('slider-fit');
        //check avalability UIslider
        if (html5Slider != null) {
            let range_min_value = $('#slider-fit').data('min-value');
            let range_max_value = $('#slider-fit').data('max-value');
            let range_cur_min_value = $('#slider-fit').data('cur-min');
            let range_cur_max_value = $('#slider-fit').data('cur-max');

            noUiSlider.create(html5Slider, {
                start: [range_cur_min_value, range_cur_max_value],
                connect: true,
                behaviour: 'none',
                //step: 2,
                range: {
                    'min': [range_min_value],
                    'max': [range_max_value]
                }
            });
            html5Slider.noUiSlider.on('update', function (values, handle) {
                let value = values[handle];

                if (handle) {
                    document.getElementById('max_price_range').value = Math.round(value);
                } else {
                    document.getElementById('min_price_range').value = Math.round(value);
                }
            });

            document.getElementById('max_price_range').addEventListener('change', function () {
                html5Slider.noUiSlider.set([null, this.value]);
            });
            document.getElementById('min_price_range').addEventListener('change', function () {
                html5Slider.noUiSlider.set([this.value, null]);
            });
            // Изменен слайдер, делаем сабмит формы
            html5Slider.noUiSlider.on('set', function (values, handle) {
                submit();
                $('body').removeClass('popup_shown');
            });
        }
    }

    $(document).on('keyup','#general_search', function(e){
        let code = e.key;
        if(code==="Enter") {
            $('.loading_page').removeClass('hidden');
        } else {
            if ($('#general_search').val()) {
                $('.search_area .delete').removeClass('hidden');
            } else {
                $('.search_area .delete').addClass('hidden');
            }
        }
    });

    function submit() {
        $('.loading_page').removeClass('hidden');
        let formData = new FormData();
        let search = $('#general_search').val();
        let rubId = $('#form_rubricator_filters').data('rubricator-id');
        let canonical_url = $('#form_rubricator_filters').data('canonical-url');
        let postUrl = '/ajax/rubricator' + (rubId ? '/' + rubId : '');

        $('.checkbox_js:checked').each(function(index, elem) {
            formData.append(elem.name, $(elem).val());
        });

        formData.append('min_price', $('#min_price_range').val());
        formData.append('max_price', $('#max_price_range').val());

        if(sort = $('#sort_by').data('value')) {
            formData.append('sort', sort);
        }

        formData.append('canonical_url', canonical_url);
        formData.append('set_ajax_filter', 'Y');


        if (search) {
            formData.append('poisk', search);
        }

        $.ajax({
            url: postUrl,
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(data) {
                $("#filters").html(data['filters'])
                $("#goods").html(data['products'])
                price_range();
                history.pushState(null, null, data['settings']['url'])
                if(!$('.sidebar').hasClass('hidden')) {
                    $('.sidebar').addClass('hidden')
                }
                $('.ui-autocomplete').hide()
                $('.loading_page').addClass('hidden')
            }
        });
        return false;
    }

    // Подключаем слайдер цен
    price_range();

    $(document).on('click', '.switch', function(){
        $(this).toggleClass("switchOn");
    });

    $(document).on('click', '.submit', function() {
        $('.loading_page').removeClass('hidden');
        $('#form_rubricator_filters').submit();
    });

    $(document).on('click', '.filter_checked a', function() {
        let code = $(this).data('code');
        if (code === 'poisk') {
            $('#general_search').val('');
        } else if (code === 'price') {
            $('#min_price_range').val($('#slider-fit').data('min-value'));
            $('#max_price_range').val($('#slider-fit').data('max-value'));
        } else if (code === 'stock') {
            $('#checked_filter_'+code).prop('checked', false);
        } else {
            let filter_value = $(this).data('value');
            let filter_name = $(this).data('code');
            $('#checked_filter_'+filter_name+'_'+filter_value).prop('checked', false);
        }
        submit();
        return false;
    });

    $(document).on('click', '.view_type>a', function () {
        $('.view_type>a').removeClass('current');

        $(this).addClass('current');
        if ($('.by_lines').hasClass('current')) {
            $('body').addClass('show_items_by_lines');
        } else {
            $('body').removeClass('show_items_by_lines');
        }
        return false;
    });

    $(document).on('click', '.sort_dropdown .choosen', function () {
        $('.sort_dropdown').toggleClass('show');
    });
    $(document).on('click', '.sort_dropdown ul li a', function () {
        $('.sort_dropdown').toggleClass('show');
        let name = $(this).text();
        $('.sort_dropdown .choosen').text(name);
    });

    $(document).on('click', '.show_more_filter_items', function () {
        if($(this).hasClass('hidden_flt_hidden')) {
            $(this).parent('.items').find('.input_flt_wrapper').removeClass('hidden');
            $(this).removeClass('hidden_flt_hidden');
            $(this).parent('.items').addClass('show');
            $(this).parent('.items').parent('.filter_section').find('.search').removeClass('hidden');
            $(this).text('Скрыть');
        }
        else {
            $(this).parent('.items').find('.hidden_flt').addClass('hidden');
            $(this).addClass('hidden_flt_hidden');
            $(this).parent('.items').removeClass('show');
            $(this).parent('.items').parent('.filter_section').find('.search').addClass('hidden');
            $(this).parent('.items').parent('.filter_section').find('.search_input').val('');
            $(this).parent('.items').find('.input_flt_wrapper').filter(function(i, elem) {
                if($(this).find('.checkbox_js').prop('checked') === true) {
                    return true;
                }
                return false;
            }).removeClass('hidden');
            $(this).text('Показать еще');
        }
        return false;
    });

    $(document).on('keyup', '.search_input', function () {
        let val = $(this).val().toLowerCase()
        $(this).parent('.search').next('.items').find('.input_flt_wrapper').removeClass('hidden').filter(function(i, elem) {
            let search = String($(this).data('search'))
            if(search.toLowerCase().search(val) == -1) {
                return true;
            }
            return false;
        }).addClass('hidden');
        return false;
    });



    $(document).on('click', '.sidebar .close_filter', function () {
        $('.sidebar').addClass('hidden');
        $('body').removeClass('popup_shown');
    });

    $(document).on('click', '.filter_ppp', function () {
        $('.sidebar').removeClass('hidden');
        $('body').addClass('popup_shown');
    });

    $(document).on('click', '.checkbox_js', function() {
        submit();
        $('body').removeClass('popup_shown');
    });
}));