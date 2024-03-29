# Prepare for production
production: ensure-composer ensure-permissions enable-cache build-assets

ensure-composer:
	composer update --ignore-platform-req=php --optimize-autoloader

ensure-permissions:
	chmod -R o+w storage

enable-cache:
	#php artisan optimize

build-assets:
	npm update
	npm run prod --qsmart --rtl --dark-mode
	npm run prod --demo2 --rtl --dark-mode
	npm run prod --demo3 --rtl --dark-mode
	npm run prod --demo4 --rtl
	npm run prod --demo5 --rtl --dark-mode
	npm run prod --demo6 --rtl --dark-mode
	npm run prod --demo7 --rtl --dark-mode
	npm run prod --demo8 --rtl --dark-mode
	npm run prod --demo9 --rtl --dark-mode
