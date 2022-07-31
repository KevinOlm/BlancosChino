class Images {
    constructor() {
        this.images = document.querySelectorAll('.image');//All images
    }

    imageResize(image) {
        image.classList.toggle('imgVertical');
        image.classList.toggle('imgHorizontal');
    }
}

(() => {
    window.addEventListener('load', () => {

        const images = new Images;

        images.images.forEach(element => {
            if (element.offsetHeight < element.parentElement.offsetHeight) {
                images.imageResize(element);
            }
        });

        window.addEventListener("resize", () => {
            images.images.forEach(element => {
                if(element.classList.contains('imgVertical')) {
                    if(element.offsetWidth < element.parentElement.offsetWidth) {
                        images.imageResize(element);
                    }
                }
                else {
                    if (element.offsetHeight < element.parentElement.offsetHeight) {
                        images.imageResize(element);
                    }
                }
            });
        });

        Livewire.on('resize', () => {
            images.images.forEach(element => {
                if (element.offsetHeight < element.parentElement.offsetHeight) {
                    images.imageResize(element);
                }
            });
        });

        Livewire.on('fixedResize', () => {
            const fixedImageResize = setInterval(() => {
                const fixedImages = document.querySelectorAll('.fixedImage');
                if(!fixedImages) clearInterval(fixedImageResize);
                else {
                    let endResize = true;
                    fixedImages.forEach(element => {
                        if(element.offsetWidth <= 0) endResize = false;
                        else {
                            if(element.offsetWidth > element.offsetHeight) element.classList.add('imgVertical');
                            else element.classList.add('imgHorizontal');
                        }
                    });
                    if(endResize) clearInterval(fixedImageResize);
                }
            }, 10);
        });
    });
})();