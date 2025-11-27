<header class="header">
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-content">
                <div class="location">📍 Ayacucho, Perú</div>
                <div>¿Necesitas ayuda? | Contáctanos</div>
            </div>
        </div>
    </div>

    <div class="main-header">
        <div class="container">
            <div class="header-content">
                <a href="{{ route('public.home') }}" class="logo">
                    <span class="logo-icon">🏃</span>
                    <div>
                        <div>CHASQUI</div>
                        <div style="font-size: 14px; font-weight: normal; opacity: 0.9;">Express</div>
                    </div>
                </a>
<!--- ro ute('avis os.sea rch') ----->
                <div class="search-bar">
    <form action="{{ route('public.buscar') }}" method="GET" class="search-container">
        <input 
            type="text" 
            name="q" 
            placeholder="Buscar empleos, productos, servicios..." 
            value="{{ request('q') }}"
            required 
        >
        <button type="submit">🔍 Buscar</button>
    </form>
</div>

                <div class="header-actions">
                    @guest
                        <a href="{{ route('login') }}" class="header-btn">Iniciar Sesión</a>
                        <a href="{{ route('register') }}" class="header-btn publish-btn"> Publicar Gratis</a>
                    @else
                        <a href="{{ route('user.perfil.index') }}" class="header-btn"><span style="color: white; margin-right: 12px;">{{ Auth::user()->name }}</span></a>
                        
                        <a href="{{route('user.avisos.create')}}" class="header-btn publish-btn">Publicar Gratis</a>
                        <a href="{{route('user.avisos.mis-avisos')}}"class="header-btn">Mis Avisos</a>
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button class="header-btn">Salir</button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</header>
