var cookies = document.querySelector('#cookies-policy');
cookies.classList.remove('cookies--no-js');
var reset = document.querySelector('.cookiereset');

if(cookies) {
    cookies.classList.remove('cookies--no-js');
    var customize = cookies.querySelector('.cookies__btn--customize');
    var details = cookies.querySelectorAll('.cookies__details');
    var acceptAll = cookies.querySelector('.cookiesBtn--accept');
    var acceptEssentials = cookies.querySelector('.cookiesBtn--essentials');
    var configure = cookies.querySelector('.cookies__customize');
    var text = JSON.parse(cookies.getAttribute('data-text'))
    cookies.removeAttribute('data-text');
}

if(reset) {
    reset.addEventListener('submit', (event) => resetCookies(event))
}

if(cookies) {
    for (let i = 0; i < details.length; i++) {
        details[i].addEventListener('click', (event) => openDetails(event));
    }
    customize.addEventListener('click', (event) => toggleExpand(event, customize));
    acceptAll.addEventListener('submit', (event) => acceptAllCookies(event));
    acceptEssentials.addEventListener('submit', (event) => acceptEssentialsCookies(event));
    configure.addEventListener('submit', (event) => configureCookies(event));
}

function configureCookies(event)  {
    event.preventDefault();
    var formData = new FormData(event.target)
    window.LaravelCookieConsent.configure(formData)
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

function openDetails(event) {
    toggleExpand(event, event.target, false);
}

function toggleExpand(event, el, hide = true) {
    event.preventDefault();
    event.target.blur();

    var element = cookies.querySelector(el.getAttribute('href')),
        content = element.firstElementChild,
        height = content.offsetHeight,
        isOpen = element.classList.contains('cookies__expandable--open');

    element.setAttribute('style', 'height:' + (isOpen ? height : 0) + 'px');

    if(!hide) {
        event.target.textContent = isOpen
            ? text.more
            : text.less
    }

    setTimeout(((cookies) => function() {
        cookies.firstElementChild.classList.toggle('cookies--show')
        element.classList.toggle('cookies__expandable--open');
        element.setAttribute('style', 'height:' + (isOpen ? 0 : height) + 'px');

        setTimeout(function() {
            element.removeAttribute('style');
        }, 310);
    })(cookies), 10);

    if(!hide) return;
    hideNotice(isOpen)
}

function hideNotice(isOpen) {
    var container = cookies.querySelector('.cookies__container'),
        containerHeight = container.firstElementChild.offsetHeight;

    container.setAttribute('style', 'height:' + (!isOpen ? containerHeight : 0) + 'px');

    setTimeout(((cookies) => function() {
        container.classList.toggle('cookies__container--hide');
        container.setAttribute('style', 'height:' + (isOpen ? containerHeight : 0) + 'px');

        setTimeout(function() {
            container.removeAttribute('style');
        }, 310);
    })(cookies), 10);
}

function close() {
    cookies.classList.add('cookies--closing');

    setTimeout(((cookies) => { return () => {
        var script = cookies.nextElementSibling;
        var style = script.nextElementSibling;

        cookies.parentNode.removeChild(cookies);
        script.parentNode.removeChild(script);
        style.parentNode.removeChild(style);

    }})(cookies), 210);
}