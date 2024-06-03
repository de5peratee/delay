document.addEventListener('DOMContentLoaded', (event) => {
    const deleteButtons = document.querySelectorAll('.delete-track-btn');
    const deleteModal = document.getElementById('deleteModal');
    const closeButton = deleteModal.querySelector('.close');
    const deleteForm = deleteModal.querySelector('form'); // Получаем форму в модальном окне
    const trackInfoContainer = deleteModal.querySelector('.track-item'); // Контейнер для информации о треке

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const trackId = this.getAttribute('data-track-id');
            const trackName = this.getAttribute('data-track-name');
            const trackIcon = this.getAttribute('data-track-icon');
            const trackReleaseDate = this.getAttribute('data-track-release-date');
            const trackGenre = this.getAttribute('data-track-genre');
            const trackListenings = this.getAttribute('data-track-listenings');

            trackInfoContainer.querySelector('img').src = trackIcon;
            trackInfoContainer.querySelector('h3').textContent = trackName;
            trackInfoContainer.querySelector('.release-date').textContent = 'Дата выхода: ' + trackReleaseDate;
            trackInfoContainer.querySelector('.genre').textContent = 'Жанр: ' + trackGenre;
            trackInfoContainer.querySelector('.listenings').textContent = 'Прослушивания: ' + trackListenings;

            // Обновляем атрибут action формы с правильным ID трека
            deleteForm.action = '/musicianProfile/deleteTrack/' + trackId;

            deleteModal.style.display = 'block';
        });
    });

    closeButton.addEventListener('click', () => {
        deleteModal.style.display = 'none';
    });

    document.getElementById('cancelDelete').addEventListener('click', () => {
        deleteModal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target == deleteModal) {
            deleteModal.style.display = 'none';
        }
    });
});
