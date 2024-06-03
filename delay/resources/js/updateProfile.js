document.addEventListener('DOMContentLoaded', (event) => {
    const editButton = document.getElementById('editButton');
    const editModal = document.getElementById('editModal');
    const closeButton = document.querySelector('.close');
    const uploadTextIcon = document.getElementById('upload-text-icon');
    const iconElement = document.getElementById('icon');
    const fileUploadElement = document.getElementById('musician_icon');

    function resetUpload() {
        fileUploadElement.value = '';
        uploadTextIcon.textContent = 'Выберите или перетащите изображение';
        iconElement.className = 'fa-solid fa-image';
        fileUploadElement.parentNode.style.borderColor = '';
    }

    editButton.addEventListener('click', () => {
        const musicianName = editButton.getAttribute('data-musician-name');
        const musicianDescription = editButton.getAttribute('data-musician-description');
        const musicianLogin = editButton.getAttribute('data-musician-login');

        document.getElementById('musician_name').value = musicianName;
        document.getElementById('musician_description').value = musicianDescription;
        document.getElementById('listener_login').value = musicianLogin;

        editModal.style.display = 'block';
    });

    closeButton.addEventListener('click', () => {
        editModal.style.display = 'none';
        resetUpload();
    });

    window.addEventListener('click', (event) => {
        if (event.target == editModal) {
            editModal.style.display = 'none';
            resetUpload();
        }
    });
});
