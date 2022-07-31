/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************************!*\
  !*** ./resources/js/modules/categoriesHome.js ***!
  \************************************************/
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var CategoriesHome = /*#__PURE__*/function () {
  function CategoriesHome() {
    _classCallCheck(this, CategoriesHome);

    this.scrollTop = document.querySelector('.scrollTop');
    this.scrollBottom = document.querySelector('.scrollBottom');
    this.categoriesContainer = document.querySelector('.categoriesContainer');
  }

  _createClass(CategoriesHome, [{
    key: "scrollHide",
    value: function scrollHide() {
      var topPosition = this.categoriesContainer.scrollTop;
      var scrollHeight = this.categoriesContainer.scrollHeight;
      var parentHeight = this.categoriesContainer.parentElement.offsetHeight;

      if (topPosition === 0) {
        this.scrollTop.style.opacity = '0%';
        this.scrollTop.style.cursor = 'default';
      } else {
        this.scrollTop.style.opacity = '100%';
        this.scrollTop.style.cursor = 'pointer';
      }

      if (topPosition + parentHeight >= scrollHeight) {
        this.scrollBottom.style.opacity = '0%';
        this.scrollBottom.style.cursor = 'default';
      } else {
        this.scrollBottom.style.opacity = '100%';
        this.scrollBottom.style.cursor = 'pointer';
      }
    }
  }]);

  return CategoriesHome;
}();

(function () {
  var categoriesHome = new CategoriesHome();
  categoriesHome.scrollHide();
  categoriesHome.scrollTop.addEventListener('click', function () {
    categoriesHome.categoriesContainer.scrollTop -= 50;
  });
  categoriesHome.scrollBottom.addEventListener('click', function () {
    categoriesHome.categoriesContainer.scrollTop += 50;
  });
  categoriesHome.categoriesContainer.addEventListener('scroll', function () {
    categoriesHome.scrollHide();
  });
})();
/******/ })()
;