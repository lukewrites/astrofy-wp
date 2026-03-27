/**
 * Close the drawer when a sidebar link is clicked on mobile.
 */
(function () {
    var drawerToggle = document.getElementById('my-drawer');
    if (!drawerToggle) return;

    var sidebar = document.querySelector('.drawer-side');
    if (!sidebar) return;

    var links = sidebar.querySelectorAll('a');
    links.forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth < 1024) {
                drawerToggle.checked = false;
            }
        });
    });
})();
