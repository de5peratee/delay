@vite(['resources/css/track.css'])
<div class="track">
    <div class="skeleton-block" id="skeleton-{{ $track->ID_tracks }}"></div>
    <img data-src="{{ asset('/storage/' . $track->Track_icon) }}" alt="Иконка трека" class="lazy" id="image-{{ $track->ID_tracks }}" style="display: none;">
    <div class="track-info">
        @if(Session::has('user'))
            <div class="i1">
                <i class="fa-solid fa-spinner fa-spin"></i>
                <i class="hidden-icon {{ Session::get('user')->playlist->contains('ID_tracks', $track->ID_tracks) ? 'fa-solid fa-minus' : 'fa-solid fa-plus' }}"></i>
            </div>
        @endif
        <div class="trackName">{{ $track->Track_name }}</div>
        <div class="trackMusician">
            <a href="/musician/show/{{ str_replace(' ', '+', $track->musician->Musician_name) }}">{{ $track->musician->Musician_name }}</a>
        </div>
        <div class="trackGenre">
            <a href="/genres/{{ str_replace(' ', '+', $track->genre->Genre_name) }}">{{ $track->genre->Genre_name }}</a>
        </div>
    </div>
    <div class="track-source" hidden>{{ asset('/storage/' . $track->Track_url) }}</div>
    <div class="track-id" hidden>{{ $track->ID_tracks }}</div>
</div>



