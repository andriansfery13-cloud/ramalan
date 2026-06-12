# Panduan Deployment Ramalanku

Untuk mendeploy Ramalanku ke server production (VPS), berikut adalah langkah-langkah yang direkomendasikan.

## 1. Setup Server (Ubuntu 22.04 LTS / 24.04 LTS)
Pastikan server memiliki:
- Nginx
- PHP 8.2-FPM & Extensions (curl, mbstring, dom, gd, xml, mysql, bcmath, zip)
- MySQL / MariaDB
- Node.js (via NVM atau setup NodeSource)
- Composer
- Supervisor (untuk menjalankan Reverb & Queue di background)

## 2. Deploy Kode
```bash
git clone <repo-url> /var/www/ramalan
cd /var/www/ramalan
composer install --optimize-autoloader --no-dev
npm install
npm run build
```

## 3. Konfigurasi Environment (`.env`)
Atur URL, Database, dan pastikan:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://ramalanku.com

BROADCAST_CONNECTION=reverb
REVERB_SERVER_HOST=0.0.0.0
REVERB_SERVER_PORT=8080
```

## 4. Konfigurasi Nginx
Buat file konfigurasi Nginx untuk menangani web dan proxy untuk WebSocket (Reverb).

```nginx
server {
    listen 80;
    server_name ramalanku.com;
    root /var/www/ramalan/public;

    index index.php;
    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # Proxy ke Reverb WebSocket Server
    location /app/ {
        proxy_pass http://127.0.0.0:8080;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "Upgrade";
        proxy_set_header Host $host;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

## 5. Supervisor (Menjaga Worker & Reverb Tetap Hidup)
Buat file `/etc/supervisor/conf.d/reverb.conf`:

```ini
[program:reverb]
process_name=%(program_name)s
command=php /var/www/ramalan/artisan reverb:start
autostart=true
autorestart=true
user=www-data
redirect_stderr=true
stdout_logfile=/var/www/ramalan/storage/logs/reverb.log
```

Buat file untuk TikTok Connector (jika dipakai) `/etc/supervisor/conf.d/tiktok-connector.conf`:

```ini
[program:tiktok]
command=node /var/www/ramalan/tiktok-connector/server.js
autostart=true
autorestart=true
user=www-data
redirect_stderr=true
stdout_logfile=/var/www/ramalan/storage/logs/tiktok.log
```

Reload supervisor:
```bash
sudo supervisorctl update
sudo supervisorctl start all
```

## 6. Selesai
Akses domain Anda via HTTPS (Gunakan Certbot Let's Encrypt untuk SSL).
