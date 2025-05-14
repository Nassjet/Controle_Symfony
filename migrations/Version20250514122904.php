<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250514122904 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE etapes (id INT AUTO_INCREMENT NOT NULL, descriptif VARCHAR(255) NOT NULL, consignes VARCHAR(1000) NOT NULL, position INT NOT NULL, parcours_id INT DEFAULT NULL, ressources_id INT DEFAULT NULL, INDEX IDX_E3443E176E38C0DB (parcours_id), INDEX IDX_E3443E173C361826 (ressources_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messages (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, contenu VARCHAR(1000) DEFAULT NULL, date_heure DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messages_rendus_activites (messages_id INT NOT NULL, rendus_activites_id INT NOT NULL, INDEX IDX_69D7EFF1A5905F5A (messages_id), INDEX IDX_69D7EFF1A7844EA2 (rendus_activites_id), PRIMARY KEY(messages_id, rendus_activites_id)) DEFAULT CHARACTER SET utf8mb4
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE parcours (id INT AUTO_INCREMENT NOT NULL, objet VARCHAR(255) NOT NULL, description VARCHAR(1000) NOT NULL, user_id INT NOT NULL, INDEX IDX_99B1DEE3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE rendez_vous (id INT AUTO_INCREMENT NOT NULL, date_heure DATETIME NOT NULL, effectue TINYINT(1) NOT NULL, modalité TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE rendus_activites (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, date_heure DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE rendus_activites_etapes (rendus_activites_id INT NOT NULL, etapes_id INT NOT NULL, INDEX IDX_BAB0D5F7A7844EA2 (rendus_activites_id), INDEX IDX_BAB0D5F74F5CEED2 (etapes_id), PRIMARY KEY(rendus_activites_id, etapes_id)) DEFAULT CHARACTER SET utf8mb4
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE ressources (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, presentation VARCHAR(255) NOT NULL, support VARCHAR(255) NOT NULL, nature VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etapes ADD CONSTRAINT FK_E3443E176E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etapes ADD CONSTRAINT FK_E3443E173C361826 FOREIGN KEY (ressources_id) REFERENCES ressources (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE messages_rendus_activites ADD CONSTRAINT FK_69D7EFF1A5905F5A FOREIGN KEY (messages_id) REFERENCES messages (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE messages_rendus_activites ADD CONSTRAINT FK_69D7EFF1A7844EA2 FOREIGN KEY (rendus_activites_id) REFERENCES rendus_activites (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parcours ADD CONSTRAINT FK_99B1DEE3A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendus_activites_etapes ADD CONSTRAINT FK_BAB0D5F7A7844EA2 FOREIGN KEY (rendus_activites_id) REFERENCES rendus_activites (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendus_activites_etapes ADD CONSTRAINT FK_BAB0D5F74F5CEED2 FOREIGN KEY (etapes_id) REFERENCES etapes (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD rdvs_id INT DEFAULT NULL, ADD rendus_activites_id INT DEFAULT NULL, ADD messages_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD CONSTRAINT FK_8D93D649E3E6550F FOREIGN KEY (rdvs_id) REFERENCES rendez_vous (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD CONSTRAINT FK_8D93D649A7844EA2 FOREIGN KEY (rendus_activites_id) REFERENCES rendus_activites (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD CONSTRAINT FK_8D93D649A5905F5A FOREIGN KEY (messages_id) REFERENCES messages (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8D93D649E3E6550F ON user (rdvs_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8D93D649A7844EA2 ON user (rendus_activites_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8D93D649A5905F5A ON user (messages_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE etapes DROP FOREIGN KEY FK_E3443E176E38C0DB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etapes DROP FOREIGN KEY FK_E3443E173C361826
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE messages_rendus_activites DROP FOREIGN KEY FK_69D7EFF1A5905F5A
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE messages_rendus_activites DROP FOREIGN KEY FK_69D7EFF1A7844EA2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parcours DROP FOREIGN KEY FK_99B1DEE3A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendus_activites_etapes DROP FOREIGN KEY FK_BAB0D5F7A7844EA2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendus_activites_etapes DROP FOREIGN KEY FK_BAB0D5F74F5CEED2
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE etapes
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messages
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messages_rendus_activites
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE parcours
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE rendez_vous
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE rendus_activites
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE rendus_activites_etapes
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE ressources
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649E3E6550F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649A7844EA2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649A5905F5A
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8D93D649E3E6550F ON `user`
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8D93D649A7844EA2 ON `user`
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8D93D649A5905F5A ON `user`
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `user` DROP rdvs_id, DROP rendus_activites_id, DROP messages_id, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`
        SQL);
    }
}
