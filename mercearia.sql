-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Out-2024 às 20:15
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mercearia`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `encomendas`
--

CREATE TABLE `encomendas` (
  `id` int(11) NOT NULL,
  `id_utilizador` int(11) DEFAULT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `quantidade` int(11) NOT NULL,
  `preco_total` decimal(10,2) NOT NULL,
  `data_encomenda` timestamp NOT NULL DEFAULT current_timestamp(),
  `dataNascimento` date NOT NULL,
  `morada` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `estoque` int(11) NOT NULL,
  `categoria` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `preco`, `estoque`, `categoria`) VALUES
(1, 'Banana', 2.00, 10, 'Fruta'),
(2, 'Maçã', 3.50, 100, 'Fruta'),
(3, 'Laranja', 4.00, 150, 'Fruta'),
(4, 'Cenoura', 1.50, 300, 'Legumes'),
(5, 'Tomate', 5.00, 120, 'Fruta'),
(6, 'Abobrinha', 2.20, 180, 'Legumes'),
(7, 'Batata', 3.00, 250, 'Legumes'),
(8, 'Morango', 6.50, 80, 'Fruta'),
(9, 'Uva', 7.00, 95, 'Fruta'),
(11, 'Pepino', 2.70, 210, 'Legumes'),
(12, 'Melancia', 15.00, 40, 'Fruta'),
(13, 'Pêssego', 4.30, 70, 'Fruta'),
(14, 'Alface', 1.20, 400, 'Legumes'),
(15, 'Espinafre', 2.50, 160, 'Legumes'),
(16, 'Manga', 3.90, 90, 'Fruta'),
(17, 'Limão', 2.80, 220, 'Fruta'),
(18, 'Beterraba', 1.80, 275, 'Legumes'),
(19, 'Brócolis', 6.00, 130, 'Legumes'),
(20, 'Cebola', 3.20, 300, 'Legumes'),
(21, 'Abacaxi', 5.80, 60, 'Fruta'),
(22, 'Óleo de Coco', 15.50, 50, 'Óleos e Gorduras'),
(23, 'Leite de Amêndoas', 10.00, 100, 'Bebidas Vegetais'),
(24, 'Tofu', 8.00, 75, 'Proteínas'),
(25, 'Farinha de Grão-de-Bico', 6.50, 120, 'Farinhas e Grãos'),
(26, 'Granola Integral', 12.00, 60, 'Cereais'),
(27, 'Castanha-do-Pará', 18.00, 80, 'Oleaginosas'),
(28, 'Leite de Aveia', 9.50, 90, 'Bebidas Vegetais'),
(29, 'Chá Verde', 5.00, 110, 'Chás e Infusões'),
(30, 'Proteína de Ervilha', 22.00, 40, 'Proteínas'),
(31, 'Quinoa', 7.80, 150, 'Farinhas e Grãos'),
(32, 'Linhaça Dourada', 4.50, 200, 'Sementes'),
(33, 'Gergelim Preto', 6.00, 140, 'Sementes'),
(34, 'Azeite de Oliva', 20.00, 35, 'Óleos e Gorduras'),
(35, 'Melado de Cana', 8.20, 85, 'Adoçantes Naturais'),
(36, 'Goiabada Cascão', 5.70, 55, 'Doces e Geléias'),
(37, 'Farinha de Linhaça', 4.20, 180, 'Farinhas e Grãos'),
(38, 'Batata Doce Chips', 6.50, 95, 'Snacks Saudáveis'),
(39, 'Amêndoas Cruas', 19.00, 70, 'Oleaginosas'),
(40, 'Cacau em Pó', 12.30, 65, 'Ingredientes para Culinária'),
(41, 'Açúcar de Coco', 10.50, 45, 'Adoçantes Naturais');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `id` int(11) NOT NULL,
  `nome_utilizador` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo_utilizador` enum('admin','cliente') NOT NULL,
  `dataNascimento` date NOT NULL DEFAULT '2000-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `utilizadores`
--

INSERT INTO `utilizadores` (`id`, `nome_utilizador`, `senha`, `tipo_utilizador`, `dataNascimento`) VALUES
(6, 'Fernando', '$2y$10$6ikRqhLqil1eewqM8plMi.WHc/tfT83deCVf8poJU4/77JZDUMuw6', 'admin', '2003-11-29'),
(7, 'Tarija', '$2y$10$z7WCT1E6IfxPU7mNq5Md6eIy0NtohVbJC3rIsATfs3iFwHrtsXk7S', 'cliente', '1974-08-07'),
(8, 'admin', '$2y$10$wbo0pFAAchUwB42CxWRhwOHAM.mutjie80loAR22TgKnXJVkvg.qG', 'admin', '1980-01-01');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `encomendas`
--
ALTER TABLE `encomendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utilizador` (`id_utilizador`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `encomendas`
--
ALTER TABLE `encomendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `encomendas`
--
ALTER TABLE `encomendas`
  ADD CONSTRAINT `encomendas_ibfk_1` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizadores` (`id`),
  ADD CONSTRAINT `encomendas_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
