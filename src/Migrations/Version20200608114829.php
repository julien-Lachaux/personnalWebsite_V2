<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200608114829 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tools ADD decoration VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE color_themes ADD colorLight VARCHAR(50) NOT NULL, ADD colorDark VARCHAR(50) NOT NULL, ADD textHover VARCHAR(50) NOT NULL, ADD accentLight VARCHAR(50) DEFAULT NULL, ADD accentDark VARCHAR(50) DEFAULT NULL, DROP color_light, DROP color_dark, DROP text_hover, DROP accent_light, DROP accent_dark');
        $this->addSql('ALTER TABLE panels DROP FOREIGN KEY FK_8B137F498587EFC5');
        $this->addSql('DROP INDEX IDX_8B137F498587EFC5 ON panels');
        $this->addSql('ALTER TABLE panels ADD navUrl VARCHAR(255) NOT NULL, ADD navText VARCHAR(255) NOT NULL, ADD navIcon VARCHAR(255) NOT NULL, DROP nav_text, DROP nav_icon, CHANGE nav_order navOrder INT NOT NULL, CHANGE color_theme_id colorTheme_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE panels ADD CONSTRAINT FK_8B137F4987AA7A82 FOREIGN KEY (colorTheme_id) REFERENCES color_themes (id)');
        $this->addSql('CREATE INDEX IDX_8B137F4987AA7A82 ON panels (colorTheme_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE color_themes ADD color_light VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD color_dark VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD text_hover VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD accent_light VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD accent_dark VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP colorLight, DROP colorDark, DROP textHover, DROP accentLight, DROP accentDark');
        $this->addSql('ALTER TABLE panels DROP FOREIGN KEY FK_8B137F4987AA7A82');
        $this->addSql('DROP INDEX IDX_8B137F4987AA7A82 ON panels');
        $this->addSql('ALTER TABLE panels ADD nav_text VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD nav_icon VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP navUrl, DROP navText, DROP navIcon, CHANGE colortheme_id color_theme_id INT DEFAULT NULL, CHANGE navorder nav_order INT NOT NULL');
        $this->addSql('ALTER TABLE panels ADD CONSTRAINT FK_8B137F498587EFC5 FOREIGN KEY (color_theme_id) REFERENCES color_themes (id)');
        $this->addSql('CREATE INDEX IDX_8B137F498587EFC5 ON panels (color_theme_id)');
        $this->addSql('ALTER TABLE tools DROP decoration');
    }
}
