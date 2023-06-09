import Axios from "axios";

export default class Cookies {
    acceptAll(url) {
        this.request(url);
    }

    acceptEssentials(url) {
        this.request(url);
    }

    configure(url, data) {
        this.request(url, data)
            .then(response => {
                console.log(response.data)
            });
    }

    reset(url) {
        this.request(url)
            .then((response) => {
                let tmp = document.createElement('div');

                tmp.innerHTML = response.data.notice;

                document.querySelector('body').appendChild(tmp.querySelector('#cookies-policy'));
                document.querySelector('body').appendChild(tmp.querySelector('style'));
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