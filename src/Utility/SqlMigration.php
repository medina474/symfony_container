<?php declare(strict_types=1);

namespace App\Utility;

use Doctrine\Migrations\AbstractMigration;

abstract class SqlMigration extends AbstractMigration
{
    private const SQL_STATEMENT_SEPARATOR = '/^\s*--\s*migration:statement\s*$/m';
    
    protected function executeSqlFile(string $file): void
    {
        $sql = file_get_contents($file);

        if ($sql === false) {
            throw new \RuntimeException(sprintf(
                'Impossible de lire "%s".',
                $file
            ));
        }

        foreach ($this->splitStatements($sql) as $statement) {
            $this->addSql($statement);
        }
    }
    
    /**
     * Découpe un fichier SQL en instructions séparées par :
     *
     * -- migration:statement
     *
     * @return list<string>
     */
    private function splitStatements(string $sql): array
    {
        $statements = preg_split(
            self::SQL_STATEMENT_SEPARATOR,
            $sql
        );

        if ($statements === false) {
            throw new \RuntimeException('Unable to parse SQL file.');
        }

        return array_values(array_filter(
            array_map(
                static fn(string $statement): string => trim($statement),
                $statements
            ),
            static fn(string $statement): bool => $statement !== ''
        ));
    }
}
