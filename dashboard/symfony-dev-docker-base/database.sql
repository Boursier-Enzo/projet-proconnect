-- ============================================================
--  ProConnect — Base de données partagée
--  Thème : Cabinet d'architecture
--  Fichier d'initialisation unique (B1 + B2)
-- ============================================================

CREATE DATABASE IF NOT EXISTS proconnect
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE proconnect;

-- ------------------------------------------------------------
--  TABLE : clients
-- ------------------------------------------------------------
CREATE TABLE clients (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom         VARCHAR(100)  NOT NULL,
    prenom      VARCHAR(100)  NOT NULL,
    email       VARCHAR(180)  NOT NULL UNIQUE,
    telephone   VARCHAR(20)   DEFAULT NULL,
    adresse     TEXT          DEFAULT NULL,
    statut      ENUM('prospect', 'actif', 'archive') NOT NULL DEFAULT 'prospect',
    created_at  TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
--  TABLE : architectes
-- ------------------------------------------------------------
CREATE TABLE architectes (
    id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom             VARCHAR(100) NOT NULL,
    prenom          VARCHAR(100) NOT NULL,
    email           VARCHAR(180) NOT NULL UNIQUE,
    telephone       VARCHAR(20)  DEFAULT NULL,
    numero_ordre    VARCHAR(50)  NOT NULL COMMENT 'Numéro d\'inscription à l\'Ordre des Architectes',
    description     TEXT         DEFAULT NULL,
    horaires        TEXT         DEFAULT NULL,
    specialites     TEXT         DEFAULT NULL COMMENT 'Ex: rénovation, neuf, ERP, urbanisme',
    created_at      TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
--  TABLE : projets
-- ------------------------------------------------------------
CREATE TABLE projets (
    id               INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    client_id        INT UNSIGNED NOT NULL,
    architecte_id    INT UNSIGNED DEFAULT NULL,
    titre            VARCHAR(255) NOT NULL,
    description      TEXT         DEFAULT NULL,
    type_projet      VARCHAR(100) DEFAULT NULL COMMENT 'Ex: maison_individuelle, renovation, ERP, urbanisme',
    statut           ENUM('nouveau', 'en_cours', 'en_attente', 'termine', 'annule') NOT NULL DEFAULT 'nouveau',
    date_debut       DATE         DEFAULT NULL,
    date_fin_prevue  DATE         DEFAULT NULL,
    budget           DECIMAL(12, 2) DEFAULT NULL,
    adresse_chantier TEXT         DEFAULT NULL,
    created_at       TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at       TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_projets_client
        FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE RESTRICT,
    CONSTRAINT fk_projets_architecte
        FOREIGN KEY (architecte_id) REFERENCES architectes(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ------------------------------------------------------------
--  TABLE : requests  (demandes issues du Portail Client)
-- ------------------------------------------------------------
CREATE TABLE requests (
    id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    client_id       INT UNSIGNED NOT NULL,
    architecte_id   INT UNSIGNED DEFAULT NULL,
    objet           VARCHAR(255) NOT NULL,
    description     TEXT         DEFAULT NULL,
    type_prestation VARCHAR(100) DEFAULT NULL COMMENT 'Ex: consultation, devis, rendez-vous, permis',
    creneau_souhaite VARCHAR(100) DEFAULT NULL,
    statut          ENUM('nouvelle', 'en_traitement', 'acceptee', 'refusee', 'cloturee') NOT NULL DEFAULT 'nouvelle',
    created_at      TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_requests_client
        FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE RESTRICT,
    CONSTRAINT fk_requests_architecte
        FOREIGN KEY (architecte_id) REFERENCES architectes(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ------------------------------------------------------------
--  TABLE : documents
-- ------------------------------------------------------------
CREATE TABLE documents (
    id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    projet_id     INT UNSIGNED DEFAULT NULL,
    request_id    INT UNSIGNED DEFAULT NULL,
    uuid          CHAR(36)     NOT NULL UNIQUE COMMENT 'Identifiant public pour accès sécurisé',
    titre         VARCHAR(255) NOT NULL,
    type_document VARCHAR(100) DEFAULT NULL COMMENT 'Ex: plan, permis, compte_rendu, rapport, devis',
    fichier_path  VARCHAR(500) DEFAULT NULL,
    code_acces    VARCHAR(64)  DEFAULT NULL COMMENT 'Code confidentiel communiqué au client',
    contenu       LONGTEXT     DEFAULT NULL COMMENT 'Contenu texte du document si applicable',
    created_at    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_documents_projet
        FOREIGN KEY (projet_id) REFERENCES projets(id) ON DELETE SET NULL,
    CONSTRAINT fk_documents_request
        FOREIGN KEY (request_id) REFERENCES requests(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ------------------------------------------------------------
--  TABLE : interventions
-- ------------------------------------------------------------
CREATE TABLE interventions (
    id               INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    projet_id        INT UNSIGNED NOT NULL,
    architecte_id    INT UNSIGNED DEFAULT NULL,
    titre            VARCHAR(255) NOT NULL,
    compte_rendu     LONGTEXT     DEFAULT NULL,
    date_intervention DATE        NOT NULL,
    statut           ENUM('planifiee', 'realisee', 'annulee') NOT NULL DEFAULT 'planifiee',
    created_at       TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at       TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_interventions_projet
        FOREIGN KEY (projet_id) REFERENCES projets(id) ON DELETE RESTRICT,
    CONSTRAINT fk_interventions_architecte
        FOREIGN KEY (architecte_id) REFERENCES architectes(id) ON DELETE SET NULL
) ENGINE=InnoDB;


-- ============================================================
--  DONNÉES DE TEST
-- ============================================================

INSERT INTO architectes (nom, prenom, email, telephone, numero_ordre, description, specialites)
VALUES
  ('Durand',  'Sophie', 'sophie.durand@proconnect.fr',  '0612345678', 'ARC-75-00123', 'Architecte DPLG, 15 ans d\'expérience', 'renovation, maison_individuelle'),
  ('Martin',  'Lucas',  'lucas.martin@proconnect.fr',   '0698765432', 'ARC-75-00456', 'Spécialiste ERP et bâtiments publics',  'ERP, urbanisme');

INSERT INTO clients (nom, prenom, email, telephone, statut)
VALUES
  ('Leroy',   'Marie',  'marie.leroy@email.com',   '0611223344', 'actif'),
  ('Petit',   'Thomas', 'thomas.petit@email.com',  '0655443322', 'prospect');

INSERT INTO projets (client_id, architecte_id, titre, type_projet, statut, budget, adresse_chantier)
VALUES
  (1, 1, 'Extension maison Leroy', 'maison_individuelle', 'en_cours', 85000.00, '12 rue des Lilas, 75014 Paris'),
  (2, 2, 'Rénovation bureau Petit', 'ERP', 'nouveau', 120000.00, '5 avenue de la République, 75011 Paris');

INSERT INTO requests (client_id, architecte_id, objet, type_prestation, creneau_souhaite, statut)
VALUES
  (1, 1, 'Demande de devis pour surélévation', 'devis', 'matin en semaine', 'acceptee'),
  (2, NULL, 'Prise de contact initiale', 'consultation', 'flexible', 'nouvelle');

INSERT INTO documents (projet_id, uuid, titre, type_document, code_acces)
VALUES
  (1, UUID(), 'Plan RDC — Extension Leroy', 'plan',     LEFT(SHA2(RAND(), 256), 8)),
  (1, UUID(), 'Permis de construire',        'permis',   LEFT(SHA2(RAND(), 256), 8));

INSERT INTO interventions (projet_id, architecte_id, titre, date_intervention, statut, compte_rendu)
VALUES
  (1, 1, 'Visite de chantier — fondations', '2025-04-10', 'realisee', 'Les fondations sont conformes au plan. RAS.');
