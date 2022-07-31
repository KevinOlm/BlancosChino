<x-main>
    @push('styles')
        <link rel="stylesheet" href="{{mix('css/pages/contact.css')}}">
    @endpush
    <x-slot name="title">Contacto</x-slot>
    <div class="contactContainer">
        <h1>Información de Contacto</h1>

        <x-product-contact-background>
            <x-slot name='graphic'>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1859.3200006451837!2d-102.32783424193707!3d21.24611949647024!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x842971977bdb6f21%3A0x92a9c773c058a151!2sBlancos%20Fernanda!5e0!3m2!1ses!2smx!4v1631151699168!5m2!1ses!2smx"
                    width="100%"
                    height="100%"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
            </x-slot>

            <div class="text">
                <h2>Contáctanos en:</h2>
                <ul class="socialMedias">
                    <li class="socialMedia"><a href="https://www.instagram.com/blancoschino/" target="_blank">
                        <span>Instagram</span>
                        <div class="icon"><i class="fab fa-instagram"></i></div>
                    </a></li>
                    <li class="socialMedia"><a href="https://www.facebook.com/blancoschino/" target="_blank">
                        <span>Facebook</span>
                        <div class="icon"><i class="fab fa-facebook-f"></i></div>
                    </a></li>
                    <li class="socialMedia"><a href="https://wa.me/523951151514/?text=Hola!%20Me%20interesan%20tus%20productos!" target="_blank">
                        <span>Whatsapp</span>
                        <div class="icon"><i class="fab fa-whatsapp"></i></div>
                    </a></li>
                    <li class="socialMedia"><a href="https://www.google.com.mx/maps/place/Blancos+Fernanda/@21.2461195,-102.3278031,18z/data=!3m1!4b1!4m5!3m4!1s0x842971977bdb6f21:0x92a9c773c058a151!8m2!3d21.2461203!4d-102.3267396" target="_blank">
                        <span>Fernando Valenzuela 126, Benito Juárez, 47090 San Juan de los Lagos, Jal.</span>
                        <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                    </a></li>
                </ul>
            </div>
        </x-product-contact-background>

        <h2>O envíanos un correo a blancoselchinosj@gmail.com</h2>

        @livewire('mail-form')
    </div>
</x-main>