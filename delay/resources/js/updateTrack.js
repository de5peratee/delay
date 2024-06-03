document.addEventListener('DOMContentLoaded', (event) => {
    const editButtons = document.querySelectorAll('.edit-track-btn');
    const trackEditModal = document.getElementById('trackEditModal');
    const closeButton = trackEditModal.querySelector('.close');
    const uploadIcon = document.getElementById('icon');
    const uploadTextIconTrack = document.getElementById('upload-text-icon-track');
    const trackIconInput = document.getElementById('track_icon');

    function resetUpload() {
        uploadIcon.className = 'fa-solid fa-image';
        uploadTextIconTrack.textContent = 'Выберите или перетащите изображение';
        trackIconInput.value = '';
        trackIconInput.parentNode.style.borderColor = '';
    }

    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const trackId = this.getAttribute('data-track-id');
            const trackName = this.getAttribute('data-track-name');
            const trackGenreId = this.getAttribute('data-track-genre-id');

            document.getElementById('editTrackForm').action = `/musicianProfile/updateTrack/${trackId}`;
            document.getElementById('track_id').value = trackId;
            document.getElementById('track_name').value = trackName;
            document.getElementById('track_genre').value = trackGenreId;

            trackEditModal.style.display = 'block';
        });
    });

    closeButton.addEventListener('click', function() {
        trackEditModal.style.display = 'none';
        resetUpload();
    });

    window.addEventListener('click', function(event) {
        if (event.target == trackEditModal) {
            trackEditModal.style.display = 'none';
            resetUpload();
        }
    });
});
