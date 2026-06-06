const openSidebar = document.getElementById('openSidebar');
const closeSidebar = document.getElementById('closeSidebar');
const sidebar = document.getElementById('sidebar');
const sidebarOverlay = document.getElementById('sidebarOverlay');

if (openSidebar && closeSidebar && sidebar && sidebarOverlay) {
    function open() {
        sidebar.classList.remove('-translate-x-full');
        sidebarOverlay.classList.remove('hidden');

        setTimeout(function () {
            sidebarOverlay.classList.remove('opacity-0');
        }, 10);
    }

    function close() {
        sidebar.classList.add('-translate-x-full');
        sidebarOverlay.classList.add('opacity-0');

        setTimeout(function () {
            sidebarOverlay.classList.add('hidden');
        }, 300);
    }

    openSidebar.addEventListener('click', open);
    closeSidebar.addEventListener('click', close);
    sidebarOverlay.addEventListener('click', close);
}