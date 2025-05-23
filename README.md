GYG-PROJECT-SECURE-VERSION
Proje Hakkında
Bu proje, güvenli bir tarif paylaşım platformu sunmaktadır. Kullanıcıların kayıt olabileceği, giriş yapabileceği, tariflerini ekleyebileceği ve diğer kullanıcıların tariflerini görüntüleyebileceği web tabanlı bir uygulamadır. Proje, özellikle güvenlik önlemleri göz önünde bulundurularak geliştirilmiştir.

Özellikler
Kullanıcı Yönetimi
Güvenli kayıt sistemi
Şifrelerin güvenli bir şekilde hashlenmesi
Oturum yönetimi ve güvenli kimlik doğrulama
Kullanıcı girişi ve çıkışı
Tarif Yönetimi
Tarif ekleme, düzenleme ve silme
Tarif kategorileri
Resim yükleme desteği
Malzeme listesi ve hazırlanış adımları
Güvenlik Özellikleri
SQL enjeksiyon koruması
XSS (Cross-Site Scripting) koruması
CSRF (Cross-Site Request Forgery) koruması
Güvenli dosya yükleme sistemi
Giriş denemelerinin sınırlandırılması
Dosya Yapısı
secure-login.php: Kullanıcı kayıt ve giriş işlemlerini yönetir.
secure-dashboard.php: Ana sayfa ve tarif listeleme sayfası.
secure-adding-recipe.php: Tarif ekleme sayfası.
secure-db.php: Veritabanı bağlantısı ve güvenli sorgu fonksiyonları.
Güvenlik Önlemleri
Veritabanı Güvenliği
Parametreli sorgular kullanılarak SQL enjeksiyon saldırıları önlenir.
Kullanıcı şifreleri güvenli hash algoritmaları ile saklanır.
Giriş Güvenliği
Brute force saldırılarına karşı giriş denemeleri sınırlandırılmıştır.
Oturum çerezleri güvenli ve HttpOnly olarak ayarlanmıştır.
Oturum verilerinin çalınmasını önlemek için oturum kimliği doğrulaması yapılır.
Form Güvenliği
CSRF token kullanılarak cross-site request forgery saldırıları engellenir.
Girdi doğrulama ve temizleme işlemleri yapılarak XSS saldırıları önlenir.
Dosya Yükleme Güvenliği
Yüklenen dosyaların türü ve boyutu kontrol edilir.
Dosya adları benzersiz olacak şekilde yeniden adlandırılır.
Yüklenen dosyalar web kök dizini dışında saklanır.
İletişim
Erdem Kumaş - GitHub
