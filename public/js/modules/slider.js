/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************!*\
  !*** ./resources/js/modules/slider.js ***!
  \****************************************/
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var Slider = /*#__PURE__*/function () {
  function Slider() {
    _classCallCheck(this, Slider);

    this.sliderContainer = document.querySelector(".sliderImages");
    this.sliderCounter = 0; //Used to chech the index of the slider image

    this.radioButtons = document.querySelectorAll('.radioButton'); //All radio buttons in the slider
  }
  /**Automatically moves the slider*/


  _createClass(Slider, [{
    key: "autoMoveSlider",
    value: function autoMoveSlider() {
      this.sliderCounter++;
      if (this.sliderCounter > 2) this.sliderCounter = 0;
      this.radioButtons[this.sliderCounter].checked = true;
    }
    /**Manually moves the slider*/

  }, {
    key: "manualMoveSlider",
    value: function manualMoveSlider(element) {
      if (element.id === "radioButton1") this.sliderCounter = 0;else if (element.id === "radioButton2") this.sliderCounter = 1;else this.sliderCounter = 2;
    }
  }, {
    key: "moveSliderWhenClick",
    value: function moveSliderWhenClick() {
      this.sliderCounter >= 2 ? this.sliderCounter = 0 : this.sliderCounter++;
      this.radioButtons[this.sliderCounter].checked = true;
    }
  }]);

  return Slider;
}();

(function () {
  window.addEventListener('load', function () {
    var slider = new Slider();
    var AutoSlider = setInterval(function () {
      slider.autoMoveSlider();
    }, 5000);
    slider.radioButtons.forEach(function (element) {
      element.addEventListener("click", function () {
        slider.manualMoveSlider(element);
        clearInterval(AutoSlider);
        AutoSlider = setInterval(function () {
          slider.autoMoveSlider();
        }, 5000);
      });
    });
    slider.sliderContainer.addEventListener('click', function () {
      slider.moveSliderWhenClick();
      clearInterval(AutoSlider);
      AutoSlider = setInterval(function () {
        slider.autoMoveSlider();
      }, 5000);
    });
  });
})();
/******/ })()
;