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
	symfony/validator

composer require \
	symfony/redis-messenger \
	symfony/mercure-bundle \
	symfony/notifier \
	symfony/mailer

composer require \
	symfony/security-bundle
