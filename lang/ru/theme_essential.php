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
    <h3>О теме Essential</h3>
    <p>Essential это измененная Moodle bootstrap тема, она наследует стили и оформление от родительской темы.</p>
    <h3>Родители</h3>
    <p>Эта тема основана на Bootstrap теме, которая была создана для Moodle 2.5, с помощью:
      <br> Stuart Lamour, Mark Aberdour, Paul Hibbitts, Mary Evans.</p>
    <h3>Спасибо за тему</h3>
    <p>Авторы: Julian Ridden<br> Контакты: julian@moodleman.net<br> Веб=сайт: <a href="http://www.moodleman.net">www.moodleman.net</a></p>
  </div>
  </div>';
/* General */
$string['geneicsettings'] = 'Основные настройки';
$string['customcss'] = 'Дополнительный CSS';
$string['customcssdesc'] = 'Дополнительные CSS правила, которые будут добавлены ко всему сайту, что облегчает настройку этой темы.';
$string['footnote'] = 'Нижний колонтитул';
$string['footnotedesc'] = 'Все что Вы добавите в эту зону будет отображаться внизу каждой страницы сайта Moodle.';
$string['invert'] = 'Инвертировать цвета панели навигации';
$string['invertdesc'] = 'Инвертировать цвета текста и фона для панели навигации в верхней части страницы между черным и белым.';
$string['logo'] = 'Логотип';
$string['logodesc'] = 'Пожалуйста загрузите свой логотип, если Вы хотите добавить его в заголовок сайта.<br>Если Вы это сделаете, этот рисунок заменит иконку и название сайта, отображаемые по-умолчанию.';
$string['copyright'] = 'Авторские права';
$string['copyrightdesc'] = 'Название Вашей организации.';
$string['profilebarcustomtitle'] = 'Альтернативный заголовок блока профиля';
$string['profilebarcustomtitledesc'] = 'Альтернативный заголовок блока профиля';
$string['contactinfo'] = 'Контактная информация';
$string['contactinfodesc'] = 'Введите Вашу контактную информацию';
$string['siteicon'] = 'Иконка сайта';
$string['siteicondesc'] = 'У вашего сайта есть логотип? Введите название иконки, которую вы хотите использовать. Список иконок <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">здесь</a>. Просто введите то, что после "icon-".';
$string['yourprofile'] = 'Вы';
$string['headerprofilepic'] = 'Показывать аватар пользователя ';
$string['headerprofilepicdesc'] = 'Если отмечено, показывать аватар профиля пользователя в заголовке каждой страницы.';
$string['layout'] = 'Использовать стандартный шаблон курса';
$string['layoutdesc'] = 'Эта тема создана для размещения обоих колонок блоков с одной стороны. Если вы предпочитаете стандартную раскладку Moodle, вы можете отметить эту опцию и вернуться к старой концепции в три колонки.';
$string['perfinfo'] = 'Информация о режиме производительности';
$string['perfinfodesc'] = 'Многие сайты не нуждаются в подробной детализации информации о производительности. Особенно после того, когда они уже просмотренны пользователями. Когда включена эта опция, отображается очищенная минимальная форма с простой информацией о загрузке страницы.';
$string['perf_max'] = 'Детально';
$string['perf_min'] = 'Минимально';
$string['visibleadminonly'] = 'Блоки, размещенные в этой области, доступны только администраторам';

/* Navbar Seperator */
$string['navbarsep'] = 'Разделитель на панели навигации';
$string['navbarsepdesc'] = 'Здесь вы можете изменить тип разделителя используемого в панели навигации';
$string['nav_thinbracket'] = 'Толская скобка';
$string['nav_doublebracket'] = 'Двойная тонкая скобка';
$string['nav_thickbracket'] = 'Тонкая скобка';
$string['nav_slash'] = 'Косая черта';
$string['nav_pipe'] = 'Вертикальная линия';

/* Regions */
$string['region-side-post'] = 'Право';
$string['region-side-pre'] = 'Лево';
$string['region-footer-left'] = 'Нижний колонтитул (Лево)';
$string['region-footer-middle'] = 'Нижний колонтитул (Центр)';
$string['region-footer-right'] = 'Нижний колонтитул (Право)';
$string['region-hidden-dock'] = 'Скрыть для пользователей';

/* Colors */
$string['colorheading'] = 'Настройки цвета';
$string['colorheadingsub'] = 'Установить цвета используемые в этой теме';
$string['colordesc'] = 'Здесь вы можете найти настройки для изменения многих цветов этой темы.';

$string['themecolor'] = 'Цвет темы';
$string['themecolordesc'] = 'Какого цвета должна быть Ваша тема. Это изменит многие компоненты использующие цвет, на сайте Moodle';
$string['themehovercolor'] = 'Цвет при наведении';
$string['themehovercolordesc'] = 'Какого цвета должны быть ссылки при наведении на них. Этот цвет используется для ссылок, меню и т.д.';
$string['footercolor'] = 'Фон нижнего колонтитула';
$string['footercolordesc'] = 'Установить цвет фона нижнего колонтитула.';
$string['footersepcolor'] = 'Цвет разделителя нижнего колонтитула';
$string['footersepcolordesc'] = 'Разделители и линии используемые для деления контанта. Установите их цвет здесь.';
$string['footertextcolor'] = 'Цвет текста в блоках нижнего колонтитула';
$string['footertextcolordesc'] = 'Установите цвет Вашего текста в блоках нижнего колонтитула.';
$string['footerurlcolor'] = 'Цвет ссылки в блоках нижнего колонтитула';
$string['footerurlcolordesc'] = 'Установите цвет Ваших ссылок в блоках нижнего колонтитула.';
$string['footerhovercolor'] = 'Цвет наведения на ссылки в блоках нижнего колонтитула';
$string['footerhovercolordesc'] = 'Установите цвет наведения на ссылку в блоках нижнего колонтитула.';
$string['footerheadingcolor'] = 'Цвет заголовка нижнего колонтитула';
$string['footerheadingcolordesc'] = 'Установить цвет заголовков блоков нижнего колонтитула.';
$string['pagebackground'] = 'Изображение для фона страницы';
$string['pagebackgrounddesc'] = 'Загрузить свое собственное изображение для фона страницы. Это изображение будет располагаться в фоне всех страниц. Если изображение не загружено по умолчанию будет использоватся стандартное изображение.';
/* Slideshow */
$string['slideshowheading'] = 'Слайд-шоу на главной странице';
$string['slideshowheadingsub'] = 'Динамическое слайд-шоу на главной странице';
$string['slideshowdesc'] = 'С помощью этих настроек создается динамическое слайд-шоу состоящее максимум из 4 слайдов, предназначенных для продвижения важных элементов вашего сайта.';

$string['hideonphone'] = 'Слайдшоу на мобильном устройстве';
$string['hideonphonedesc'] = 'Выберите, если вы хотите, чтобы слайд-шоу отображалась на мобильных телефонах';
$string['display'] = 'Отображать';
$string['dontdisplay'] = 'Не отображать';
$string['readmore'] = 'Подробнее';

$string['slideshowTitle'] = 'Слайд-шоу';
$string['slide1'] = 'Слайд первый: Название';
$string['slide1caption'] = 'Слайд первый: Заголовок';
$string['slide1captiondesc'] = 'Введите текст заголовка, если Вы хотите использовать первый слайд';
$string['slide1desc'] = 'Введите описание для вашего слайда';
$string['slide1image'] = 'Слайд первый: Изображение';
$string['slide1imagedesc'] = 'Лучше всего использовать изображения с прозрачностью. (Размер изображения должен быть 256px X 256px)';
$string['slide1url'] = 'Слайд первый: URL-ссылка';
$string['slide1urldesc'] = 'Введите URL-адрес назначения для первого слайда';

$string['slide2'] = 'Слайд второй: Название';
$string['slide2caption'] = 'Слайд второй: Заголовок';
$string['slide2captiondesc'] = 'Введите текст заголовка, если Вы хотите использовать  второй слайд';
$string['slide2desc'] = 'Введите описание для вашего слайда';
$string['slide2image'] = 'Слайд второй: Изображение';
$string['slide2imagedesc'] = 'Лучше всего использовать изображения с прозрачностью. (Размер изображения должен быть 256px X 256px)';
$string['slide2url'] = 'Слайд второй: URL-ссылка';
$string['slide2urldesc'] = 'Введите URL-адрес назначения для первого слайда';

$string['slide3'] = 'Слайд третий: Название';
$string['slide3caption'] = 'Слайд третий: Заголовок';
$string['slide3captiondesc'] = 'Введите текст заголовка, если Вы хотите использовать  третий слайд';
$string['slide3desc'] = 'Введите описание для вашего слайда';
$string['slide3image'] = 'Слайд третий: Изображение';
$string['slide3imagedesc'] = 'Лучше всего использовать изображения с прозрачностью. (Размер изображения должен быть 256px X 256px)';
$string['slide3url'] = 'Слайд третий: URL-ссылка';
$string['slide3urldesc'] = 'Введите URL-адрес назначения для первого слайда';

$string['slide4'] = 'Слайд четвертый: Название';
$string['slide4caption'] = 'Слайд четвертый: Заголовок';
$string['slide4captiondesc'] = 'Введите текст заголовка, если Вы хотите использовать четвертый слайд';
$string['slide4desc'] = 'Введите описание для вашего слайда';
$string['slide4image'] = 'Слайд четвертый: Изображение';
$string['slide4imagedesc'] = 'Лучше всего использовать изображения с прозрачностью. (Размер изображения должен быть 256px X 256px)';
$string['slide4url'] = 'Слайд четвертый: URL-ссылка';
$string['slide4urldesc'] = 'Введите URL-адрес назначения для четвертого слайда';

/* Marketing Spots */
$string['marketingheading'] = 'Рекламные блоки';
$string['marketingheadingsub'] = 'Три места на главной странице для добавления важной информации и ссылок на нее';
$string['marketingheight'] = 'Высота изображения на рекламном блоке';
$string['marketingheightdesc'] = 'Если вы хотите показывать изображения в рекламных блоках Вы можете задать их высоту в этом поле.';
$string['marketingdesc'] = 'Эта тема дает возможность включить три "рекламных" или "содержательных" блока под слайд-шоу. Это позволит вам легко донести основную информацию для пользователей и обеспечить возможность получения ими прямых ссылок на нужный контент.';

$string['togglemarketing'] = 'Показывать рекламные блоки';
$string['togglemarketingdesc'] = 'Выберите показывать или нет рекламные блоки на сайте.';


$string['marketing1'] = 'Рекламный блок 1 - Заголовок';
$string['marketing1buttontext'] = 'Рекламный блок 1 - Текст кнопки';
$string['marketing1buttontextdesc'] = 'Текст, появляющийся на кнопке.';
$string['marketing1buttonurl'] = 'Рекламный блок 1 - URL-адрес';
$string['marketing1buttonurldesc'] = 'URL-адрес по которому перейдет пользователь нажав на кнопку';
$string['marketing1content'] = 'Рекламный блок 1 - Содержимое блока';
$string['marketing1contentdesc'] = 'Содержимое, отображаемое в окне рекламного блока. Оно должно быть коротким и стимулирующим.';
$string['marketing1desc'] = 'Заголовок может быть показан на рекламном блоке';
$string['marketing1icon'] = 'Рекламный блок 1 - Иконка';
$string['marketing1icondesc'] = 'Название иконки, которую вы хотите использовать. Список иконок <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">здесь</a>. Просто введите то, что после "icon-".';
$string['marketing1image'] = 'Рекламный блок 1 - Изображение';
$string['marketing1imagedesc'] = 'Эта настройка дает возможность отображать изображение над текстом в рекламном блоке';

$string['marketing2'] = 'Рекламный блок 2 - Заголовок';
$string['marketing2buttontext'] = 'Рекламный блок 2 - Текст кнопки';
$string['marketing2buttontextdesc'] = 'Текст, появляющийся на кнопке.';
$string['marketing2buttonurl'] = 'Рекламный блок 2 - URL-адрес';
$string['marketing2buttonurldesc'] = 'URL-адрес по которому перейдет пользователь нажав на кнопку';
$string['marketing2content'] = 'Рекламный блок 2 - Содержимое блока';
$string['marketing2contentdesc'] = 'Содержимое, отображаемое в окне рекламного блока. Оно должно быть коротким и стимулирующим.';
$string['marketing2desc'] = 'Заголовок может быть показан на рекламном блоке';
$string['marketing2icon'] = 'Рекламный блок 2 - Иконка';
$string['marketing2icondesc'] = 'Название иконки, которую вы хотите использовать. Список иконок <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">здесь</a>. Просто введите то, что после "icon-".';
$string['marketing2image'] = 'Рекламный блок 2 - Изображение';
$string['marketing2imagedesc'] = 'Эта настройка дает возможность отображать изображение над текстом в рекламном блоке';

$string['marketing3'] = 'Рекламный блок 3 - Заголовок';
$string['marketing3buttontext'] = 'Рекламный блок 3 - Текст кнопки';
$string['marketing3buttontextdesc'] = 'Текст, появляющийся на кнопке.';
$string['marketing3buttonurl'] = 'Рекламный блок 3 - URL-адрес';
$string['marketing3buttonurldesc'] = 'URL-адрес по которому перейдет пользователь нажав на кнопку';
$string['marketing3content'] = 'Рекламный блок 3 - Содержимое блока';
$string['marketing3contentdesc'] = 'Содержимое, отображаемое в окне рекламного блока. Оно должно быть коротким и стимулирующим.';
$string['marketing3desc'] = 'Заголовок может быть показан на рекламном блоке';
$string['marketing3icon'] = 'Рекламный блок 3 - Иконка';
$string['marketing3icondesc'] = 'Название иконки, которую вы хотите использовать. Список иконок <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">здесь</a>. Просто введите то, что после "icon-".';
$string['marketing3image'] = 'Рекламный блок 3 - Изображение';
$string['marketing3imagedesc'] = 'Эта настройка дает возможность отображать изображение над текстом в рекламном блоке';

/* Social Networks */
$string['socialheading'] = 'Социальные сети';
$string['socialheadingsub'] = 'Привлекайте пользователей социальных сетей';
$string['socialdesc'] = 'Обеспечиваются прямые ссылки на основные социальные сети, продвигающие Ваш бренд. Они будут появляться в заголовке каждой страницы.';
$string['socialnetworks'] = 'Социальные сети';
$string['facebook'] = 'Фейсбук URL';
$string['facebookdesc'] = 'Введите URL на Вашу страницу в Фейсбук. (i.e http://www.facebook.com/mycollege)';

$string['twitter'] = 'Twitter URL';
$string['twitterdesc'] = 'Введите URL на Вашу ленту в Twitter. (i.e http://www.twitter.com/mycollege)';

$string['googleplus'] = 'Google+ URL';
$string['googleplusdesc'] = 'Введите URL на Ваш профиль Google+. (i.e http://plus.google.com/107817105228930159735)';

$string['linkedin'] = 'LinkedIn URL';
$string['linkedindesc'] = 'Введите URL на Ваш профиль в LinkedIn. (i.e http://www.linkedin.com/company/mycollege)';

$string['youtube'] = 'YouTube URL';
$string['youtubedesc'] = 'Введите URL на Ваш канал в YouTube. (i.e http://www.youtube.com/mycollege)';

$string['flickr'] = 'Flickr URL';
$string['flickrdesc'] = 'Введите URL на Вашу страницу в Flickr. (i.e http://www.flickr.com/mycollege)';

$string['vk'] = 'ВКонтанке URL';
$string['vkdesc'] = 'Введите URL на Вашу страницу ВКонтанке. (i.e http://www.vk.com/mycollege)';

$string['skype'] = 'Аккаунт Skype';
$string['skypedesc'] = 'Введите имя пользователя Skype от профиля Skype Вашей организации';

$string['pinterest'] = 'Pinterest URL';
$string['pinterestdesc'] = 'Введите URL на Вашу страницу в Pinterest. (i.e http://pinterest.com/mycollege)';

$string['instagram'] = 'Instagram URL';
$string['instagramdesc'] = 'Введите URL на Вашу страницу в Instagram. (i.e http://instagram.com/mycollege)';

$string['website'] = 'URL вебсайта';
$string['websitedesc'] = 'Введите URL на Ваш вебсайт. (i.e http://www.pukunui.com)';

/* Mobile Apps */
$string['mobileappsheading'] = 'Мобильные приложения';
$string['mobileappsheadingsub'] = 'Ссылка на Ваше приложение доступная для студентов использующих мобильные устройства';
$string['mobileappsdesc'] = 'У вас есть веб-приложение в магазинах App Store или Google Play? Вы можете указать ссылки на эти приложения в этом месте, чтобы пользователи смогли получить к ним доступ онлайн';

$string['android'] = 'Android (Google Play)';
$string['androiddesc'] = 'Введите URL Вашего мобильного приложения в магазине Google Play. Если у Вас нет Вашего приложения, Вы можете ввести в это поле ссылку на официальное мобильное приложение Moodle.';

$string['ios'] = 'iPhone/iPad (App Store)';
$string['iosdesc'] = 'Введите URL Вашего мобильного приложения в магазине App Store. Если у Вас нет Вашего приложения, Вы можете ввести в это поле ссылку на официальное мобильное приложение Moodle.';

/* Alerts */
$string['ie7message'] = '<p id="ie7message">Просим прощения, но этот сайт требует <strong>Internet Explorer 8</strong> или выше для отображения и корректной работы. Пожалуйста, обновите свой браузер с помощью Windows Update, или <a href="http://windows.microsoft.com/en-au/internet-explorer/download-ie" target="_blank">загрузите последнюю версию здесь</a>. Кроме того, вы можете попробовать установить <a href="http://www.google.com/chromeframe" target="_blank">ChromeFrame плагин</a>, который может решить некоторые из проблем, возникающих в старых браузерах. Если Вы продолжите сталкиваться с подобной проблемой, свяжитесь со службой поддержки.</p>';
