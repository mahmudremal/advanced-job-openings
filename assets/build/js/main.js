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
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./advanced-job-openings/assets/src/icons/certificate.svg":
/*!****************************************************************!*\
  !*** ./advanced-job-openings/assets/src/icons/certificate.svg ***!
  \****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("../../icons/certificate.svg");

/***/ }),

/***/ "./advanced-job-openings/assets/src/icons/check.svg":
/*!**********************************************************!*\
  !*** ./advanced-job-openings/assets/src/icons/check.svg ***!
  \**********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("../../icons/check.svg");

/***/ }),

/***/ "./advanced-job-openings/assets/src/icons/clock.svg":
/*!**********************************************************!*\
  !*** ./advanced-job-openings/assets/src/icons/clock.svg ***!
  \**********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("../../icons/clock.svg");

/***/ }),

/***/ "./advanced-job-openings/assets/src/icons/controls.svg":
/*!*************************************************************!*\
  !*** ./advanced-job-openings/assets/src/icons/controls.svg ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("../../icons/controls.svg");

/***/ }),

/***/ "./advanced-job-openings/assets/src/icons/cross.svg":
/*!**********************************************************!*\
  !*** ./advanced-job-openings/assets/src/icons/cross.svg ***!
  \**********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("../../icons/cross.svg");

/***/ }),

/***/ "./advanced-job-openings/assets/src/icons/empty-postbox.svg":
/*!******************************************************************!*\
  !*** ./advanced-job-openings/assets/src/icons/empty-postbox.svg ***!
  \******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("../../icons/empty-postbox.svg");

/***/ }),

/***/ "./advanced-job-openings/assets/src/icons/eye-open.svg":
/*!*************************************************************!*\
  !*** ./advanced-job-openings/assets/src/icons/eye-open.svg ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("../../icons/eye-open.svg");

/***/ }),

/***/ "./advanced-job-openings/assets/src/icons/gender.svg":
/*!***********************************************************!*\
  !*** ./advanced-job-openings/assets/src/icons/gender.svg ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("../../icons/gender.svg");

/***/ }),

/***/ "./advanced-job-openings/assets/src/icons/graduate-cap.svg":
/*!*****************************************************************!*\
  !*** ./advanced-job-openings/assets/src/icons/graduate-cap.svg ***!
  \*****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("../../icons/graduate-cap.svg");

/***/ }),

/***/ "./advanced-job-openings/assets/src/icons/line-chart.svg":
/*!***************************************************************!*\
  !*** ./advanced-job-openings/assets/src/icons/line-chart.svg ***!
  \***************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("../../icons/line-chart.svg");

/***/ }),

/***/ "./advanced-job-openings/assets/src/icons/location-pin.svg":
/*!*****************************************************************!*\
  !*** ./advanced-job-openings/assets/src/icons/location-pin.svg ***!
  \*****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("../../icons/location-pin.svg");

/***/ }),

/***/ "./advanced-job-openings/assets/src/icons/man-in-office-desk-with-computer.svg":
/*!*************************************************************************************!*\
  !*** ./advanced-job-openings/assets/src/icons/man-in-office-desk-with-computer.svg ***!
  \*************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("../../icons/man-in-office-desk-with-computer.svg");

/***/ }),

/***/ "./advanced-job-openings/assets/src/icons/mansion.svg":
/*!************************************************************!*\
  !*** ./advanced-job-openings/assets/src/icons/mansion.svg ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("../../icons/mansion.svg");

/***/ }),

/***/ "./advanced-job-openings/assets/src/icons/money-cash.svg":
/*!***************************************************************!*\
  !*** ./advanced-job-openings/assets/src/icons/money-cash.svg ***!
  \***************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("../../icons/money-cash.svg");

/***/ }),

/***/ "./advanced-job-openings/assets/src/icons/nill-frawn.svg":
/*!***************************************************************!*\
  !*** ./advanced-job-openings/assets/src/icons/nill-frawn.svg ***!
  \***************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("../../icons/nill-frawn.svg");

/***/ }),

/***/ "./advanced-job-openings/assets/src/icons/notification.svg":
/*!*****************************************************************!*\
  !*** ./advanced-job-openings/assets/src/icons/notification.svg ***!
  \*****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("../../icons/notification.svg");

/***/ }),

/***/ "./advanced-job-openings/assets/src/icons/resume.svg":
/*!***********************************************************!*\
  !*** ./advanced-job-openings/assets/src/icons/resume.svg ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("../../icons/resume.svg");

/***/ }),

/***/ "./advanced-job-openings/assets/src/icons/right-arrow.svg":
/*!****************************************************************!*\
  !*** ./advanced-job-openings/assets/src/icons/right-arrow.svg ***!
  \****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("../../icons/right-arrow.svg");

/***/ }),

/***/ "./advanced-job-openings/assets/src/icons/star-fill.svg":
/*!**************************************************************!*\
  !*** ./advanced-job-openings/assets/src/icons/star-fill.svg ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("../../icons/star-fill.svg");

/***/ }),

/***/ "./advanced-job-openings/assets/src/icons/star-o.svg":
/*!***********************************************************!*\
  !*** ./advanced-job-openings/assets/src/icons/star-o.svg ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("../../icons/star-o.svg");

/***/ }),

/***/ "./advanced-job-openings/assets/src/img/cat.jpg":
/*!******************************************************!*\
  !*** ./advanced-job-openings/assets/src/img/cat.jpg ***!
  \******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("../../images/cat.jpg");

/***/ }),

/***/ "./advanced-job-openings/assets/src/img/cats.jpg":
/*!*******************************************************!*\
  !*** ./advanced-job-openings/assets/src/img/cats.jpg ***!
  \*******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("../../images/cats.jpg");

/***/ }),

/***/ "./advanced-job-openings/assets/src/img/patterns/cover.jpg":
/*!*****************************************************************!*\
  !*** ./advanced-job-openings/assets/src/img/patterns/cover.jpg ***!
  \*****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("../../images/cover.jpg");

/***/ }),

/***/ "./advanced-job-openings/assets/src/img/placeholder.png":
/*!**************************************************************!*\
  !*** ./advanced-job-openings/assets/src/img/placeholder.png ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("../../images/placeholder.png");

/***/ }),

/***/ "./advanced-job-openings/assets/src/js/frontend/index.js":
/*!***************************************************************!*\
  !*** ./advanced-job-openings/assets/src/js/frontend/index.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

(function ($) {
  /**
   * Class Frontend Main JS.
   */
  var FUTUREWORDPRESS_PROJECT_FROTEND_MAIN = /*#__PURE__*/function () {
    /**
     * Contructor.
     */
    function FUTUREWORDPRESS_PROJECT_FROTEND_MAIN() {
      var _siteConfig$ajaxUrl, _siteConfig, _siteConfig$ajax_nonc, _siteConfig2, _siteConfig$confirmde, _siteConfig3, _siteConfig$confirmde2, _siteConfig4, _siteConfig$confirmde3, _siteConfig5;

      _classCallCheck(this, FUTUREWORDPRESS_PROJECT_FROTEND_MAIN);

      this.ajaxUrl = (_siteConfig$ajaxUrl = (_siteConfig = siteConfig) === null || _siteConfig === void 0 ? void 0 : _siteConfig.ajaxUrl) !== null && _siteConfig$ajaxUrl !== void 0 ? _siteConfig$ajaxUrl : '/wp-admin/admin-ajax.php';
      this.ajaxNonce = (_siteConfig$ajax_nonc = (_siteConfig2 = siteConfig) === null || _siteConfig2 === void 0 ? void 0 : _siteConfig2.ajax_nonce) !== null && _siteConfig$ajax_nonc !== void 0 ? _siteConfig$ajax_nonc : '';
      this.confirmDeleteCV = (_siteConfig$confirmde = (_siteConfig3 = siteConfig) === null || _siteConfig3 === void 0 ? void 0 : _siteConfig3.confirmdeletecv) !== null && _siteConfig$confirmde !== void 0 ? _siteConfig$confirmde : 'Are you sure you want to delete Your CV? This can\'t be undo.';
      this.confirmDeleteApply = (_siteConfig$confirmde2 = (_siteConfig4 = siteConfig) === null || _siteConfig4 === void 0 ? void 0 : _siteConfig4.confirmdeleteapply) !== null && _siteConfig$confirmde2 !== void 0 ? _siteConfig$confirmde2 : 'Are you sure you want to delete Your Application? This can\'t be undo.';
      this.confirmDeleteJob = (_siteConfig$confirmde3 = (_siteConfig5 = siteConfig) === null || _siteConfig5 === void 0 ? void 0 : _siteConfig5.confirmdeletejob) !== null && _siteConfig$confirmde3 !== void 0 ? _siteConfig$confirmde3 : 'Are you sure you want to delete Your Application? This can\'t be undo.';
      this.loadMoreBtn = $('#load-more');
      this.loadingTextEl = $('#loading-text');
      this.isRequestProcessing = false;
      this.init(); // this.preload();this.scroll();
      // this.according();this.progress();
    }

    _createClass(FUTUREWORDPRESS_PROJECT_FROTEND_MAIN, [{
      key: "init",
      value: function init() {
        this.cv_add();
        this.cv_edit();
        this.cv_delete();
        this.apply_delete();
        this.job_delete();
        this.job_mark();
        this.dataTable();
        this.see_more();
      }
    }, {
      key: "cv_add",
      value: function cv_add() {
        var thisClass = this;

        if (!window.fwp_form_CV_ADD) {
          return;
        }

        var form = window.fwp_form_CV_ADD,
            name = form.name.value,
            file = form.file;
        file.addEventListener('change', function (e) {
          var formData = new FormData();

          if (form.file.dataset.id) {
            formData.append('edit-cv', form.file.dataset.id);
          }

          formData.append('action', 'fwp-candidate-add-cv-action');
          formData.append('name', form.name.value);
          formData.append('file', $(form.file)[0].files[0]);
          formData.append('_nonce', thisClass.ajaxNonce);
          $.ajax({
            url: thisClass.ajaxUrl,
            type: 'POST',
            data: formData,
            processData: false,
            // tell jQuery not to process the data
            contentType: false,
            // tell jQuery not to set contentType
            dataType: "json",
            success: function success(data) {
              if (data.success) {
                location.reload();
              } else {
                console.log(data);
              }
            }
          });
        });
      }
    }, {
      key: "cv_edit",
      value: function cv_edit() {
        document.querySelectorAll('.edit-cv-fwp').forEach(function (e, i) {
          e.addEventListener('click', function (event) {
            var id = this.dataset.id ? this.dataset.id : false;
            var name = this.dataset.name ? this.dataset.name : '';

            if (id) {
              window.fwp_form_CV_ADD.file.dataset.id = id;
              window.fwp_form_CV_ADD.name.value = name;
              window.fwp_form_CV_ADD.file.click();
            }
          });
        });
      }
    }, {
      key: "cv_delete",
      value: function cv_delete() {
        var thisClass = this;
        document.querySelectorAll('.delete-cv-fwp').forEach(function (e, i) {
          e.addEventListener('click', function (event) {
            var id = this.dataset.id ? this.dataset.id : false;
            var name = this.dataset.name ? this.dataset.name : '';

            if (id && confirm(thisClass.confirmDeleteCV)) {
              var data = {
                action: 'fwp-candidate-delete-cv-action',
                id: id,
                _nonce: thisClass.ajaxNonce
              };

              if (this.dataset.isCompany) {
                data.isCompany = this.dataset.isCompany;
                data.action = 'fwp-company-delete-application-action';
              }

              console.log(data);
              $.ajax({
                url: thisClass.ajaxUrl,
                type: 'POST',
                data: data,
                // processData: false,
                // contentType: false,
                dataType: "json",
                success: function success(data) {
                  if (data.success) {
                    location.reload();
                  } else {
                    console.log(data);
                  }
                }
              });
            }
          });
        });
      }
    }, {
      key: "apply_delete",
      value: function apply_delete() {
        var thisClass = this;
        document.querySelectorAll('.delete-application-fwp').forEach(function (e, i) {
          e.addEventListener('click', function (event) {
            var id = this.dataset.id ? this.dataset.id : false;
            var name = this.dataset.name ? this.dataset.name : '';

            if (id && confirm(thisClass.confirmDeleteApply)) {
              var data = {
                action: 'fwp-candidate-delete-application-action',
                id: id,
                _nonce: thisClass.ajaxNonce
              };
              console.log(data);
              $.ajax({
                url: thisClass.ajaxUrl,
                type: 'POST',
                data: data,
                // processData: false,
                // contentType: false,
                dataType: "json",
                success: function success(data) {
                  if (data.success) {
                    location.reload();
                  } else {
                    console.log(data);
                  }
                }
              });
            }
          });
        });
      }
    }, {
      key: "job_delete",
      value: function job_delete() {
        var thisClass = this;
        document.querySelectorAll('.delete-job-fwp').forEach(function (e, i) {
          e.addEventListener('click', function (event) {
            var id = this.dataset.id ? this.dataset.id : false;
            var nonce = this.dataset.nonce ? this.dataset.nonce : '';

            if (id && confirm(thisClass.confirmDeleteJob)) {
              var data = {
                action: 'fwp-company-delete-job-action',
                job: id,
                'fwp-company-delete-job-action': nonce
              };
              console.log(data);
              $.ajax({
                url: thisClass.ajaxUrl,
                type: 'POST',
                data: data,
                // processData: false,
                // contentType: false,
                dataType: "json",
                success: function success(data) {
                  if (data.success) {
                    location.reload();
                  } else {
                    console.log(data);
                  }
                }
              });
            }
          });
        });
      }
    }, {
      key: "job_mark",
      value: function job_mark() {
        var thisClass = this;
        document.querySelectorAll('.mark-job-fwp').forEach(function (e, i) {
          e.addEventListener('click', function (event) {
            var id = this.dataset.id ? this.dataset.id : false;
            var markas = this.dataset.markas ? this.dataset.markas : '';
            var nonce = this.dataset.nonce ? this.dataset.nonce : '';
            var user_id = this.dataset.user_id ? this.dataset.user_id : '';
            var job_id = this.dataset.job_id ? this.dataset.job_id : '';
            var cv_id = this.dataset.cv_id ? this.dataset.cv_id : '';

            if (id && confirm('Are you sure to ' + (markas == 'approved' ? 'Approved' : markas == 'paid' ? 'Paid' : 'Proceed') + '?')) {
              var data = {
                action: 'fwp-company-approve-job-action',
                markas: markas,
                id: id,
                'fwp-company-approve-job-action': nonce,
                user_id: user_id,
                job_id: job_id,
                cv_id: cv_id
              };
              $.ajax({
                url: thisClass.ajaxUrl,
                type: 'POST',
                data: data,
                // processData: false,
                // contentType: false,
                dataType: "json",
                success: function success(data) {
                  if (data.success) {
                    location.reload();
                  } else {
                    console.log(data);
                  }
                }
              });
            }
          });
        });
      }
    }, {
      key: "dataTable",
      value: function dataTable() {
        var thisClass = this;
        document.querySelectorAll('.fwp-datatable').forEach(function (e, i) {
          $(e).DataTable();
        });
      }
    }, {
      key: "see_more",
      value: function see_more() {
        var thisClass = this;
        document.querySelectorAll('.fwp-see-more').forEach(function (e, i) {
          e.addEventListener('click', function (event) {
            var text = this.dataset.text ? this.dataset.text : '';
            var textarget = this.dataset.textarget ? this.dataset.textarget : '';

            if (text != '' && document.querySelector(textarget)) {
              document.querySelector(textarget).innerHTML = text;
            } else {
              if (document.querySelector(textarget)) {
                document.querySelector(textarget).innerHTML = '';
              }
            }
          });
        });
      }
    }, {
      key: "preload",
      value: function preload() {
        if ($('.preloader').length) {
          $('.preloader').delay(200).fadeOut(300);
        }

        $(".preloader_disabler").on('click', function () {
          $("#preloader").hide();
        });
      }
    }, {
      key: "scroll",
      value: function scroll() {
        $(window).scroll(function () {
          if ($(this).scrollTop() > 600) {
            $('.scrollToHome').fadeIn();
          } else {
            $('.scrollToHome').fadeOut();
          }
        });
        $('.scrollToHome').on('click', function () {
          $('html, body').animate({
            scrollTop: 0
          }, 800);
          return false;
        });
      }
    }, {
      key: "according",
      value: function according() {
        $(document).on('ready', function () {
          $('.collapse').on('show.bs.collapse', function () {
            $(this).siblings('.card-header').addClass('active');
          });
          $('.collapse').on('hide.bs.collapse', function () {
            $(this).siblings('.card-header').removeClass('active');
          });
          $(function () {
            $('[data-toggle="tooltip"]').tooltip();
          });
        });
      }
    }, {
      key: "progress",
      value: function progress() {
        if ($('.progress-levels .progress-box .bar-fill').length) {
          $(".progress-box .bar-fill").each(function () {
            var progressWidth = $(this).attr('data-percent');
            $(this).css('width', progressWidth + '%');
            $(this).children('.percent').html(progressWidth + '%');
          });
        }
      }
    }, {
      key: "handleLoadMorePosts",
      value: function handleLoadMorePosts() {
        var _this = this;

        var page = this.loadMoreBtn.data('page');

        if (!page || this.isRequestProcessing) {
          return null;
        }

        var nextPage = parseInt(page) + 1;
        this.isRequestProcessing = true;
        $.ajax({
          url: this.ajaxUrl,
          type: 'post',
          data: {
            page: page,
            action: 'load_more',
            ajax_nonce: this.ajaxNonce
          },
          success: function success(response) {
            _this.loadMoreBtn.data('page', nextPage);

            $('#load-more-content').append(response);

            _this.removeLoadMoreIfOnLastPage(nextPage);

            _this.isRequestProcessing = false;
          },
          error: function error(response) {
            console.log(response);
            _this.isRequestProcessing = false;
          }
        });
      }
      /**
       * Remove Load more Button If on last page.
       *
       * @param {int} nextPage New Page.
       */

    }, {
      key: "removeLoadMoreIfOnLastPage",
      value: function removeLoadMoreIfOnLastPage(nextPage) {
        if (nextPage + 1 > this.totalPagesCount) {
          this.loadMoreBtn.remove();
        }
      }
    }]);

    return FUTUREWORDPRESS_PROJECT_FROTEND_MAIN;
  }();

  new FUTUREWORDPRESS_PROJECT_FROTEND_MAIN();
})(jQuery);

/***/ }),

/***/ "./advanced-job-openings/assets/src/js/main.js":
/*!*****************************************************!*\
  !*** ./advanced-job-openings/assets/src/js/main.js ***!
  \*****************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _frontend__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./frontend */ "./advanced-job-openings/assets/src/js/frontend/index.js");
/* harmony import */ var _frontend__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_frontend__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _sass_invoice_scss__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../sass/invoice.scss */ "./advanced-job-openings/assets/src/sass/invoice.scss");
/* harmony import */ var _sass_invoice_scss__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_sass_invoice_scss__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _img_cat_jpg__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../img/cat.jpg */ "./advanced-job-openings/assets/src/img/cat.jpg");
/* harmony import */ var _img_cats_jpg__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../img/cats.jpg */ "./advanced-job-openings/assets/src/img/cats.jpg");
/* harmony import */ var _img_placeholder_png__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../img/placeholder.png */ "./advanced-job-openings/assets/src/img/placeholder.png");
/* harmony import */ var _img_patterns_cover_jpg__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../img/patterns/cover.jpg */ "./advanced-job-openings/assets/src/img/patterns/cover.jpg");
/* harmony import */ var _icons_certificate_svg__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../icons/certificate.svg */ "./advanced-job-openings/assets/src/icons/certificate.svg");
/* harmony import */ var _icons_check_svg__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../icons/check.svg */ "./advanced-job-openings/assets/src/icons/check.svg");
/* harmony import */ var _icons_clock_svg__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../icons/clock.svg */ "./advanced-job-openings/assets/src/icons/clock.svg");
/* harmony import */ var _icons_controls_svg__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ../icons/controls.svg */ "./advanced-job-openings/assets/src/icons/controls.svg");
/* harmony import */ var _icons_cross_svg__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ../icons/cross.svg */ "./advanced-job-openings/assets/src/icons/cross.svg");
/* harmony import */ var _icons_empty_postbox_svg__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ../icons/empty-postbox.svg */ "./advanced-job-openings/assets/src/icons/empty-postbox.svg");
/* harmony import */ var _icons_eye_open_svg__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ../icons/eye-open.svg */ "./advanced-job-openings/assets/src/icons/eye-open.svg");
/* harmony import */ var _icons_gender_svg__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! ../icons/gender.svg */ "./advanced-job-openings/assets/src/icons/gender.svg");
/* harmony import */ var _icons_graduate_cap_svg__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! ../icons/graduate-cap.svg */ "./advanced-job-openings/assets/src/icons/graduate-cap.svg");
/* harmony import */ var _icons_line_chart_svg__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! ../icons/line-chart.svg */ "./advanced-job-openings/assets/src/icons/line-chart.svg");
/* harmony import */ var _icons_location_pin_svg__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! ../icons/location-pin.svg */ "./advanced-job-openings/assets/src/icons/location-pin.svg");
/* harmony import */ var _icons_man_in_office_desk_with_computer_svg__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! ../icons/man-in-office-desk-with-computer.svg */ "./advanced-job-openings/assets/src/icons/man-in-office-desk-with-computer.svg");
/* harmony import */ var _icons_mansion_svg__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(/*! ../icons/mansion.svg */ "./advanced-job-openings/assets/src/icons/mansion.svg");
/* harmony import */ var _icons_money_cash_svg__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(/*! ../icons/money-cash.svg */ "./advanced-job-openings/assets/src/icons/money-cash.svg");
/* harmony import */ var _icons_nill_frawn_svg__WEBPACK_IMPORTED_MODULE_20__ = __webpack_require__(/*! ../icons/nill-frawn.svg */ "./advanced-job-openings/assets/src/icons/nill-frawn.svg");
/* harmony import */ var _icons_notification_svg__WEBPACK_IMPORTED_MODULE_21__ = __webpack_require__(/*! ../icons/notification.svg */ "./advanced-job-openings/assets/src/icons/notification.svg");
/* harmony import */ var _icons_resume_svg__WEBPACK_IMPORTED_MODULE_22__ = __webpack_require__(/*! ../icons/resume.svg */ "./advanced-job-openings/assets/src/icons/resume.svg");
/* harmony import */ var _icons_right_arrow_svg__WEBPACK_IMPORTED_MODULE_23__ = __webpack_require__(/*! ../icons/right-arrow.svg */ "./advanced-job-openings/assets/src/icons/right-arrow.svg");
/* harmony import */ var _icons_star_fill_svg__WEBPACK_IMPORTED_MODULE_24__ = __webpack_require__(/*! ../icons/star-fill.svg */ "./advanced-job-openings/assets/src/icons/star-fill.svg");
/* harmony import */ var _icons_star_o_svg__WEBPACK_IMPORTED_MODULE_25__ = __webpack_require__(/*! ../icons/star-o.svg */ "./advanced-job-openings/assets/src/icons/star-o.svg");
 // import './carousel';
// import './posts/loadmore';
// // Styles
// import '../sass/frontend.scss';

 // // Images.


























/***/ }),

/***/ "./advanced-job-openings/assets/src/sass/invoice.scss":
/*!************************************************************!*\
  !*** ./advanced-job-openings/assets/src/sass/invoice.scss ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin

/***/ }),

/***/ "./node_modules/regenerator-runtime/runtime.js":
/*!*****************************************************!*\
  !*** ./node_modules/regenerator-runtime/runtime.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * Copyright (c) 2014-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

var runtime = (function (exports) {
  "use strict";

  var Op = Object.prototype;
  var hasOwn = Op.hasOwnProperty;
  var undefined; // More compressible than void 0.
  var $Symbol = typeof Symbol === "function" ? Symbol : {};
  var iteratorSymbol = $Symbol.iterator || "@@iterator";
  var asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator";
  var toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag";

  function define(obj, key, value) {
    Object.defineProperty(obj, key, {
      value: value,
      enumerable: true,
      configurable: true,
      writable: true
    });
    return obj[key];
  }
  try {
    // IE 8 has a broken Object.defineProperty that only works on DOM objects.
    define({}, "");
  } catch (err) {
    define = function(obj, key, value) {
      return obj[key] = value;
    };
  }

  function wrap(innerFn, outerFn, self, tryLocsList) {
    // If outerFn provided and outerFn.prototype is a Generator, then outerFn.prototype instanceof Generator.
    var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator;
    var generator = Object.create(protoGenerator.prototype);
    var context = new Context(tryLocsList || []);

    // The ._invoke method unifies the implementations of the .next,
    // .throw, and .return methods.
    generator._invoke = makeInvokeMethod(innerFn, self, context);

    return generator;
  }
  exports.wrap = wrap;

  // Try/catch helper to minimize deoptimizations. Returns a completion
  // record like context.tryEntries[i].completion. This interface could
  // have been (and was previously) designed to take a closure to be
  // invoked without arguments, but in all the cases we care about we
  // already have an existing method we want to call, so there's no need
  // to create a new function object. We can even get away with assuming
  // the method takes exactly one argument, since that happens to be true
  // in every case, so we don't have to touch the arguments object. The
  // only additional allocation required is the completion record, which
  // has a stable shape and so hopefully should be cheap to allocate.
  function tryCatch(fn, obj, arg) {
    try {
      return { type: "normal", arg: fn.call(obj, arg) };
    } catch (err) {
      return { type: "throw", arg: err };
    }
  }

  var GenStateSuspendedStart = "suspendedStart";
  var GenStateSuspendedYield = "suspendedYield";
  var GenStateExecuting = "executing";
  var GenStateCompleted = "completed";

  // Returning this object from the innerFn has the same effect as
  // breaking out of the dispatch switch statement.
  var ContinueSentinel = {};

  // Dummy constructor functions that we use as the .constructor and
  // .constructor.prototype properties for functions that return Generator
  // objects. For full spec compliance, you may wish to configure your
  // minifier not to mangle the names of these two functions.
  function Generator() {}
  function GeneratorFunction() {}
  function GeneratorFunctionPrototype() {}

  // This is a polyfill for %IteratorPrototype% for environments that
  // don't natively support it.
  var IteratorPrototype = {};
  define(IteratorPrototype, iteratorSymbol, function () {
    return this;
  });

  var getProto = Object.getPrototypeOf;
  var NativeIteratorPrototype = getProto && getProto(getProto(values([])));
  if (NativeIteratorPrototype &&
      NativeIteratorPrototype !== Op &&
      hasOwn.call(NativeIteratorPrototype, iteratorSymbol)) {
    // This environment has a native %IteratorPrototype%; use it instead
    // of the polyfill.
    IteratorPrototype = NativeIteratorPrototype;
  }

  var Gp = GeneratorFunctionPrototype.prototype =
    Generator.prototype = Object.create(IteratorPrototype);
  GeneratorFunction.prototype = GeneratorFunctionPrototype;
  define(Gp, "constructor", GeneratorFunctionPrototype);
  define(GeneratorFunctionPrototype, "constructor", GeneratorFunction);
  GeneratorFunction.displayName = define(
    GeneratorFunctionPrototype,
    toStringTagSymbol,
    "GeneratorFunction"
  );

  // Helper for defining the .next, .throw, and .return methods of the
  // Iterator interface in terms of a single ._invoke method.
  function defineIteratorMethods(prototype) {
    ["next", "throw", "return"].forEach(function(method) {
      define(prototype, method, function(arg) {
        return this._invoke(method, arg);
      });
    });
  }

  exports.isGeneratorFunction = function(genFun) {
    var ctor = typeof genFun === "function" && genFun.constructor;
    return ctor
      ? ctor === GeneratorFunction ||
        // For the native GeneratorFunction constructor, the best we can
        // do is to check its .name property.
        (ctor.displayName || ctor.name) === "GeneratorFunction"
      : false;
  };

  exports.mark = function(genFun) {
    if (Object.setPrototypeOf) {
      Object.setPrototypeOf(genFun, GeneratorFunctionPrototype);
    } else {
      genFun.__proto__ = GeneratorFunctionPrototype;
      define(genFun, toStringTagSymbol, "GeneratorFunction");
    }
    genFun.prototype = Object.create(Gp);
    return genFun;
  };

  // Within the body of any async function, `await x` is transformed to
  // `yield regeneratorRuntime.awrap(x)`, so that the runtime can test
  // `hasOwn.call(value, "__await")` to determine if the yielded value is
  // meant to be awaited.
  exports.awrap = function(arg) {
    return { __await: arg };
  };

  function AsyncIterator(generator, PromiseImpl) {
    function invoke(method, arg, resolve, reject) {
      var record = tryCatch(generator[method], generator, arg);
      if (record.type === "throw") {
        reject(record.arg);
      } else {
        var result = record.arg;
        var value = result.value;
        if (value &&
            typeof value === "object" &&
            hasOwn.call(value, "__await")) {
          return PromiseImpl.resolve(value.__await).then(function(value) {
            invoke("next", value, resolve, reject);
          }, function(err) {
            invoke("throw", err, resolve, reject);
          });
        }

        return PromiseImpl.resolve(value).then(function(unwrapped) {
          // When a yielded Promise is resolved, its final value becomes
          // the .value of the Promise<{value,done}> result for the
          // current iteration.
          result.value = unwrapped;
          resolve(result);
        }, function(error) {
          // If a rejected Promise was yielded, throw the rejection back
          // into the async generator function so it can be handled there.
          return invoke("throw", error, resolve, reject);
        });
      }
    }

    var previousPromise;

    function enqueue(method, arg) {
      function callInvokeWithMethodAndArg() {
        return new PromiseImpl(function(resolve, reject) {
          invoke(method, arg, resolve, reject);
        });
      }

      return previousPromise =
        // If enqueue has been called before, then we want to wait until
        // all previous Promises have been resolved before calling invoke,
        // so that results are always delivered in the correct order. If
        // enqueue has not been called before, then it is important to
        // call invoke immediately, without waiting on a callback to fire,
        // so that the async generator function has the opportunity to do
        // any necessary setup in a predictable way. This predictability
        // is why the Promise constructor synchronously invokes its
        // executor callback, and why async functions synchronously
        // execute code before the first await. Since we implement simple
        // async functions in terms of async generators, it is especially
        // important to get this right, even though it requires care.
        previousPromise ? previousPromise.then(
          callInvokeWithMethodAndArg,
          // Avoid propagating failures to Promises returned by later
          // invocations of the iterator.
          callInvokeWithMethodAndArg
        ) : callInvokeWithMethodAndArg();
    }

    // Define the unified helper method that is used to implement .next,
    // .throw, and .return (see defineIteratorMethods).
    this._invoke = enqueue;
  }

  defineIteratorMethods(AsyncIterator.prototype);
  define(AsyncIterator.prototype, asyncIteratorSymbol, function () {
    return this;
  });
  exports.AsyncIterator = AsyncIterator;

  // Note that simple async functions are implemented on top of
  // AsyncIterator objects; they just return a Promise for the value of
  // the final result produced by the iterator.
  exports.async = function(innerFn, outerFn, self, tryLocsList, PromiseImpl) {
    if (PromiseImpl === void 0) PromiseImpl = Promise;

    var iter = new AsyncIterator(
      wrap(innerFn, outerFn, self, tryLocsList),
      PromiseImpl
    );

    return exports.isGeneratorFunction(outerFn)
      ? iter // If outerFn is a generator, return the full iterator.
      : iter.next().then(function(result) {
          return result.done ? result.value : iter.next();
        });
  };

  function makeInvokeMethod(innerFn, self, context) {
    var state = GenStateSuspendedStart;

    return function invoke(method, arg) {
      if (state === GenStateExecuting) {
        throw new Error("Generator is already running");
      }

      if (state === GenStateCompleted) {
        if (method === "throw") {
          throw arg;
        }

        // Be forgiving, per 25.3.3.3.3 of the spec:
        // https://people.mozilla.org/~jorendorff/es6-draft.html#sec-generatorresume
        return doneResult();
      }

      context.method = method;
      context.arg = arg;

      while (true) {
        var delegate = context.delegate;
        if (delegate) {
          var delegateResult = maybeInvokeDelegate(delegate, context);
          if (delegateResult) {
            if (delegateResult === ContinueSentinel) continue;
            return delegateResult;
          }
        }

        if (context.method === "next") {
          // Setting context._sent for legacy support of Babel's
          // function.sent implementation.
          context.sent = context._sent = context.arg;

        } else if (context.method === "throw") {
          if (state === GenStateSuspendedStart) {
            state = GenStateCompleted;
            throw context.arg;
          }

          context.dispatchException(context.arg);

        } else if (context.method === "return") {
          context.abrupt("return", context.arg);
        }

        state = GenStateExecuting;

        var record = tryCatch(innerFn, self, context);
        if (record.type === "normal") {
          // If an exception is thrown from innerFn, we leave state ===
          // GenStateExecuting and loop back for another invocation.
          state = context.done
            ? GenStateCompleted
            : GenStateSuspendedYield;

          if (record.arg === ContinueSentinel) {
            continue;
          }

          return {
            value: record.arg,
            done: context.done
          };

        } else if (record.type === "throw") {
          state = GenStateCompleted;
          // Dispatch the exception by looping back around to the
          // context.dispatchException(context.arg) call above.
          context.method = "throw";
          context.arg = record.arg;
        }
      }
    };
  }

  // Call delegate.iterator[context.method](context.arg) and handle the
  // result, either by returning a { value, done } result from the
  // delegate iterator, or by modifying context.method and context.arg,
  // setting context.delegate to null, and returning the ContinueSentinel.
  function maybeInvokeDelegate(delegate, context) {
    var method = delegate.iterator[context.method];
    if (method === undefined) {
      // A .throw or .return when the delegate iterator has no .throw
      // method always terminates the yield* loop.
      context.delegate = null;

      if (context.method === "throw") {
        // Note: ["return"] must be used for ES3 parsing compatibility.
        if (delegate.iterator["return"]) {
          // If the delegate iterator has a return method, give it a
          // chance to clean up.
          context.method = "return";
          context.arg = undefined;
          maybeInvokeDelegate(delegate, context);

          if (context.method === "throw") {
            // If maybeInvokeDelegate(context) changed context.method from
            // "return" to "throw", let that override the TypeError below.
            return ContinueSentinel;
          }
        }

        context.method = "throw";
        context.arg = new TypeError(
          "The iterator does not provide a 'throw' method");
      }

      return ContinueSentinel;
    }

    var record = tryCatch(method, delegate.iterator, context.arg);

    if (record.type === "throw") {
      context.method = "throw";
      context.arg = record.arg;
      context.delegate = null;
      return ContinueSentinel;
    }

    var info = record.arg;

    if (! info) {
      context.method = "throw";
      context.arg = new TypeError("iterator result is not an object");
      context.delegate = null;
      return ContinueSentinel;
    }

    if (info.done) {
      // Assign the result of the finished delegate to the temporary
      // variable specified by delegate.resultName (see delegateYield).
      context[delegate.resultName] = info.value;

      // Resume execution at the desired location (see delegateYield).
      context.next = delegate.nextLoc;

      // If context.method was "throw" but the delegate handled the
      // exception, let the outer generator proceed normally. If
      // context.method was "next", forget context.arg since it has been
      // "consumed" by the delegate iterator. If context.method was
      // "return", allow the original .return call to continue in the
      // outer generator.
      if (context.method !== "return") {
        context.method = "next";
        context.arg = undefined;
      }

    } else {
      // Re-yield the result returned by the delegate method.
      return info;
    }

    // The delegate iterator is finished, so forget it and continue with
    // the outer generator.
    context.delegate = null;
    return ContinueSentinel;
  }

  // Define Generator.prototype.{next,throw,return} in terms of the
  // unified ._invoke helper method.
  defineIteratorMethods(Gp);

  define(Gp, toStringTagSymbol, "Generator");

  // A Generator should always return itself as the iterator object when the
  // @@iterator function is called on it. Some browsers' implementations of the
  // iterator prototype chain incorrectly implement this, causing the Generator
  // object to not be returned from this call. This ensures that doesn't happen.
  // See https://github.com/facebook/regenerator/issues/274 for more details.
  define(Gp, iteratorSymbol, function() {
    return this;
  });

  define(Gp, "toString", function() {
    return "[object Generator]";
  });

  function pushTryEntry(locs) {
    var entry = { tryLoc: locs[0] };

    if (1 in locs) {
      entry.catchLoc = locs[1];
    }

    if (2 in locs) {
      entry.finallyLoc = locs[2];
      entry.afterLoc = locs[3];
    }

    this.tryEntries.push(entry);
  }

  function resetTryEntry(entry) {
    var record = entry.completion || {};
    record.type = "normal";
    delete record.arg;
    entry.completion = record;
  }

  function Context(tryLocsList) {
    // The root entry object (effectively a try statement without a catch
    // or a finally block) gives us a place to store values thrown from
    // locations where there is no enclosing try statement.
    this.tryEntries = [{ tryLoc: "root" }];
    tryLocsList.forEach(pushTryEntry, this);
    this.reset(true);
  }

  exports.keys = function(object) {
    var keys = [];
    for (var key in object) {
      keys.push(key);
    }
    keys.reverse();

    // Rather than returning an object with a next method, we keep
    // things simple and return the next function itself.
    return function next() {
      while (keys.length) {
        var key = keys.pop();
        if (key in object) {
          next.value = key;
          next.done = false;
          return next;
        }
      }

      // To avoid creating an additional object, we just hang the .value
      // and .done properties off the next function object itself. This
      // also ensures that the minifier will not anonymize the function.
      next.done = true;
      return next;
    };
  };

  function values(iterable) {
    if (iterable) {
      var iteratorMethod = iterable[iteratorSymbol];
      if (iteratorMethod) {
        return iteratorMethod.call(iterable);
      }

      if (typeof iterable.next === "function") {
        return iterable;
      }

      if (!isNaN(iterable.length)) {
        var i = -1, next = function next() {
          while (++i < iterable.length) {
            if (hasOwn.call(iterable, i)) {
              next.value = iterable[i];
              next.done = false;
              return next;
            }
          }

          next.value = undefined;
          next.done = true;

          return next;
        };

        return next.next = next;
      }
    }

    // Return an iterator with no values.
    return { next: doneResult };
  }
  exports.values = values;

  function doneResult() {
    return { value: undefined, done: true };
  }

  Context.prototype = {
    constructor: Context,

    reset: function(skipTempReset) {
      this.prev = 0;
      this.next = 0;
      // Resetting context._sent for legacy support of Babel's
      // function.sent implementation.
      this.sent = this._sent = undefined;
      this.done = false;
      this.delegate = null;

      this.method = "next";
      this.arg = undefined;

      this.tryEntries.forEach(resetTryEntry);

      if (!skipTempReset) {
        for (var name in this) {
          // Not sure about the optimal order of these conditions:
          if (name.charAt(0) === "t" &&
              hasOwn.call(this, name) &&
              !isNaN(+name.slice(1))) {
            this[name] = undefined;
          }
        }
      }
    },

    stop: function() {
      this.done = true;

      var rootEntry = this.tryEntries[0];
      var rootRecord = rootEntry.completion;
      if (rootRecord.type === "throw") {
        throw rootRecord.arg;
      }

      return this.rval;
    },

    dispatchException: function(exception) {
      if (this.done) {
        throw exception;
      }

      var context = this;
      function handle(loc, caught) {
        record.type = "throw";
        record.arg = exception;
        context.next = loc;

        if (caught) {
          // If the dispatched exception was caught by a catch block,
          // then let that catch block handle the exception normally.
          context.method = "next";
          context.arg = undefined;
        }

        return !! caught;
      }

      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        var record = entry.completion;

        if (entry.tryLoc === "root") {
          // Exception thrown outside of any try block that could handle
          // it, so set the completion value of the entire function to
          // throw the exception.
          return handle("end");
        }

        if (entry.tryLoc <= this.prev) {
          var hasCatch = hasOwn.call(entry, "catchLoc");
          var hasFinally = hasOwn.call(entry, "finallyLoc");

          if (hasCatch && hasFinally) {
            if (this.prev < entry.catchLoc) {
              return handle(entry.catchLoc, true);
            } else if (this.prev < entry.finallyLoc) {
              return handle(entry.finallyLoc);
            }

          } else if (hasCatch) {
            if (this.prev < entry.catchLoc) {
              return handle(entry.catchLoc, true);
            }

          } else if (hasFinally) {
            if (this.prev < entry.finallyLoc) {
              return handle(entry.finallyLoc);
            }

          } else {
            throw new Error("try statement without catch or finally");
          }
        }
      }
    },

    abrupt: function(type, arg) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.tryLoc <= this.prev &&
            hasOwn.call(entry, "finallyLoc") &&
            this.prev < entry.finallyLoc) {
          var finallyEntry = entry;
          break;
        }
      }

      if (finallyEntry &&
          (type === "break" ||
           type === "continue") &&
          finallyEntry.tryLoc <= arg &&
          arg <= finallyEntry.finallyLoc) {
        // Ignore the finally entry if control is not jumping to a
        // location outside the try/catch block.
        finallyEntry = null;
      }

      var record = finallyEntry ? finallyEntry.completion : {};
      record.type = type;
      record.arg = arg;

      if (finallyEntry) {
        this.method = "next";
        this.next = finallyEntry.finallyLoc;
        return ContinueSentinel;
      }

      return this.complete(record);
    },

    complete: function(record, afterLoc) {
      if (record.type === "throw") {
        throw record.arg;
      }

      if (record.type === "break" ||
          record.type === "continue") {
        this.next = record.arg;
      } else if (record.type === "return") {
        this.rval = this.arg = record.arg;
        this.method = "return";
        this.next = "end";
      } else if (record.type === "normal" && afterLoc) {
        this.next = afterLoc;
      }

      return ContinueSentinel;
    },

    finish: function(finallyLoc) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.finallyLoc === finallyLoc) {
          this.complete(entry.completion, entry.afterLoc);
          resetTryEntry(entry);
          return ContinueSentinel;
        }
      }
    },

    "catch": function(tryLoc) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.tryLoc === tryLoc) {
          var record = entry.completion;
          if (record.type === "throw") {
            var thrown = record.arg;
            resetTryEntry(entry);
          }
          return thrown;
        }
      }

      // The context.catch method must only be called with a location
      // argument that corresponds to a known catch block.
      throw new Error("illegal catch attempt");
    },

    delegateYield: function(iterable, resultName, nextLoc) {
      this.delegate = {
        iterator: values(iterable),
        resultName: resultName,
        nextLoc: nextLoc
      };

      if (this.method === "next") {
        // Deliberately forget the last sent value so that we don't
        // accidentally pass it on to the delegate.
        this.arg = undefined;
      }

      return ContinueSentinel;
    }
  };

  // Regardless of whether this script is executing as a CommonJS module
  // or not, return the runtime object so that we can declare the variable
  // regeneratorRuntime in the outer scope, which allows this module to be
  // injected easily by `bin/regenerator --include-runtime script.js`.
  return exports;

}(
  // If this script is executing as a CommonJS module, use module.exports
  // as the regeneratorRuntime namespace. Otherwise create a new empty
  // object. Either way, the resulting object will be used to initialize
  // the regeneratorRuntime variable at the top of this file.
   true ? module.exports : undefined
));

try {
  regeneratorRuntime = runtime;
} catch (accidentalStrictMode) {
  // This module should not be running in strict mode, so the above
  // assignment should always work unless something is misconfigured. Just
  // in case runtime.js accidentally runs in strict mode, in modern engines
  // we can explicitly access globalThis. In older engines we can escape
  // strict mode using a global Function call. This could conceivably fail
  // if a Content Security Policy forbids using Function, but in that case
  // the proper solution is to fix the accidental strict mode problem. If
  // you've misconfigured your bundler to force strict mode and applied a
  // CSP to forbid Function, and you're not willing to fix either of those
  // problems, please detail your unique predicament in a GitHub issue.
  if (typeof globalThis === "object") {
    globalThis.regeneratorRuntime = runtime;
  } else {
    Function("r", "regeneratorRuntime = r")(runtime);
  }
}


/***/ }),

/***/ 0:
/*!******************************************************************************************!*\
  !*** multi regenerator-runtime/runtime.js ./advanced-job-openings/assets/src/js/main.js ***!
  \******************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! regenerator-runtime/runtime.js */"./node_modules/regenerator-runtime/runtime.js");
module.exports = __webpack_require__(/*! C:\xampp\htdocs\crx-download\advanced-job-openings\assets\src\js/main.js */"./advanced-job-openings/assets/src/js/main.js");


/***/ })

/******/ });
//# sourceMappingURL=main.js.map