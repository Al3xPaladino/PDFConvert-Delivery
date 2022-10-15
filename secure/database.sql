--
-- Struttura del database SpeedService
--

-- --------------------------------------------------------

--
-- Struttura della tabella utenti
--

CREATE TABLE utenti (
  id smallint(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  Nome varchar(100),
  Cognome varchar(100),
  Username varchar(255) NOT NULL,
  Password varchar(255) NOT NULL,
  UNIQUE(Username)
);

-- --------------------------------------------------------

--
-- Struttura della tabella file
--

/*CREATE TABLE file (
  id smallint(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  file varchar(255) NOT NULL,
  CodUser smallint(6) NOT NULL,
  foreign key (CodUser) REFERENCES utenti(id)
	On DELETE Cascade
	On Update Cascade
);*/