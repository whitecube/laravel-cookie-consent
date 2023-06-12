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
                console.log(response.data.notice);
                tmp.innerHTML = response.data.notice;

                document.body.appendChild(tmp.querySelector('#cookies-policy'));
                document.body.appendChild(tmp.querySelector('style'));

                const scripts = tmp.querySelector('script');
                const script = document.createElement('script');
                script.textContent = scripts.textContent;
                document.body.appendChild(script);
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