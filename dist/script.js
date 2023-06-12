/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/script.js":
/*!********************************!*\
  !*** ./resources/js/script.js ***!
  \********************************/
/***/ (() => {

var cookies = document.querySelector('#cookies-policy');
cookies.classList.remove('cookies--no-js');
var reset = document.querySelector('.cookiereset');
if (cookies) {
  cookies.classList.remove('cookies--no-js');
  var customize = cookies.querySelector('.cookies__btn--customize');
  var details = cookies.querySelectorAll('.cookies__details');
  var acceptAll = cookies.querySelector('.cookiesBtn--accept');
  var acceptEssentials = cookies.querySelector('.cookiesBtn--essentials');
  var configure = cookies.querySelector('.cookies__customize');
  var text = JSON.parse(cookies.getAttribute('data-text'));
  cookies.removeAttribute('data-text');
}
if (reset) {
  reset.addEventListener('submit', function (event) {
    return resetCookies(event);
  });
}
if (cookies) {
  for (var i = 0; i < details.length; i++) {
    details[i].addEventListener('click', function (event) {
      return openDetails(event);
    });
  }
  customize.addEventListener('click', function (event) {
    return toggleExpand(event, customize);
  });
  acceptAll.addEventListener('submit', function (event) {
    return acceptAllCookies(event);
  });
  acceptEssentials.addEventListener('submit', function (event) {
    return acceptEssentialsCookies(event);
  });
  configure.addEventListener('submit', function (event) {
    return configureCookies(event);
  });
}
function configureCookies(event) {
  event.preventDefault();
  var formData = new FormData(event.target);
  window.LaravelCookieConsent.configure(formData);
  close();
}
function acceptAllCookies(event) {
  event.preventDefault();
  window.LaravelCookieConsent.acceptAll();
  close();
}
function acceptEssentialsCookies(event) {
  event.preventDefault();
  window.LaravelCookieConsent.acceptEssentials();
  close();
}
function resetCookies(event) {
  event.preventDefault();
  if (document.querySelector('#cookies-policy')) return;
  window.LaravelCookieConsent.reset();
}
function openDetails(event) {
  toggleExpand(event, event.target, false);
}
function toggleExpand(event, el) {
  var hide = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : true;
  event.preventDefault();
  event.target.blur();
  var element = cookies.querySelector(el.getAttribute('href')),
    content = element.firstElementChild,
    height = content.offsetHeight,
    isOpen = element.classList.contains('cookies__expandable--open');
  element.setAttribute('style', 'height:' + (isOpen ? height : 0) + 'px');
  if (!hide) {
    event.target.textContent = isOpen ? text.more : text.less;
  }
  setTimeout(function (cookies) {
    return function () {
      cookies.firstElementChild.classList.toggle('cookies--show');
      element.classList.toggle('cookies__expandable--open');
      element.setAttribute('style', 'height:' + (isOpen ? 0 : height) + 'px');
      setTimeout(function () {
        element.removeAttribute('style');
      }, 310);
    };
  }(cookies), 10);
  if (!hide) return;
  hideNotice(isOpen);
}
function hideNotice(isOpen) {
  var container = cookies.querySelector('.cookies__container'),
    containerHeight = container.firstElementChild.offsetHeight;
  container.setAttribute('style', 'height:' + (!isOpen ? containerHeight : 0) + 'px');
  setTimeout(function (cookies) {
    return function () {
      container.classList.toggle('cookies__container--hide');
      container.setAttribute('style', 'height:' + (isOpen ? containerHeight : 0) + 'px');
      setTimeout(function () {
        container.removeAttribute('style');
      }, 310);
    };
  }(cookies), 10);
}
function close() {
  cookies.classList.add('cookies--closing');
  setTimeout(function (cookies) {
    return function () {
      var script = cookies.nextElementSibling;
      var style = script.nextElementSibling;
      cookies.parentNode.removeChild(cookies);
      script.parentNode.removeChild(script);
      style.parentNode.removeChild(style);
    };
  }(cookies), 210);
}

/***/ }),

/***/ "./resources/scss/style.scss":
/*!***********************************!*\
  !*** ./resources/scss/style.scss ***!
  \***********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/script": 0,
/******/ 			"style": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunklaravel_cookie_consent"] = self["webpackChunklaravel_cookie_consent"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["style"], () => (__webpack_require__("./resources/js/script.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["style"], () => (__webpack_require__("./resources/scss/style.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;