<header class="top-header">
    <div class="top-header-content">
    <a href="{{ route('admin.dashboard') }}" class="logo">
        <span class="logo-icon">🏃</span>
        <div>
            <div>CHASQUI</div>
            <div style="font-size: 12px; font-weight: normal; opacity: 0.9;">Express</div>
        </div>
    </a>

    <div class="user-menu">
        <button class="notification-btn">
            🔔 <span class="notification-badge">3</span>
        </button>

        <div class="user-profile">
            <div class="user-avatar">👤</div>
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->name ?? 'Admin' }}</div>
                <div class="user-role">{{ Auth::user()->label ?? 'Administrador' }}</div>
            </div>
        </div>
    </div>
    </div>
</header>
