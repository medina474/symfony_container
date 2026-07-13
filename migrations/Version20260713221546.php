<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Utility\SqlMigration;
use Doctrine\DBAL\Schema\Schema;

final class Version20260713221546 extends SqlMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->executeSqlFile(__DIR__ . '/sql/user.sql');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('drop table "user"');
    }
}
