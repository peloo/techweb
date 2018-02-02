-- Matteo Pellanda - 1125349
-- Nicola Carlesso - 1123257
-- Enrico Trinco   - 1121850

-- Server version: 
-- PHP Version: 

-- CREATE TABLE & INSERT INTO

-- ------------------------------------------------------------------------------------------------------------------------------------

--
-- Database: `[nome del nostro sito]`
--

-- CREATE Database [nome del nostro sito];
-- USE [nome del nostro sito];

DROP DATABASE IF EXISTS techweb;
CREATE DATABASE techweb;
USE techweb;
SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `log`;
DROP TABLE IF EXISTS `utente`;
DROP TABLE IF EXISTS `admin_redatore`;
DROP TABLE IF EXISTS `user`;

DROP TABLE IF EXISTS `articolo`;
DROP TABLE IF EXISTS `articolo_tag`;
DROP TABLE IF EXISTS `tag`;
DROP TABLE IF EXISTS `tag_argomento`;
DROP TABLE IF EXISTS `argomento`;

DROP TABLE IF EXISTS `media`;
DROP TABLE IF EXISTS `articolo_media`;

DROP TABLE IF EXISTS `info`;
DROP TABLE IF EXISTS `commento`;

DROP TABLE IF EXISTS 'donne_s_vuoto';
DROP TABLE IF EXISTS 'donne_s_pieno';
DROP TABLE IF EXISTS 'uomini_s_vuoto';
DROP TABLE IF EXISTS 'uomini_s_pieno';

--
-- Struttura della tabella `utente`
--
-- UNIQUE: Il vincolo UNIQUE identifica in modo univoco ogni record in una tabella di database.

CREATE TABLE IF NOT EXISTS `utente` (
  `mail` varchar(255) NOT NULL PRIMARY KEY,
  `username` varchar(255) UNIQUE NOT NULL,
  `password` char(32) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `cognome` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `utente` (`mail`, `username`, `password`, `nome`, `cognome`) VALUES
('mrikoconte@gmail.com', 'user_vuoto', 'nonteladice', 'Mirko', 'Contessa'),
('caromarco@gmail.com', 'user_vuoto1', 'nonteladice', 'Marco', 'Caroleo'),
('nicolacarl@gmail.com', 'user_vuoto2', 'nonteladice', 'Nicola', 'Carlesso'),
('gastanicola@yahoo.it', 'user_vuoto3', 'nonteladico', 'Nicola', 'Gastaldon'),
('matteopellanda@gmail.com', 'user_vuoto4', 'nonteladico', 'Matteo', 'Pellanda');

--
-- Struttura della tabella `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `mail` varchar(255) NOT NULL,
  `data` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`mail`, `data`),
  CONSTRAINT FOREIGN KEY (`mail`) references utente(`mail`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Struttura della tabella `admin_redatore`
--

CREATE TABLE IF NOT EXISTS `admin_redatore` (
  `mail` varchar(255) NOT NULL,
  PRIMARY KEY (`mail`),
  CONSTRAINT FOREIGN KEY (`mail`) references utente(`mail`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Struttura della tabella `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `mail` varchar(255) NOT NULL,
  PRIMARY KEY (`mail`),
  CONSTRAINT FOREIGN KEY (`mail`) references utente(`mail`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Struttura della tabella `articolo`
--

CREATE TABLE IF NOT EXISTS `articolo` (
  `mail` varchar(255) NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `contenuto` varchar(255) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`mail`, `titolo`),
  CONSTRAINT FOREIGN KEY (`mail`) references admin_redatore(`mail`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `articolo` (`mail`, `titolo`, `contenuto`, `data`) VALUES
('nicolacarl@gmail.com', 'Alfa Romeo Stelvio Quadrifoglio, il primo SUV ad ”emozione integrale”!', 'Della Lamborghini Urus e delle sue concorrenti più accreditate in quanto a prestazioni vi abbiamo già parlato', '1996-08-30'),
('nicolacarl@gmail.com', 'Motor Show di Bologna, tutto sull edizione 2017', 'Della Lamborghini Urus e delle sue concorrenti più accreditate in quanto a prestazioni vi abbiamo già parlato', '1996-08-30'),
('nicolacarl@gmail.com', 'Opel, il nuovo claim ci dice che "Il futuro appartiene a tutti"', 'Il marchio tedesco si dedicherà all elettrificazione all interno del gruppo PSA, con la Corsa a batteria già dal 2020', '1996-08-30'),
('nicolacarl@gmail.com', 'Guida autonoma, gli automobilisti europei non sono pronti', 'E il risultato di una ricerca presentata da Mazda. E voi cosa ne pensate? ', '1996-08-30'),
('nicolacarl@gmail.com', 'Lamborghini Urus vs Alfa Romeo Stelvio Quadrifoglio, una sfida per niente scontata', 'Insomma, la Stelvio e la Urus non potrebbero essere più diverse: a livello di dimensioni, di prezzo, di posizionamento e di ambizioni, mentre per quanto riguarda le prestazioni il discorso si fa più interessante.', '1996-08-30'),
('nicolacarl@gmail.com', 'Nuova Mercedes Classe A, arie da AMG GT', 'Tradotto vuol dire che la Urus è certamente più veloce sul dritto della Stelvio, ma non è detto che lo sia anche tra i cordoli di un circuito, dove il fardello di quasi quattro quintali incide molto sia a livello di inerzia nelle curve che a livello di maggiore energia cinetica in frenata.', '1996-08-30');

--
-- Struttura della tabella `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `nome` varchar(255) NOT NULL PRIMARY KEY,
  `descrizione` varchar(255) DEFAULT 'n/a descrizione'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Struttura della tabella `articolo_tagghino`
--

CREATE TABLE IF NOT EXISTS `articolo_tag` (
  `mail` varchar(255) NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`mail`, `titolo`, `nome`),
  CONSTRAINT FOREIGN KEY (`mail`,`titolo`) references articolo(`mail`,`titolo`) ON DELETE CASCADE,
  CONSTRAINT FOREIGN KEY (`nome`) references tag(`nome`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Struttura della tabella `argomento`
--

CREATE TABLE IF NOT EXISTS `argomento` (
  `nome` varchar(255) NOT NULL PRIMARY KEY
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Struttura della tabella `tag_argomento`
--

CREATE TABLE IF NOT EXISTS `tag_argomento` (
  `nome_tag` varchar(255) NOT NULL,
  `nome_arg` varchar(255) NOT NULL,
  PRIMARY KEY (`nome_tag`, `nome_arg`),
  CONSTRAINT FOREIGN KEY (`nome_tag`) references tag(`nome`) ON DELETE CASCADE,
  CONSTRAINT FOREIGN KEY (`nome_arg`) references argomento(`nome`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Struttura della tabella `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `id` smallint(7) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `link` varchar(255) DEFAULT NULL,
  `foto` blob DEFAULT NULL,
  `foto_video` boolean NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Struttura della tabella `articolo_media`
--

CREATE TABLE IF NOT EXISTS `articolo_media` (
  `mail` varchar(255) NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `id` smallint(7) NOT NULL,
  PRIMARY KEY (`mail`, `titolo`,`id`),
  CONSTRAINT FOREIGN KEY (`mail`,`titolo`) references articolo(`mail`,`titolo`) ON DELETE CASCADE,
  CONSTRAINT FOREIGN KEY (`id`) references media(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `articolo_media` (`mail`, `titolo`, `id`) VALUES
('nicolacarl@gmail.com', 'Alfa Romeo Stelvio Quadrifoglio, il primo SUV ad ”emozione integrale”!', '1'),
('nicolacarl@gmail.com', 'Lamborghini Urus vs Alfa Romeo Stelvio Quadrifoglio, una sfida per niente scontata', '2'),
('nicolacarl@gmail.com', 'Nuova Mercedes Classe A, arie da AMG GT', '3');

--
-- Struttura della tabella `info`
--

CREATE TABLE IF NOT EXISTS `info` (
  `mail` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `contenuto` varchar(255) NOT NULL,
  PRIMARY KEY (`mail`),
  CONSTRAINT FOREIGN KEY (`mail`) references user(`mail`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Struttura della tabella `commento`
--

CREATE TABLE IF NOT EXISTS `commento` (
  `mail_user` varchar(255) NOT NULL,
  `mail_art` varchar(255) NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `contenuto` varchar(255) NOT NULL,
  PRIMARY KEY (`mail_user`, `mail_art`, `titolo`, `data`),
  CONSTRAINT FOREIGN KEY (`mail_user`) references user(`mail`) ON DELETE CASCADE,
  CONSTRAINT FOREIGN KEY (`mail_art`,`titolo`) references articolo(`mail`,`titolo`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Struttura tabelle alcolici
--

CREATE TABLE IF NOT EXISTS 'donne_s_vuoto' (
  'bevanda' varchar(255) NOT NULL,
  'gradazione' decimal(3,1) NOT NULL,
  '45Kg' decimal(3,2) NOT NULL,
  '55Kg' decimal(3,2) NOT NULL,
  '60Kg' decimal(3,2) NOT NULL,
  '65Kg' decimal(3,2) NOT NULL,
  '75Kg' decimal(3,2) NOT NULL,
  '80Kg' decimal(3,2) NOT NULL,
  PRIMARY KEY ('bevanda', 'gradazione')
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO 'donne_s_vuoto' ('bevanda', 'gradazione', '45Kg', '55Kg', '60Kg', '65Kg', '75Kg', '80Kg') VALUES
('birra_analcolica', 0.5, 0.06, 0.05, 0.04, 0.04, 0.03, 0.03),
('birra_leggera', 3.5, 0.39, 0.32, 0.29, 0.27, 0.24, 0.22),
('birra_normale', 5, 0.56, 0.46, 0.42, 0.39, 0.34, 0.32),
('birra_speciale', 8, 0.9, 0.73, , 0.67, 0.62, 0.54, 0.5),
('birra_doppio_malto', 10, 1.12, 0.92, 0.84, 0.78, 0.67, 0.63),
('vino', 12, 0.51, 0.42, 0.38, 0.35, 0.31, 0.29),
('vini_liquorosi/aperitivi', 18, 0.49, 0.40, 0.37, 0.34, 0.29, 0.28),
('digestivi', 25, 0.32, 0.26, 0.24, .022, 0.19, 0.18),
('digestivi', 30, 0.39, 0.32, 0.29, 0.27, 0.23, 0.22),
('superalcolici', 35, 0.45, 0.37, 0.34, 0.31, 0.27, 0.25),
('superalcolici', 45, 0.58, 0.47, 0.43, 0.4, 0.35, 0.33),
('superalcolici', 60, 0.77, 0.63, 0.58, 0.53, 0.46, 0.43),
('champagne/spumante', 11, 0.37, 0.31, 0.28, 0.26, 0.22, 0.21),
('ready_to_drink', 2.8, 0.12, 0.1, 0.09, 0.08, 0.077, 0.07),
('ready_to_drink', 5, 0.24, 0.2, 0.18, 0.17, 0.17, 0.14);


CREATE TABLE IF NOT EXISTS 'donne_s_pieno' (
  'bevanda' varchar(255) NOT NULL,
  'gradazione' decimal(3,1) NOT NULL,
  '45Kg' decimal(3,2) NOT NULL,
  '55Kg' decimal(3,2) NOT NULL,
  '60Kg' decimal(3,2) NOT NULL,
  '65Kg' decimal(3,2) NOT NULL,
  '75Kg' decimal(3,2) NOT NULL,
  '80Kg' decimal(3,2) NOT NULL,
  PRIMARY KEY ('bevanda', 'gradazione')
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO 'donne_s_pieno' ('bevanda', 'gradazione', '45Kg', '55Kg', '60Kg', '65Kg', '75Kg', '80Kg') VALUES
('birra_analcolica', 0.5, 0.03, 0.03, 0.02, 0.02, 0.02, 0.02),
('birra_leggera', 3.5, 0.23, 0.19, 0.17, 0.16, 0.14, 0.13),
('birra_normale', 5, 0.32, 0.26, 0.24, 0.22, 0.19,  0.18),
('birra_speciale', 8, 0.52, 0.42, 0.39, 0.36, 0.31, 0.29),
('birra_doppio_malto', 10, 0.65, 0.53, 0.48, 0.45, 0.39, 0.36),
('vino', 12, 0.29, 0.24, 0.22, 0.2, 0.18, 0.17),
('vini_liquorosi/aperitivi', 18, 0.28, 0.23, 0.21, 0.2, 0.17, 0.16),
('digestivi', 25, 0.2, 0.16, 0.15, 0.14, 0.12, 0.11),
('digestivi', 30, 0.24, 0.19, 0.18, 0.16, 0.14, 0.13),
('superalcolici', 35, 0.27, 0.22, 0.21, 0.19, 0.16, 0.15),
('superalcolici', 45, 0.35, 0.29, 0.26, 0.24, 0.21, 0.2),
('superalcolici', 60, 0.47, 0.38, 0.35, 0.33, 0.28, 0.26),
('champagne/spumante', 11, 0.22, 0.18, 0.16, 0.15, 0.13, 0.12),
('ready_to_drink', 2.8, 0.07, 0.06, 0.06, 0.05, 0.04, 0.04),
('ready_to_drink', 5, 0.15, 0.12, 0.11, 0.1, 0.09, 0.08);


CREATE TABLE IF NOT EXISTS 'uomini_s_vuoto' (
  'bevanda' varchar(255) NOT NULL,
  'gradazione' decimal(3,1) NOT NULL,
  '45Kg' decimal(3,2) NOT NULL,
  '55Kg' decimal(3,2) NOT NULL,
  '60Kg' decimal(3,2) NOT NULL,
  '65Kg' decimal(3,2) NOT NULL,
  '75Kg' decimal(3,2) NOT NULL,
  '80Kg' decimal(3,2) NOT NULL,
  PRIMARY KEY ('bevanda', 'gradazione')
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO 'uomini_s_vuoto' ('bevanda', 'gradazione', '45Kg', '55Kg', '60Kg', '65Kg', '75Kg', '80Kg') VALUES
('birra_analcolica', 0.5, 0.04, 0.03, 0.03, 0.01, 0.01, 0.01),
('birra_leggera', 3.5, 0.25, 0.21, 0.19, 0.18, 0.17, 0.01),
('birra_normale', 5, 0.35, 0.3, .028, 0.26, 0.24, 0.22),
('birra_speciale', 8, 0.56, 0.48, 0.44, 0.41, 0.39, 0.35),
('birra_doppio_malto', 10, 0.71, 0.6, 0.55, 0.52, 0.49, 0.43),
('vino', 12, 0.32, 0.27, 0.25, 0.24, 0.22, 0.2)
('vini_liquorosi/aperitivi', 18, 0.31, 0.26, 0.24, 0.23, 0.21, 0.19),
('digestivi', 25, 0.2, 0.17, 0.16, 0.15, 0.15, 0.12),
('digestivi', 30, 0.24, 0.21, 0.19, 0.18, 0.18, 0.15),
('superalcolici', 35, 0.28, 0.24, 0.22, 0.21, 0.19, 0.17),
('superalcolici', 45, 0.36, 0.31, 0.29, 0.27, 0.25, 0.22),
('superalcolici', 60, 0.48, 0.41, 0.38, 0.36, 0.33, 0.3),
('champagne/spumante', 11, 0.24, 0.19, 0.18, 0.17, 0.16, 0.14),
('ready_to_drink', 2.8, 0.08, 0.06, 0.06, 0.06, 0.05, 0.05),
('ready_to_drink', 5, 0.15, 0.13, 0.12, 0.11, 0.1, 0.09);


CREATE TABLE IF NOT EXISTS 'uomini_s_pieno' (
  'bevanda' varchar(255) NOT NULL,
  'gradazione' decimal(3,1) NOT NULL,
  '45Kg' decimal(3,2) NOT NULL,
  '55Kg' decimal(3,2) NOT NULL,
  '60Kg' decimal(3,2) NOT NULL,
  '65Kg' decimal(3,2) NOT NULL,
  '75Kg' decimal(3,2) NOT NULL,
  '80Kg' decimal(3,2) NOT NULL,
  PRIMARY KEY ('bevanda', 'gradazione')
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO 'uomini_s_pieno' ('bevanda', 'gradazione', '45Kg', '55Kg', '60Kg', '65Kg', '75Kg', '80Kg') VALUES
('birra_analcolica', 0.5, 0.02, 0.02, 0.02, 0.01, 0.01, 0.01),
('birra_leggera', 3.5, 0.14, 0.12, 0.11, 0.1, 0.1, 0.09),
('birra_normale', 5, 0.2, 0.17, 0.16, 0.15, 0.14, 0.12),
('birra_speciale', 8, 0.33, 0.28, 0.26, 0.24, 0.22, 0.2),
('birra_doppio_malto', 10, 0.41, 0.34, 0.32, 0.3, 0.28, 0.25),
('vino', 12, 0.18, 0.15, 0.14, 0.13, 0.11)
('vini_liquorosi/aperitivi', 18, 0.18, 0.15, 0.14, 0.13, 0.12, 0.11),
('digestivi', 25, 0.12, 0.1, 0.1, 0.09, 0.08, 0.08),
('digestivi', 30, 0.15, 0.13, 0.12, 0.11, 0.1, 0.09),
('superalcolici', 35, 0.17, 0.15, 0.14, 0.13, 0.12, 0.11),
('superalcolici', 45, 0.22, 0.19, 0.17, 0.16, 0.15, 0.14),
('superalcolici', 60, 0.3, 0.25, 0.23, 0.22, 0.2, 0.18),
('champagne/spumante', 11, 0.14, 0.11, 0.11, 0.1, 0.09, 0.08),
('ready_to_drink', 2.8, 0.05, 0.04, 0.04, 0.03, 0.03, 0.03),
('ready_to_drink', 5, 0.09, 0.08, 0.07, 0.07, 0.06, 0.06);