<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260701040713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Schéma reporting';
    }

    public function up(Schema $schema): void
    {
        $dbName = $this->connection->getDatabase();

        $this->addSql('create schema if not exists reporting;');
        $this->addSql(sprintf('grant connect on database "%s" to grafana;', $dbName));
        $this->addSql(sprintf('alter role grafana in database "%s" set search_path = reporting;', $dbName));
        $this->addSql('grant usage on schema reporting to grafana;');
        $this->addSql('alter default privileges in schema reporting grant select on tables to grafana;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('drop schema reporting cascade;');
    }
}
