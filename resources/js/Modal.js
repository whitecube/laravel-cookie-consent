window.LaravelCookieModalLoaded = false;

class LaravelCookieModal {
    elements;
    translations;

    constructor(translations) {
        this.translations = translations;
    }

    init() {
        if (!window.LaravelCookieConsent || window.LaravelCookieModalLoaded) {
            return;
        }

        this.elements = this.getUIElements(document.querySelector('#cookies-policy'));

        if (!this.elements) {
            return;
        }

        this.elements.root.classList.add('cookies--pre-init');
        this.elements.root.classList.add('cookies--closing');

        this.addEventListeners();

        setTimeout(() => {
            this.elements.root.classList.remove('cookies--pre-init');
            this.elements.root.classList.remove('cookies--closing');
        }, 60);

        window.LaravelCookieModalLoaded = true;
    };

    getUIElements(root) {
        if (!root) {
            return null;
        }

        return {
            root: root,
            reset: document.querySelector('[data-cookie-button]'),
            customize: root.querySelector('.cookies__btn--customize'),
            details: root.querySelectorAll('.cookies__details'),
            acceptAll: root.querySelector('.cookiesBtn--accept'),
            acceptEssentials: root.querySelector('.cookiesBtn--essentials'),
            configure: root.querySelector('.cookies__customize'),
            translations: this.translations,
        };
    }

    addEventListeners() {
        if (this.elements.reset) {
            this.elements.reset.addEventListener('submit', (event) => this.resetCookies(event))
        }
        for (let i = 0; i < this.elements.details.length; i++) {
            this.elements.details[i].addEventListener('click', (event) => this.toggleExpand(event, event.target, false));
        }
        this.elements.customize.addEventListener('click', (event) => this.toggleExpand(event, this.elements.customize));
        this.elements.acceptAll.addEventListener('submit', (event) => this.acceptAllCookies(event));
        this.elements.acceptEssentials.addEventListener('submit', (event) => this.acceptEssentialsCookies(event));
        this.elements.configure.addEventListener('submit', (event) => this.configureCookies(event));
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
        if (window.innerHeight <= this.elements.root.offsetHeight) {
            this.elements.root.querySelector('.cookies__sections').style.maxHeight = '50vh';
        } else {
            this.elements.root.querySelector('.cookies__sections').removeAttribute('style')
        }
    }

    toggleExpand(event, el, hide = true) {
        event.preventDefault();
        event.target.blur();

        const element = this.elements.root.querySelector(el.getAttribute('href')),
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

        })(this.elements.root), 10);

        this.hideNotice(hide, isOpen)
    }

    changeText(hide, isOpen, event) {
        if (hide) return;

        event.target.textContent = isOpen
            ? this.elements.translations.more
            : this.elements.translations.less
    }

    hideNotice(hide, isOpen) {
        if (!hide) return;

        const container = this.elements.root.querySelector('.cookies__container'),
            containerHeight = container.firstElementChild.offsetHeight;

        container.setAttribute('style', 'height:' + (!isOpen ? containerHeight : 0) + 'px');

        setTimeout(((cookie) => function () {
            cookie.classList.toggle('cookies--show')
            container.classList.toggle('cookies__container--hide');
            container.setAttribute('style', 'height:' + (isOpen ? containerHeight : 0) + 'px');

            setTimeout(() => {
                container.removeAttribute('style');
            }, 320);

        })(this.elements.root), 10);
    }

    close() {
        this.elements.root.classList.add('cookies--closing');

        setTimeout(((cookie) => {
            return () => {
                if (!cookie.parentNode) return;

                let scripts = this.elements.root.parentNode.querySelectorAll('[data-cookie-consent]');

                scripts.forEach(script => {
                    script.parentNode.removeChild(script);
                });

                this.elements.root.parentNode.removeChild(cookie);
            }
        })(this.elements.root), 210);
    }

    resetCookies(event) {
        event.preventDefault();
        if (document.querySelector('#cookies-policy')) return;
        window.LaravelCookieConsent.reset()
    }
}

/*
    "Translations" is set to 1 here, but is modified by the ScriptController depending on the current locale.
*/
window.LaravelCookieModal = new LaravelCookieModal({translations:1});
window.LaravelCookieModal.init();
window.addEventListener('LARAVEL_COOKIE_CONSENT_SCRIPT_LOAD', () => {
    window.LaravelCookieModal.init();
});