$(document).ready(function() {
    $('#searchNew').on('input', function() {
        var searchKeyword = $(this).val();
        if (searchKeyword.length >= 3) {
            $.get('/searchNew', { searchNew: searchKeyword }, function(data) {
                $('.scroll-menu').empty();
                data.tracks.forEach(function(track) {
                    var trackElement = `
                        <div class="track">
                            <img src="/storage/${track.Track_icon}" alt="Иконка трека">
                            <div class="track-info">
                                <div class="i1">
                                    <i class="plus fa-solid fa-plus"></i>
                                </div>
                                <div class="trackName">${track.Track_name}</div>
                                <div class="trackMusician">${track.musician.Musician_name}</div>
                                <div class="trackGenre">
                                    <a href="/genres/${track.genre.Genre_name.replace(' ', '+')}">${track.genre.Genre_name}</a>
                                </div>
                            </div>
                            <div class="track-source" hidden>/storage/${track.Track_url}</div>
                        </div>`;
                    $('.scroll-menu').append(trackElement);
                });
            });
        } else if (searchKeyword.length == 0) {
            $.get('/new', function(data) {
                $('.scroll-menu').empty();
                data.tracks.forEach(function(track) {
                    var trackElement = `
                        <div class="track">
                            <img src="/storage/${track.Track_icon}" alt="Иконка трека">
                            <div class="track-info">
                                <div class="i1">
                                    <i class="plus fa-solid fa-plus"></i>
                                </div>
                                <div class="trackName">${track.Track_name}</div>
                                <div class="trackMusician">${track.musician.Musician_name}</div>
                                <div class="trackGenre">
                                    <a href="/genres/${track.genre.Genre_name.replace(' ', '+')}">${track.genre.Genre_name}</a>
                                </div>
                            </div>
                            <div class="track-source" hidden>/storage/${track.Track_url}</div>
                        </div>`;
                    $('.scroll-menu').append(trackElement);
                });
            });
        }
    });
});
