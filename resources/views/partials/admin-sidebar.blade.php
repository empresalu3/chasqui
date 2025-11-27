 <!--- <div class="dashboard-layout">-->
<aside class="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-item active">
        <span class="sidebar-icon">📊</span>
        <span>Panel Principal</span>
    </a>
    <a href="{{route('admin.avisos.index')}}" class="sidebar-item">
        <span class="sidebar-icon">📝</span>
        <span>Publicaciones</span>
    </a>
    <a href="{{route('admin.usuarios.index')}}" class="sidebar-item">
                <span class="sidebar-icon">🤵‍♂️</span>
                <span>Usuarios</span>
    </a>
            <a href="#" class="sidebar-item">
                <span class="sidebar-icon">💬</span>
                <span>Mensajes</span>
            </a>    
    <a href="#" class="sidebar-item">
        <span class="sidebar-icon">📈</span>
        <span>Estadísticas</span>
    </a>
            <a href="#" class="sidebar-item">
                <span class="sidebar-icon">💳</span>
                <span>Pagos y Planes</span>
            </a>
    <div class="sidebar-divider"></div>
    <a href="#" class="sidebar-item">
        <span class="sidebar-icon">⚙️</span>
        <span>Configuración</span>
    </a>

    <div class="sidebar-divider"></div>
    <a href="#" class="sidebar-item">
                <span class="sidebar-icon">❓</span>
                <span>Ayuda</span>
            </a>
           
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="sidebar-item" style="background:none;border:none;width:100%;text-align:left;">
            <span class="sidebar-icon">🚪</span>
            <span>Cerrar Sesión</span>
        </button>
    </form>
</aside>
<!--- </div> -->