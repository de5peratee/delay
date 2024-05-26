document.addEventListener("DOMContentLoaded", function() {
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

    checkVisibilityAndLoadImage(); // Проверяем видимость изображений при загрузке страницы
    window.addEventListener('scroll', checkVisibilityAndLoadImage); // Проверяем видимость изображений при прокрутке страницы
});
