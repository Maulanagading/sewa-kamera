# Belajar Laravel: Arsitektur & Panduan Membuat Web Sewa Kamera

Dokumen ini tidak hanya berisi langkah-langkah, tetapi juga penjelasan teori tentang **Arsitektur Laravel** agar kamu memahami *bagaimana* dan *mengapa* web ini bisa bekerja.

---

## Memahami Arsitektur Laravel (Konsep MVC)
Sebelum mulai ngoding, kita harus paham bagaimana cara kerja Laravel. Laravel menggunakan arsitektur **MVC (Model - View - Controller)**. 

Bayangkan sebuah restoran:
1. **Route (Resepsionis):** Menerima tamu (URL yang diakses) dan mengarahkannya ke pelayan yang tepat.
2. **Controller (Pelayan):** Menerima pesanan dari tamu, lalu pergi ke dapur (Model) untuk mengambil makanan, dan menyerahkannya ke meja tamu (View).
3. **Model (Dapur / Database):** Tempat bahan baku (data) disimpan, diolah, dan diambil.
4. **View (Meja Makan):** Tempat makanan disajikan dengan rapi dan cantik (Tampilan HTML/CSS).

**Siklus Hidup (Lifecycle) saat ada yang mengakses web kamu:**
Pengunjung Ketik URL -> Route -> Controller -> Model (ambil data dari Database) -> Controller -> View (Tampil ke layar pengunjung).

---

## Tahap 1: Persiapan dan Instalasi (Membangun Fondasi)

1. **Install Local Server (Laragon/XAMPP)**
   *Kenapa?* Komputer kita aslinya tidak mengerti bahasa PHP. Laragon bertugas menyulap komputermu menjadi "Server" (menyediakan Apache/Nginx dan MySQL Database) agar kode PHP bisa dijalankan secara lokal.
2. **Install Composer**
   *Kenapa?* Composer adalah "toko aplikasi" khusus bahasa PHP. Laravel adalah kerangka kerja (framework) yang terdiri dari ribuan file. Composer bertugas mendownload dan merakit file-file tersebut.
3. **Membuat Project Laravel**
   ```bash
   composer create-project laravel/laravel sewa-kamera
   ```
   *Penjelasan:* Perintah ini menyuruh Composer untuk mengambil *source code* Laravel terbaru dan menyimpannya ke dalam folder `sewa-kamera`.
4. **Masuk ke Direktori**
   ```bash
   cd sewa-kamera
   ```

## Tahap 2: Pengaturan Database (`.env`)

Laravel menyimpan rahasia dan konfigurasi penting di dalam file `.env` (Environment).
1. Buat database kosong bernama `sewakamera_db` di Laragon (melalui phpMyAdmin atau HeidiSQL).
2. Buka file `.env` dan atur koneksinya:
   ```env
   DB_CONNECTION=mysql       # Menggunakan database jenis MySQL
   DB_HOST=127.0.0.1         # Alamat server lokal (localhost)
   DB_PORT=3306              # Port default MySQL
   DB_DATABASE=sewakamera_db # Nama database yang baru kita buat
   DB_USERNAME=root          # Username default Laragon/XAMPP
   DB_PASSWORD=              # Password default kosong
   ```
   *Kenapa?* Laravel butuh "kunci" dan "alamat" agar bisa masuk dan ngobrol dengan databasemu.

## Tahap 3: Merancang Tabel (Migrations)

Di pemrograman lawas, kita bikin tabel manual klik-klik di phpMyAdmin. Di Laravel, kita pakai **Migration**. Migration adalah "Cetak Biru" (Blueprint) tabel database dalam bentuk kode PHP.

1. **Membuat File Migration:**
   ```bash
   php artisan make:migration create_products_table
   ```
   *Penjelasan:* Artisan adalah asisten ajaib bawaan Laravel. Perintah ini menyuruh asisten membuatkan file kerangka tabel produk.
2. **Menulis Desain Tabel:** (Buka file di `database/migrations/..._create_products_table.php`)
   ```php
   public function up(): void
   {
       Schema::create('products', function (Blueprint $table) {
           $table->id(); // Bikin primary key otomatis
           $table->string('name'); // Bikin kolom teks untuk nama produk
           $table->integer('price'); // Bikin kolom angka untuk harga
           $table->timestamps(); // Bikin kolom waktu (kapan data dibuat)
       });
   }
   ```
3. **Eksekusi Blueprint ke Database:**
   ```bash
   php artisan migrate
   ```
   *Penjelasan:* Perintah ini membaca semua cetak biru tadi dan secara otomatis membuatkan tabel fisiknya di dalam MySQL.

## Tahap 4: Menyiapkan Dapur Data (Model)

Setelah tabel tercipta, kita butuh **Model** agar kode PHP kita (Controller) bisa berkomunikasi dengan tabel tersebut. Laravel menggunakan fitur bernama **Eloquent ORM**.

1. **Membuat Model:**
   ```bash
   php artisan make:model Product
   ```
2. **Pengaturan Model (`app/Models/Product.php`):**
   ```php
   class Product extends Model
   {
       // $fillable adalah sistem keamanan Laravel (Mass Assignment Protection).
       // Ini mendefinisikan kolom apa saja yang BOLEH diisi datanya secara bersamaan.
       protected $fillable = ['name', 'category', 'price', 'image', 'stock'];
   }
   ```
   *Penjelasan:* Jika ada hacker yang mencoba menyisipkan data terlarang (misal kolom 'is_admin'), Laravel akan menolaknya karena tidak ada di dalam daftar `$fillable`.

## Tahap 5: Mengisi Data Awal (Seeders)

Agar saat di-testing webnya tidak kosong melompong, kita butuh "Data Dummy".

1. **Membuat Seeder:**
   ```bash
   php artisan make:seeder ProductSeeder
   ```
2. **Menulis Data (`database/seeders/ProductSeeder.php`):**
   ```php
   $products = [
       ['name' => 'Sony a6400', 'price' => 150000, 'category' => 'Kamera'],
       // ... data lainnya
   ];
   foreach ($products as $product) {
       Product::create($product); // Memasukkan data ke database lewat Model
   }
   ```
3. **Mengeksekusi Seeder:**
   ```bash
   php artisan db:seed --class=ProductSeeder
   ```

## Tahap 6: Membuat Sang Pengendali (Controller)

Controller adalah "otak" aplikasi. Dia tidak menyimpan data, dia juga bukan antarmuka web, tapi dia yang mengatur alurnya.

1. **Membuat Controller:**
   ```bash
   php artisan make:controller HomeController
   ```
2. **Menulis Logika (`app/Http/Controllers/HomeController.php`):**
   ```php
   public function index()
   {
       // Menyuruh Model 'Product' mengambil SEMUA data dari tabel, lalu dikelompokkan
       $products = Product::all()->groupBy('category');
       
       // Mengirim data tersebut ($products) ke file tampilan (view) bernama 'welcome'
       return view('welcome', compact('products'));
   }
   ```

## Tahap 7: Menyiapkan Rute / Pintu Masuk (Routes)

Laravel sangat ketat. Walaupun Controller dan View sudah ada, kalau rutenya tidak didaftarkan, web tidak akan bisa dibuka.

- **Buka `routes/web.php` dan tulis:**
  ```php
  // Artinya: Saat URL utama '/' diakses dengan metode GET, 
  // jalankan fungsi 'index' milik 'HomeController'.
  Route::get('/', [HomeController::class, 'index']);
  ```

## Tahap 8: Menyajikan Tampilan (Views - Blade Templating)

File view di Laravel menggunakan mesin bernama **Blade** (akhiran filenya `.blade.php`). Blade memungkinkan kita menyisipkan logika PHP (seperti perulangan) ke dalam HTML biasa dengan sintaks yang sangat bersih.

1. **Buka file `resources/views/welcome.blade.php`.**
2. **Menggunakan Data dari Controller:**
   Ingat, di Controller tadi kita mengirim data `$products`. Di Blade, kita bisa menampilkannya seperti ini:
   ```html
   <!-- Blade punya sintaks @foreach yang lebih rapi dari PHP murni -->
   @foreach ($products as $category => $items)
       <h2>Kategori: {{ $category }}</h2>
       
       @foreach ($items as $product)
           <div class="card">
               <!-- Simbol kurung kurawal ganda {{ }} digunakan untuk mencetak teks -->
               <h3>{{ $product->name }}</h3>
               <p>Harga: Rp {{ $product->price }}</p>
           </div>
       @endforeach
   @endforeach
   ```

## Tahap 9: Uji Coba Aplikasi

Semua bagian MVC sudah saling terhubung (Route -> Controller -> Model -> View). Saatnya menjalankan web!

1. Buka terminal:
   ```bash
   php artisan serve
   ```
   *Penjelasan:* Artisan menyediakan *mini-server* instan. Kamu tidak perlu repot menyeting Apache.
2. Buka browser dan ketik alamat yang diberikan (biasanya `http://localhost:8000`).

**Selamat!** Website Sewa Kamera buatanmu sudah berjalan berdasarkan arsitektur standar industri (Laravel).
