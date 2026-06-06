const notificationButton = document.getElementById('notificationButton');
const notificationPanel = document.getElementById('notificationPanel');
const closeNotification = document.getElementById('closeNotification');

if (notificationButton && notificationPanel && closeNotification) {
    notificationButton.addEventListener('click', function (event) {
        event.stopPropagation();
        notificationPanel.classList.toggle('hidden');
    });

    closeNotification.addEventListener('click', function (event) {
        event.stopPropagation();
        notificationPanel.classList.add('hidden');
    });

    notificationPanel.addEventListener('click', function (event) {
        event.stopPropagation();
    });

    document.addEventListener('click', function () {
        notificationPanel.classList.add('hidden');
    });
}