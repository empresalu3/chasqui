@extends('layouts.admin')

@section('title', 'Panel Principal')

@section('content')
<div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">{{$publicaciones_activas}}</div>
                            <div class="stat-label">Publicaciones Activas</div>
                            <div class="stat-trend up">↑ 25% vs mes anterior</div>
                        </div>
                        <div class="stat-icon purple">📝</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">2,847</div>
                            <div class="stat-label">Visitas Totales</div>
                            <div class="stat-trend up">↑ 18% esta semana</div>
                        </div>
                        <div class="stat-icon green">👁️</div>
                    </div>
                </div>
                <!-- Additional Stat Cards 
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">47</div>
                            <div class="stat-label">Mensajes Recibidos</div>
                            <div class="stat-trend up">↑ 12% vs semana anterior</div>
                        </div>
                        <div class="stat-icon orange">💬</div>
                    </div>
                </div>
-->
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">8</div>
                            <div class="stat-label">Favoritos</div>
                            <div class="stat-trend down">↓ 5% vs mes anterior</div>
                        </div>
                        <div class="stat-icon blue">⭐</div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <!-- Nueva Publicación -->
    <button class="action-btn primary"
        onclick="window.location.href='{{ route('admin.avisos.create') }}'">
        <span>➕</span>
        <span>Nueva Publicación</span>
    </button>
                <!-- Buscar Avisos -->
    <button class="action-btn"
        onclick="window.location.href='{{ route('admin.avisos.index') }}'">
        <span>🔍</span>
        <span>Buscar Avisos</span>
    </button>
                <!-- Destacar anuncio -->
    <button class="action-btn"
        onclick="window.location.href='{{ route('admin.avisos.index') }}'">
        <span>💎</span>
        <span>Destacar Anuncio</span>
    </button>
            </div>

            <!-- Chart Card 
            <div class="content-card">
                <div class="card-header">
                    <h2 class="card-title">Visitas en los Últimos 30 Días</h2>
                </div>
                <div class="chart-container">
                    📊
                </div>
            </div>-->

<!-- Listings Card -->
<div class="content-card">
    <div class="card-header">
        <h2 class="card-title">Mis Publicaciones Recientes</h2>
        <div class="filter-tabs">
            <div class="tab active">Todas</div>
            <div class="tab">Activas</div>
            <div class="tab">Pendientes</div>
            <div class="tab">Finalizadas</div>
        </div>
    </div>

    @forelse($avisos as $aviso)
    <div class="listing-item">
        <div style="width:100px">
            <img src="{{ $aviso->imagenes->count() ? asset($aviso->imagenes->first()->ruta) : asset('images/no-image.png') }}" alt="Imagen del aviso" style="width:100%;border-radius:6px;">
        </div>

        <div class="listing-details">
            <div class="listing-title">{{ $aviso->titulo }}</div>
            <div class="listing-meta">
                <div class="listing-meta-item">📍 {{ $aviso->ubicacion ?? 'Sin ubicación' }}</div>
                <div class="listing-meta-item">📅 {{ $aviso->created_at->diffForHumans() }}</div>
                <div class="listing-meta-item">💰 S/ {{ number_format($aviso->precio, 2) }}</div>
            </div>
            <div class="listing-stats">
                <div class="listing-stat">👤 {{ $aviso->user->name ?? 'Anon' }}</div>
                <div class="listing-stat">📂 {{ $aviso->categoria->nombre ?? 'Sin categoría' }}</div>
                <div class="listing-stat">⭐ {{ $aviso->destacado ? 'Destacado' : 'Normal' }}</div>
            </div>
        </div>

        <div class="listing-actions">
            {{-- Estado visual --}}
            @if($aviso->estado_publicacion == 'pendiente')
                <span class="status-badge pending">PENDIENTE</span>
            @elseif($aviso->estado_publicacion == 'aprobado')
                <span class="status-badge approved">APROBADO</span>
            @elseif($aviso->estado_publicacion == 'rechazado')
                <span class="status-badge rejected">RECHAZADO</span>
            @endif

            <div class="listing-action-btns">
                {{-- Editar --}}
                <a href="{{ route('admin.avisos.edit', $aviso) }}" class="icon-btn edit" title="Editar">✏️</a>

                {{-- Publicar / Despublicar --}}
                <form action="{{ route('admin.avisos.toggleEstado', $aviso) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="icon-btn publish" title="{{ $aviso->estado == 'activo' ? 'Despublicar' : 'Publicar' }}">
                        {{ $aviso->estado == 'activo' ? '📤' : '📥' }}
                    </button>
                </form>

                {{-- Destacar / Quitar destaque --}}
                <form action="{{ route('admin.avisos.toggleDestacado', $aviso) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="icon-btn promote" title="{{ $aviso->destacado ? 'Quitar destaque' : 'Destacar' }}">
                        💎
                    </button>
                </form>

                {{-- Aprobar / Rechazar --}}
                @if($aviso->estado_publicacion == 'pendiente')
                    <form action="{{ route('admin.avisos.aprobar', $aviso->id) }}" method="POST" style="display:inline;">
                        @csrf @method('PATCH')
                        <button class="icon-btn approve" title="Aprobar" onclick="return confirm('¿Aprobar este aviso?')">✅</button>
                    </form>

                    <form action="{{ route('admin.avisos.rechazar', $aviso->id) }}" method="POST" style="display:inline;">
                        @csrf @method('PATCH')
                        <button class="icon-btn reject" title="Rechazar" onclick="return confirm('¿Rechazar este aviso?')">🚫</button>
                    </form>
                @endif

                {{-- Eliminar --}}
                <form action="{{ route('admin.avisos.destroy', $aviso) }}" method="POST" onsubmit="return confirm('¿Eliminar este aviso?')" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="icon-btn delete" title="Eliminar">🗑️</button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <p style="padding: 12px;">No tienes publicaciones recientes.</p>
    @endforelse
</div>

@endsection
