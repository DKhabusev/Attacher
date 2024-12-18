if (document.getElementById('mini_popup_favorite_add') !== null) {
    $(document).on('click', '#mini_popup_favorite_add .popup_wrapper', function () {
        $(this).removeClass('show');
    });
    $(document).on('click', '.fav', function () {
        var favoriteCookieName = 'favorite';
        var id = $(this).attr('data-id');
        var favoriteCookieValue = $.cookie(favoriteCookieName);
        var newFavoriteCookie = '';
        var cookieParam = {
            path    : '/',      
        };
        var favIndex = 1;

        if($(this).hasClass('faved')) {
            $(this).removeClass('faved');

            if(favoriteCookieValue) {
                var arrayOfFavorite = favoriteCookieValue.split('|');
                var idIndex = arrayOfFavorite.indexOf(id);
                if (idIndex !== -1) {
                    arrayOfFavorite.splice(idIndex, 1);
                    favIndex = -1;
                }

                newFavoriteCookie = arrayOfFavorite.join('|');
            }            
                        
        }else{

            $('#mini_popup_favorite_add .popup_wrapper').addClass('show');
            setTimeout(() => {$('#mini_popup_favorite_add .popup_wrapper').removeClass('show');}, 2000);
            $(this).addClass('faved');

            newFavoriteCookie = favoriteCookieValue ? 
                favoriteCookieValue + '|' + id : id;
        }

        $.cookie(favoriteCookieName, newFavoriteCookie, cookieParam);

        $('#fav_index').html(parseInt($('#fav_index').html()) + favIndex );

        return false;
    });
    
}