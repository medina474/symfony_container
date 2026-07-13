<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Utility\SqlMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260702034851 extends SqlMigration
{
    public function getDescription(): string
    {
        return 'Job';
    }

    public function up(Schema $schema): void
    {
        $this->executeSqlFile(__DIR__ . '/sql/job.sql');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('drop view reporting.job');
        $this->addSql('drop table job');
    }
}
