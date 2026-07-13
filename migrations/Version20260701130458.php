<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Utility\SqlMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260701130458 extends SqlMigration
{
    public function getDescription(): string
    {
        return 'Chronologie';
    }

    public function up(Schema $schema): void
    {
        $this->executeSqlFile(__DIR__ . '/sql/chronologie.sql');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('drop table chronologie');
    }
}
