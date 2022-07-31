/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************!*\
  !*** ./resources/js/modules/images.js ***!
  \****************************************/
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var Images = /*#__PURE__*/function () {
  function Images() {
    _classCallCheck(this, Images);

    this.images = document.querySelectorAll('.image'); //All images
  }

  _createClass(Images, [{
    key: "imageResize",
    value: function imageResize(image) {
      image.classList.toggle('imgVertical');
      image.classList.toggle('imgHorizontal');
    }
  }]);

  return Images;
}();

(function () {
  window.addEventListener('load', function () {
    var images = new Images();
    images.images.forEach(function (element) {
      if (element.offsetHeight < element.parentElement.offsetHeight) {
        images.imageResize(element);
      }
    });
    window.addEventListener("resize", function () {
      images.images.forEach(function (element) {
        if (element.classList.contains('imgVertical')) {
          if (element.offsetWidth < element.parentElement.offsetWidth) {
            images.imageResize(element);
          }
        } else {
          if (element.offsetHeight < element.parentElement.offsetHeight) {
            images.imageResize(element);
          }
        }
      });
    });
    Livewire.on('resize', function () {
      images.images.forEach(function (element) {
        if (element.offsetHeight < element.parentElement.offsetHeight) {
          images.imageResize(element);
        }
      });
    });
    Livewire.on('fixedResize', function () {
      var fixedImageResize = setInterval(function () {
        var fixedImages = document.querySelectorAll('.fixedImage');
        if (!fixedImages) clearInterval(fixedImageResize);else {
          var endResize = true;
          fixedImages.forEach(function (element) {
            if (element.offsetWidth <= 0) endResize = false;else {
              if (element.offsetWidth > element.offsetHeight) element.classList.add('imgVertical');else element.classList.add('imgHorizontal');
            }
          });
          if (endResize) clearInterval(fixedImageResize);
        }
      }, 10);
    });
  });
})();
/******/ })()
;