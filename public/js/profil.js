const photoInput  = document.getElementById('photoInput');
const avatarPreview = document.getElementById('avatarPreview');
const avatarInitial = document.getElementById('avatarInitial');

photoInput.addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function (e) {
        // Hapus onerror dulu supaya tidak konflik dengan preview baru
        avatarPreview.onerror = null;
        avatarPreview.src = e.target.result;
        avatarPreview.classList.remove('hidden');
        if (avatarInitial) avatarInitial.classList.add('hidden');
    };
    reader.readAsDataURL(file);
});
