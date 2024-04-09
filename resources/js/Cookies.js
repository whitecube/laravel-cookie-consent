import axios from "axios";

class LaravelCookieConsent {
    config;

    constructor(config) {
        this.config = config;
    }

    acceptAll() {
        return this.request(this.config['accept.all'])
            .then((response) => this.addScripts(response.data));
    }

    acceptEssentials() {
        return this.request(this.config['accept.essentials'])
            .then((response) => this.addScripts(response.data));
    }

    configure(data) {
        return this.request(this.config['accept.configuration'], data)
            .then((response) => this.addScripts(response.data));
    }

    reset() {
        return this.request(this.config['reset'])
            .then((response) => this.addNotice(response.data));
    }

    request(url, data = null) {
        return axios.post(url, data);
    }

    addScripts(data) {
        if(!data.scripts) {
            return;
        }

        data.scripts.forEach(script => {
            const scriptRegex = /<script.*<\/script>/;
            if (!scriptRegex.test(script)) {
                console.error('Invalid script tag: ' + script);
            }
            let tmp = document.createElement('div');
            tmp.innerHTML = script;

            let tag = document.createElement('script');
            tag.textContent = tmp.querySelector('script').textContent;
            for (const attr of tmp.querySelector('script').attributes) {
                tag.setAttribute(attr.name, attr.value);
            }
            tag.setAttribute('data-cookie-consent', true);

            document.head.appendChild(tag);
        });
    }

    addNotice(data) {
        if(!data.notice) {
            return;
        }

        let tmp = document.createElement('div');
        tmp.innerHTML = data.notice;

        let cookies = tmp.querySelector('#cookies-policy')
        document.body.appendChild(cookies);

        let tags = tmp.querySelectorAll('[data-cookie-consent]');

        if (! tags.length) {
            return;
        }

        tags.forEach(tag => {
            if (tag.nodeName === 'SCRIPT') {
                const script = document.createElement('script');
                script.textContent = tag.textContent;
                document.body.appendChild(script);
            } else {
                document.body.appendChild(tag);
            }
        });
    }
}

window.addEventListener('load', () => {
    window.LaravelCookieConsent = new LaravelCookieConsent({config:1});
});