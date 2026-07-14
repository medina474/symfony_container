#!/bin/sh

composer require \
	symfony/monolog-bundle

# Composants de développement
composer require --dev \
	symfony/maker-bundle \
	symfony/debug-pack \
	symfony/test-pack \
	phpstan/phpstan-symfony

composer require \
	symfony/twig-bundle \
	symfony/asset \
	symfony/asset-mapper \
	symfony/ux-icons

composer require \
	symfony/stimulus-bundle \
	symfony/ux-turbo \
	symfonycasts/tailwind-bundle

composer require \
	symfony/orm-pack \
	symfony/form \
	symfony/validator \
	martin-georgiev/postgresql-for-doctrine

composer require \
	symfony/redis-messenger \
	symfony/doctrine-messenger \
	symfony/mercure-bundle \
	symfony/mailer

# You cannot use "Symfony\Bridge\Twig\Mime\NotificationEmail" if the "CSS Inliner" and "Inky" Twig extensions are not available. 
# Try running "composer require twig/cssinliner-extra twig/inky-extra".

composer require \
	symfony/notifier \
	twig/cssinliner-extra \
	twig/inky-extra

composer require \
	symfony/security-bundle

composer require \
	symfony/uid \
	symfony/serializer-pack

composer require --dev \
	orm-fixtures \
	phpstan/phpstan-doctrine
