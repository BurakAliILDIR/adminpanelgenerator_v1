@servers(['localhost' => '127.0.0.1'])

@story('deploy')
setup
@endstory

@task('setup')
echo "Depo çekme başladı"
git pull origin master
echo "Depo çekildi"
echo "Kurulum başladı"
composer install
composer update

php artisan key:generate
php artisan storage:link
php artisan build
echo "Cache temizleniyor"
php artisan config:clear
php artisan cache:clear
composer dump-autoload
php artisan view:clear
php artisan route:clear
echo "Kurulum tamamlandı!"
@endtask
