-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12/11/2023 às 02:49
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `seminariobd`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aurora_notas`
--

CREATE TABLE `aurora_notas` (
  `fk_notas_n_nota` varchar(14) NOT NULL,
  `n_carga` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `caminhoes`
--

CREATE TABLE `caminhoes` (
  `placa` char(8) NOT NULL,
  `modelo` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cruzeiro_notas`
--

CREATE TABLE `cruzeiro_notas` (
  `fk_notas_n_nota` varchar(14) NOT NULL,
  `peso_liquido` decimal(9,2) NOT NULL,
  `sequencia` int(4) NOT NULL,
  `Carga` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------


-- Estrutura para tabela `monitoramento`
--

CREATE TABLE `monitoramento` (
  `Id` smallint(6) NOT NULL,
  `controle` smallint(6) DEFAULT NULL,
  `largada` date DEFAULT NULL,
  `lead_time` tinyint(1) DEFAULT NULL,
  `status` bit(1) DEFAULT NULL,
  `data_entrega` date DEFAULT NULL,
  `placa_caminhao` char(8) DEFAULT NULL,
  `cpf_motorista` char(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `motorista`
--

CREATE TABLE `motorista` (
  `nome` varchar(20) NOT NULL,
  `CPF_motorista` char(11) NOT NULL,
  `num_habilitacao` int(11) NOT NULL,
  `venci_habilitacao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `motorista_caminhoes`
--

CREATE TABLE `motorista_caminhoes` (
  `fk_placa` char(8) NOT NULL,
  `fk_cpf_motorista` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `notas`
--

CREATE TABLE `notas` (
  `Cliente` varchar(85) NOT NULL,
  `Endereco` varchar(50) NOT NULL,
  `numero` int(6) DEFAULT NULL,
  `bairro` varchar(30) NOT NULL,
  `municipio` varchar(45) NOT NULL,
  `n_nota` varchar(14) NOT NULL,
  `peso_bruto` decimal(9,2) NOT NULL,
  `Data_lancamento` date DEFAULT NULL,
  `Id_monitoramento` smallint(6) DEFAULT NULL,
  `fornecedor` varchar(20) NOT NULL,
  `valor_nota` double(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `plena_notas`
--

CREATE TABLE `plena_notas` (
  `fk_notas_n_nota` varchar(14) NOT NULL,
  `n_caixas` smallint(6) DEFAULT NULL,
  `sequencia` int(4) DEFAULT NULL,
  `Carga` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `cod` varchar(12) NOT NULL,
  `descricao` varchar(30) NOT NULL,
  `nf` int(12) NOT NULL,
  `quantidade` float NOT NULL,
  `unidade` varchar(4) NOT NULL,
  `QuantAux` int(4) DEFAULT NULL,
  `data_producao` date DEFAULT NULL,
  `data_validade` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------


--
-- Estrutura para tabela `redes`
--

CREATE TABLE `redes` (
  `fk_notas_n_nota` varchar(14) NOT NULL,
  `fornecedor` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `suinco_notas`
--

CREATE TABLE `suinco_notas` (
  `fk_notas_n_nota` varchar(14) NOT NULL,
  `Carga` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aurora_notas`
--
ALTER TABLE `aurora_notas`
  ADD PRIMARY KEY (`fk_notas_n_nota`);

--
-- Índices de tabela `caminhoes`
--
ALTER TABLE `caminhoes`
  ADD PRIMARY KEY (`placa`);

--
-- Índices de tabela `cruzeiro_notas`
--
ALTER TABLE `cruzeiro_notas`
  ADD PRIMARY KEY (`fk_notas_n_nota`);

--

--
-- Índices de tabela `monitoramento`
--
ALTER TABLE `monitoramento`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `placa_caminhao` (`placa_caminhao`),
  ADD KEY `cpf_motorista` (`cpf_motorista`);

--
-- Índices de tabela `motorista`
--
ALTER TABLE `motorista`
  ADD PRIMARY KEY (`CPF_motorista`);

--
-- Índices de tabela `motorista_caminhoes`
--
ALTER TABLE `motorista_caminhoes`
  ADD PRIMARY KEY (`fk_placa`,`fk_cpf_motorista`),
  ADD KEY `fk_cpf_motorista` (`fk_cpf_motorista`);

--
-- Índices de tabela `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`n_nota`),
  ADD KEY `Id_monitoramento` (`Id_monitoramento`);

--
-- Índices de tabela `plena_notas`
--
ALTER TABLE `plena_notas`
  ADD PRIMARY KEY (`fk_notas_n_nota`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`cod`,`nf`);

--
-- Índices de tabela `redes`
--

ALTER TABLE `redes`
  ADD PRIMARY KEY (`fk_notas_n_nota`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--

--
-- AUTO_INCREMENT de tabela `monitoramento`
--
ALTER TABLE `monitoramento`
  MODIFY `Id` smallint(6) NOT NULL AUTO_INCREMENT;

--

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `aurora_notas`
--
ALTER TABLE `aurora_notas`
  ADD CONSTRAINT `aurora_notas_ibfk_1` FOREIGN KEY (`fk_notas_n_nota`) REFERENCES `notas` (`n_nota`);

--
-- Restrições para tabelas `cruzeiro_notas`
--
ALTER TABLE `cruzeiro_notas`
  ADD CONSTRAINT `cruzeiro_notas_ibfk_1` FOREIGN KEY (`fk_notas_n_nota`) REFERENCES `notas` (`n_nota`);

--
-- Restrições para tabelas `monitoramento`
--
ALTER TABLE `monitoramento`
  ADD CONSTRAINT `monitoramento_ibfk_1` FOREIGN KEY (`placa_caminhao`) REFERENCES `motorista_caminhoes` (`fk_placa`),
  ADD CONSTRAINT `monitoramento_ibfk_2` FOREIGN KEY (`cpf_motorista`) REFERENCES `motorista_caminhoes` (`fk_cpf_motorista`);

--
-- Restrições para tabelas `motorista_caminhoes`
--
ALTER TABLE `motorista_caminhoes`
  ADD CONSTRAINT `motorista_caminhoes_ibfk_1` FOREIGN KEY (`fk_placa`) REFERENCES `caminhoes` (`placa`),
  ADD CONSTRAINT `motorista_caminhoes_ibfk_2` FOREIGN KEY (`fk_cpf_motorista`) REFERENCES `motorista` (`CPF_motorista`);

--
-- Restrições para tabelas `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`Id_monitoramento`) REFERENCES `monitoramento` (`Id`);

--
-- Restrições para tabelas `plena_notas`
--
ALTER TABLE `plena_notas`
  ADD CONSTRAINT `plena_notas_ibfk_1` FOREIGN KEY (`fk_notas_n_nota`) REFERENCES `notas` (`n_nota`);

--
-- Restrições para tabelas `redes`
--


