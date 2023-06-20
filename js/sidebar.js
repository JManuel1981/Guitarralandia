const body = document.querySelector('body');
const sidebar = body.querySelector('nav');
const toggle = body.querySelector('.toggle');
const searchBtn = body.querySelector('.search-box');
const modeText = body.querySelector('.mode-text');
const logoFooter = document.getElementById('logoFooter');

if (toggle !== null) {
    toggle.addEventListener('click', () => {
        sidebar.classList.toggle('close');

        if (logoFooter.style.visibility === 'hidden') {
            logoFooter.style.visibility = 'visible';
        } else {
            logoFooter.style.visibility = 'hidden';
        }
    });
}

if (searchBtn !== null) {
    searchBtn.addEventListener('click', () => {
        sidebar.classList.remove('close');
    });
}

