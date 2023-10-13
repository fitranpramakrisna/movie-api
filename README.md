# Nama Proyek - API CRUD Laravel

Deskripsi singkat proyek: Proyek ini merupakan proyek API CRUD untuk movie management menggunakan Laravel. Proyek ini dilengkapi dengan proteksi otentikasi API menggunakan Sanctum. Proyek ini juga sudah dilengkapi dengan Unit Testing menggunakan PHPUnit Test

## Instalasi

1. Pastikan Anda memiliki PHP dan Composer diinstal.
2. Clone repositori ini ke komputer Anda.
3. Pindah ke direktori proyek: `cd nama-proyek`.
4. Salin file .env.example menjadi .env dan konfigurasikan pengaturan database.
5. Jalankan perintah `composer install` untuk menginstal dependensi.
6. Jalankan perintah `composer require laravel/sanctum` untuk mengunduh Sanctum.
7. Jalankan migrasi database: `php artisan migrate`.

## Konfigurasi

- Pastikan untuk mengatur pengaturan database Anda di file `.env`.
- Atur konfigurasi lainnya seperti kunci API atau pengaturan lainnya yang diperlukan di file `.env`.

## Cara Menggunakan

- API untuk AuthController :
   - POST `/api/register` - Untuk melakukan registrasi user, dengan mengisi form nama, email, dan password
   - POST `/api/login` - Untuk login, dengan mengisi form email, dan password
   - POST `/api/logout` - Untuk logout, perlu diingat untuk menggunakannya diperlukan token yang didapat dari hasil login tadi

     - Contoh request dan response:
       - **POST `/api/register`
         - Request:
              ```
              Content-Type: application/json
              Body:
              {
                "name": "John Doe",
                "email": "johndoe@gmail.com",
                "password": "123password"
              }
              ```
            - Response:
              ```json
              {
                "message": "Account has been created successfully"
              }
              ```

       - **POST `/api/login`
         - Request:
              ```
              Content-Type: application/json
              Body:
              {
                "name": "John Doe",
                "email": "johndoe@gmail.com"
              }
              ```
            - Response:
              ```json
              {
                "message": "Success!",
                "data": {
                    "user": {
                        "id": 1,
                        "name": "John Doe",
                        "email": "johndoe@gmail.com",
                        "email_verified_at": null,
                        "created_at": "2023-10-13T16:23:07.000000Z",
                        "updated_at": "2023-10-13T16:23:07.000000Z"
                    },
                        "token": "1|tiWUYxxxxxxxxxxxxxxxxxxx"
                    }
                }
              ```
              
       - **POST `/api/logout`
         - Request:
              ```
              Content-Type: application/json
              Accept: application/json
              Authorization: Bearer Token
              ```
            - Response:
              ```json
              {
                  "message": "Berhasil logout!"
                }
              ```
         
       
     
- API untuk MovieController :
  - GET `/api/movies` - Mendapatkan semua data.
  - POST `/api/movies` - Membuat entitas data baru.
  - GET `/api/movies/{id}` - Mendapatkan entitas data berdasarkan ID.
  - PATCH `/api/movies/{id}` - Memperbarui data X berdasarkan ID.
  - DELETE `/api/movies/{id}` - Menghapus entitas X berdasarkan ID.

     - Contoh request dan response:
       - **GET `/api/movies`
         - Request:
              ```
              Content-Type: application/json
              Accept: application/json
              Authorization: Bearer Token
              
              ```
            - Response:
              ```json
              {
                "message": "Success! Ini adalah halaman utama!",
                "data": [
                    {
                        "id": 1,
                        "user_id": 1,
                        "title": "fizi punya",
                        "description": "Kisah Tanah Jawa: Pocong Gundul adalah film horor Indonesia tahun 2023 yang disutradarai oleh Awi Suryadi berdasarkan novel berjudul sama karya Om Hao. Film produksi MD Pictures ini dibintangi oleh Deva Mahenra, Della Dartyan, dan Iwa K. Kisah Tanah Jawa: Pocong Gundul tayang perdana di bioskop pada tanggal 21 September 2023.",
                        "rating": 4,
                        "image": "1697198909.jpg",
                        "created_at": "2023-10-13T12:08:29.000000Z",
                        "updated_at": "2023-10-13T12:08:29.000000Z"
                    }
                ]
            }
              ```

       - **POST `/api/movies`
         - Request:
              ```
              Content-Type: application/json
              Accept: application/json
              Authorization: Bearer Token
              
              Body:
              {
                "title": "MOVIE A",
                "description": "this is the description",
                "rating": 6.8,
                "image": image.jpg
              }
              ```
            - Response:
              ```json
              {
               "message": "Success! Data berhasil dibuat"
              }
              ```
              
       - **GET `/api/movies/{id}`
         - Request:
              ```
              Content-Type: application/json
              Accept: application/json
              Authorization: Bearer Token
              ```
            - Response:
              ```json
              {
                "message": "Success! Ini adalah halaman index",
                "data": {
                    "id": 2,
                    "user_id": 2,
                    "title": "MOVIE A",
                    "description": "this is the description",
                    "rating": 6.8,
                    "image": "1697189678.jpg",
                    "created_at": "2023-10-13T09:34:38.000000Z",
                    "updated_at": "2023-10-13T11:58:31.000000Z"
                 }
              }
              ```

       - **PATCH `/api/movies/{id}`
         - Request:
              ```
              Content-Type: application/json
              Accept: application/json
              Authorization: Bearer Token
              ```
               Body: {
                   "title": "MOVIE B",
                   "description": "this is the new description"
               }
           
            - Response:
              ```json
                {
                    "message": "Data update successfully"
                }
              ```
    
       - **DELETE `/api/movies/{id}`
         - Request:
              ```
              Content-Type: application/json
              Accept: application/json
              Authorization: Bearer Token
              ```
           
            - Response:
              ```json
                {
                    "message": "Success! Data berhasil dihapus"
                }
              ```


## Kontribusi

Kami sangat menghargai kontribusi dari komunitas. Untuk berkontribusi ke proyek ini, ikuti langkah-langkah berikut:

1. Fork repositori ini.
2. Buat cabang (branch) fitur Anda: `git checkout -b fitur-anda`.
3. Lakukan perubahan yang diperlukan.
4. Commit perubahan Anda: `git commit -m 'Menambahkan fitur XYZ'`.
5. Push ke cabang Anda: `git push origin fitur-anda`.
6. Buat pull request ke repositori ini.

## Lisensi

Proyek ini dilisensikan di bawah Lisensi [Nama Lisensi]. Lihat file [LISENSI.md] untuk informasi lebih lanjut.

## Cara Untuk Terhubung

Jika Anda memiliki pertanyaan atau masalah, jangan ragu untuk menghubungi saya di fitranpramakrisna@gmail.com.

