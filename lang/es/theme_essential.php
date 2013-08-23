<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * This is built using the Clean template to allow for new theme's using
 * Moodle's new Bootstrap theme engine
 *
 *
 * @package   theme_essential
 * @copyright 2013 Julian Ridden
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/* Core */
$string['configtitle'] = 'Essential';
$string['pluginname'] = 'Essential';
$string['choosereadme'] = '
<div class="clearfix">
<div class="well">
<h2>Clean</h2>
<p><img class=img-polaroid src="clean/pix/screenshot.jpg" /></p>
</div>
<div class="well">
<h3>Acerca de Essential</h3>
<p>Essential es un tema basado en Moodle bootstrap que hereda sus estilos y reproductores de sus temas padre.</p>
<h3>Padres</h3>
<p>Este tema esta basado en el BootstrapBase theme, el cual fue creado para Moodle 2.5, con la ayuda de:<br>
Stuart Lamour, Mark Aberdour, Paul Hibbitts, Mary Evans.</p>
<h3>Créditos del tema</h3>
<p>Authors: Julian Ridden<br>
Contacto: julian@moodleman.net<br>
Sitio web: <a href="http://www.moodleman.net">www.moodleman.net</a>
</p>
</div></div>';

/* General */
$string['geneicsettings'] = 'Ajustes generales';
$string['autohide'] = 'Incluir funcionalidad de ocultamiento automático';
$string['autohidedesc'] = 'La funcionalidad de ocultamiento automático está diseñada para hacer menos confusa la interface de la plataforma. Al estar activo el modo de edición, los iconos de modificación solo aparecerán al ubicarse sobre cada bloque.';
$string['editicons'] = 'Editar Iconos V2';
$string['editiconsdesc'] = 'Este ajuste utiliza Font Awesome para mostrar los iconos de edición en un formato más limpio en las páginas y bloques del curso. Por favor, tome en cuenta que este ajuste no es compatible con la funcionalidad de ocultamiento automático.';
$string['customcss'] = 'CSS personalizado';
$string['customcssdesc'] = 'Cualquier regla CSS que agregue en este campo será visible en todas las páginas, haciendo más fácil la personalización de este tema';
$string['footnote'] = 'Nota al pie de página';
$string['footnotedesc'] = 'Cualquier texto que agregue en este campo se mostará en el pie de página de todo su sitio Moodle';
$string['invert'] = 'Barra de navegación invertida';
$string['invertdesc'] = 'Intercambia entre blanco y negro el texto y fondo para la barra de navegación en la parte superior de la página.';
$string['logo'] = 'Logotipo';
$string['logodesc'] = 'Por favor suba su logotipo personalizado acá si quiere agregarlo a la cabecera de la página.<br>Si usted sube un logotipo, este reemplazará el ícono y texto mostrado por defecto.';
$string['copyright'] = 'Copyright';
$string['copyrightdesc'] = 'El nombre de su organización.';
$string['profilebarcustomtitle'] = 'Bloque de título personalizado para la barra de perfil';
$string['profilebarcustomtitledesc'] = 'título personalizado para la barra de perfil';
$string['contactinfo'] = 'Información de contacto';
$string['contactinfodesc'] = 'Introduzca su información de contacto';
$string['siteicon'] = 'Ícono del sitio';
$string['siteicondesc'] = '¿No tiene un logotipo? Coloque el nombre del ícono que desea utilizar. La lista está <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">aquí</a>. Sólo coloque lo que esta después de "icon-". ';
$string['yourprofile'] = 'Tú';
$string['headerprofilepic'] = 'Mostrar fotografía del usuario';
$string['headerprofilepicdesc'] = 'Si se selecciona, se mostrará la fotografía del perfil del usuario en el encabezado del sitio.';
$string['layout'] = 'Utilice un esquema curso estándar';
$string['layoutdesc'] = 'Este tema está diseñado para colocar las dos columnas secundarias a un lado. Si usted prefiere el esquema estándar, puede seleccionar esta opción y retornará al usual esquema de tres columnas.';
$string['perfinfo'] = 'Modo de información de rendimiento';
$string['perfinfodesc'] = 'Muchos sitios no necesitan información detallada sobre su rendimiento, especialmente al ser vistos por usuarios regulares. Al habilitarse, se mostrará un formato de página limpia empleando únicamente la información necesaria.';
$string['perf_max'] = 'Detallado';
$string['perf_min'] = 'Mínimo';
$string['visibleadminonly'] = 'Los bloques colocados en esta área serán vistos únicamente por los administradores';

/* Navbar Seperator */
$string['navbarsep'] = 'Separador para barra de navegación';
$string['navbarsepdesc'] = 'Aquí puede cambiar el tipo de separador que se desplegará en la barra de navegación';
$string['nav_thinbracket'] = 'Soporte delgado';
$string['nav_doublebracket'] = 'Soporte regular';
$string['nav_thickbracket'] = 'Soporte grueso';
$string['nav_slash'] = 'Barra inclinada';
$string['nav_pipe'] = 'Línea vertical';

/* Regions */
$string['region-side-post'] = 'Derecha';
$string['region-side-pre'] = 'Izquierda';
$string['region-footer-left'] = 'Pie de página (Izquierda)';
$string['region-footer-middle'] = 'Pie de página (Centro)';
$string['region-footer-right'] = 'Pie de página (Derecha)';
$string['region-hidden-dock'] = 'Oculto para los usuarios';


/* Colors */
$string['colorheading'] = 'Ajustes de color';
$string['colorheadingsub'] = 'Establezca los colores a utilizar en su tema.';
$string['colordesc'] = 'En esta sección encontrará varios ajustes que permiten modificar muchos de los colores encontrados en este tema gráfico.';
$string['themecolor'] = 'Color del tema';
$string['themecolordesc'] = 'Color predefinido para su tema. Esto cambirá múltiples componentes para producir el nuevo color que usted desea a lo largo de todo el sitio moodle';
$string['themehovercolor'] = 'Color del tema para enlaces';
$string['themehovercolordesc'] = 'Color predefinido del tema para los enlaces. Es usado para enlace, menu, etc.';
$string['footercolor'] = 'Color de fondo para el píe de página';
$string['footercolordesc'] = 'Establezca cual debe ser el color de fondo del píe de página.';
$string['footersepcolor'] = 'Color de separador para el píe de página';
$string['footersepcolordesc'] = 'Los separadores son líneas utilizadas para separar contenidos. Puede establecer su color aquí.';
$string['footertextcolor'] = 'Color de texto en el píe de página';
$string['footertextcolordesc'] = 'Seleccione el color que desea para el texto ubicado en el píe de página.';
$string['footerurlcolor'] = 'Color de enlaces en el píe de página';
$string['footerurlcolordesc'] = 'Seleccione el color para el texto de los enlaces ubicados en el píe de página.';
$string['footerhovercolor'] = 'Color del enlace seleccionado en el píe de página';
$string['footerhovercolordesc'] = 'Seleccione el color del texto a utilizar al pasar sobre los enlaces en el píe de página.';
$string['footerheadingcolor'] = 'Color de texto para los encabezados en el píe de página';
$string['footerheadingcolordesc'] = 'Seleccione el color para los bloques de encabezado ubicados en el píe de página.';
$string['pagebackground'] = 'Imagen de fondo para la página';
$string['pagebackgrounddesc'] = 'Cargue su propia imagen de fondo para el sitio. Esta será mostrada en forma de mosaico en el fondo de todas las páginas. Si no se carga ninguna, se utilizará una imagen predeterminada.';

/* Slideshow */
$string['slideshowheading'] = 'Diapositivas de Página Principal';
$string['slideshowheadingsub'] = 'Diapositivas Dinámicas para la Página Principal';
$string['slideshowdesc'] = 'Esto genera un carrusel de hasta 4 diapositivas que le permiten promover elementos importantes de su sitio.';

$string['hideonphone'] = 'Oculto para Móviles';
$string['hideonphonedesc'] = 'Escoja si desea mostrar el carrusel en móviles';
$string['display'] = 'Mostrar';
$string['dontdisplay'] = 'No Mostrar';
$string['readmore'] = 'Read More';

$string['slideshowTitle'] = 'Carrusel de diapositivas';
$string['slide1'] = 'Diapositiva Uno: Título';
$string['slide1desc'] = 'Coloque un título descriptivo a su diapositiva';
$string['slide1image'] = 'Diapositiva Uno: Imagen';
$string['slide1imagedesc'] = 'La imagen funciona mejor si tiene fondo transparente. (El tamaño debe ser 256px x 256px)';
$string['slide1caption'] = 'Diapositiva Uno: Subtítulo';
$string['slide1captiondesc'] = 'Coloque el subtítulo para usar con la primera diapositiva';
$string['slide1url'] = 'Diapositiva Uno: Enlace de la imagen';
$string['slide1urldesc'] = 'Coloque el destino del enlace asociado a la primera diapositiva';

$string['slide2'] = 'Diapositiva Dos: Título';
$string['slide2desc'] = 'Coloque un título descriptivo a su diapositiva';
$string['slide2image'] = 'Diapositiva Dos: Imagen';
$string['slide2imagedesc'] = 'La imagen funciona mejor si tiene fondo transparente. (El tamaño debe ser 256px x 256px)';
$string['slide2caption'] = 'Diapositiva Dos: Subtítulo';
$string['slide2captiondesc'] = 'Coloque el subtítulo para usar con la segunda diapositiva';
$string['slide2url'] = 'Diapositiva Dos: Enlace de la imagen';
$string['slide2urldesc'] = 'Coloque el destino del enlace asociado a la segunda diapositiva';

$string['slide3'] = 'Diapositiva Tres: Título';
$string['slide3desc'] = 'Coloque un título descriptivo a su diapositiva';
$string['slide3image'] = 'Diapositiva Tres: Imagen';
$string['slide3imagedesc'] = 'La imagen funciona mejor si tiene fondo transparente. (El tamaño debe ser 256px x 256px)';
$string['slide3caption'] = 'Diapositiva Tres: Subtítulo';
$string['slide3captiondesc'] = 'Coloque el subtítulo para usar con la tercera diapositiva';
$string['slide3url'] = 'Diapositiva Tres: Enlace de la imagen';
$string['slide3urldesc'] = 'Coloque el destino del enlace asociado a la tercera diapositiva';

$string['slide4'] = 'Diapositiva Cuatro: Título';
$string['slide4desc'] = 'Coloque un título descriptivo a su diapositiva';
$string['slide4image'] = 'Diapositiva Cuatro: Imagen';
$string['slide4imagedesc'] = 'La imagen funciona mejor si tiene fondo transparente. (El tamaño debe ser 256px x 256px)';
$string['slide4caption'] = 'Diapositiva Cuatro: Subtítulo';
$string['slide4captiondesc'] = 'Coloque el subtítulo para usar con la cuarta diapositiva';
$string['slide4url'] = 'Diapositiva Cuatro: Enlace de la imagen';
$string['slide4urldesc'] = 'Coloque el destino del enlace asociado a la cuarta diapositiva';

/* Marketing Spots */
$string['marketingheading'] = 'Spots Publicitarios';
$string['marketingheadingsub'] = 'Bloques en la página principal diseñados para agregar información y enlaces';
$string['marketingheight'] = 'Altura de las imágenes';
$string['marketingheightdesc'] = 'Si desea mostrar imágenes en los spots publicitarios, puede especificar su altura aquí.';
$string['marketingdesc'] = 'Este tema ofrece la opción de habilitar tres "spots publicitarios" justo debajo del carrusel de diapositivas. Estos le permitirán identificar fácilmente información importante para sus usuarios y proveer enlaces directos.';
$string['togglemarketing'] = 'Intercambiar Pantalla de Spot Publicitario';
$string['togglemarketingdesc'] = 'Escoja si desea mostrar o esconder los tres Spots Publicitarios.';

$string['marketing1'] = 'Spot Publicitario Uno: Título';
$string['marketing1desc'] = 'Título para mostrar en este spot publicitario';
$string['marketing1icon'] = 'Spot Publicitario Uno: Ícono';
$string['marketing1icondesc'] = 'Nombre del ícono que desea usar. La lista de íconos disponibles esta <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">aquí</a>. Solo coloque lo que esta justo después de "icon-".';
$string['marketing1image'] = 'Spot Publicitario Uno: Imagen';
$string['marketing1imagedesc'] = 'Este tema ofrece la opción de desplegar una imagen sobre el texto en el spot publicitario';
$string['marketing1content'] = 'Spot Publicitario Uno: Contenido';
$string['marketing1contentdesc'] = 'Contenido a mostrar en el spot publicitario. Manténgalo corto y genial.';
$string['marketing1buttontext'] = 'Spot Publicitario Uno: Texto del enlace';
$string['marketing1buttontextdesc'] = 'Texto que aparecerá en el botón.';
$string['marketing1buttonurl'] = 'Spot Publicitario Uno: URL del enlace';
$string['marketing1buttonurldesc'] = 'URL al que apunta el botón.';

$string['marketing2'] = 'Spot Publicitario Dos: Título';
$string['marketing2desc'] = 'Título para mostrar en este spot publicitario';
$string['marketing2icon'] = 'Spot Publicitario Dos: Ícono';
$string['marketing2icondesc'] = 'Nombre del ícono que desea usar. La lista de íconos disponibles esta <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">aquí</a>. Solo coloque lo que esta justo después de "icon-".';
$string['marketing2image'] = 'Spot Publicitario Dos: Imagen';
$string['marketing2imagedesc'] = 'Este tema ofrece la opción de desplegar una imagen sobre el texto en el spot publicitario';
$string['marketing2content'] = 'Spot Publicitario Dos: Contenido';
$string['marketing2contentdesc'] = 'Contenido a mostrar en el spot publicitario. Manténgalo corto y genial.';
$string['marketing2buttontext'] = 'Spot Publicitario Dos: Texto del enlace';
$string['marketing2buttontextdesc'] = 'Texto que aparecerá en el botón.';
$string['marketing2buttonurl'] = 'Spot Publicitario Dos: URL del enlace';
$string['marketing2buttonurldesc'] = 'URL al que apunta el botón.';

$string['marketing3'] = 'Spot Publicitario Tres: Título';
$string['marketing3desc'] = 'Título para mostrar en este spot publicitario';
$string['marketing3icon'] = 'Spot Publicitario Tres: Ícono';
$string['marketing3icondesc'] = 'Nombre del ícono que desea usar. La lista de íconos disponibles esta <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">aquí</a>. Solo coloque lo que esta justo después de "icon-".';
$string['marketing3image'] = 'Spot Publicitario Tres: Imagen';
$string['marketing3imagedesc'] = 'Este tema ofrece la opción de desplegar una imagen sobre el texto en el spot publicitario';
$string['marketing3content'] = 'Spot Publicitario Tres: Contenido';
$string['marketing3contentdesc'] = 'Contenido a mostrar en el spot publicitario. Manténgalo corto y genial.';
$string['marketing3buttontext'] = 'Spot Publicitario Tres: Texto del enlace';
$string['marketing3buttontextdesc'] = 'Texto que aparecerá en el botón.';
$string['marketing3buttonurl'] = 'Spot Publicitario Tres: URL del enlace';
$string['marketing3buttonurldesc'] = 'URL al que apunta el botón.';

/* Social Networks */
$string['socialheading'] = 'Redes Sociales';
$string['socialheadingsub'] = 'Enlace a sus usuarios con sus Redes Sociales';
$string['socialdesc'] = 'Provea enlaces directos a las principales redes sociales que usa para promover su marca. Esta sección aparecerá en la cabecera de todas las páginas.';
$string['socialnetworks'] = 'Redes Sociales';
$string['facebook'] = 'Facebook URL';
$string['facebookdesc'] = 'Introduzca el URL de su página en Facebook. (ej. http://www.facebook.com/mycollege)';

$string['twitter'] = 'Twitter URL';
$string['twitterdesc'] = 'Introduzca el URL de su cuenta de Twitter. (ej. http://www.twitter.com/mycollege)';

$string['googleplus'] = 'Google+ URL';
$string['googleplusdesc'] = 'Introduzca el URL de su perfil en Google+. (ej. http://plus.google.com/107817105228930159735)';

$string['linkedin'] = 'LinkedIn URL';
$string['linkedindesc'] = 'Introduzca el URL de su perfil en LinkedIn. (ej. http://www.linkedin.com/company/mycollege)';

$string['youtube'] = 'YouTube URL';
$string['youtubedesc'] = 'Introduzca el URL de su canal en YouTube. (ej. http://www.youtube.com/mycollege)';

$string['flickr'] = 'Flickr URL';
$string['flickrdesc'] = 'Introduzca el URL de su página en Flickr. (ej. http://www.flickr.com/mycollege)';

$string['vk'] = 'VKontakte URL';
$string['vkdesc'] = 'Introduzca el URL de su página en Vkontakte. (ej. http://www.vk.com/mycollege)';

$string['skype'] = 'Cuenta de Skype';
$string['skypedesc'] = 'Introduzca el nombre de usuario de Skype utilizado por su organización.';

$string['pinterest'] = 'Pinterest URL';
$string['pinterestdesc'] = 'Introduzca el URL de su página en Pinterest. (ej. http://pinterest.com/mycollege)';

$string['instagram'] = 'Instagram URL';
$string['instagramdesc'] = 'Introduzca el URL de su página en Instagram. (ej. http://instagram.com/mycollege)';

$string['website'] = 'URL de su sitio web';
$string['websitedesc'] = 'Introduzca el URL de su sitio web institucional. (ej. http://www.pukunui.com)';

/* Mobile Apps */
$string['mobileappsheading'] = 'Aplicaciones móviles';
$string['mobileappsheadingsub'] = 'Ofrezca enlaces sus aplicaciones móviles a sus usuarios';
$string['mobileappsdesc'] = '¿Posee una aplicación registrada en App Store o Google Play Store? Ofrezca aquí en enlace para que sus usuarios puedan aprovecharlas';

$string['android'] = 'Android (Google Play)';
$string['androiddesc'] = 'URL de su aplicación móvil en Google Play Store. Si usted no posee una propia, tal vez podría considerar enlazar la aplicación oficial gratuita que Moodle proporciona.';

$string['ios'] = 'iPhone/iPad (App Store)';
$string['iosdesc'] = 'URL de su aplicación móvil en App Store. Si usted no posee una propia, tal vez podría considerar enlazar la aplicación oficial gratuita que Moodle proporciona.';


/* Alerts */
$string['ie7message'] = '<p id="ie7message">Disculpe, este sitio requiere <strong>Internet Explorer 8</strong> o superior para funcionar correctamente. Por favor actualice su navegador usando Windows Update, o <a href="http://windows.microsoft.com/en-au/internet-explorer/download-ie" target="_blank">descargue la última versión aquí</a>. También puede probar instalado el <a href="http://www.google.com/chromeframe" target="_blank">ChromeFrame plugin</a> que puede ayudar a resolver algunos problemas con navegadores desactualizados. Si continúa teniendo problemas para ingresar a este sitio o a las actualizaciones aquí mencionadas, por favor contacte a su servicio técnico para asistencia.</p>';