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
<p>Авторы: Julian Ridden<br>
Контакты: julian@moodleman.net<br>
Веб=сайт: <a href="http://www.moodleman.net">www.moodleman.net</a>
</p>
</div></div>';

/* General */
$string['geneicsettings'] = 'Основные настройки';
$string['autohide'] = 'Автоматически показывать/скрывать иконки в режиме редактирования';
$string['autohidedesc'] = 'Режим автоматического показа/скрытия иконок в режиме редактирования разработан для того, чтобы сделать Moodle более эстетичным. В режиме редактирования иконки показываются только для того блока, над которым находится курсор мыши.';
$string['editicons'] = 'Иконки настроек в стиле Awesome';
$string['editiconsdesc'] = 'Все иконки настроек, на страницах курса и блоках, будут отображаться цветными и акуратно отформатированными шрифтом Awesome. Обратите внимание, что сейчас эта функция НЕ совместима с режимом автоскрытия иконок настроек.';
$string['customcss'] = 'Дополнительный CSS';
$string['customcssdesc'] = 'Дополнительные CSS правила, которые будут добавлены ко всему сайту, что облегчает настройку этой темы.';
$string['footnote'] = 'Нижний колонтитул';
$string['footnotedesc'] = 'Все что Вы добавите в эту зону будет отображаться внизу каждой страницы сайта Moodle.';
$string['invert'] = 'Инвертировать цвета панели навигации';
$string['invertdesc'] = 'Инвертировать цвета текста и фона для панели навигации в верхней части страницы между черным и белым.';
$string['logo'] = 'Логотип';
$string['logodesc'] = 'Пожалуйста загрузите свой логотип, если Вы хотите добавить его в заголовок сайта.<br>Если Вы это сделаете, этот рисунок заменит иконку и название сайта, отображаемые по-умолчанию.';
$string['bootstrapcdn'] = 'FontAwesome из CDN';
$string['bootstrapcdndesc'] = 'Если отмечено, загрузка FontAwesome произходит из онлайн истичника Bootstrap CDN. Включите эту опцию, если Вы испытываете проблемы с получением Font Awesome иконок на Вашем сайте.';
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
$string['backtotop'] = 'К началу';

/* CustomMenu */
$string['custommenuheading'] = 'Пользовательское меню';
$string['custommenuheadingsub'] = 'Включает новые возможности пользовательского меню.';
$string['custommenudesc'] = 'Эти настройки разрешают добавлять динамическое пользовательское меню (так же может называтся раскрывающийся список)';

$string['mydashboardinfo'] = 'Личный кабинет пользователя';
$string['mydashboardinfodesc'] = 'Отображает список общих функций, используемых пользователями.';
$string['displaymydashboard'] = 'Отображать личный кабинет';
$string['displaymydashboarddesc'] = 'Отображать ссылку на личный кабинет в пользовательском меню';

$string['mycoursesinfo'] = 'Динамический список изучаемых курсов';
$string['mycoursesinfodesc'] = 'Отображать динамический список изучаемых пользователями курсов.';
$string['displaymycourses'] = 'Отображать илучаемые курсы';
$string['displaymycoursesdesc'] = 'Отображать изучаемые курсы в пользовательском меню';

$string['mycoursetitle'] = 'Терминология';
$string['mycoursetitledesc'] = 'Измените терминологию для ссылки "Мои курсы" в выпадающем меню';
$string['mycourses'] = 'Мои курсы';
$string['myunits'] = 'Мои задания';
$string['mymodules'] = 'Мои модули';
$string['myclasses'] = 'Мои классы';
$string['allcourses'] = 'Все курсы';
$string['allunits'] = 'Все задания';
$string['allmodules'] = 'Все модули';
$string['allclasses'] = 'Все классы';
$string['noenrolments'] = 'Вы не подписаны ни на один курс';

/* My Dashboard custommenu dropdown */
$string['mydashboard'] = 'Личный кабинет';

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

/* Frontpage Content */
$string['frontcontentheading'] = 'Контент на главной странице';
$string['frontcontentheadingsub'] = 'Добавить для пользователей информацию на главной странице';
$string['frontcontentdesc'] = 'Эта опция дает возможность добавить пользовательский контент в область между слайд-шоу и рекламными блоками';

$string['usefrontcontent'] = 'Включить контент на главной странице';
$string['usefrontcontentdesc'] = 'Если опция включена в области между слайд-шоу и рекламными блоками будет отображатся пользовательский контент.';

$string['frontcontentarea'] = 'Контент на главной странице';
$string['frontcontentareadesc'] = 'Все, что Вы введете в этом окне будет отображается в области между слайд-шоу и рекламными блоками';

/* Slideshow */
$string['slideshowheading'] = 'Слайды на главной странице';
$string['slideshowheadingsub'] = 'Динамические слайды на главной странице';
$string['slideshowdesc'] = 'С помощью этих настроек создается динамическое слайд-шоу состоящее максимум из 4 слайдов, предназначенных для продвижения важных элементов вашего сайта.';

$string['hideonphone'] = 'Показывать слайды на мобильных устройствах';
$string['hideonphonedesc'] = 'Выберите, если Вы хотите, чтобы слайды показывались на мобильных устройствах';
$string['display'] = 'Отображать';
$string['dontdisplay'] = 'Не отображать';
$string['readmore'] = 'Подробнее';

$string['slideshowTitle'] = 'Слайд-шоу';
$string['slideinfodesc'] = 'Введите настройки для Ваших слайдов.';
$string['slide1'] = 'Слайд первый';
$string['slide2'] = 'Слайд второй';
$string['slide3'] = 'Слайд третий';
$string['slide4'] = 'Слайд четвертый';

$string['slidetitle'] = 'Заголовок';
$string['slidetitledesc'] = 'Введите заголовок для Вашего слайда';
$string['slideimage'] = 'Изображение';
$string['slideimagedesc'] = 'Лучше всего использовать изображения с прозрачностью. (Размер изображения должен быть 256px X 256px)';
$string['slidecaption'] = 'Описание';
$string['slidecaptiondesc'] = 'Введите описание для Вашего слайда';
$string['slideurl'] = 'Ссылка';
$string['slideurldesc'] = 'Введите URL-ссылку для Вашего слайда';

/* Marketing Spots */
$string['marketingheading'] = 'Рекламные блоки';
$string['marketinginfodesc'] = 'Введите настройки Вашего рекламного блока.';
$string['marketingheadingsub'] = 'Это три блока на главной странице для важной информации и ссылок';
$string['marketingheight'] = 'Высота изображения в рекламном блоке';
$string['marketingheightdesc'] = 'Если Вы хотите показывать изображения в рекламных блоках в этом поле можно задать для них высоту.';
$string['marketingdesc'] = 'Эта тема дает возможность включить три "рекламных" или "содержательных" блока, размещенных под слайдами. Это позволит Вам легко донести основную информацию для пользователей и обеспечить возможность получения ими прямых ссылок на нужный контент.';

$string['togglemarketing'] = 'Показывать рекламные блоки';
$string['togglemarketingdesc'] = 'Выберите показывать или нет рекламные блоки на сайте.';


$string['marketing1'] = 'Первый рекламный блок';
$string['marketing2'] = 'Второй рекламный блок';
$string['marketing3'] = 'Третий рекламный блок';

$string['marketingtitle'] = 'Название';
$string['marketingtitledesc'] = 'Введите название этого рекламного блока';
$string['marketingicon'] = 'Иконка';
$string['marketingicondesc'] = 'Название иконки, которую вы хотите использовать. Список иконок <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">здесь</a>. Просто введите то, что после "icon-".';
$string['marketingimage'] = 'Изображение';
$string['marketingimagedesc'] = 'Эта настройка дает возможность отображать изображение над текстом в рекламном блоке';
$string['marketingcontent'] = 'Содержимое блока';
$string['marketingcontentdesc'] = 'Содержимое, отображаемое в окне рекламного блока. Оно должно быть коротким и стимулирующим.';
$string['marketingbuttontext'] = 'Текст ссылки';
$string['marketingbuttontextdesc'] = 'Текст, появляющийся на кнопке.';
$string['marketingbuttonurl'] = 'URL-адрес';
$string['marketingbuttonurldesc'] = 'URL-адрес по которому перейдет пользователь нажав на кнопку рекламного блока.';

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

/* iOS Icons */
$string['iosicon'] = 'Иконки домашней страницы для iOS';
$string['iosicondesc'] = 'Здесь Вы можете установить иконки по-умолчанию для домашней страницы iOS и android устройств. Вы можете загрузить свои иконки, если Вы хотите.';

$string['iphoneicon'] = 'Иконка iPhone/iPod Touch (Не Retina)';
$string['iphoneicondesc'] = 'Иконка должна быть в виде PNG файла размером 57px на 57px';

$string['iphoneretinaicon'] = 'Иконка iPhone/iPod Touch (Retina)';
$string['iphoneretinaicondesc'] = 'Иконка должна быть в виде PNG файла размером 114px на 114px';

$string['ipadicon'] = 'Иконка iPad (Не Retina)';
$string['ipadicondesc'] = 'Иконка должна быть в виде PNG файла размером 72px на 72px';

$string['ipadretinaicon'] = 'Иконка iPad Icon (Retina)';
$string['ipadretinaicondesc'] = 'Иконка должна быть в виде PNG файла размером 144px на 144px';

/* Google Analytics */
$string['analyticsheading'] = 'Google Analytics';
$string['analyticsheadingsub'] = 'Мощная аналитика от Google';
$string['analyticsdesc'] = 'Здесь можно включить Google Analytics для вашего сайта Moodle. Вам нужно будет подписаться на бесплатный аккаунт на сайте Google Analytics (<a href="http://analytics.google.com" target="_blank">http://analytics.google.com</a>)';

$string['useanalytics'] = 'Включить Google Analytics';
$string['useanalyticsdesc'] = 'Включить или выключить Google analytics.';

$string['analyticsid'] = 'Ваш Tracking ID';
$string['analyticsiddesc'] = 'Введите Tracking ID. Обычно он имеет формат: UA-XXXXXXXX-X';

$string['analyticsclean'] = 'Посылать чистый URLs';
$string['analyticscleandesc'] = 'Эта фантастическая возможность была создана <a href="https://moodle.org/user/profile.php?id=281671" target="_blank">Gavin Henrick</a> и <a href="https://moodle.org/user/view.php?id=907814" target="_blank">Bas Brands</a> и интегрирована в эту тему. Вместо стандартых URL-адресов Moodle будет посылать чистые ссылки, что дает возможность их более простой идентификации и обеспечивает усовершенствованные возможности для создания отчетов. Более подробную информацию об использовании этой функции и её использования можно почитать <b><a href="http://www.somerandomthoughts.com/blog/2012/04/18/ireland-uk-moodlemoot-analytics-to-the-front/" target="_blank">здесь</a></b>.';

/* Alerts */
$string['alertsheading'] = 'Пользовательские оповещения';
$string['alertsheadingsub'] = 'Показать важные сообщения для пользователей на главной странице';
$string['alertsdesc'] = 'На главной странице сайта появится предупреждение (или несколько) в трех различных стилях. Пожалуйста, не забудьте отключить их, когда они будут больше не нужны.';

$string['enablealert'] = 'Включить предупреждение';
$string['enablealertdesc'] = 'Включить или выключить предупреждение';

$string['alert1'] = 'Первое предупреждение';
$string['alert2'] = 'Второе предупреждение';
$string['alert3'] = 'Третье предупреждение';

$string['alerttitle'] = 'Название';
$string['alerttitledesc'] = 'Главное название/заголовок для вашего оповещения';

$string['alerttype'] = 'Уровень';
$string['alerttypedesc'] = 'Установите соответствующий уровень тревоги/тип сообщения, для того, чтобы лучшие информировать пользователей';

$string['alerttext'] = 'Текст предупреждения';
$string['alerttextdesc'] = 'Текст, который будет отображаться в вашем предупреждении';

$string['alert_info'] = 'Информация';
$string['alert_warning'] = 'Предупреждение';
$string['alert_general'] = 'Объявление';

$string['ie7message'] = '<p id="ie7message">Просим прощения, но этот сайт требует <strong>Internet Explorer 8</strong> или выше для отображения и корректной работы. Пожалуйста, обновите свой браузер с помощью Windows Update, или <a href="http://windows.microsoft.com/en-au/internet-explorer/download-ie" target="_blank">загрузите последнюю версию здесь</a>. Кроме того, вы можете попробовать установить <a href="http://www.google.com/chromeframe" target="_blank">ChromeFrame плагин</a>, который может решить некоторые из проблем, возникающих в старых браузерах. Если Вы продолжите сталкиваться с подобной проблемой, свяжитесь со службой поддержки.</p>';
