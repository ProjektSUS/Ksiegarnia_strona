
/* Header */
window.addEventListener("scroll", function () {
    var headerScroll = document.querySelector("header");
    headerScroll.classList.toggle("sticky", window.scrollY > 0)
});