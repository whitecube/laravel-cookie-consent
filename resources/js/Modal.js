window.LaravelCookieModalLoaded = false;

class LaravelCookieModal {
    element;

    init() {
        if (!window.LaravelCookieConsent || window.LaravelCookieModalLoaded) {
            return;
        }

        this.element = document.querySelector('#cookies-policy');

        if (!this.element) {
            return;
        }

        this.getValues();
        this.addEventListeners();

        this.element.removeAttribute('data-text');

        setTimeout(() => {
            this.element.classList.remove('cookies--pre-init');
            this.element.classList.remove('cookies--closing');
        }, 60);

        window.LaravelCookieModalLoaded = true;
    };

    getValues() {
        this.reset = document.querySelector('#reset-button');
        this.customize = this.element.querySelector('.cookies__btn--customize');
        this.details = this.element.querySelectorAll('.cookies__details');
        this.acceptAll = this.element.querySelector('.cookiesBtn--accept');
        this.acceptEssentials = this.element.querySelector('.cookiesBtn--essentials');
        this.configure = this.element.querySelector('.cookies__customize');
        this.text = JSON.parse(this.element.getAttribute('data-text'));
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
        if (window.innerHeight <= this.element.offsetHeight) {
            this.element.querySelector('.cookies__sections').style.maxHeight = '50vh';
        } else {
            this.element.querySelector('.cookies__sections').removeAttribute('style')
        }
    }

    toggleExpand(event, el, hide = true) {
        event.preventDefault();
        event.target.blur();

        const element = this.element.querySelector(el.getAttribute('href')),
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

        })(this.element), 10);

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

        const container = this.element.querySelector('.cookies__container'),
            containerHeight = container.firstElementChild.offsetHeight;

        container.setAttribute('style', 'height:' + (!isOpen ? containerHeight : 0) + 'px');

        setTimeout(((cookie) => function () {
            cookie.classList.toggle('cookies--show')
            container.classList.toggle('cookies__container--hide');
            container.setAttribute('style', 'height:' + (isOpen ? containerHeight : 0) + 'px');

            setTimeout(() => {
                container.removeAttribute('style');
            }, 320);

        })(this.element), 10);
    }

    close() {
        this.element.classList.add('cookies--closing');

        setTimeout(((cookie) => {
            return () => {
                if (!cookie.parentNode) return;

                let scripts = this.element.parentNode.querySelectorAll('[data-cookie-consent]');

                scripts.forEach(script => {
                    script.parentNode.removeChild(script);
                });

                this.element.parentNode.removeChild(cookie);
            }
        })(this.element), 210);
    }

    resetCookies(event) {
        event.preventDefault();
        if (document.querySelector('#cookies-policy')) return;
        window.LaravelCookieConsent.reset()
    }
}

window.LaravelCookieModal = new LaravelCookieModal();
window.LaravelCookieModal.init();
window.addEventListener('LARAVEL_COOKIE_CONSENT_SCRIPT_LOAD', () => {
    window.LaravelCookieModal.init();
});
