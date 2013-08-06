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
<h3>Essential Hakkında </h3>
<p>Essential tema özelliklerini ve stillerini  Moodle bootsrap temasında almaktadır.</p>
<h3>Parents</h3>
<p>Bu tema Bootstrap teması üzerine aşağıdakilerin katkılarıyla kurulmuştur:<br>
Stuart Lamour, Mark Aberdour, Paul Hibbitts, Mary Evans.</p>
<h3>Temaya Katkıda bulunanlar</h3>
<p>Geliştiricisi: Julian Ridden<br>
İletişim: julian@moodleman.net<br>
Web Sayfası: <a href="http://www.moodleman.net">www.moodleman.net</a>
</p>
</div></div>';

/* General */
$string['geneicsettings'] = 'Genel Ayarlar';
$string['customcss'] = 'Özelleştirilmiş CSS';
$string['customcssdesc'] = 'Hangi CSS kuralını eklerseniz ekleyin özelleştirmeyi kolaşlaştırmak adına bütün sayfaları etkileyecektir.';
$string['footnote'] = 'Dipnot';
$string['footnotedesc'] = 'Bu alana eklediğiniz her yazı bütün sayfaların altında dipnot olarak görüntülenecektir..';
$string['invert'] = 'Menü renklerini terse çevir.';
$string['invertdesc'] = 'Metin ve arkaplan renklerini siyah-beyaz olarak değiştirmek için kullanılır.';
$string['logo'] = 'Logo';
$string['logodesc'] = 'Başlık bölümüne özelliştirilmiş logonuzu eklemek için logo dosyasını yükleyiniz.<br>Yüklediğinizde standart icon ve yanındaki isim logonuzla yer değiştirecektir.';
$string['copyright'] = 'Telif';
$string['copyrightdesc'] = 'Kurumunuzun Adı.';
$string['profilebarcustomtitle'] = 'Profil bölümü özelleştrilmiş başlık';
$string['profilebarcustomtitledesc'] = 'Profil bölümü özelleştrilmiş başlık';
$string['contactinfo'] = 'İletişim Bilgisi';
$string['contactinfodesc'] = 'İletişim bilginizi giriniz';
$string['siteicon'] = 'Site ikonu';
$string['siteicondesc'] = 'Logonuz mevcut mu?Kullanmak istediğiniz ikon ismini giriniz. Listeye  <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">Bu sayfadan </a>. erişebilirsiniz. Sadece "icon-" dan sonraki kısmı giriniz. ';
$string['yourprofile'] = 'Siz';
$string['headerprofilepic'] = 'Kullanıcı fotoğrafını görüntüle';
$string['headerprofilepicdesc'] = 'Tıklanırsa başlık bölümünde kullanıcı fotoğrafı görüntülenecektir.';
$string['layout'] = 'Standart ders yerleşim şablonunu kullan.';
$string['layoutdesc'] = 'Bu tema blokları sağa gelecek şekilde dizayn edilmiştir. Fakat hala sıkıcı standart 3 kolonlu Moodle görünümünü kullanmak istiyorsanız tıklayınız.';
$string['perfinfo'] = 'Performans bilgisini göster';
$string['perfinfodesc'] = 'Çoğu site detaylı performan bilgisine ihtiyaç duymaz. Çoğunlıkla kullanıcılar tarafından görüntülendiğinde. Bu özellik Aktif edildiğinde kullancılara kısa ve öz bir performans bilgisi gösterilecektir.';
$string['perf_max'] = 'Detaylı';
$string['perf_min'] = 'Özet';
$string['visibleadminonly'] = 'Bu alana sürüklenen bloklar sadece yöneticiler tarafından görüntülenebilmektedir. ';

/* Navbar Seperator */
$string['navbarsep'] = 'Konum ayracı';
$string['navbarsepdesc'] = 'Burada sayfada nerede olduğunuzu gösteren başlık bilgisindeki bölümler arasındaki ayracı belirleyebilirsiniz';
$string['nav_thinbracket'] = 'İnce Parantez';
$string['nav_doublebracket'] = 'Çift ince parantez';
$string['nav_thickbracket'] = 'Kalın Parantez';
$string['nav_slash'] = 'Sağa doğru slash işareti';
$string['nav_pipe'] = 'Dikey Çizgi';

/* Regions */
$string['region-side-post'] = 'Sağ';
$string['region-side-pre'] = 'Sol';
$string['region-footer-left'] = 'Sol altalan';
$string['region-footer-middle'] = 'Orta altalan';
$string['region-footer-right'] = 'Sağ altalan';
$string['region-hidden-dock'] = 'Kullanıcılardan sakla';

/* Colors */
$string['colorheading'] = 'Renk Ayarları';
$string['colorheadingsub'] = 'Temanızda kullanılacak renkleri belirleyiniz.';
$string['colordesc'] = 'Burda temada bulunan çeşitli renkleri değiştirebileceğiniz renkleri bulabilirsiniz.';

$string['themecolor'] = 'Tema Rengi';
$string['themecolordesc'] = 'Tema Hangi Renk olmalı. Bu ayar çoğu bileşendeki ayarlamak istediğiniz rengi belirler.';
$string['themehovercolor'] = 'Tema Hover rengi';
$string['themehovercolordesc'] = 'Tema hover renginizin ne olacağını belirlersiniz. Bu linkler ve menü öğerlerinde kullanaılacaktır.';
$string['footercolor'] = 'Sayfa altlığı geriplan rengi';
$string['footercolordesc'] = 'Sayfa altlığı kutusunun rengini belirlemeye yarar.';
$string['footersepcolor'] = 'Sayfa altlığı ayracı rengi';
$string['footersepcolordesc'] = 'Ayraçlar içeriği ayırmak için kullanılan çizgilerdir. Bu çizgilerin rengini burada belirleyebilirsiniz.';
$string['footertextcolor'] = 'Sayfa altlığı metin rengi';
$string['footertextcolordesc'] = 'Sayfa altlığı metin rengini burada belirleyebilirsiniz.';
$string['footerurlcolor'] = 'Sayfa altlığı Link rengi';
$string['footerurlcolordesc'] = 'Sayfa altlığında bulunan linkin rengini burada ayaralayabilirsiniz.';
$string['footerhovercolor'] = 'Sayfa Altlığı link(bağlantı) hover(bağlantı vurgusu) Rengi.';
$string['footerhovercolordesc'] = 'Sayfa altlığındaki bağlantının üzerine gelince hangi renk olmasını istediğinizi burada belirleyiniz.';
$string['footerheadingcolor'] = 'Sayfa Altlığı Başlık Rengi';
$string['footerheadingcolordesc'] = 'Sayfa altlığında bulunan blokların başlığını burada belirleyebilirsiniz.';
$string['pagebackground'] = 'Sayfa Arkaplan Resmi';
$string['pagebackgrounddesc'] = 'Kendi arka plan resminizi yükleyiniz. Bu bütün sayfalardaki arka plana yayılacaktır. Eğer yüklenmezse varsayılan resim kullanılacaktır.';

/* Slideshow */
$string['slideshowheading'] = 'Ön sayfa slayt gösterisi';
$string['slideshowheadingsub'] = 'Ön sayfa için Dinamik Slayt gösterisi';
$string['slideshowdesc'] = 'Bu sayfanızdaki önemli bulduğunuz konuları vurgulamak istediğiniz 4 sayfalık bir dinamik slayt gösterisi oluşturmanızı sağlar.';

$string['hideonphone'] = 'Mobil Cihazlarda Gösterilsin mi ?';
$string['hideonphonedesc'] = 'Slayt gösterisinin mobil cihazlarda gösterilip gösterilmeyeceğini belirleyiniz.';
$string['display'] = 'Göster';
$string['dontdisplay'] = 'Gösterme';
$string['readmore'] = 'Devamı';

$string['slideshowTitle'] = 'Slayt Gösterisi';
$string['slide1'] = 'Sayfa 1: Başlık';
$string['slide1desc'] = 'Slayt Gösterisindeki bu sayfa için açıklayıcı bir başlık belirleyiniz.';
$string['slide1image'] = 'Sayfa 1: Resim';
$string['slide1imagedesc'] = 'En iyi sonuç alabilmek için resmin şeffaf olmasına özen gösteriniz.(Resim boyutu 256px x 256px olmalıdır)';
$string['slide1caption'] = 'Sayfa 1: Resim açıklaması';
$string['slide1captiondesc'] = '1. sayfa için Resmi açılkayan metin giriniz.';
$string['slide1url'] = 'Sayfa 1: Resim Bağlantısı';
$string['slide1urldesc'] = '1. Sayfa Resim bağlantısının Hedef URL sini belirtiniz.';

$string['slideshowTitle'] = 'Slayt Gösterisi';
$string['slide1'] = 'Sayfa 2: Başlık';
$string['slide1desc'] = 'Slayt Gösterisindeki bu sayfa için açıklayıcı bir başlık belirleyiniz.';
$string['slide1image'] = 'Sayfa 2: Resim';
$string['slide1imagedesc'] = 'En iyi sonuç alabilmek için resmin şeffaf olmasına özen gösteriniz.(Resim boyutu 256px x 256px olmalıdır)';
$string['slide1caption'] = 'Sayfa 2: Resim açıklaması';
$string['slide1captiondesc'] = '2. sayfa için Resmi açılkayan metin giriniz.';
$string['slide1url'] = 'Sayfa 2: Resim Bağlantısı';
$string['slide1urldesc'] = '2. Sayfa Resim bağlantısının Hedef URL sini belirtiniz.';


$string['slideshowTitle'] = 'Slayt Gösterisi';
$string['slide1'] = 'Sayfa 3: Başlık';
$string['slide1desc'] = 'Slayt Gösterisindeki bu sayfa için açıklayıcı bir başlık belirleyiniz.';
$string['slide1image'] = 'Sayfa 3: Resim';
$string['slide1imagedesc'] = 'En iyi sonuç alabilmek için resmin şeffaf olmasına özen gösteriniz.(Resim boyutu 256px x 256px olmalıdır)';
$string['slide1caption'] = 'Sayfa 3: Resim açıklaması';
$string['slide1captiondesc'] = '3. sayfa için Resmi açılkayan metin giriniz.';
$string['slide1url'] = 'Sayfa 3: Resim Bağlantısı';
$string['slide1urldesc'] = '3. Sayfa Resim bağlantısının Hedef URL sini belirtiniz.';


$string['slideshowTitle'] = 'Slayt Gösterisi';
$string['slide1'] = 'Sayfa 4: Başlık';
$string['slide1desc'] = 'Slayt Gösterisindeki bu sayfa için açıklayıcı bir başlık belirleyiniz.';
$string['slide1image'] = 'Sayfa 4: Resim';
$string['slide1imagedesc'] = 'En iyi sonuç alabilmek için resmin şeffaf olmasına özen gösteriniz.(Resim boyutu 256px x 256px olmalıdır)';
$string['slide1caption'] = 'Sayfa 4: Resim açıklaması';
$string['slide1captiondesc'] = '4. sayfa için Resmi açılkayan metin giriniz.';
$string['slide1url'] = 'Sayfa 4: Resim Bağlantısı';
$string['slide1urldesc'] = '4. Sayfa Resim bağlantısının Hedef URL sini belirtiniz.';

/* Marketing Spots */
$string['marketingheading'] = 'Pazarlama kutucukları';
$string['marketingheadingsub'] = 'Bu kutucuklar ön sayfada yer alan 3 adet bilgi ve bağlantı içeren bölgelerden oluşmaktadır.';
$string['marketingheight'] = 'Pazarlama resimlerinin yüksekliği';
$string['marketingheightdesc'] = 'Pazarlama kutucuklarında resim gösterilmesini istiyorsanız boyutunu burada belirleyebilirsiniz.';
$string['marketingdesc'] = 'Bu tema slayt gösterisinin hemen altında reklam veya pazarlama kutucukları eklemenizi sağlayak bir özellik içermektedir. Bunlar sisteminizle ilgili temel özellikleri içerip kullanıcıların kolayca erişimini direk bağlantılar yardımıyla sağlamaktadır.';

$string['togglemarketing'] = 'Pazarlama kutucuklarını Gizle/Göster';
$string['togglemarketingdesc'] = 'Pazarlama kutucuklarınız Gizlemek/Göstermek için burayı seçiniz.';


$string['marketing1'] = 'Pazarlama kutucuğu 1 - Başlık';
$string['marketing1desc'] = 'Bu kutudaki başlığı belirtiniz.';
$string['marketing1icon'] = 'Pazarlama kutucuğu 1 - İkon';
$string['marketing1icondesc'] = 'Kullanmak istediğiniz ikonun adını belirtiniz. Bütün listeye  <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">Buradan</a> erişebilirsiniz. Sadece "icon-" dan sonraki kısmı yazınız.';
$string['marketing1image'] = 'Pazarlama Kutucuğu 1 - Resim';
$string['marketing1imagedesc'] = 'Bu pazarlama kutucuğu içerisindeki metnin hemen üzerinde göstermek istediğiniz resmi ayarlamanızı sağlar.';
$string['marketing1content'] = 'Pazarlama kutucuğu 1 - İçerik';
$string['marketing1contentdesc'] = 'Pazarlama kutucuğunda gösterilmesini istediğiniz içerik metnini giriniz. Bu metni kısa ve öz tutun.';
$string['marketing1buttontext'] = 'Pazarlama Kutucuğu 1 - Bağlantı Metni';
$string['marketing1buttontextdesc'] = 'Buton üzerinde gösterilecek metni belirleyiniz.';
$string['marketing1buttonurl'] = 'Pazarlama Kutucuğu 1 - Bağlantı URL si';
$string['marketing1buttonurldesc'] = 'Butona tıklanınca gidilecek web adresini giriniz.';


$string['marketing1'] = 'Pazarlama kutucuğu 2 - Başlık';
$string['marketing1desc'] = 'Bu kutudaki başlığı belirtiniz.';
$string['marketing1icon'] = 'Pazarlama kutucuğu 2 - İkon';
$string['marketing1icondesc'] = 'Kullanmak istediğiniz ikonun adını belirtiniz. Bütün listeye  <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">Buradan</a> erişebilirsiniz. Sadece "icon-" dan sonraki kısmı yazınız.';
$string['marketing1image'] = 'Pazarlama Kutucuğu 2 - Resim';
$string['marketing1imagedesc'] = 'Bu pazarlama kutucuğu içerisindeki metnin hemen üzerinde göstermek istediğiniz resmi ayarlamanızı sağlar.';
$string['marketing1content'] = 'Pazarlama kutucuğu 2 - İçerik';
$string['marketing1contentdesc'] = 'Pazarlama kutucuğunda gösterilmesini istediğiniz içerik metnini giriniz. Bu metni kısa ve öz tutun.';
$string['marketing1buttontext'] = 'Pazarlama Kutucuğu 2 - Bağlantı Metni';
$string['marketing1buttontextdesc'] = 'Buton üzerinde gösterilecek metni belirleyiniz.';
$string['marketing1buttonurl'] = 'Pazarlama Kutucuğu 2 - Bağlantı URL si';
$string['marketing1buttonurldesc'] = 'Butona tıklanınca gidilecek web adresini giriniz.';

$string['marketing1'] = 'Pazarlama kutucuğu 3 - Başlık';
$string['marketing1desc'] = 'Bu kutudaki başlığı belirtiniz.';
$string['marketing1icon'] = 'Pazarlama kutucuğu 3 - İkon';
$string['marketing1icondesc'] = 'Kullanmak istediğiniz ikonun adını belirtiniz. Bütün listeye  <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">Buradan</a> erişebilirsiniz. Sadece "icon-" dan sonraki kısmı yazınız.';
$string['marketing1image'] = 'Pazarlama Kutucuğu 3 - Resim';
$string['marketing1imagedesc'] = 'Bu pazarlama kutucuğu içerisindeki metnin hemen üzerinde göstermek istediğiniz resmi ayarlamanızı sağlar.';
$string['marketing1content'] = 'Pazarlama kutucuğu 3 - İçerik';
$string['marketing1contentdesc'] = 'Pazarlama kutucuğunda gösterilmesini istediğiniz içerik metnini giriniz. Bu metni kısa ve öz tutun.';
$string['marketing1buttontext'] = 'Pazarlama Kutucuğu 3 - Bağlantı Metni';
$string['marketing1buttontextdesc'] = 'Buton üzerinde gösterilecek metni belirleyiniz.';
$string['marketing1buttonurl'] = 'Pazarlama Kutucuğu 3 - Bağlantı URL si';
$string['marketing1buttonurldesc'] = 'Butona tıklanınca gidilecek web adresini giriniz.';


/* Social Networks */
$string['socialheading'] = 'Sosyal Ağlar';
$string['socialheadingsub'] = 'Kullanıcılarınızı Sosyal Ağlarla bağlayınız.';
$string['socialdesc'] = 'Markanızı ve sisteminizi öne çıkaran sosyal ağ adresinize direk bağlantı verin. Bu her sayfanın sağında  başlık bölümünde bulunacaktır.';
$string['socialnetworks'] = 'Sosyal Ağlar';
$string['facebook'] = 'Facebook URL';
$string['facebookdesc'] = 'Facebook sayfanızın URL sini giriniz. (örn: http://www.facebook.com/universitem)';

$string['twitter'] = 'Twitter URL';
$string['twitterdesc'] = 'Twitter sayfanızın URL sini giriniz. (örn: http://www.twitter.com/universitem)';

$string['googleplus'] = 'Google+ URL';
$string['googleplusdesc'] = 'Google+ profilinizin URLsini giriniz. (örn: http://plus.google.com/107817105228930159735)';

$string['linkedin'] = 'LinkedIn URL';
$string['linkedindesc'] = 'LinkedIn profilinizin URLsini giriniz. (örn: http://www.linkedin.com/company/universitem)';

$string['youtube'] = 'YouTube URL';
$string['youtubedesc'] = 'Youtube kanalınızın URLsini giriniz. (örn: http://www.youtube.com/universitem)';

$string['flickr'] = 'Flickr URL';
$string['flickrdesc'] = 'Flickr Sayfanızın URLsini giriniz (örn: http://www.flickr.com/Universitem)';

/* Alerts */
$string['ie7message'] = '<p id="ie7message">Üzgünüz bu sayfa düzün çalışabilmesi için  <strong>Internet Explorer 8</strong> veya Daha yüksek versiyonuna ihtiyacı vardır. Lütfen tarayıcınızı Windows Güncellemeler yardımıyla güncelleyiniz veya  <a href="http://windows.microsoft.com/en-au/internet-explorer/download-ie" target="_blank">Son versiyonu bu linkten indiriniz</a>. Veya alternatif bir yöntem olarak <a href="http://www.google.com/chromeframe" target="_blank">ChromeFrame eklentisini</a> indirebilrsiniz. Bu eski tarayıcılarda uyuyumluluk sorunlarını çözebilen bir eklentidir. 
Eğer IE8 veya Yükseğini Uyuyumluluk Modunda çalıştırıyorsanız, sayfayı düzgün görüntüleyebilmek için bu özelliği kaptınız. Eğer sorununuz hala düzelmediyse Lütfen Yardım masasına başvurunuz.</p>';
