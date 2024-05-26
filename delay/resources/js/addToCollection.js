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
            if (icon.hasClass('fa-plus')) {
                $.ajax({
                    url: '/addTrack',
                    method: 'POST',
                    data: {
                        ID_tracks: trackId,
                        _token: csrfToken
                    },
                    success: function() {
                        icon.removeClass('fa-plus');
                        icon.addClass('fa-check');
                    }
                });
            } else if (icon.hasClass('fa-check')) {
                $.ajax({
                    url: '/removeTrack',
                    method: 'POST',
                    data: {
                        ID_tracks: trackId,
                        _token: csrfToken
                    },
                    success: function() {
                        icon.removeClass('fa-check');
                        icon.addClass('fa-plus');
                    }
                });
            }
        });
    }
});
