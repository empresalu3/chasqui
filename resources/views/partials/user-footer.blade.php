<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Chasqui Express</h3>
                <ul>
                    <li><a href="{{route ('public.sobre')}}">Sobre Nosotros</a></li>
                    <li><a href="{{route ('public.contacto')}}">Contacto</a></li>
                    <li><a href="{{route ('public.blog')}}">Blog</a></li>
                    <li><a href="{{ route ('public.prensa')}}">Prensa</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Para Usuarios</h3>
                <ul>
                    <li><a href="#">Cómo Publicar</a></li>
                    <li><a href="#">Consejos de Seguridad</a></li>
                    <li><a href="#">Preguntas Frecuentes</a></li>
                    <li><a href="#">Términos y Condiciones</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Para Empresas</h3>
                <ul>
                    <li><a href="#">Publicidad</a></li>
                    <li><a href="#">Planes Premium</a></li>
                    <li><a href="#">API para Desarrolladores</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Síguenos</h3>
                <ul>
                    <li><a href="#">📘 Facebook</a></li>
                    <li><a href="#">📷 Instagram</a></li>
                    <li><a href="#">🐦 Twitter</a></li>
                    <li><a href="#">💼 LinkedIn</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© {{ date('Y') }} Chasqui Express. Todos los derechos reservados. | Plataforma de Avisos Online en Ayacucho</p>
        </div>
    </div>
</footer>
