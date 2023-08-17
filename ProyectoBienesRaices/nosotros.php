<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Conoce Sobre Nosotros</h1>
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 Años de experiencia
                </blockquote>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo nesciunt, id ipsam adipisci atque officia ad quibusdam? Ipsa a eum repellat accusantium tempora, aut facilis incidunt tempore enim explicabo itaque.</p>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci numquam qui animi perspiciatis iusto libero impedit ducimus delectus nemo corrupti!</p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>M&aacute;s Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Similique pariatur, perferendis, minus laborum, optio 
                    reprehenderit quisquam voluptatem asperiores nobis obcaecati 
                    tempora aliquam quidem enim consequuntur sed nemo laudantium ipsum delectus?
                </p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono seguridad" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Similique pariatur, perferendis, minus laborum, optio 
                    reprehenderit quisquam voluptatem asperiores nobis obcaecati 
                    tempora aliquam quidem enim consequuntur sed nemo laudantium ipsum delectus?
                </p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono seguridad" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Similique pariatur, perferendis, minus laborum, optio 
                    reprehenderit quisquam voluptatem asperiores nobis obcaecati 
                    tempora aliquam quidem enim consequuntur sed nemo laudantium ipsum delectus?
                </p>
            </div>
        </div>
    </section>

<?php
    incluirTemplate('footer');
?>   