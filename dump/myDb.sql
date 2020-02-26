

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `suportebd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tickets`
--

CREATE TABLE `tickets` (
  `idTicket` int NOT NULL,
  `idChamado` int DEFAULT NULL,
  `idUsuario` int NOT NULL,
  `emailUsuario` varchar(100) DEFAULT NULL,
  `assunto` varchar(30) DEFAULT NULL,
  `textoTicket` longtext,
  `resposta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `numeroContato` varchar(15) DEFAULT NULL,
  `estadoTicket` tinyint(1) DEFAULT NULL,
  `dataCriacao` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `idSuporte` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `tickets`
--

INSERT INTO `tickets` (`idTicket`, `idChamado`, `idUsuario`, `emailUsuario`, `assunto`, `textoTicket`, `resposta`, `numeroContato`, `estadoTicket`, `dataCriacao`, `idSuporte`) VALUES
(1, NULL, 2, 'user1@email.com', 'Primerio Ticket', 'User Um abre Ticket', NULL, '9999999999', 1, '2020-02-22 17:07:56.718098', NULL),
(2, NULL, 2, 'user1@email.com', 'Test dois', 'User 2 abre novo ticket', NULL, '99999', 1, '2020-02-23 17:08:36.498221', NULL),
(3, NULL, 3, 'user2@email.com', 'Teste User 2', 'User dois abre primeiro ticket', NULL, '99999', 1, '2020-02-25 17:09:28.496941', NULL),
(4, 4, 3, 'user2@email.com', 'Test dois User 2', 'User dois abre mais um ticket', 'Respondido user Dois', '999999999', 3, '2020-02-26 17:09:50.858318', 1),
(5, 4, 3, 'user2@email.com', 'Test dois User 2', 'Não funcionou', NULL, '999999999', 2, '2020-02-26 17:12:01.104232', NULL),
(6, NULL, 3, 'user2@email.com', 'Novo teste user 2', 'AQUI NOVO TICKET', NULL, '9999', 1, '2020-02-26 17:14:09.679512', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `idUsers` int NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `emailUsers` tinytext NOT NULL,
  `pwdUsers` longtext NOT NULL,
  `vkey` varchar(45) DEFAULT NULL,
  `verified` tinyint(1) DEFAULT '0',
  `createdate` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `tipoUsuario` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`idUsers`, `nome`, `emailUsers`, `pwdUsers`, `vkey`, `verified`, `createdate`, `tipoUsuario`) VALUES
(1, 'Suporte Fulano', 'fulano@email.com', '$2y$10$Zhq/i/XkZhnk.6JGwzjmo.ifq9kilsONXq/oLR4ygjSwnZ/gto4Qu', '244a96a01084d19f5fbb44a48557f0b2', 0, '2020-02-26 17:05:11.493520', 'suporte'),
(2, 'Usuário Exemplo Um', 'user1@email.com', '$2y$10$rfpI.MfEV3SgJOMvVOQQZulweN1t7OIcAXOfVoe8gHqvxlFR9964C', 'cdb3b85cfbf099621116b5325cd43c1b', 0, '2020-02-26 17:06:26.184863', 'user'),
(3, 'Usuário Exemplo Dois', 'user2@email.com', '$2y$10$zJn10X8TqdMWxEygCxXNHuy5feKzkIbLkUvT7Gr.COk2icPNx0t06', '7f25a3666885d3066fcc3ae925b19e9f', 0, '2020-02-26 17:06:53.284864', 'user');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Índices para tabela `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`idTicket`),
  ADD KEY `FK_tickets_users` (`idUsuario`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsers`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tickets`
--
ALTER TABLE `tickets`
  MODIFY `idTicket` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `FK_tickets_users` FOREIGN KEY (`idUsuario`) REFERENCES `users` (`idUsers`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
