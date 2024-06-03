$(document).ready(function() {
    if (userIsLoggedIn) {
        $.ajax({
            url: '/playlistTracks',
            method: 'GET',
            success: function(trackIds) {
                $('.track').each(function() {
                    var trackId = parseInt($(this).closest('.track').find('.track-id').text());
                    var spinner = $(this).find('.fa-spinner');
                    var icon = $(this).find('.fa-solid');
                    spinner.remove();
                    icon.removeClass('hidden-icon');
                    if (trackIds.includes(trackId)) {
                        icon.addClass('fa-check');
                    } else {
                        icon.addClass('fa-plus');
                    }
                });
            }
        });

        $('.fa-solid.fa-plus, .fa-solid.fa-check').click(function(event) {
            event.stopPropagation();
            var trackId = $(this).closest('.track').find('.track-id').text();
            var icon = $(this);
            // Обновляем состояние иконки сразу, не дожидаясь ответа от сервера
            if (icon.hasClass('fa-plus')) {
                icon.removeClass('fa-plus').addClass('fa-check');
                // AJAX-запрос для добавления трека
                $.ajax({
                    url: '/addTrack',
                    method: 'POST',
                    data: {
                        ID_tracks: trackId,
                        _token: csrfToken
                    }
                });
            } else if (icon.hasClass('fa-check')) {
                icon.removeClass('fa-check').addClass('fa-plus');
                // AJAX-запрос для удаления трека
                $.ajax({
                    url: '/removeTrack',
                    method: 'POST',
                    data: {
                        ID_tracks: trackId,
                        _token: csrfToken
                    }
                });
            }
        });

    }
});
