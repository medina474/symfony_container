<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Utility\SqlMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260701040713 extends SqlMigration
{
    public function getDescription(): string
    {
        return 'Schéma reporting';
    }

    public function up(Schema $schema): void
    {
        $this->executeSqlFile(__DIR__ . '/sql/reporting.sql');
    }

    public function down(Schema $schema): void
    {
        $this->executeSqlFile(__DIR__ . '/sql/reporting.down.sql');
    }
}
