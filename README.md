# Admin Panel Generator v.1


Bu projede amaç kod yazmadan sadece yazılım zihniyetine sahip birinin kod yazmadan panel üzerinde form doldurarak sıfırdan istediği özelliklerde bir admin paneline sahip olabilir.

10 Mart 2020 - 20 Mayıs 2020 tarihleri arasında geliştirildi.

## Roller Yönetimi
- Super Admin (Projeyi kodsuz olarak inşa edebilme yeteneği)
- Admin (Projeyi Super Adminden istediği özellikler ile satın alan kişi)
- ..... Dinamik rol ekleme ve izinlerini düzenleyebilme imkanı.

## Dinamik Database
- MySQL üzerinde tablo oluşturabiliyor.
- Oluşturulan tablolar üzerinde panel üzerinden kolon adı girilerek tabloda istenilen tipte istenilen özellikte (indexleme, unique sınırlaması) kolon oluşturulabiliyor. 
- Tablolar arasında teke tek, teke çok veya çoka çok ilişkiyi kurabiliyor.
- Oluşturulan tabloların Laravel tarafında Eloquent ORM ile daha efektif kullanılabilmesi için her tablo oluşturulurken o tabloya ait modeller otomatik oluşturuluyor arka planda.


## Modul Yönetimi
- Super Admin tarafından bir modül oluşturulduğunda sol menüde o modülün adıyla otomatik olarak bir menü oluşur.
- Modül içine tablo ve tablo içindeki kolonları eklerken, selectbox'dan text, number, resim, çoklu resim, dosya, büyük text alanı, selectbox, çoklu checkbox, çoklu seçim yapılabilecek selectbox gibi gibi veri girdileri için bu kabiliyetleri veren form kontrolleri ve veri girildikten sonra bunların gösterimini sağlamak için ve düzenleme sayfasında düzenlemeyi otomatik yapması için otomatik olarak kodsuz üretilebilmesini sağlıyor.

## Diğer
- Her admin panelinde olması gereken profil yönetimi, giriş, çıkış, parolamı unuttum gibi özellikler.

## Teknolojiler
- PHP
- Laravel
- MySQL
- Redis
- Docker (Geliştirici ortamı için)
