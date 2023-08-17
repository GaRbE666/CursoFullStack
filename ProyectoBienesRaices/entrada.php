<?php
    include './includes/templates/header.php';
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Gu&iacute;a para la decoraci&oacute;n de tu hogar</h1>

        <p class="informacion-meta">Escrito el: <span>20/10/2023</span> por: <span>Admin</span></p>

        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada2.jpg" alt="imagen de la propiedad">
        </picture>

        <div class="resumen-propiedad">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo nesciunt, id ipsam adipisci atque officia ad quibusdam? Ipsa a eum repellat accusantium tempora, aut facilis incidunt tempore enim explicabo itaque.</p>

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci numquam qui animi perspiciatis iusto libero impedit ducimus delectus nemo corrupti!</p>
        </div>
    </main>

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="nosotros.html">Nosotros</a>
                <a href="anuncios.html">Anuncios</a>
                <a href="blog.html">Blog</a>
                <a href="contactos.html">Contactos</a>
            </nav>
        </div>
        <p class="copyright">Todos los derechos reservados 2023 &copy;</p>
    </footer>

    <script src="build/js/bundle.min.js"></script>

</body>
</html>