<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Utility\SqlMigration;
use Doctrine\DBAL\Schema\Schema;

final class Version20260702033312 extends SqlMigration
{
    public function getDescription(): string
    {
        return 'Géo';
    }

    public function up(Schema $schema): void
    {
        $this->executeSqlFile(__DIR__ . '/sql/geo.sql');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('drop table country');
        $this->addSql('drop table tncc');
    }
}
