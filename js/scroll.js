window.addEventListener('scroll', function () {
    var flechaScroll = document.getElementById('flechaScroll');

    if (flechaScroll !== null) {
        if (document.documentElement.scrollTop > 20) {
            flechaScroll.style.display = 'block';
        } else {
            flechaScroll.style.display = 'none';
        }
    }
});

var flechaScrollElement = document.getElementById('flechaScroll');
if (flechaScrollElement !== null) {
    flechaScrollElement.addEventListener('click', function () {
        document.documentElement.scrollTop = 0;
    });
}
