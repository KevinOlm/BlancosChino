<x-main>
    @push('styles')
        <link rel="stylesheet" href="{{mix('css/pages/about.css')}}">
    @endpush
    <x-slot name="title">Nosotros</x-slot>
    <div class="aboutContainer">
        <div class="slogan">
            <div class="imgContainer">
                <img src="{{asset('img/massimo-sartirana-jNm5xnUpnm8-unsplash.jpg')}}" alt="Un hombre corriéndo en un campo">
                <div class="blurry"></div>
                <a class="imgCredits" href="https://unsplash.com/photos/jNm5xnUpnm8" target="_blank">
                    fotografía por Massimo Sartirana
                </a>
            </div>
            <div class="text">
                <h2>¡EL EXITO ES LA SUMA DE PEQUEÑOS ESFUERZOS REPETIDOS DIA TRAS DIA!</h2>
            </div>
        </div>
        <div class="ethicalValues">
            <div class="textContainer">
                <div class="text">
                    <h3>Nuestros Valores</h3>
                    <p>
                        ¿Por qué contar con nosotros para conseguir buenos resultados?
                    </p>
                    <p>
                        Porque nuestra empresa es más que un negocio. Cada persona aporta algo diferente al equipo, pero siempre siguiendo un núcleo de valores que todos compartimos.
                    </p>
                </div>
            </div>
            <div class="imgContainer">
                <img src="{{asset('img/sean-pollock-PhYq704ffdA-unsplash.jpg')}}" alt="Rascacielos vistos desde abajo">
                <div class="blurry"></div>
                <a class="imgCredits" href="https://unsplash.com/photos/PhYq704ffdA" target="_blank">
                    fotografía por Sean Pollock
                </a>
            </div>
        </div>
        <div class="team">
            <div class="imgContainer">
                <img src="{{asset('img/annie-spratt-QckxruozjRg-unsplash.jpg')}}" alt="Grupo de trabajo sentados alrededor de una mesa">
                <div class="blurry"></div>
                <a class="imgCredits" href="https://unsplash.com/photos/QckxruozjRg" target="_blank">
                    fotografía por Annie Spratt
                </a>
            </div>
            <div class="textContainer">
                <div class="text">
                    <h3>Nuestros Equipo</h3>
                    <p>
                        Más que un grupo de expertos, somos una familia con una visión en común. Nuestra pasión y conocimientos nos ayudan a marcar la diferencia.
                    </p>
                </div>
            </div>
        </div>
        <div class="clients">
            <div class="textContainer">
                <div class="text">
                    <h3>Nuestros Valores</h3>
                    <p>
                        ¿Por qué contar con nosotros para conseguir buenos resultados?
                    </p>
                    <p>
                        Porque nuestra empresa es más que un negocio. Cada persona aporta algo diferente al equipo, pero siempre siguiendo un núcleo de valores que todos compartimos.
                    </p>
                </div>
            </div>
            <div class="imgContainer">
                <img src="{{asset('img/sebastian-herrmann-GkEt4m4btLM-unsplash.jpg')}}" alt="Empresarios analizando archivos">
                <div class="blurry"></div>
                <a class="imgCredits" href="https://unsplash.com/photos/GkEt4m4btLM" target="_blank">
                    fotografía por Sebastian Herrmann
                </a>
            </div>
        </div>
        <div class="thanks">
            <div class="imgContainer">
                <img src="{{asset('img/naassom-azevedo-Q_Sei-TqSlc-unsplash.jpg')}}" alt="Grupo de personas">
                <div class="blurry"></div>
                <a class="imgCredits" href="https://unsplash.com/photos/Q_Sei-TqSlc" target="_blank">
                    fotografía por Naassom Azevedo
                </a>
            </div>
            <div class="text">
                <h3>Agradecemos que sea parte de nuestro equipo.</h3>
                <p>
                    Juntos continuamos innovando nuestros productos para darles un mejor servicio, tal como lo merecen.
                </p>
                <p>
                    Agradecemos mucho sus compras y les deseamos que sus negocios crezcan y prosperen.
                </p>
                <h2>¡MUCHO ÉXITO!</h2>
            </div>
        </div>
    </div>
</x-main>