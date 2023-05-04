class LaravelCookieConsent {

    constructor() {
        console.log('LaravelCookieConsent script loaded');
    }

}

window.addEventListener('load', () => {
    window.LaravelCookieConsent = new LaravelCookieConsent();
});
