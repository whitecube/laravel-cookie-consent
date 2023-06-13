import axios from "axios";

class LaravelCookieConsent {
    config;

    constructor(config) {
        this.config = config;
    }

    acceptAll() {
        return this.request(this.config['accept.all'])
            .then((response) => {
                this.addScripts(response.data)
            });
    }

    acceptEssentials() {
        return this.request(this.config['accept.essentials'])
            .then((response) => {
                this.addScripts(response.data)
            });
    }

    configure(data) {
        return this.request(this.config['accept.configuration'], data)
            .then((response) => {
                this.addScripts(response.data)
            });
    }

    addScripts(data) {
        if(data.scripts && data.scripts.length) {
            data.scripts.forEach(script => {
                let tmp = document.createElement('div');
                tmp.innerHTML = script;

                let newScript = tmp.querySelector('script')
                newScript.setAttribute('data-cookie-consent', true);

                document.head.appendChild(newScript);
            });
        }
    }

    reset() {
        return this.request(this.config['reset'])
            .then((response) => {
                let tmp = document.createElement('div');
                tmp.innerHTML = response.data.notice;

                let cookies = tmp.querySelector('#cookies-policy')
                document.body.appendChild(cookies);

                let scripts = tmp.querySelectorAll('[data-cookie-consent]');

                if(scripts.length) {
                    return;
                }

                scripts.forEach(script => {
                    if (script.nodeName == 'SCRIPT') {
                        const newScript = document.createElement('script');
                        newScript.textContent = script.textContent;
                        document.body.appendChild(newScript);
                    } else {
                        document.body.appendChild(script);
                    }
                });
            });
    }

    request(url, data = null) {
        return axios.post(url, data);
    }
}

window.addEventListener('load', () => {
    window.LaravelCookieConsent = new LaravelCookieConsent({config:1});
});