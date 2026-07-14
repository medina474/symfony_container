<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Utility\SqlMigration;
use Doctrine\DBAL\Schema\Schema;

final class Version20260713030517 extends SqlMigration
{
    public function getDescription(): string
    {
        return 'Audit';
    }

    public function up(Schema $schema): void
    {
        $this->executeSqlFile(__DIR__ . '/sql/audit.sql');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('drop view reporting.audit');
        $this->addSql('drop table audit');
    }
}
