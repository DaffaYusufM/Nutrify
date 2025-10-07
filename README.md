## Nutrify
<img width="2233" height="1049" alt="Screenshot 2025-10-07 205525" src="https://github.com/user-attachments/assets/4a076060-e760-4e83-af55-25ff3ebee83a" />

## Instalation
Clone Repository
```sh
https://github.com/DaffaYusufM/Nutrify.git
```
Tulis perintah dibawah in untuk menginstal depedensi yang di perlukan 
```sh
composer install

npm install
```

Lalu copy file .env 
```sh
cp .env.example .env
```

Setelah itu lakukan generate key
```sh
php artisan key:generate
```

Jalankan migration dan seeder
```sh
php artisan migrate

php artisan migrate:fresh --seed
```

## Running Project
```sh
php artisan serve    

npm run dev
```
