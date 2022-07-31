<div class="slider">
    <input type="radio" name="radioBtn" id="radioButton1" class="radioButton" checked>
    <input type="radio" name="radioBtn" id="radioButton2" class="radioButton">
    <input type="radio" name="radioBtn" id="radioButton3" class="radioButton">

    <div class="sliderImages">
        <div class="imageContainer">
            <div class="text-center">
                <p class="sliderTitle mainTitle">Bienvenido a Blancos El Chino</p>
                <p class="sliderParagraph">
                    Una página donde podrás comprar blancos de manera fácil y segura
                </p>
            </div>
            <div class="imageBlurry"></div>
            <img
                class="image imgHorizontal"
                src="{{asset('img/blancos-el-chino-establecimiento.jpeg')}}"
                alt="Establecimiento de Blancos El Chino">
        </div>
        <div class="imageContainer">
            <div class="text">
                <p class="sliderTitle">Envíos a toda la república mexicana</p>
                <p class="sliderParagraph">
                    Con un cargo extra de $50mxn por envío
                </p>
            </div>
            <div class="imageBlurry"></div>
            <img
                class="image imgHorizontal"
                src="{{asset('img/kazem-hussein-Kq1ERpkH0eQ-unsplash.jpg')}}"
                alt="Hombre cargando una furgoneta con paquetes">
            <a
                class="imgCredits"
                href="https://unsplash.com/photos/Kq1ERpkH0eQ?utm_source=unsplash&utm_medium=referral&utm_content=creditShareLink"
                target="_blank">
                fotografía por Kazem Hussein
            </a>
        </div>
        <div class="imageContainer">
            <div class="text">
                <p class="sliderTitle">¡Contáctanos!</p>
                <p class="sliderParagraph">
                    En Blancos El Chino nos alegramos de tenerte como cliente, si deseas conocer precios de mayoreo y tener un
                    trato más directo con la empresa, envíanos un mensaje por cualquiera de nuestros medios listados en la
                    <a href="{{route('contact')}}">página de contacto</a>
                </p>
            </div>
            <div class="imageBlurry"></div>
            <img
                class="image imgHorizontal"
                src="{{asset('img/michal-biernat-h0xEUQXzU38-unsplash.jpg')}}"
                alt="Persona sosteniendo un teléfono con ambas manos">
            <a
                class="imgCredits"
                href="https://unsplash.com/photos/h0xEUQXzU38?utm_source=unsplash&utm_medium=referral&utm_content=creditShareLink"
                target="_blank">
                fotografía por Michal Biernat
            </a>
        </div>
    </div>

    <div class="manualNavigation">
        <label for="radioButton1" class="manualButton" id="manualButton1"></label>
        <label for="radioButton2" class="manualButton" id="manualButton2"></label>
        <label for="radioButton3" class="manualButton" id="manualButton3"></label>
    </div>
</div>