<nav class="nav-bar">
    <div class="container">
        <div class="nav-content">

            <a href="{{ route('public.home')}}" class="nav-item">
                <div class="nav-icon">📢</div>
                <div class="nav-label">Todos los Avisos</div>
            </a>

            <a href="{{ route('public.categoria',1) }}" class="nav-item">
                <div class="nav-icon">💼</div>
                <div class="nav-label">Empleos</div>
            </a>
            <!---
            <a href="#" class="nav-item">
                <div class="nav-icon">🏠</div>
                <div class="nav-label">Inmuebles</div>
            </a>-->
            <a href="{{ route('public.categoria',2)}}" class="nav-item">
                <div class="nav-icon">🛍️</div>
                <div class="nav-label">Compra/Venta</div>
            </a>

            <a href="{{ route('public.categoria',3)}}" class="nav-item">
                <div class="nav-icon">🚗</div>
                <div class="nav-label">Alquileres</div>
            </a>

            <a href="{{ route('public.categoria',4)}}" class="nav-item">
                <div class="nav-icon">🤝</div>
                <div class="nav-label">Servicios</div>
            </a>
            
            <a href="{{ route('public.categoria',5)}}" class="nav-item">
                <div class="nav-icon">🎭</div>
                <div class="nav-label">Eventos</div>
            </a>

            
            
            <!-----<a href="#" class="nav-item">
                <div class="nav-icon">❤️</div>
                <div class="nav-label">Social</div>
            </a>-->
        </div>
    </div>
</nav>
