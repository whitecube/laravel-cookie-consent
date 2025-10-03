export class LaravelCookieModal {
    cookieConsentNotice;
    translations;

    constructor(cookieConsentNotice, translations) {
        this.cookieConsentNotice = cookieConsentNotice;
        this.translations = translations;
        this.getValues();
        this.addEventListeners();
    }

    getValues() {
        this.reset = document.querySelector('.cookiereset');
        this.customize = this.cookieConsentNotice.querySelector('.cookies__btn--customize');
        this.details = this.cookieConsentNotice.querySelectorAll('.cookies__details');
        this.acceptAll = this.cookieConsentNotice.querySelector('.cookiesBtn--accept');
        this.acceptEssentials = this.cookieConsentNotice.querySelector('.cookiesBtn--essentials');
        this.configure = this.cookieConsentNotice.querySelector('.cookies__customize');
        this.text = this.translations;
    }

    addEventListeners() {
        if (this.reset) {
            this.reset.addEventListener('submit', (event) => this.resetCookies(event))
        }
        for (let i = 0; i < this.details.length; i++) {
            this.details[i].addEventListener('click', (event) => this.toggleExpand(event, event.target, false));
        }
        this.customize.addEventListener('click', (event) => this.toggleExpand(event, this.customize));
        this.acceptAll.addEventListener('submit', (event) => this.acceptAllCookies(event));
        this.acceptEssentials.addEventListener('submit', (event) => this.acceptEssentialsCookies(event));
        this.configure.addEventListener('submit', (event) => this.configureCookies(event));
        window.addEventListener('resize', (event) => this.resize(event));
    }

    configureCookies(event) {
        event.preventDefault();
        window.LaravelCookieConsent.configure(new FormData(event.target));
        this.close();
    }

    acceptAllCookies(event) {
        event.preventDefault();
        window.LaravelCookieConsent.acceptAll()
        this.close();
    }

    acceptEssentialsCookies(event) {
        event.preventDefault();
        window.LaravelCookieConsent.acceptEssentials()
        this.close();
    }

    resize() {
        if (window.innerHeight <= this.cookieConsentNotice.offsetHeight) {
            this.cookieConsentNotice.querySelector('.cookies__sections').style.maxHeight = '50vh';
        } else {
            this.cookieConsentNotice.querySelector('.cookies__sections').removeAttribute('style')
        }
    }

    toggleExpand(event, el, hide = true) {
        event.preventDefault();
        event.target.blur();

        const element = this.cookieConsentNotice.querySelector(el.getAttribute('href')),
            content = element.firstElementChild,
            height = content.offsetHeight,
            isOpen = element.classList.contains('cookies__expandable--open');

        element.setAttribute('style', 'height:' + (isOpen ? height : 0) + 'px');

        this.changeText(hide, isOpen, event);

        setTimeout(((cookies) => function () {
            element.classList.toggle('cookies__expandable--open');
            element.setAttribute('style', 'height:' + (isOpen ? 0 : height) + 'px');

            setTimeout(() => {
                element.removeAttribute('style');
            }, 310);

        })(this.cookieConsentNotice), 10);

        this.hideNotice(hide, isOpen)
    }

    changeText(hide, isOpen, event) {
        if (hide) return;

        event.target.textContent = isOpen
            ? this.text.more
            : this.text.less
    }

    hideNotice(hide, isOpen) {
        if (!hide) return;

        const container = this.cookieConsentNotice.querySelector('.cookies__container'),
            containerHeight = container.firstElementChild.offsetHeight;

        container.setAttribute('style', 'height:' + (!isOpen ? containerHeight : 0) + 'px');

        setTimeout(((cookie) => function () {
            cookie.classList.toggle('cookies--show')
            container.classList.toggle('cookies__container--hide');
            container.setAttribute('style', 'height:' + (isOpen ? containerHeight : 0) + 'px');

            setTimeout(() => {
                container.removeAttribute('style');
            }, 320);

        })(this.cookieConsentNotice), 10);
    }

    close() {
        this.cookieConsentNotice.classList.add('cookies--closing');

        setTimeout(((cookie) => {
            return () => {
                if (!cookie.parentNode) return;

                let scripts = this.cookieConsentNotice.parentNode.querySelectorAll('[data-cookie-consent]');

                scripts.forEach(script => {
                    script.parentNode.removeChild(script);
                });

                this.cookieConsentNotice.parentNode.removeChild(cookie);

            }
        })(this.cookieConsentNotice), 210);
    }

    resetCookies(event) {
        event.preventDefault();
        if (document.querySelector('#cookies-policy')) return;
        window.LaravelCookieConsent.reset()
    }
}