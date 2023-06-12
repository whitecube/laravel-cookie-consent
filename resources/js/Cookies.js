import Axios from "axios";

class cookies {
    constructor(config) {
        this.config = JSON.parse(config);
    }

    acceptAll() {
        this.request(this.config['accept.all']);
    }

    acceptEssentials() {
        this.request(this.config['accept.essentials']);
    }

    configure(data) {
        this.request(this.config['accept.configuration'], data);
    }

    reset() {
        this.request(this.config['reset'])
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
        return Axios({
            method: 'post',
            url: url,
            data : data,
        });
    }
}

window.addEventListener('load', () => {
    window.LaravelCookieConsent = new cookies('{config}');
});