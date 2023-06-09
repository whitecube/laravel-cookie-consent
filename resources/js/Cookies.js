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

            });
    }

    reset(url) {
        this.request(url)
            .then((response) => {
                let cookies = response.data.querySelector('.cookies')

                document.querySelector('body').appendChild(cookies);

                cookies.classList.add('cookies--closing');

                setTimeout(function() {
                    cookies.classList.remove('cookies--closing');
                }, 210);
            });
    }

    request(url, data = null) {
        return Axios({
            method: 'post',
            url: url,
            data : data,
            transformResponse: (response) => {
                let tmp = document.createElement('div');

                tmp.innerHTML = response;

                return tmp
            }
        });
    }
}