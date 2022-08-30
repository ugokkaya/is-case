##### Açıklamalar

Laravel framework kullanılmıştır.

İndirimler kısmı Enums kısmında tanımlanmıştır. Buna bağlı olarak indirim kuralının çalışacağı dosya yolu burda belirtilmiştir. Tanımlanan Enumlar Services\OrderDiscount kısmında otomatik import edilmektedir. Daha gelişmiş bir versiyon düşünülürse bu kısım veritabanına kaydırılabilir.

Sipariş ekleme ve silme aşamalarından sonra stok güncellerken DB Transaction kullanılarak veri güvenliği sağlanmıştır.

Ürün listesi olarak sizin reponuzda bulunan [[products.json]][products] kullanılmıştır.

Müşteri listesi olarak laravel faker ile 10 adet müşteri oluşturulmaktadır.

Postman collection repoya eklenmiştir. Collection içinde sample data lar mevcuttur.

##### Ayağa kaldırma

`git clone https://github.com/ugokkaya/is-case.git
`

`cd is-case
`

Change root user (`sudo -s`) -> Linux ve macOS için

`composer install
`

`docker compose up
`

Docker üzerinden terminal açılırsa aşağıdaki komuta gerek yoktur.

`docker container exec -it laravel-api bash
`

`php artisan migrate
`

`php artisan db:seed`




[products]: https://github.com/ugokkaya/is-case/blame/main/database/data/products.json " product.json"
