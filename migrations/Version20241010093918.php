<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241010093918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create user2 table';
    }

    public function up(Schema $schema): void
    {
        $sm = $this->connection->getSchemaManager();
        if (!$sm->tablesExist(['user2'])) {
            $this->addSql('CREATE TABLE user2 (
                id INT AUTO_INCREMENT NOT NULL, 
                email VARCHAR(180) NOT NULL, 
                roles JSON NOT NULL, 
                password VARCHAR(255) NOT NULL, 
                UNIQUE INDEX UNIQ_1558D4EFE7927C74 (email), 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        }
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE user2');
    }
}
