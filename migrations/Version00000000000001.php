<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Utility\SqlMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version00000000000001 extends SqlMigration
{
    public function getDescription(): string
    {
        return 'Géo';
    }

    public function up(Schema $schema): void
    {
        $this->executeSqlFile(__DIR__ . '/sql/Version00000000000001.sql');
    }

    public function down(Schema $schema): void
    {
        $this->executeSqlFile(__DIR__ . '/sql/Version00000000000001.down.sql');
    }
}
