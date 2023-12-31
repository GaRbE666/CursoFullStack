<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{

    public static function index(Router $router){

        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('paginas/index', ['propiedades' => $propiedades,
                                          'inicio'      => $inicio]);

    }

    public static function nosotros(Router $router){
        
        $router->render('paginas/nosotros');

    }

    public static function propiedades(Router $router){

        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', ['propiedades' => $propiedades]);

    }

    public static function propiedad(Router $router){

        $id = validarORedireccionar('/propiedades');

        //Buscar la porpiedad por su id
        $propiedad = Propiedad::findById($id);

        $router->render('paginas/propiedad', ['propiedad' => $propiedad]);

    }

    public static function blog(Router $router){
        $router->render('paginas/blog');
    }

    public static function entrada(Router $router){
        
        $router->render('paginas/entrada');

    }

    public static function contacto(Router $router){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $mensaje = null;

            $respuestas = $_POST['contacto'];

            //Crear una instancia de PHPMailer
            $mail = new PHPMailer();

            //Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '400767590fae95';
            $mail->Password = 'b9c6fdcddb4618';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            //Configurar el contenido del email
            $mail->setFrom('admin@bienesraices.com', 'BienesRaices.com');
            $mail->addAddress('admin@bienesraices.com');
            $mail->Subject = 'Tienes un Nuevo Mensaje';
            
            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';



            //Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo Mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>';
            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
            

            //Enviar de forma condicional algunos campos de email o telefono
            if($respuestas['contacto'] === 'telefono'){
                $contenido .= '<p>Eligi&oacute; ser contactado por tel&eacute;fono: </p>';
                $contenido .= '<p>Telefono: ' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p>Fecha contacto: ' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p>Hora contacto: ' . $respuestas['hora'] . '</p>';
            }else{
                $contenido .= '<p>Eligi&oacute; ser contactado por email: </p>';
                $contenido .= '<p>Email: ' . $respuestas['email'] . '</p>';
            }

            
            $contenido .= '<p>Vende o Compra: ' . $respuestas['tipo'] . '</p>';
            $contenido .= '<p>Precio o Presupuesto: ' . $respuestas['precio'] . '</p>';
            $contenido .= '<p>Prefiere ser contactado por: ' . $respuestas['contacto'] . '</p>';
            
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternatibo sin HTML';
            
            //Enviar el mail
            if($mail->send()){
                $mensaje = "Mensaje enviado Correctamente";
            }else{
                $mensaje = "El mensaje no se pudo enviar...";
            }

        }

        $router->render('paginas/contacto', [ 'mensaje' => $mensaje]);
    }

}

?>