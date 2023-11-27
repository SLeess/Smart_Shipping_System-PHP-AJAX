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

--
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
DROP VIEW IF EXISTS Visao_Monitoramento;
   CREATE VIEW Visao_Monitoramento AS
   SELECT m.Id, m.controle, m.largada, m.lead_time, m.status, m.data_entrega, m.placa_caminhao, m.cpf_motorista,
       c.modelo AS modelo_caminhao, mt.nome AS nome_motorista
   FROM monitoramento m, caminhoes c, motorista mt 
   WHERE m.placa_caminhao = c.placa AND
   m.cpf_motorista = mt.CPF_motorista;

DROP VIEW IF EXISTS Visao_SimplificadaNotas
   CREATE VIEW Visao_SimplificadaNotas AS
   SELECT 
       n.n_nota,
       n.Cliente,
       n.Endereco,
       n.bairro,
       n.municipio,
       COUNT(p.cod) AS total_produtos
   FROM 
       notas n
   JOIN 
       produtos p ON n.n_nota = p.nf
   GROUP BY 
       n.n_nota, n.Cliente, n.Endereco, n.bairro, n.municipio;

   DROP VIEW IF EXISTS Visao_PesoPorMunicipFornecSimples;
   CREATE VIEW Visao_PesoPorMunicipFornecSimples AS
   SELECT n.municipio, SUM(n.peso_bruto) as 'Soma de Pesos'
   FROM notas n
      LEFT JOIN redes r ON n.n_nota = r.fk_notas_n_nota
      LEFT JOIN aurora_notas a ON n.n_nota = a.fk_notas_n_nota
      LEFT JOIN cruzeiro_notas c ON n.n_nota = c.fk_notas_n_nota
      LEFT JOIN plena_notas p ON n.n_nota = p.fk_notas_n_nota
      LEFT JOIN suinco_notas s ON n.n_nota = s.fk_notas_n_nota
   GROUP BY n.municipio
   ORDER BY n.municipio;

DROP VIEW IF EXISTS Visao_PesoPorMunicipFornecCompleto;
   CREATE VIEW Visao_PesoPorMunicipFornecCompleto AS
   SELECT 
       n.fornecedor, 
       n.municipio, 
       SUM(n.peso_bruto) as 'Soma de Pesos', 
       n.cliente,
       CASE WHEN r.fk_notas_n_nota IS NOT NULL THEN 'Valor para redes' ELSE NULL END AS ColunaRedes
   FROM notas n
      LEFT JOIN redes r ON n.n_nota = r.fk_notas_n_nota
      LEFT JOIN aurora_notas a ON n.n_nota = a.fk_notas_n_nota
      LEFT JOIN cruzeiro_notas c ON n.n_nota = c.fk_notas_n_nota
      LEFT JOIN plena_notas p ON n.n_nota = p.fk_notas_n_nota
      LEFT JOIN suinco_notas s ON n.n_nota = s.fk_notas_n_nota
   GROUP BY n.fornecedor, n.cliente, n.municipio  
   ORDER BY `ColunaRedes` DESC;

DROP VIEW IF EXISTS Visao_DetalhamentoNotas;
   CREATE VIEW Visao_GroupByMunicipFornecedores AS
   SELECT n.fornecedor, n.cliente, n.n_nota as 'N° da Nota', n.endereco, n.numero, n.bairro, n.municipio, n.data_lancamento, n.id_monitoramento, n.valor_nota
   FROM notas n
      LEFT JOIN redes r ON n.n_nota = r.fk_notas_n_nota
      LEFT JOIN aurora_notas a ON n.n_nota = a.fk_notas_n_nota
      LEFT JOIN cruzeiro_notas c ON n.n_nota = c.fk_notas_n_nota
      LEFT JOIN plena_notas p ON n.n_nota = p.fk_notas_n_nota
      LEFT JOIN suinco_notas s ON n.n_nota = s.fk_notas_n_nota
   ORDER BY n.fornecedor;


   CREATE INDEX IndexMonitoramentoPlaca ON monitoramento (placa_caminhao);
   CREATE INDEX IndexProdutosNota ON produtos (nf);
   
    DELIMITER //
   DROP PROCEDURE IF EXISTS AlterarProdutoQuantidade//
   CREATE PROCEDURE AlterarProdutoQuantidade(
       IN p_cod VARCHAR(12),
       IN p_nf INT,
       IN p_nova_quantidade FLOAT
   )
   BEGIN
       UPDATE produtos SET quantidade = p_nova_quantidade
       WHERE cod = p_cod AND nf = p_nf;
   END;
   //
   DELIMITER ;
   DELIMITER //

   DROP PROCEDURE IF EXISTS UpMotoristas_Caminhoes//
   CREATE PROCEDURE UpMotoristas_Caminhoes(
       IN p_placa CHAR(8),
       IN p_modelo CHAR(1),
       IN p_nome VARCHAR(20),
       IN p_CPF_motorista CHAR(11),
       IN p_num_habilitacao INT,
       IN p_venci_habilitacao DATE
   )
   BEGIN
       -- Verifica se a placa já existe na tabela
       IF NOT EXISTS (SELECT 1 FROM caminhoes WHERE placa = p_placa) THEN
           INSERT INTO caminhoes (placa, modelo) VALUES (p_placa, p_modelo);
           SELECT 'Caminhão inserido com sucesso.' AS Mensagem;
       ELSE
           SELECT 'Placa já cadastrada. Não foi possível inserir o caminhão.' AS Mensagem_Caminhao;
       END IF;

       -- Verifica se o motorista já existe na tabela
       IF NOT EXISTS (SELECT 1 FROM motorista WHERE cpf_motorista = p_CPF_motorista) THEN
           INSERT INTO motorista (nome, CPF_motorista, num_habilitacao, venci_habilitacao) VALUES (p_nome, p_CPF_motorista, p_num_habilitacao, p_venci_habilitacao);
           SELECT 'Motorista inserido com sucesso.' AS Mensagem;
       ELSE
           SELECT 'Motorista já cadastrado. Não foi possível inseri-lo.' AS Mensagem_Motorista;
       END IF;

       -- Atualiza a tabela motorista_caminhoes
       IF NOT EXISTS (SELECT 1 FROM motorista_caminhoes WHERE fk_cpf_motorista = p_CPF_motorista AND fk_placa = p_placa) THEN
           INSERT INTO motorista_caminhoes (fk_placa, fk_cpf_motorista) VALUES (p_placa, p_CPF_motorista);
           SELECT 'Tabela motorista_caminhoes atualizada com sucesso!' AS Info;
       ELSE
           SELECT 'Motorista já associado ao caminhão selecionado.' AS Info;
       END IF;
   END //

   DELIMITER ;
   DELIMITER //

   DROP PROCEDURE IF EXISTS VerificarMonitoramentosAtivos//
   CREATE PROCEDURE VerificarMonitoramentosAtivos()
   BEGIN
       SELECT *
       FROM visao_monitoramento
       WHERE largada >= CURDATE();
   END //

   DELIMITER ;
    DELIMITER //

   DROP PROCEDURE IF EXISTS AttrDataEntregaMonitor//
   CREATE PROCEDURE AttrDataEntregaMonitor(
       IN p_IdMonitoramento INT,
       IN p_DataEntrega DATE
   )
   BEGIN
       UPDATE monitoramento
       SET data_entrega = p_DataEntrega
       WHERE Id = p_IdMonitoramento;
   END //

   DELIMITER ;

   DELIMITER //
DROP TRIGGER IF EXISTS INSERE_REDES//
CREATE TRIGGER INSERE_REDES
AFTER INSERT ON notas FOR EACH ROW
BEGIN
    IF(NEW.cliente = 'CENCOSUD BRASIL COMERCIAL S A' OR NEW.cliente = 'COMERCIAL GALA LTDA' OR NEW.cliente = 'COMERCIAL GALA' OR NEW.cliente = 'MART MINAS DISTRIBUICAO LTDA' OR NEW.cliente ='SUPERMERCADOS BH COMERCIO DE ALIMENTOS S' OR NEW.cliente = 'SUPERMERCADOS BH COMERCIO DE ALIMENTOS' OR NEW.cliente = 'SUPERMERCADOS BH COMERCIO DE ALIMENTOS S A' OR NEW.cliente = 'CEMA CENTRAL MINEIRA ATACADISTA LTDA') THEN 
        INSERT INTO redes (fk_notas_n_nota, fornecedor) VALUES (NEW.n_nota, NEW.fornecedor);
    END IF;
END;

//

DELIMITER ;


