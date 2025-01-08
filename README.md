# Coffee Shop

<p align="center"><img src="public/image/UBSI.png" width="200" alt="Logo UBSI"></p>


## Pengenalan Project

Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur, quasi! Sint aspernatur culpa, cupiditate vitae expedita sit impedit esse rem fugiat, modi est, eveniet iusto molestias qui deleniti voluptatum quos!

## Nama Kelompok
<table border="1">
  <thead>
    <tr>
      <td>No</td>
      <td>NIM</td>
      <td>Nama Anggota</td>
    </tr>
  <thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>19230339</td>
      <td>Arman Jaya Laia</td>
    </tr>
    <tr>
      <td>2</td>
      <td>19231904</td>
      <td>Arnanda Surya Mukti</td>
    </tr>
    <tr>
      <td>3</td>
      <td>19231669</td>
      <td>Raihan Muhammad Ikhsan Swarga</td>
    </tr>
    <tr>
      <td>4</td>
      <td>19231320</td>
      <td>Vivi Oktaviyanti</td>
    </tr>
    <tr>
      <td>5</td>
      <td>19230468</td>
      <td>Willy Andryan</td>
    </tr>
  </tbody>
</table>

## ERD & LRS
<p align="center"><img src="public/image/ERD.png" width="600" alt="ERD"></p>
<p align="center"><img src="public/image/LRS.jpeg" width="600" alt="LRS"></p>

## Skenario Kebutuhan Pengguna
<strong>Pelanggan</strong>
<ol>
<li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
<li>Illo amet nesciunt ipsam velit? Perferendis quo, corrupti assumenda ipsa commodi laborum aliquam..</li>
</ol>

<strong>Admin</strong>
<ol>
<li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
<li>Illo amet nesciunt ipsam velit? Perferendis quo, corrupti assumenda ipsa commodi laborum aliquam..</li>
</ol>

<strong>Kasir</strong>
<ol>
<li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
<li>Illo amet nesciunt ipsam velit? Perferendis quo, corrupti assumenda ipsa commodi laborum aliquam..</li>
</ol>

<strong>Bartender</strong>
<ol>
<li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
<li>Illo amet nesciunt ipsam velit? Perferendis quo, corrupti assumenda ipsa commodi laborum aliquam..</li>
</ol>
<!-- Sesuaikan dengan hak akses dari project masing-masing kelompok -->

## Pra-Install
Sebelumnya pastikan menginstall terlebih dahulu kebutuhan sistem untuk menggunakan project ini.
- [x] Git
- [x] Composer
- [x] Code Editor <code>VS Code, Sublime Text atau sejenisnya</code>
- [x] Web Server <code>Laragon, Xampp atau sejenisnya</code>
- [x] Web Browser <code>Chrome, Mozilla atau sejenisnya</code>
- [x] Node.js <code>(opsional)</code>

## Cara Install
1. Cloning repository ini melalui terminal. Tunggu hingga selesai cloning.
```
git clone https://github.com/Adryn27/CoffeeShop.git
```
<!-- Ubah link diatas dengan link repository yang kalian -->

2.  Buka project menggunakan Code Editor, lalu inisiasi dependensi composer melalui terminal.
```
composer install
```
3. Duplikat file `.env.example` menjadi `.env` dan konfigurasikan koneksi database menjadi seperti ini pada file `.env`
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_coffeeshop
DB_USERNAME=root
DB_PASSWORD=
```
<!-- Ubah nama DB sesuai nama DB projectnya -->

4. Generate key aplikasi pada env melalui terminal.
```
php artisan key:generate
```
5. Generate Storage Link melalui terminal agar dapat mengakses storage.
```
php artisan storage:link
```
6. Migrasikan tabel beserta seeder melalui terminal.
```
php artisan migrate:fresh --seed
```

## Screenshot
<table width="100%">
<tr>
<td><h3 align="center">Menu 1</h3><img src="folder/image1.jpg"></td>
<td><h3 align="center">Menu 2</h3><img src="folder/image2.jpg"></td>
</tr>
<tr>
<td><h3 align="center">Menu 3</h3><img src="folder/image3.jpg"></td>
<td><h3 align="center">Menu 4</h3><img src="folder/image4.jpg"></td>
</tr>
<tr>
<td><h3 align="center">Menu 5</h3><img src="folder/image5.jpg"></td>
<td><h3 align="center">Menu 6</h3><img src="folder/image6.jpg"></td>
</tr>
<tr>
<td><h3 align="center">Menu 7</h3><img src="folder/image7.jpg"></td>
<td><h3 align="center">Menu 8</h3><img src="folder/image8.jpg"></td>
</tr>
</table>

## Lisensi

Project ini dibuat untuk menyelesaikan project mata kuliah Web Programming II Universitas Bina Sarana Informatika (UBSI) yang diampu oleh Bpk. <a href="https://github.com/yuris60">Yuris Alkhalifi, M.Kom., CPDSA</a> selaku Dosen. Project ini bersifat open source untuk edukasi.
<!-- Kalian boleh mengubah bentuk lisensi ini sesuai kesepakatan kelompok apakah akan bersifat open source atau tidak -->
<blockquote>Kuliah...? BSI AJA !!</blockquote>