class CategoriesHome {

    constructor() {
        this.scrollTop = document.querySelector('.scrollTop');
        this.scrollBottom = document.querySelector('.scrollBottom');
        this.categoriesContainer = document.querySelector('.categoriesContainer');
    }

    scrollHide() {
        let topPosition = this.categoriesContainer.scrollTop;
        let scrollHeight = this.categoriesContainer.scrollHeight;
        let parentHeight = this.categoriesContainer.parentElement.offsetHeight;

        if(topPosition === 0) {
            this.scrollTop.style.opacity = '0%';
            this.scrollTop.style.cursor = 'default';
        }
        else {
            this.scrollTop.style.opacity = '100%';
            this.scrollTop.style.cursor = 'pointer';
        }

        if (topPosition + parentHeight >= scrollHeight) {
            this.scrollBottom.style.opacity = '0%';
            this.scrollBottom.style.cursor = 'default';
        }
        else {
            this.scrollBottom.style.opacity = '100%';
            this.scrollBottom.style.cursor = 'pointer';
        }
    }
}

(() => {
    const categoriesHome = new CategoriesHome;

    categoriesHome.scrollHide();

    categoriesHome.scrollTop.addEventListener('click', () => {
        categoriesHome.categoriesContainer.scrollTop -= 50;
    });
    categoriesHome.scrollBottom.addEventListener('click', () => {
        categoriesHome.categoriesContainer.scrollTop += 50;
    });

    categoriesHome.categoriesContainer.addEventListener('scroll', () => {
        categoriesHome.scrollHide();
    });
})();