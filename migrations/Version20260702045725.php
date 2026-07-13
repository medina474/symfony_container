<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260702045725 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'lyixx/async-messenger-mercure';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE first_name_stat (id uuid NOT NULL, gender INT NOT NULL, first_name VARCHAR(255) NOT NULL, year_of_birth VARCHAR(255) DEFAULT NULL, count INT NOT NULL, PRIMARY KEY (id))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('drop table first_name_stat');
    }
}
