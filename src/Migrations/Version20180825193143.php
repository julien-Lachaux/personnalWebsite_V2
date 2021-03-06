<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180825193143 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE IF NOT EXISTS color_themes (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, color VARCHAR(50) NOT NULL, color_light VARCHAR(50) NOT NULL, color_dark VARCHAR(50) NOT NULL, text VARCHAR(50) NOT NULL, text_hover VARCHAR(50) NOT NULL, accent VARCHAR(50) DEFAULT NULL, accent_light VARCHAR(50) DEFAULT NULL, accent_dark VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS experiences (id INT AUTO_INCREMENT NOT NULL, company VARCHAR(255) NOT NULL, job VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date_start DATETIME NOT NULL, date_end DATETIME DEFAULT NULL, displayed TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS experience_skill (experience_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_3D6F986146E90E27 (experience_id), INDEX IDX_3D6F98615585C142 (skill_id), PRIMARY KEY(experience_id, skill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS favoris (id INT AUTO_INCREMENT NOT NULL, group_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, displayed TINYINT(1) NOT NULL, INDEX IDX_8933C432FE54D947 (group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS panels (id INT AUTO_INCREMENT NOT NULL, color_theme_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, subtitle VARCHAR(255) DEFAULT NULL, decorations JSON DEFAULT NULL COMMENT \'(DC2Type:json_array)\', nav_text VARCHAR(255) NOT NULL, nav_icon VARCHAR(255) NOT NULL, nav_order INT NOT NULL, displayed TINYINT(1) NOT NULL, INDEX IDX_8B137F498587EFC5 (color_theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS profile (firstname VARCHAR(150) NOT NULL, lastname VARCHAR(150) NOT NULL, title VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, tel VARCHAR(10) NOT NULL, github VARCHAR(255) NOT NULL, linkedin VARCHAR(255) NOT NULL, freelance_website VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(firstname, lastname)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS skills (id INT AUTO_INCREMENT NOT NULL, group_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, level INT NOT NULL, picture VARCHAR(255) NOT NULL, displayed TINYINT(1) NOT NULL, INDEX IDX_D5311670FE54D947 (group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS skills_groups (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, color VARCHAR(6) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS tools (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, picture VARCHAR(255) DEFAULT NULL, link VARCHAR(255) NOT NULL, family VARCHAR(255) NOT NULL, displayed TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE experience_skill ADD CONSTRAINT FK_3D6F986146E90E27 FOREIGN KEY (experience_id) REFERENCES experiences (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE experience_skill ADD CONSTRAINT FK_3D6F98615585C142 FOREIGN KEY (skill_id) REFERENCES skills (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C432FE54D947 FOREIGN KEY (group_id) REFERENCES skills_groups (id)');
        $this->addSql('ALTER TABLE panels ADD CONSTRAINT FK_8B137F498587EFC5 FOREIGN KEY (color_theme_id) REFERENCES color_themes (id)');
        $this->addSql('ALTER TABLE skills ADD CONSTRAINT FK_D5311670FE54D947 FOREIGN KEY (group_id) REFERENCES skills_groups (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE panels DROP FOREIGN KEY FK_8B137F498587EFC5');
        $this->addSql('ALTER TABLE experience_skill DROP FOREIGN KEY FK_3D6F986146E90E27');
        $this->addSql('ALTER TABLE experience_skill DROP FOREIGN KEY FK_3D6F98615585C142');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_8933C432FE54D947');
        $this->addSql('ALTER TABLE skills DROP FOREIGN KEY FK_D5311670FE54D947');
        $this->addSql('DROP TABLE color_themes');
        $this->addSql('DROP TABLE experiences');
        $this->addSql('DROP TABLE experience_skill');
        $this->addSql('DROP TABLE favoris');
        $this->addSql('DROP TABLE panels');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE skills');
        $this->addSql('DROP TABLE skills_groups');
        $this->addSql('DROP TABLE tools');
    }
}
