# Instalasi Ramalanku

## Persyaratan Sistem
- PHP 8.2+
- Composer
- Node.js 20+ & npm
- MySQL / MariaDB

## Langkah Instalasi

1. **Clone Repository (atau ekstrak file zip)**
   ```bash
   cd ramalan
   ```

2. **Install Dependencies Backend**
   ```bash
   composer install
   ```

3. **Install Dependencies Frontend**
   ```bash
   npm install
   ```

4. **Konfigurasi Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Atur koneksi database di file `.env`.

5. **Migrasi & Seeding Database**
   ```bash
   # Ini akan memasukkan 20,000+ template ramalan
   php artisan migrate:fresh --seed
   ```

6. **Setup TikTok Connector (Opsional, untuk Auto Mode)**
   ```bash
   cd tiktok-connector
   npm install
   ```

7. **Build Frontend Assets**
   ```bash
   npm run build
   ```

## Menjalankan Aplikasi (Lokal)

1. **Jalankan Web Server Laravel**
   ```bash
   php artisan serve
   ```

2. **Jalankan Reverb WebSocket Server**
   ```bash
   php artisan reverb:start
   ```

3. **Jalankan TikTok Connector (Opsional)**
   ```bash
   cd tiktok-connector
   npm start
   ```

Aplikasi siap diakses di `http://localhost:8000`. 
Akun Admin Default: `admin@ramalanku.com` / `password`.
