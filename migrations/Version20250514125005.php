<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250514125005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE messages ADD sender_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE messages ADD CONSTRAINT FK_DB021E96F624B39D FOREIGN KEY (sender_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_DB021E96F624B39D ON messages (sender_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendez_vous CHANGE modalité en_distanciel TINYINT(1) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendus_activites ADD user_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendus_activites ADD CONSTRAINT FK_4F9C19EEA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_4F9C19EEA76ED395 ON rendus_activites (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E3E6550F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A5905F5A
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A7844EA2
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8D93D649E3E6550F ON user
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8D93D649A7844EA2 ON user
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8D93D649A5905F5A ON user
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP rdvs_id, DROP rendus_activites_id, DROP messages_id
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE messages DROP FOREIGN KEY FK_DB021E96F624B39D
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_DB021E96F624B39D ON messages
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE messages DROP sender_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendez_vous CHANGE en_distanciel modalité TINYINT(1) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendus_activites DROP FOREIGN KEY FK_4F9C19EEA76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_4F9C19EEA76ED395 ON rendus_activites
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendus_activites DROP user_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `user` ADD rdvs_id INT DEFAULT NULL, ADD rendus_activites_id INT DEFAULT NULL, ADD messages_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649E3E6550F FOREIGN KEY (rdvs_id) REFERENCES rendez_vous (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649A5905F5A FOREIGN KEY (messages_id) REFERENCES messages (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649A7844EA2 FOREIGN KEY (rendus_activites_id) REFERENCES rendus_activites (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8D93D649E3E6550F ON `user` (rdvs_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8D93D649A7844EA2 ON `user` (rendus_activites_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8D93D649A5905F5A ON `user` (messages_id)
        SQL);
    }
}
