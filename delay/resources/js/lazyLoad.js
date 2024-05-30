document.addEventListener('DOMContentLoaded', function() {
    let lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));

    function checkVisibilityAndLoadImage() {
        lazyImages.forEach(function(lazyImage) {
            let rect = lazyImage.getBoundingClientRect();

            if (rect.top <= window.innerHeight && rect.bottom >= 0) {
                let imageId = lazyImage.id.split('-')[1];
                let skeleton = document.getElementById('skeleton-' + imageId);

                lazyImage.src = lazyImage.dataset.src;
                lazyImage.classList.remove("lazy");

                lazyImage.onload = function() {
                    skeleton.style.display = 'none';
                    lazyImage.style.display = 'block';
                }

                lazyImage.onerror = function() {
                    lazyImage.style.display = 'none';
                    skeleton.style.display = 'block';
                }
            }
        });
    }

    checkVisibilityAndLoadImage();
    window.addEventListener('scroll', checkVisibilityAndLoadImage);

    document.querySelectorAll('.track img').forEach(img => {
        img.addEventListener('click', function(event) {
            event.stopPropagation();
            const trackId = this.id.split('-')[1];
            fetch(`/track/${trackId}`)
                .then(response => response.json())
                .then(data => {
                    const modal = document.createElement('div');
                    modal.className = 'modal';
                    modal.innerHTML = `
                        <div class="modal-content">
                            <i class="fa-solid fa-xmark"></i>
                            <div class="modal-left">
                                <img src="${this.dataset.src}" alt="Иконка трека">
                            </div>
                            <div class="modal-right">
                                <div class="modal-info">
                                    <h2>${data.Track_name}</h2>
                                    <div class="block">
                                        <p>Исполнитель: <a href="/musician/show/${data.musician.Musician_name.replace(/ /g, '+')}">${data.musician.Musician_name}</a></p>
                                        <p>Жанр: <a href="/genres/${data.genre.Genre_name.replace(/ /g, '+')}">${data.genre.Genre_name}</a></p>
                                    </div>
                                    <br>
                                    <div class="block">
                                        <p>Длительность: ${Math.floor(data.Track_duration / 60)}:${('0' + data.Track_duration % 60).slice(-2)}</p>
                                        <p>Прослушивания: ${data.Play_count}</p>
                                    </div>
                                    <br>
                                    <div class="block">
                                        <p>Дата выпуска: ${new Date(data.Release_date).toLocaleDateString()}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    document.body.appendChild(modal);
                    modal.style.display = 'block';

                    const closeModal = () => {
                        modal.style.display = 'none';
                        document.body.removeChild(modal);
                    };

                    modal.querySelector('.fa-solid.fa-xmark').addEventListener('click', closeModal);
                    modal.addEventListener('click', function(event) {
                        if (event.target === modal) {
                            closeModal();
                        }
                    });
                })
                .catch(error => console.error('Ошибка при получении данных о треке:', error));
        });
    });
});
