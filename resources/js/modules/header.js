class Header {

    constructor() {
        // Navigable menu
        this.headerMenu = document.getElementById('headerMenu');
        this.headerMenuHamburguer = document.getElementById('headerMenuHamburguer');

        // User menu
        this.userLoginButton = document.getElementById('userLogin');
        this.userLoginMenu = document.querySelector('.loginItems');

        //Search bar
        this.searchIcon = document.getElementById('searchIcon');
        this.searchFieldContainer = document.querySelector('.searchFieldContainer');
    }

    showMenu(menu) {
        menu.classList.toggle('hidden');
        menu.classList.toggle('visible');
    }

    showSearchBar() {
        this.searchFieldContainer.classList.toggle('searchBarHidden');
    }
}

(function() {
    window.addEventListener('load', () => {

        const header = new Header;

        if(window.innerWidth >= 1200) {
            header.headerMenu.removeAttribute('class');
        }

        header.headerMenuHamburguer.addEventListener('click', () => {
            header.showMenu(header.headerMenu);
            if(header.userLoginMenu.classList.contains('visible')) {
                header.showMenu(header.userLoginMenu)
            }
            else if (!header.searchFieldContainer.classList.contains('searchBarHidden')) {
                header.showSearchBar();
            }
        });

        header.userLoginButton.addEventListener('click', () => {
            header.showMenu(header.userLoginMenu);
            if(header.headerMenu.classList.contains('visible')) {
                header.showMenu(header.headerMenu);
            }
            else if (!header.searchFieldContainer.classList.contains('searchBarHidden')) {
                header.showSearchBar();
            }
        });

        header.searchIcon.addEventListener('click', () => {
            header.showSearchBar();
            if(header.userLoginMenu.classList.contains('visible')) {
                header.showMenu(header.userLoginMenu)
            }
            else if(header.headerMenu.classList.contains('visible')) {
                header.showMenu(header.headerMenu);
            }
        });

        window.addEventListener("resize", () => {
            if(window.innerWidth >= 1200) {
                header.headerMenu.removeAttribute('class');
            }
            else {
                header.headerMenu.classList.add('hidden');
            }
        });
    });
})();