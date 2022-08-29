##### Açıklamalar

Laravel framework kullanılmıştır.

İndirimler kısmı Enums kısmında tanımlanmıştır. Buna bağlı olarak indirim ismi ve indirim kuralının çalışacağı dosya yolu burda belirtilmiştir. Tanımlanan Enumlar Services\OrderDiscount kısmında otomatik import edilmektedir.

Sipariş ekleme ve silme aşamalarından sonra stok güncellerken DB Transaction kullanılarak veri güvenliği sağlanmıştır.

Ürün listesi olarak sizin reponuzda bulunan [[products.json]][products] kullanılmıştır.

Müşteri listesi olarak laravel faker ile 10 adet müşteri oluşturulmaktadır.

Postman collection repoya eklenmiştir. Collection içinde sample data lar mevcuttur.

##### Ayağa kaldırma

`docker compose up
`

Change root user // Windows harici composer Update hata verirse

`sudo -s`

`composer update
`

`docker container exec -it laravel-api bash
`

`php artisan migrate
`

`php artisan db:seed`




[products]: https://github.com/ugokkaya/is-case/blame/main/database/data/products.json " product.json"
