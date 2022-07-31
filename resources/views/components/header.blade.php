<header>
    <div class="logoContainer">
        <a href="{{route('home')}}"><img src="{{asset('/img/blancos_el_chino_blanco.png')}}" alt="Blancos El Chino Logo"></a>
    </div>
    <ul class="icons">
        <li>
            <div class="searchFieldContainer searchBarHidden">
                @livewire('search')
            </div>
            <i class="fas fa-search icon" id="searchIcon" wire:click="$toggle('open')"></i>
        </li>
        <li class="icon" id="userLogin"><i class="fas fa-user"></i></li>
        @if (request()->routeIs('cart'))
            <li class="icon iconDisabled">
                <i class="fas fa-shopping-cart"></i>
            </li>
        @else
            <li class="icon">
                <a href="{{route('cart')}}"><i class="fas fa-shopping-cart"></i></a>
            </li>
        @endif
        <li class="icon" id="headerMenuHamburguer"><i class="fas fa-bars"></i></li>
    </ul>
    @if (Route::has('login'))
        <ul class="loginItems hidden">
            @auth
                @if (Auth::user()->user_type === 'admin')
                    <li class="loginItem"><a href="{{ route('admin.home') }}">Administrar</a></li>
                @endif
                <li class="loginItem">
                    @if (request()->routeIs('user.config'))
                        <span>Mi cuenta: {{ Auth::user()->name }}</span>
                    @else
                        <a href="{{route('user.config')}}">Mi cuenta: {{ Auth::user()->name }}</a>
                    @endif
                </li>
                <li class="loginItem">
                    @if (request()->routeIs('purchases'))
                        <span>Compras</span>
                    @else
                        <a href="{{route('purchases')}}">Compras</a>
                    @endif
                </li>
                <li class="loginItem"><a href="{{route('billing-portal')}}">Métodos de pago</a></li>
                <li class="loginItem">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick=" event.preventDefault(); this.closest('form').submit(); ">
                            Cerrar Sesión
                        </a>
                    </form>
                </li>
            @else
                <li class="loginItem"><a href="{{ route('login') }}">Iniciar Sesión</a></li>
                <li class="loginItem"><a href="{{ route('register') }}">Registrarse</a></li>
            @endauth
        </ul>
    @endif
    <nav class="hidden" id="headerMenu">
        <ul class="menuItems">
            <li class="menuItem">
                @if (request()->routeIs('home'))
                    <span>Inicio</span>
                @else
                    <a href="{{route('home')}}">Inicio</a>
                @endif
            </li>
            <li class="menuItem">
                @if (request()->routeIs('products'))
                    <span>Productos</span>
                @else
                    <a href="{{route('products')}}">Productos</a>
                @endif
            </li>
            <li class="menuItem">
                @if (request()->routeIs('about'))
                    <span>Nosotros</span>
                @else
                    <a href="{{route('about')}}">Nosotros</a>
                @endif
            </li>
            <li class="menuItem">
                @if (request()->routeIs('contact'))
                    <span>Contacto</span>
                @else
                    <a href="{{route('contact')}}">Contacto</a>
                @endif
            </li>
        </ul>
    </nav>
</header>