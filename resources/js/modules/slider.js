class Slider {
    constructor () {
        this.sliderContainer = document.querySelector(".sliderImages");
        this.sliderCounter = 0;//Used to chech the index of the slider image
        this.radioButtons = document.querySelectorAll('.radioButton');//All radio buttons in the slider
    }

    /**Automatically moves the slider*/
    autoMoveSlider() {
        this.sliderCounter++;
        if(this.sliderCounter > 2) this.sliderCounter = 0;
        this.radioButtons[this.sliderCounter].checked = true;
    }

    /**Manually moves the slider*/
    manualMoveSlider(element) {
        if(element.id === "radioButton1") this.sliderCounter = 0;
        else if (element.id === "radioButton2") this.sliderCounter = 1;
        else this.sliderCounter = 2;
    }

    moveSliderWhenClick() {
        (this.sliderCounter >= 2)? this.sliderCounter = 0: this.sliderCounter++; 
        this.radioButtons[this.sliderCounter].checked = true;
    }
}

(() => {
    window.addEventListener('load', () => {

        const slider = new Slider;
        
        var AutoSlider = setInterval(() => {slider.autoMoveSlider()}, 5000);

        slider.radioButtons.forEach (element => {
            element.addEventListener("click", () => {
                slider.manualMoveSlider(element);
                clearInterval(AutoSlider);
                AutoSlider = setInterval(() => {slider.autoMoveSlider()}, 5000);
            });
        });

        slider.sliderContainer.addEventListener('click', () => {
            slider.moveSliderWhenClick();
            clearInterval(AutoSlider);
            AutoSlider = setInterval(() => {slider.autoMoveSlider()}, 5000);
        });
    });
})();