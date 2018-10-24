<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181017121317 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, postcode_id INT DEFAULT NULL, city_id INT DEFAULT NULL, address_num INT NOT NULL, street VARCHAR(255) NOT NULL, banned TINYINT(1) NOT NULL, email VARCHAR(255) NOT NULL, signin_confirmed TINYINT(1) NOT NULL, signin_date DATETIME NOT NULL, password VARCHAR(255) NOT NULL, auth_fail_count INT NOT NULL, userType VARCHAR(255) NOT NULL, INDEX IDX_8D93D649EECBFDF1 (postcode_id), INDEX IDX_8D93D6498BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vendor (id INT NOT NULL, email_contact VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, vat VARCHAR(255) NOT NULL, website VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, vendor_id INT DEFAULT NULL, url VARCHAR(255) NOT NULL, order_position INT NOT NULL, INDEX IDX_E01FBE6AF603EE73 (vendor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_code (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649EECBFDF1 FOREIGN KEY (postcode_id) REFERENCES post_code (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE vendor ADD CONSTRAINT FK_F52233F6BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6AF603EE73 FOREIGN KEY (vendor_id) REFERENCES vendor (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vendor DROP FOREIGN KEY FK_F52233F6BF396750');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6AF603EE73');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649EECBFDF1');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498BAC62AF');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vendor');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE post_code');
        $this->addSql('DROP TABLE city');
    }
}
