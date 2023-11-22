<?php
/**
 * @var string $descripcion /src/logged-header.php
 * @var string $titulo /src/logged-header.php
 * @var string $css /src/logged-header.php
 * @var string $js /src/logged-header.php
 */

require '../src/utils/sessionInit.php';
require DIR . '/src/utils/autoloader.php';
require DIR . '/vendor/autoload.php';
include_once DIR . '/src/utils/utils.php';

unsetLoginRegister();

$descripcion = "Página de foros de AsynCore";
$titulo = "AsynCore";
$css = ["css/style.css","css/FAQ.css"];
$js = ["js/script.js"];
$cdn = ["https://friconix.com/cdn/friconix.js"];
include_once DIR . '/src/head.php';
if (isset($_SESSION['USER_ID'])) {
    include_once DIR . '/src/logged-header.php';
} else {
    include_once DIR . '/src/login-header.php';
}
?>
<main>
  <section class="faq">
    <h2>Preguntas Frecuentes</h2>
    <ul>
      <li>
        <h3>1. ¿Cómo puedo registrarme en el foro?</h3>
        <p>Para registrarte en el foro, sigue los siguientes pasos...</p>
        <p>Haz clic en el apartado Login/registro ubicado la parte superior derecha,
        cuando estes en la página te saldrá una caja ubicada en el centro de la pantalla, tendrás que clicar en el botón
        "Registrarse" ubicado en la parte superior derecha.
        Introduce tus datos y podrás disfrutar de AsynCore en su totalidad.</p>
      </li>
      <li>
        <h3>2. ¿Cómo publico una pregunta en el foro?</h3>
        <p>Para publicar una pregunta, sigue estos pasos...</p>
      </li>
      <li>
        <h3>3. ¿Cómo puedo formatear correctamente mi código en el foro?</h3>
        <p>Para formatear tu código en el foro, puedes utilizar etiquetas de código como &lt;code&gt; o &lt;pre&gt;. También puedes indentar tu código con espacios o tabulaciones antes de pegarlo en tu publicación.</p>
      </li>
      <li>
        <h3>4. ¿Es necesario tener experiencia previa en programación para unirse al foro?</h3>
        <p>No es necesario tener experiencia previa en programación para unirse al foro. Aceptamos miembros de todos los niveles, desde principiantes hasta expertos.</p>
      </li>
      <li>
        <h3>5. ¿Cómo puedo cambiar mi contraseña en el foro?</h3>
        <p>Para cambiar tu contraseña, inicia sesión en tu cuenta y ve a la configuración de la cuenta. Allí encontrarás una opción para cambiar tu contraseña.</p>
      </li>
      <li>
        <h3>6. ¿Puedo compartir enlaces a recursos externos en el foro?</h3>
        <p>Sí, puedes compartir enlaces a recursos externos relevantes en el foro, como tutoriales, documentación o ejemplos de código. Sin embargo, asegúrate de que cumplan con nuestras políticas de publicación.</p>
      </li>
      <li>
        <h3>7. ¿Cuál es la política de moderación del foro?</h3>
        <p>Nuestra política de moderación se basa en promover un entorno respetuoso y constructivo. Los mensajes que infrinjan estas normas podrían ser editados o eliminados por nuestros moderadores.</p>
      </li>
      <li>
        <h3>8. ¿Cómo puedo recibir notificaciones de respuestas a mis publicaciones en el foro?</h3>
        <p>Puedes recibir notificaciones de respuestas a tus publicaciones habilitando las notificaciones por correo electrónico en la configuración de tu cuenta. También puedes suscribirte a hilos específicos.</p>
      </li>
      <li>
        <h3>9. ¿Cuál es la etiqueta correcta para hacer preguntas técnicas en el foro?</h3>
        <p>Recomendamos usar una etiqueta específica relacionada con el lenguaje de programación o la tecnología sobre la que tienes una pregunta. Esto ayudará a otros miembros a encontrar y responder a tus preguntas de manera más efectiva.</p>
      </li>
      <li>
        <h3>10. ¿Cómo puedo contactar al equipo de soporte del foro en caso de problemas técnicos?</h3>
        <p>Si tienes problemas técnicos o necesitas asistencia adicional, puedes ponerte en contacto con nuestro equipo de soporte a través de la página de "Contacto" en el sitio web. Estaremos encantados de ayudarte.</p>
      </li>
    </ul>
  </section>
</main>

<?php
include_once "../src/footer.php";
?>
</body>
</html>