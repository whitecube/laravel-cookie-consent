import Cookies from './Cookies';

class LaravelCookieConsent {

    constructor() {
        this.initCookies()
        this.getElements()
        this.setEvents()
    }

    initCookies() {
        this.cookiesConsent = new Cookies();
    }

    getElements() {
        this.cookies = document.querySelector('#cookies-policy');
        this.cookies.classList.add('cookies--js');
        this.cookies.classList.remove('cookies--no-js');
        this.customize = this.cookies.querySelector('.cookies__btn--customize');
        this.details = this.cookies.querySelectorAll('.cookies__details');
        this.acceptAll = this.cookies.querySelector('.cookiesBtn--accept');
        this.acceptEssentials = this.cookies.querySelector('.cookiesBtn--essentials');
        this.configure = this.cookies.querySelector('.cookies__customize');
        this.reset = document.querySelector('.cookiereset');
    }

    setEvents() {
        for (let i = 0; i < this.details.length; i++) {
            this.details[i].addEventListener('click', (event) => this.openDetails(event));
        }
        this.customize.addEventListener('click', (event) => this.toggleExpand(event));
        this.acceptAll.addEventListener('submit', (event) => this.acceptAllCookies(event));
        this.acceptEssentials.addEventListener('submit', (event) => this.acceptEssentialsCookies(event));
        this.configure.addEventListener('submit', (event) => this.configureCookies(event));
        this.reset.addEventListener('submit', (event) => this.resetCookies(event))
    }

    configureCookies(event)  {
        event.preventDefault();
        let formData = new FormData(event.target)
        this.cookiesConsent.configure(event.target.action, formData)
        this.close();
    }

    acceptAllCookies(event) {
        event.preventDefault();
        this.cookiesConsent.acceptAll(event.target.action)
        this.close();
    }

    acceptEssentialsCookies(event) {
        event.preventDefault();
        this.cookiesConsent.acceptEssentials(event.target.action)
        this.close();
    }

    resetCookies(event) {
        event.preventDefault();
        this.cookiesConsent.reset(event.target.action)
    }

    openDetails(event) {
        event.preventDefault();
        this.toggleExpand(event);
    }

    toggleExpand(event) {
        event.preventDefault();
        event.target.blur();

        let element = this.cookies.querySelector(event.target.getAttribute('href'))
        let content = element.firstElementChild,
            height = content.offsetHeight,
            isOpen = element.classList.contains('cookies__expandable--open');

        this.changeText(event, isOpen)

        element.setAttribute('style', 'height:' + (isOpen ? height : 0) + 'px');

        setTimeout(((cookies) => function() {
            cookies.classList.toggle('cookies--show')
            element.classList.toggle('cookies__expandable--open');
            element.setAttribute('style', 'height:' + (isOpen ? 0 : height) + 'px');

            setTimeout(function() {
                element.removeAttribute('style');
            }, 200);
        })(this.cookies), 10);
    }

    changeText(event, isOpen) {
        if(event.target.dataset.text) {
            let data = JSON.parse(event.target.dataset.text)
            event.target.textContent = isOpen ? data.more : data.less
        }
    }

    close() {
        this.cookies.classList.add('cookies--closing');

        setTimeout(((cookies) => { return () => {
            cookies.parentNode.removeChild(cookies);
        }})(this.cookies), 210);
    }
}

window.addEventListener('load', () => {
    window.LaravelCookieConsent = new LaravelCookieConsent();
});
