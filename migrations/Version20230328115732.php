<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230328115732 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE allergies (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, phone_number VARCHAR(15) NOT NULL, adress VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, page_title VARCHAR(255) NOT NULL, page_text LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diets (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE difficulties (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE home_page (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, welcome_text LONGTEXT NOT NULL, about_title VARCHAR(255) NOT NULL, about_text LONGTEXT NOT NULL, services_title VARCHAR(255) NOT NULL, services_text LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE opinions (id INT AUTO_INCREMENT NOT NULL, user_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', recipe_id INT NOT NULL, rating INT NOT NULL, comment LONGTEXT NOT NULL, INDEX IDX_BEAF78D0A76ED395 (user_id), INDEX IDX_BEAF78D059D8A214 (recipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipes (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, difficulty_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, preparation_time INT NOT NULL, preparation_standing_time INT NOT NULL, cooking_time INT NOT NULL, ingredients LONGTEXT NOT NULL, stages_of_recipe LONGTEXT NOT NULL, is_public TINYINT(1) NOT NULL, image_file_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_A369E2B512469DE2 (category_id), INDEX IDX_A369E2B5FCFA9DAE (difficulty_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipes_allergies (recipes_id INT NOT NULL, allergies_id INT NOT NULL, INDEX IDX_57D8575FDF2B1FA (recipes_id), INDEX IDX_57D85757104939B (allergies_id), PRIMARY KEY(recipes_id, allergies_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipes_diets (recipes_id INT NOT NULL, diets_id INT NOT NULL, INDEX IDX_2FC6AAF3FDF2B1FA (recipes_id), INDEX IDX_2FC6AAF39B4CB3A8 (diets_id), PRIMARY KEY(recipes_id, diets_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_allergies (users_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', allergies_id INT NOT NULL, INDEX IDX_EB64C5FA67B3B43D (users_id), INDEX IDX_EB64C5FA7104939B (allergies_id), PRIMARY KEY(users_id, allergies_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_diets (users_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', diets_id INT NOT NULL, INDEX IDX_C78AAFEF67B3B43D (users_id), INDEX IDX_C78AAFEF9B4CB3A8 (diets_id), PRIMARY KEY(users_id, diets_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE opinions ADD CONSTRAINT FK_BEAF78D0A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE opinions ADD CONSTRAINT FK_BEAF78D059D8A214 FOREIGN KEY (recipe_id) REFERENCES recipes (id)');
        $this->addSql('ALTER TABLE recipes ADD CONSTRAINT FK_A369E2B512469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE recipes ADD CONSTRAINT FK_A369E2B5FCFA9DAE FOREIGN KEY (difficulty_id) REFERENCES difficulties (id)');
        $this->addSql('ALTER TABLE recipes_allergies ADD CONSTRAINT FK_57D8575FDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_allergies ADD CONSTRAINT FK_57D85757104939B FOREIGN KEY (allergies_id) REFERENCES allergies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_diets ADD CONSTRAINT FK_2FC6AAF3FDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_diets ADD CONSTRAINT FK_2FC6AAF39B4CB3A8 FOREIGN KEY (diets_id) REFERENCES diets (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_allergies ADD CONSTRAINT FK_EB64C5FA67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_allergies ADD CONSTRAINT FK_EB64C5FA7104939B FOREIGN KEY (allergies_id) REFERENCES allergies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_diets ADD CONSTRAINT FK_C78AAFEF67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_diets ADD CONSTRAINT FK_C78AAFEF9B4CB3A8 FOREIGN KEY (diets_id) REFERENCES diets (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE opinions DROP FOREIGN KEY FK_BEAF78D0A76ED395');
        $this->addSql('ALTER TABLE opinions DROP FOREIGN KEY FK_BEAF78D059D8A214');
        $this->addSql('ALTER TABLE recipes DROP FOREIGN KEY FK_A369E2B512469DE2');
        $this->addSql('ALTER TABLE recipes DROP FOREIGN KEY FK_A369E2B5FCFA9DAE');
        $this->addSql('ALTER TABLE recipes_allergies DROP FOREIGN KEY FK_57D8575FDF2B1FA');
        $this->addSql('ALTER TABLE recipes_allergies DROP FOREIGN KEY FK_57D85757104939B');
        $this->addSql('ALTER TABLE recipes_diets DROP FOREIGN KEY FK_2FC6AAF3FDF2B1FA');
        $this->addSql('ALTER TABLE recipes_diets DROP FOREIGN KEY FK_2FC6AAF39B4CB3A8');
        $this->addSql('ALTER TABLE users_allergies DROP FOREIGN KEY FK_EB64C5FA67B3B43D');
        $this->addSql('ALTER TABLE users_allergies DROP FOREIGN KEY FK_EB64C5FA7104939B');
        $this->addSql('ALTER TABLE users_diets DROP FOREIGN KEY FK_C78AAFEF67B3B43D');
        $this->addSql('ALTER TABLE users_diets DROP FOREIGN KEY FK_C78AAFEF9B4CB3A8');
        $this->addSql('DROP TABLE allergies');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE diets');
        $this->addSql('DROP TABLE difficulties');
        $this->addSql('DROP TABLE home_page');
        $this->addSql('DROP TABLE opinions');
        $this->addSql('DROP TABLE recipes');
        $this->addSql('DROP TABLE recipes_allergies');
        $this->addSql('DROP TABLE recipes_diets');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE users_allergies');
        $this->addSql('DROP TABLE users_diets');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
