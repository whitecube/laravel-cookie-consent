import axios from "axios";

class LaravelCookieConsent {
    config;

    constructor(config) {
        this.config = config;
    }

    acceptAll() {
        return this.request(this.config['accept.all']);
    }

    acceptEssentials() {
        return this.request(this.config['accept.essentials']);
    }

    configure(data) {
        return this.request(this.config['accept.configuration'], data);
    }

    reset() {
        return this.request(this.config['reset'])
            .then((response) => {
                let tmp = document.createElement('div');
                tmp.innerHTML = response.data.notice;

                document.body.appendChild(tmp.querySelector('#cookies-policy'));

                let style = tmp.querySelector('style')
                if(style) document.body.appendChild(tmp.querySelector('style'));

                const script = tmp.querySelector('script');

                if(script) {
                    const newScript = document.createElement('script');
                    newScript.textContent = script.textContent;
                    document.body.appendChild(newScript);
                }
            });
    }

    request(url, data = null) {
        return axios.post(url, data);
    }
}

window.addEventListener('load', () => {
    window.LaravelCookieConsent = new LaravelCookieConsent({config:1});
});