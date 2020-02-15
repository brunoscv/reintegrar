--
-- Database: `base_de_dados`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `audit`
--

DROP TABLE IF EXISTS `audit`;
CREATE TABLE IF NOT EXISTS `audit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `createdAt` datetime DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `query` text,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(45) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text,
  PRIMARY KEY (`session_id`),
  KEY `last_actvity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_empresa` varchar(100) NOT NULL,
  `nome_responsavel` varchar(100) NOT NULL,
  `url` varchar(250) DEFAULT NULL,
  `telefone` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `configuracoes` text,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Estrutura da tabela `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menus_id` int(11) DEFAULT NULL,
  `descricao` varchar(45) NOT NULL,
  `url` varchar(45) NOT NULL,
  `icone` varchar(45) NOT NULL,
  `createdAt` varchar(45) NOT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_menus_menus1_idx` (`menus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `menus`
--

INSERT INTO `menus` (`id`, `menus_id`, `descricao`, `url`, `icone`, `createdAt`, `updatedAt`) VALUES
(1, NULL, ' Dashboard', '/dashboard', 'fa fa-book', '2017-04-19 21:09:19', '2017-07-06 21:38:52'),
(2, NULL, 'Configurações', '#', 'fa fa-cogs', '2016-07-14 12:19:59', '2017-01-09 17:41:39'),
(3, 2, 'Menus', '/menus', 'fa fa-list', '2016-07-14 12:20:21', NULL),
(4, 2, 'Usuarios', '/usuarios', 'fa fa-user', '2016-07-14 12:20:42', NULL),
(5, 2, 'Perfis de Acesso', '/perfis', 'fa fa-group', '2016-07-14 12:21:01', '2016-07-14 12:21:47');

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfis`
--

DROP TABLE IF EXISTS `perfis`;
CREATE TABLE IF NOT EXISTS `perfis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `perfis`
--

INSERT INTO `perfis` (`id`, `descricao`, `createdAt`, `updatedAt`) VALUES
(2, 'Administrador', '2016-07-14 12:21:26', '2018-08-14 14:33:50'),
(3, 'Colaborador', '2017-03-07 11:46:59', '2017-08-04 16:23:34'),
(4, 'Desenvolvedor', '2017-03-14 23:41:06', '2017-10-26 15:39:39');

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfis_menus`
--

DROP TABLE IF EXISTS `perfis_menus`;
CREATE TABLE IF NOT EXISTS `perfis_menus` (
  `perfis_id` int(11) NOT NULL,
  `menus_id` int(11) NOT NULL,
  PRIMARY KEY (`perfis_id`,`menus_id`),
  KEY `fk_perfis_has_menus_menus1_idx` (`menus_id`),
  KEY `fk_perfis_has_menus_perfis1_idx` (`perfis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `perfis_menus`
--

INSERT INTO `perfis_menus` (`perfis_id`, `menus_id`) VALUES
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(200) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `senha` varchar(250) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `clientes_id` int(11) DEFAULT NULL,
  `principal` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_usuarios_clientes1_idx` (`clientes_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `nome`, `email`, `telefone`, `senha`, `createdAt`, `updatedAt`, `clientes_id`, `principal`) VALUES
(2, 'brunoscv', 'Bruno Carvalho', 'bruno@academiahoradorecreio.com.br', NULL, 'CdFnneH/zlky3z/8e44F+Akb6YgcgLqIz5QxoiUfnlTdu2q5lVU9bipM9+vsCFy39k+whgZ02dGeFi6EgpIv+Q==', '2017-01-09 18:29:54', '2017-05-23 05:28:49', NULL, 0);

-- --------------------------------------------------------


--
-- Estrutura da tabela `usuarios_perfis`
--

DROP TABLE IF EXISTS `usuarios_perfis`;
CREATE TABLE IF NOT EXISTS `usuarios_perfis` (
  `usuarios_id` int(11) NOT NULL,
  `perfis_id` int(11) NOT NULL,
  PRIMARY KEY (`usuarios_id`,`perfis_id`),
  KEY `fk_usuarios_has_perfis_perfis1_idx` (`perfis_id`),
  KEY `fk_usuarios_has_perfis_usuarios1_idx` (`usuarios_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios_perfis`
--

INSERT INTO `usuarios_perfis` (`usuarios_id`, `perfis_id`) VALUES (2, 4);