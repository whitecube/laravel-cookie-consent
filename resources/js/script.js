var cookies = document.querySelector('#cookies-policy');
var reset = document.querySelector('.cookiereset');

if(reset) {
    reset.addEventListener('submit', (event) => resetCookies(event))
}

if(cookies) {
    var customize = cookies.querySelector('.cookies__btn--customize');
    var details = cookies.querySelectorAll('.cookies__details');
    var acceptAll = cookies.querySelector('.cookiesBtn--accept');
    var acceptEssentials = cookies.querySelector('.cookiesBtn--essentials');
    var configure = cookies.querySelector('.cookies__customize');
    var text = JSON.parse(cookies.getAttribute('data-text'))

    initCookies();

    for (let i = 0; i < details.length; i++) {
        details[i].addEventListener('click', (event) => toggleExpand(event, event.target, false));
    }
    customize.addEventListener('click', (event) => toggleExpand(event, customize));
    acceptAll.addEventListener('submit', (event) => acceptAllCookies(event));
    acceptEssentials.addEventListener('submit', (event) => acceptEssentialsCookies(event));
    configure.addEventListener('submit', (event) => configureCookies(event));
    window.addEventListener('resize', (event) => resize(event));
}

function initCookies() {
    cookies.removeAttribute('data-text');
    cookies.classList.remove('cookies--no-js');
    cookies.classList.add('cookies--closing');

    setTimeout(function() {
        cookies.classList.remove('cookies--closing');
    }, 310);
}

function configureCookies(event)  {
    event.preventDefault();
    window.LaravelCookieConsent.configure(new FormData(event.target));
    close();
}

function acceptAllCookies(event) {
    event.preventDefault();
    window.LaravelCookieConsent.acceptAll()
    close();
}

function acceptEssentialsCookies(event) {
    event.preventDefault();
    window.LaravelCookieConsent.acceptEssentials()
    close();
}

function resetCookies(event) {
    event.preventDefault();
    if(document.querySelector('#cookies-policy')) return;
    window.LaravelCookieConsent.reset()
}

function resize() {
    if (window.innerHeight <= cookies.offsetHeight) {
        cookies.querySelector('.cookies__sections').style.maxHeight = '50vh';
    } else {
        cookies.querySelector('.cookies__sections').removeAttribute('style')
    }
}

function toggleExpand(event, el, hide = true) {
    event.preventDefault();
    event.target.blur();

    var element = cookies.querySelector(el.getAttribute('href')),
        content = element.firstElementChild,
        height = content.offsetHeight,
        isOpen = element.classList.contains('cookies__expandable--open');

    element.setAttribute('style', 'height:' + (isOpen ? height : 0) + 'px');

    changeText(hide, isOpen, event);

    setTimeout(((cookies) => function() {
        element.classList.toggle('cookies__expandable--open');
        element.setAttribute('style', 'height:' + (isOpen ? 0 : height) + 'px');

        setTimeout(function() {
            element.removeAttribute('style');
        }, 310);
    })(cookies), 10);

    hideNotice(hide, isOpen)
}

function changeText(hide, isOpen, event) {
    if(hide) return;

    event.target.textContent = isOpen
        ? text.more
        : text.less
}

function hideNotice(hide, isOpen) {
    if(!hide) return;

    var container = cookies.querySelector('.cookies__container'),
        containerHeight = container.firstElementChild.offsetHeight;

    container.setAttribute('style', 'height:' + (!isOpen ? containerHeight : 0) + 'px');

    setTimeout(((cookies) => function() {
        cookies.classList.toggle('cookies--show')
        container.classList.toggle('cookies__container--hide');
        container.setAttribute('style', 'height:' + (isOpen ? containerHeight : 0) + 'px');

        setTimeout(function() {
            container.removeAttribute('style');
        }, 320);
    })(cookies), 10);
}

function close() {
    cookies.classList.add('cookies--closing');

    setTimeout(((cookies) => { return () => {
        if (!cookies.parentNode) return;

        let scripts = cookies.parentNode.querySelectorAll('[data-cookie-consent]');

        scripts.forEach(script => {
            script.parentNode.removeChild(script);
        });

        cookies.parentNode.removeChild(cookies);

    }})(cookies), 210);
}