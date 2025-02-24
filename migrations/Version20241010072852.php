<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241010072852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create category and product tables';
    }

    public function up(Schema $schema): void
    {
        // Create the category table only if it doesn't exist
        $this->addSql('CREATE TABLE IF NOT EXISTS category (
            id INT AUTO_INCREMENT NOT NULL, 
            name VARCHAR(255) NOT NULL, 
            description VARCHAR(255) NOT NULL, 
            image VARCHAR(255) NOT NULL, 
            date_add DATETIME NOT NULL, 
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // Create the product table with foreign key
        $this->addSql('CREATE TABLE IF NOT EXISTS product (
            id INT AUTO_INCREMENT NOT NULL, 
            id_category INT NOT NULL, 
            name VARCHAR(255) NOT NULL, 
            description VARCHAR(255) NOT NULL, 
            photo VARCHAR(255) NOT NULL, 
            date_add DATETIME NOT NULL, 
            price INT NOT NULL, 
            PRIMARY KEY(id), 
            FOREIGN KEY (id_category) REFERENCES category(id) ON DELETE CASCADE
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // Drop product table first to remove foreign key constraints
        $this->addSql('DROP TABLE IF EXISTS product');
        $this->addSql('DROP TABLE IF EXISTS category');
    }
}
