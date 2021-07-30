<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210730210656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gift (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', code VARCHAR(50) NOT NULL, description VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gift_receiver (gift_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', receiver_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_7BBD68DC97A95A83 (gift_id), INDEX IDX_7BBD68DCCD53EDB6 (receiver_id), PRIMARY KEY(gift_id, receiver_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE receiver (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, country_code VARCHAR(2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, gift_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', quantity INT NOT NULL, INDEX IDX_4B36566097A95A83 (gift_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gift_receiver ADD CONSTRAINT FK_7BBD68DC97A95A83 FOREIGN KEY (gift_id) REFERENCES gift (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gift_receiver ADD CONSTRAINT FK_7BBD68DCCD53EDB6 FOREIGN KEY (receiver_id) REFERENCES receiver (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B36566097A95A83 FOREIGN KEY (gift_id) REFERENCES gift (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gift_receiver DROP FOREIGN KEY FK_7BBD68DC97A95A83');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B36566097A95A83');
        $this->addSql('ALTER TABLE gift_receiver DROP FOREIGN KEY FK_7BBD68DCCD53EDB6');
        $this->addSql('DROP TABLE gift');
        $this->addSql('DROP TABLE gift_receiver');
        $this->addSql('DROP TABLE receiver');
        $this->addSql('DROP TABLE stock');
    }
}
