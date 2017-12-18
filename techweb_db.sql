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

