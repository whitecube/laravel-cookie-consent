<aside class="cookies" id="cookies-policy">
    <div class="cookies__alert">
        <p class="cookies__title">We use cookies</p>
        <div class="cookies__intro">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing, elit. Tempore magnam, consectetur corporis quo distinctio aperiam! Quo modi unde suscipit earum accusantium molestiae ullam, consequatur maiores cum, et accusamus exercitationem numquam?</p>
            <p>Check our <a href="#">cookies policy</a> for more information.</p>
        </div>
        <div class="cookies__actions">
            @cookieconsentbutton(action: 'accept.essentials', label: 'Only essentials')
            @cookieconsentbutton(action: 'accept.all', label: 'Accept all')
            <a href="#cookies-policy-customize" class="cookies__btn cookies__btn--customize">Customize</a>
        </div>
        @cookieconsentbutton(action: 'reset', label: 'Manage cookies', attributes: ['class' => 'cookiereset'])
        <div class="cookies__expandable" id="cookies-policy-customize">
            <form action="#" method="post" class="cookies__customize">
                @csrf
                @foreach($cookies->getCategories() as $category)
                <div class="cookies__section">
                    <label for="cookies-policy-check-{{ $category->key() }}" class="cookies__category">
                        <input type="checkbox" name="categories[]" value="{{ $category->key() }}" id="cookies-policy-check-{{ $category->key() }}" />
                        <span class="cookies__box">
                            <strong class="cookies__label">{{ $category->key() }}</strong>
                            <a href="#cookies-policy-{{ $category->key() }}" class="cookies__details">(details)</a>
                        </span>
                    </label>
                    <div class="cookies__expandable" id="cookies-policy-{{ $category->key() }}">
                        <ul class="cookies__definitions">
                            @foreach($category->getCookies() as $cookie)
                            <li class="cookies__cookie">
                                <p class="cookies__name">{{ $cookie->name }}</p>
                                <p class="cookies__duration">{{ \Carbon\CarbonInterval::minutes($cookie->duration)->cascade() }}</p>
                                <p class="cookies__description">Lorem, ipsum, dolor sit amet consectetur adipisicing elit. Id placeat corporis repellat excepturi maiores quisquam.</p>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
                <div class="cookies__save">
                    <button type="submit" class="cookies__btn cookies__btn--save">Save settings</button>
                </div>
            </form>
        </div>
    </div>
</aside>

{{-- JAVASCRIPT : feel free to remove the script and add your own --}}

<script>
    let cookies = document.querySelector('#cookies-policy');
    cookies.classList.add('js');

    function lcs_toggle_expand(element) {
        let content = element.firstElementChild,
            height = content.offsetHeight,
            isOpen = element.classList.contains('cookies__expandable--open');

        element.setAttribute('style', 'height:' + (isOpen ? height : 0) + 'px');

        setTimeout(function() {
            element.classList.toggle('cookies__expandable--open');
            element.setAttribute('style', 'height:' + (isOpen ? 0 : height) + 'px');
            setTimeout(function() {
                element.removeAttribute('style');
            }, 200);
        }, 10);
    }

    function lcs_close() {
        cookies.classList.add('cookies--closing');
        setTimeout(function() {
            cookies.parentNode.removeChild(cookies);
        }, 210);
    }

    cookies.querySelector('.cookies__btn--essentials').addEventListener('click', function(event) {
        event.preventDefault();
        console.log('essentials');
        lcs_close();
    });

    cookies.querySelector('.cookies__btn--customize').addEventListener('click', function(event) {
        event.preventDefault();
        event.target.blur();
        lcs_toggle_expand(cookies.querySelector(event.target.getAttribute('href')));
    });

    // cookies.querySelector('.cookies__btn--accept').addEventListener('click', function(event) {
    //     event.preventDefault();
    //     console.log('accept');
    //     lcs_close();
    // });

    cookies.querySelector('.cookies__btn--save').addEventListener('click', function(event) {
        event.preventDefault();
        console.log('save');
        lcs_close();
    });

    cookies.querySelectorAll('.cookies__details').forEach(function(btn) {
        btn.addEventListener('click', function(event) {
            event.preventDefault();
            lcs_toggle_expand(cookies.querySelector(event.target.getAttribute('href')));
        });
    });
</script>

{{-- STYLES : feel free to remove them and add your own --}}

<style type="text/css">
    #cookies-policy.cookies {
        font-size: 16px;
        position: fixed;
        bottom: 0;
        right: 0;
        max-width: 100%;
        max-height: 100%;
        overflow: auto;
        z-index: 9999;
        transition: transform 200ms ease-out,
                    opacity 200ms ease-out;
    }
    #cookies-policy.cookies--closing {
        opacity: 0;
        transform: translateY(10px);
    }
    #cookies-policy .cookies__alert {
        width: 30em;
        max-width: 90%;
        margin: 5%;
        background: #fff;
        padding: 2em;
        border-radius: 4px;
        -webkit-box-shadow: 0px 4px 24px 0px rgba(0,0,0,0.14);
        -moz-box-shadow: 0px 4px 24px 0px rgba(0,0,0,0.14);
        box-shadow: 0px 4px 24px 0px rgba(0,0,0,0.14);
    }
    #cookies-policy .cookies__title {
        font-weight: bold;
        line-height: 1.4em;
        margin-bottom: 1em;
        color: #233232;
    }
    #cookies-policy .cookies__intro {
        margin: 1em 0;
        line-height: 1.4em;
        color: #676767;
    }
    #cookies-policy .cookies__intro p {
        margin-top: 1em;
    }
    #cookies-policy .cookies__intro p:first-child {
        margin-top: 0;
    }
    #cookies-policy .cookies__intro a {
        color: inherit;
        transition: color 200ms ease-out;
    }
    #cookies-policy .cookies__intro a:hover,
    #cookies-policy .cookies__intro a:focus {
        color: #135868;
    }
    #cookies-policy .cookies__actions {
        margin-top: 1em;
        display: flex;
        justify-content: space-between;
    }
    #cookies-policy .cookies__btn {
        font: inherit;
        display: block;
        background: #fff;
        border: 1px solid #135868;
        border-radius: 4px;
        margin: 0;
        padding: 0.8em 1em;
        line-height: 1em;
        text-align: center;
        text-decoration: none;
        color: #135868;
        width: 32%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        cursor: pointer;
        transition: color 200ms ease-out, background 200ms ease-out;
    }
    #cookies-policy .cookies__btn:hover,
    #cookies-policy .cookies__btn:focus {
        color: #fff;
        background: #135868;
    }
    #cookies-policy .cookies__btn--save {
        width: auto;
    }
    #cookies-policy .cookies__expandable {
        display: block;
        overflow: hidden;
    }
    #cookies-policy.js .cookies__expandable {
        height: 0;
        visibility: hidden;
        opacity: 0;
        transition: height 200ms ease-out,
                    opacity 200ms ease-out,
                    visibility 0s 200ms linear;
    }
    #cookies-policy.js .cookies__expandable.cookies__expandable--open {
        height: auto;
        visibility: visible;
        opacity: 1;
        transition: height 200ms ease-out,
                    opacity 200ms ease-out;
    }
    #cookies-policy .cookies__customize {
        padding-top: 0.4em;
    }
    #cookies-policy .cookies__section + .cookies__section {
        border-top: 1px solid #eee;
    }
    #cookies-policy .cookies__category,
    #cookies-policy .cookies__box {
        display: block;
        position: relative;
        overflow: hidden;
    }
    #cookies-policy .cookies__category input {
        position: absolute;
        display: block;
        top: 0;
        right: 105%;
        padding: 0;
        margin: 0;
    }
    #cookies-policy .cookies__box {
        padding: 1em 3em 1em 0;
        line-height: 1.4em;
        cursor: pointer;
    }
    #cookies-policy .cookies__box:before,
    #cookies-policy .cookies__box:after {
        content: '';
        display: block;
        position: absolute;
        top: 50%;
        border-radius: 1.4em;
    }
    #cookies-policy .cookies__box:after {
        right: 0;
        width: 2.5em;
        height: 1.4em;
        margin-top: -0.7em;
        background: #ddd;
        z-index: 0;
        transition: background 200ms ease-out;
    }
    #cookies-policy .cookies__box:before {
        right: 0.75em;
        width: 1em;
        height: 1em;
        margin-top: -0.5em;
        background: #fff;
        z-index: 1;
        transform: translateX(-0.55em);
        transition: transform 200ms ease-out;
    }
    #cookies-policy .cookies__category input:checked + .cookies__box:after {
        background: #A5CF60;
    }
    #cookies-policy .cookies__category input:checked + .cookies__box:before {
        transform: translateX(0.55em);
    }
    #cookies-policy .cookies__label {
        font-weight: bold;
        color: #233232;
    }
    #cookies-policy .cookies__details {
        color: #676767;
        transition: color 200ms ease-out;
    }
    #cookies-policy .cookies__details:hover,
    #cookies-policy .cookies__details:focus {
        color: #135868;
    }
    #cookies-policy .cookies__definitions {
        font-size: 0.875em;
        line-height: 1.2em;
        padding-bottom: 1.6em;
        color: #676767;
    }
    #cookies-policy .cookies__cookie {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }
    #cookies-policy .cookies__cookie + .cookies__cookie {
        margin-top: 1em;
    }
    #cookies-policy .cookies__name {
        display: block;
        flex-grow: 1;
        flex-shrink: 0;
        text-align: left;
        font-weight: bold;
        color: #676767;
    }
    #cookies-policy .cookies__duration {
        display: block;
        flex-grow: 0;
        flex-shrink: 0;
        text-align: right;
        font-style: italic;
    }
    #cookies-policy .cookies__description {
        display: block;
        width: 100%;
        flex-grow: 0;
        flex-shrink: 0;
        text-align: left;
    }
    #cookies-policy .cookies__save {
        margin-top: 0.4em;
        display: flex;
        justify-content: flex-end;
    }
</style>