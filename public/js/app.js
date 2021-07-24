/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed (from ./node_modules/babel-loader/lib/index.js):\nSyntaxError: /Applications/MAMP/htdocs/cryptotrend-s/resources/js/app.js: Identifier 'coinapp' has already been declared. (37:10)\n\n\u001b[0m \u001b[90m 35 |\u001b[39m     \u001b[36mconst\u001b[39m newsapp \u001b[33m=\u001b[39m \u001b[36mnew\u001b[39m \u001b[33mVue\u001b[39m({el\u001b[33m:\u001b[39m \u001b[32m'#newsapp'\u001b[39m\u001b[33m,\u001b[39m})\u001b[0m\n\u001b[0m \u001b[90m 36 |\u001b[39m     \u001b[36mconst\u001b[39m coinapp \u001b[33m=\u001b[39m \u001b[36mnew\u001b[39m \u001b[33mVue\u001b[39m({el\u001b[33m:\u001b[39m \u001b[32m'#coinsapp'\u001b[39m\u001b[33m,\u001b[39m})\u001b[0m\n\u001b[0m\u001b[31m\u001b[1m>\u001b[22m\u001b[39m\u001b[90m 37 |\u001b[39m     \u001b[36mconst\u001b[39m coinapp \u001b[33m=\u001b[39m \u001b[36mnew\u001b[39m \u001b[33mVue\u001b[39m({el\u001b[33m:\u001b[39m \u001b[32m'#followsapp'\u001b[39m\u001b[33m,\u001b[39m})\u001b[0m\n\u001b[0m \u001b[90m    |\u001b[39m           \u001b[31m\u001b[1m^\u001b[22m\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 38 |\u001b[39m   })\u001b[33m;\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 39 |\u001b[39m\u001b[0m\n    at Parser._raise (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:816:17)\n    at Parser.raiseWithData (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:809:17)\n    at Parser.raise (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:770:17)\n    at ScopeHandler.checkRedeclarationInScope (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:1432:12)\n    at ScopeHandler.declareName (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:1398:12)\n    at Parser.checkLVal (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:10422:24)\n    at Parser.parseVarId (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:13228:10)\n    at Parser.parseVar (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:13203:12)\n    at Parser.parseVarStatement (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:13020:10)\n    at Parser.parseStatementContent (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:12603:21)\n    at Parser.parseStatement (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:12536:17)\n    at Parser.parseBlockOrModuleBlockBody (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:13125:25)\n    at Parser.parseBlockBody (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:13116:10)\n    at Parser.parseBlock (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:13100:10)\n    at Parser.parseFunctionBody (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:11983:24)\n    at Parser.parseFunctionBodyAndFinish (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:11967:10)\n    at /Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:13258:12\n    at Parser.withTopicForbiddingContext (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:12305:14)\n    at Parser.parseFunction (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:13257:10)\n    at Parser.parseFunctionOrFunctionSent (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:11391:17)\n    at Parser.parseExprAtom (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:11217:21)\n    at Parser.parseExprSubscripts (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:10869:23)\n    at Parser.parseUpdate (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:10849:21)\n    at Parser.parseMaybeUnary (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:10827:23)\n    at Parser.parseExprOps (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:10684:23)\n    at Parser.parseMaybeConditional (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:10658:23)\n    at Parser.parseMaybeAssign (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:10621:21)\n    at /Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:10589:39\n    at Parser.allowInAnd (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:12336:12)\n    at Parser.parseMaybeAssignAllowIn (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:10589:17)\n    at Parser.parseExprListItem (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:12070:18)\n    at Parser.parseCallExpressionArguments (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:11073:22)\n    at Parser.parseCoverCallAndAsyncArrowHead (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:10980:29)\n    at Parser.parseSubscript (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:10913:19)\n    at Parser.parseSubscripts (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:10886:19)\n    at Parser.parseExprSubscripts (/Applications/MAMP/htdocs/cryptotrend-s/node_modules/@babel/parser/lib/index.js:10875:17)");

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Applications/MAMP/htdocs/cryptotrend-s/resources/js/app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/cryptotrend-s/resources/sass/app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });