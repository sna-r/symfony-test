<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241126084047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE setu CASCADE');
        $this->addSql('CREATE TABLE test_entity (id SERIAL NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE noteetudiant DROP CONSTRAINT noteetudiant_idetudiant_fkey');
        $this->addSql('ALTER TABLE noteetudiant DROP CONSTRAINT noteetudiant_idmatiere_fkey');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE noteetudiant');
        $this->addSql('ALTER TABLE etudiant DROP CONSTRAINT etudiant_pkey');
        $this->addSql('ALTER TABLE etudiant ADD id SERIAL NOT NULL');
        $this->addSql('ALTER TABLE etudiant ALTER idetudiant DROP DEFAULT');
        $this->addSql('ALTER TABLE etudiant ALTER idetudiant TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE etudiant ALTER nom SET NOT NULL');
        $this->addSql('ALTER TABLE etudiant ALTER nom TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE etudiant ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE setu INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE matiere (idmatiere VARCHAR(50) NOT NULL, nom VARCHAR(50) DEFAULT NULL, semestre VARCHAR(50) DEFAULT NULL, credit INT DEFAULT NULL, PRIMARY KEY(idmatiere))');
        $this->addSql('CREATE TABLE noteetudiant (idetudiant VARCHAR(50) NOT NULL, idmatiere VARCHAR(50) NOT NULL, note NUMERIC(10, 0) DEFAULT NULL, session DATE DEFAULT NULL, PRIMARY KEY(idetudiant, idmatiere))');
        $this->addSql('CREATE INDEX IDX_84900704DBAB6AEE ON noteetudiant (idetudiant)');
        $this->addSql('CREATE INDEX IDX_849007044F100524 ON noteetudiant (idmatiere)');
        $this->addSql('ALTER TABLE noteetudiant ADD CONSTRAINT noteetudiant_idetudiant_fkey FOREIGN KEY (idetudiant) REFERENCES etudiant (idetudiant) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE noteetudiant ADD CONSTRAINT noteetudiant_idmatiere_fkey FOREIGN KEY (idmatiere) REFERENCES matiere (idmatiere) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE test_entity');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('DROP INDEX etudiant_pkey');
        $this->addSql('ALTER TABLE etudiant DROP id');
        $this->addSql('ALTER TABLE etudiant ALTER idetudiant SET DEFAULT \'ETU\'');
        $this->addSql('ALTER TABLE etudiant ALTER idetudiant TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE etudiant ALTER nom DROP NOT NULL');
        $this->addSql('ALTER TABLE etudiant ALTER nom TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE etudiant ADD PRIMARY KEY (idetudiant)');
    }
}
