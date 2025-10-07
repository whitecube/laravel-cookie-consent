import {LaravelCookieModal} from "./Modal";
import {LaravelCookieConsent} from "./Cookies";

const cookieConsentNotice = document.querySelector('#cookies-policy');
const cookieConsentConfigScript = document.querySelector('#cookies-script');

if (cookieConsentNotice) {
    cookieConsentNotice.classList.remove('cookies--no-js');
    cookieConsentNotice.classList.add('cookies--closing');

    window.addEventListener('DOMContentLoaded', () => {
        let config = JSON.parse(cookieConsentConfigScript.getAttribute('data-config'));
        let text = JSON.parse(cookieConsentNotice.getAttribute('data-text'));

        window.LaravelCookieConsent = new LaravelCookieConsent(config);
        window.LaravelCookieModal = LaravelCookieModal;

        LaravelCookieModal.getValues(cookieConsentNotice, text);
        LaravelCookieModal.addEventListeners();

        cookieConsentConfigScript.removeAttribute('data-config');
        cookieConsentNotice.removeAttribute('data-text');

        setTimeout( () => {
            cookieConsentNotice.classList.remove('cookies--closing');
            cookieConsentNotice.style.transitionDuration = "200ms";
        }, 110);
    });
}
