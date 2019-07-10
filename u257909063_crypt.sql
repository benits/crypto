-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 10-Jul-2019 às 16:57
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u257909063_crypt`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` smallint(5) UNSIGNED NOT NULL,
  `nome` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `email` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `senha` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `telefone` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `endereco` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `cpf_cliente` varchar(20) NOT NULL,
  `admin` int(1) NOT NULL,
  `data_criacao` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`idCliente`, `nome`, `email`, `senha`, `telefone`, `endereco`, `cpf_cliente`, `admin`, `data_criacao`) VALUES
(5, 'Franciel', 'criptoinvest@hotmail.com', '$2y$10$HjhA1SoaHo77b6WOKabOquO3QZ8Knmva8agjgfJ7XdEoafkzAiKbS', '(27) 99704-3576', 'Água Limpa', '154.150.577-', 0, '2019-05-01 21:33:10'),
(8, 'Thiago Bezerra', 'thiago.bezerra0299@gmail.com', '$2y$10$wQ/qBCYv1KqnjWscPA.9PuU6XIWIUFpMRwDVioYWb3CKxLhbJuun2', '(61) 99398-2724', 'Valparaiso de Goiás', '064.179.522-18', 0, '2019-05-01 21:33:10'),
(9, 'Welingson Expedito dos Santos', 'welingson12@gmail.com', '$2y$10$mul9LXKO6FGNRC73BudxO.NNQEM3.z8jycxEJt1EYja1bgy94MNiO', '(35) 98456-8419', 'Brazópolis/MG', '123.456.799-88', 0, '2019-05-01 21:33:10'),
(10, 'Joao', 'pedrodeveloper77@gmail.com', '$2y$10$Qwtu7.IJVKYdfBZMQrP42us3HAhRWDWfKLNKejsKPnHpcmPU9GFrW', '(11) 97450-4936', 'Avenida Deputado Emílio Carlos', '495.768.788-', 0, '2019-05-01 21:33:10'),
(11, 'Eleandro Pavanatti', 'trading@4bps.com.br', '$2y$10$uC3RiLSTXDfOxrXxAU1NUeb2fgf8bO2QX2SpcoRJGXyYWFJol9pxy', '(41) 99662-2363', 'Curitiba/PR', '036.578.289-07', 0, '2019-05-01 21:33:10'),
(12, 'Francisco Barros Reis', 'franciscobarrosreis@gmail.com', '$2y$10$9XMKKvZ6RjjBipObsPC1CObT/6nKrcMJiQlo0uKxnLEU7fKwNAVEu', '(94) 99197-3535', 'Rua 33', '867.306.492-91', 0, '2019-05-01 21:33:10'),
(13, 'Greise Walbrink Horst', 'greise@graficagt.com.br', '$2y$10$D8.PwlBYvWTLqWLZzdVZPeg4BQ2ThRNdxOrrXLuMtbRf/N5ZBHbiG', '(51) 98447-6613', 'Rua 6 Sul, 363 - Centro Administrativo - Teutônia/RS', '019.452.750-65', 0, '2019-05-01 21:33:10'),
(14, 'Helmiton Barbosa Oliveira Filho', 'helmiton.filho@gmail.com', '$2y$10$mDksnMRI9vpOUjHLfE2sMurtf6HrMm8SJJw69QkW27OWfznqvXgRK', '(83) 99676-6976', 'Rua Gileno B Nascimento 130, Sandra Cavalcante', '082.222.734-77', 0, '2019-05-01 21:33:10'),
(15, 'Felipe Becker Delwing', 'Felipebeckerd@gmail.com', '$2y$10$Spt/.m1fJjwyn1tpSdvilu7EGZ9RgU85DPYLPgK1nzLj31ZEyNzXq', '(51) 98128-8898', 'Porto Alegre RS', '004.399.470-90', 0, '2019-05-01 21:33:10'),
(16, 'Herisson Chaves', 'chaves.herisson@gmail.com', '$2y$10$.MUcocM5LnGq5OanqbpFVej7hOVa2R8Cw5wZGHLSIgwNsWRrzqA0i', '(98) 99230-3796', 'são luís', '650.553.15', 0, '2019-05-01 21:33:10'),
(17, 'Lucineia da Silva Melo', 'neiadorea1992@gmail.com', '$2y$10$d8tGTfgxBELCsp2tPewsKe7pq3HIUtrXHJHKapIskDgnjlTXk5rv2', '(71) 99192-8309', 'Minas', '853.105.145-20', 0, '2019-05-01 21:33:10'),
(18, 'Leonardo M P', 'leonh2002@gmail.com', '$2y$10$V/2vhgKay5ZI8K0LLaJvqeybkPuP11Rlcg5OZ/ft3rg9QyZ7LbW4W', '(51) 98403-8748', 'Novo Hamburgo/RS', '926.565.010-91', 0, '2019-05-01 21:33:10'),
(19, 'Bruno', 'r7capital@outlook.com', '$2y$10$52fMywpwd.lsg.v9golcturGVflo8YnKUUm2iWqWoN4wzZyRhRkIO', '(12) 99111-8912', 'Av Copacabana, 325', '311.633.798-59', 0, '2019-05-01 21:33:10'),
(20, 'Ariane Anselmo', 'investing4anita@gmail.com', '$2y$10$Kx3iME1wVJy5JxyxGLVF4.91GwS2LMkE.Ts121YKVSjlQDgYy3HoG', '()', 'Porto Alegre/RS', '016.364.410-17', 0, '2019-05-01 21:33:10'),
(22, 'Franciel Altoe', 'altoef16@gmail.com', '$2y$10$jQ.lkygOdwh5BmUtqDH2ueZWnGN8qCzWTwLhUCF0INXx5aJs9vfpG', '(27) 99704-3576', 'Jaguaré', '154.150.577-', 1, '2019-05-02 13:49:05'),
(25, 'Marcelo Cappelletti', 'mcappellreis@gmail.com', '$2y$10$Oxk9htK48iLpeoejAfVfDuXWn7w9fZLpND91HnDaWVdD/Q.p0erRK', '(19) 98364-1138', 'Americana/SP', '255.435.898-24', 0, NULL),
(26, 'EDUARDO ROBERSON PIRES', 'eduardo.roberson@hotmail.com', '$2y$10$s8R.aAbkZ.ccUXFJWXH9LuJd5IeL8GEJNuMrAo2Nn.nF8L5EQkDie', '(51) 9978-5298', 'SAPUCAIA DO SUL', '008.854.150-94', 0, NULL),
(27, 'DIOGO PEREIRA DE BRITO', 'diogopbrito5@gmail.com', '$2y$10$YXxBCIvjqCZRmLyOWfnPcezqlj0jQy1AEklXb4yGUOfx3rjEMnRme', '(62) 98101-6959', 'GOIAS', '031.239.201-00', 0, NULL),
(28, 'Christian Silva Mont', 'chrismontpipe@gmail.com', '$2y$10$oelRGAMHkSYuQvyZOesC5e9TwsRHJIBbnrHWliUE92MEhjacnqB3G', '(11) 94711-0492', 'Avenida Major Alvim n°400 Bloco 1 Apto 31', '159.269.578-77', 0, NULL),
(29, 'Eric Coleta', 'ericbercol@gmail.com', '$2y$10$jQ/duwV8eg7SU45Y3QjQl.EqaNbSkiTV8OGBvvJ3Rv0a9RIsl2.Ty', '(16) 99355-7849', 'Ribeirão Preto - SP', '000.000.000-00', 0, NULL),
(30, 'teste crypto', 'teste@cryptoteste.com', '$2y$10$5H5q7wsVAAQsraUVWGI5rOD0GACf4DQ.s/ouNp9aO/sstCA2kZKe.', '(76) 79998-8389', 'dourados/MS', '051.234.661-18', 0, NULL),
(31, 'Raul Flavio Barros Rodrigues', 'rfbr21@gmail.com', '$2y$10$a60yTVILUuoHNovMHKHmlO3gMlhuZJ3Bpvc0ORfUDYw3/L29vKhai', '(11) 95348-9898', 'atibaia', '370.459.278-', 0, NULL),
(32, 'Marlos P Batista', 'marlos_p_b@hotmail.com', '$2y$10$oIn2op0drM0BPh6p/aIjYe0Hi5P0Jtl8u3LbJTVOhS1m8fecA.HIS', '(71) 99300-3009', 'Santa Maria da Vitória, Bahia', '019.079.761-40', 0, NULL),
(33, 'Emerson Pinheli', 'epinheli@gmail.com', '$2y$10$RI.Rv0NzocjQGDDiBAdiJuIRen14kkP9HtSwqMVkDFg5HJY0knfq2', '(44) 99961-9090', 'Maringa/Parana', '019.381.339-43', 0, NULL),
(34, 'ALLAN ETN', 'comprashccelular@gmail.com', '$2y$10$XF1mCdeI8B6spEUQJMpFHOUGUPuorXQhrpb4nBD5EiiXmrurf6Gda', '()', 'MACEIÓ', '032.9685040-6', 0, NULL),
(35, 'Fabricio santos Galletti', 'fsgalletti@gmail.com', '$2y$10$lwYhy3aSgAvjc4hVQ9a53ObwIwzHwHNjRD.s18g..xmNdxE9HmAkC', '(21) 98855-8255', 'Rio de Janeiro RJ', '007.700.977-07', 0, NULL),
(36, 'GALBERTO BRUNO BARROS DE ALMEIDA', 'bacta22@gmail.com', '$2y$10$d5AhuvLkhs9nSBMM7otCYO.wZyP2iHqa.lQ6HjBWJHx.L5UAZeQs2', '(85) 98702-2563', 'Caucaia', '007.730.743-76', 0, NULL),
(37, 'Marcos Rodrigues Pinto', 'mrpnet@gmail.com', '$2y$10$6Ok.eXezZTdhVYrmXD2Hcew2cbTRXJLIuNJTahgSSWf0EYPujbm7m', '(31) 99848-4837', 'Belo Horizonte / MG', '055.0974466-9', 0, NULL),
(38, 'Victor Hugo', 'vichfsilva@gmail.com', '$2y$10$4ondbVR4aTprf/debSxhu.vwSo5lYN43sKq0dtrqZokB.75Mfhpr6', '(21) 99387-2013', 'Belford Roxo RJ', '044.898.957-39', 0, NULL),
(39, 'JOSE MARIA DA SILVA ROCHA', 'josemaria.instalatec@gmail.com', '$2y$10$qTuTJ49tAKV7PNI1ngzNFuWP..JUkFVjEb5WhLeyv.MeoUvGomZoS', '(31) 98776-3671', 'Sete Lagoas', '031.853.606-48', 0, NULL),
(40, 'Jonas Tamandare Lins Rodrigues Junior', 'linsjonas@gmail.com', '$2y$10$ZFbrcHl.afMv9IbKpgHF8uugcLqs1ObknwHN1SwBFBgEvbv73B4x6', '(92) 99228-6816', 'MANAUS', '963.846.462-34', 0, NULL),
(41, 'Matheus Benites benites', 'benites.amorim@gmail.com', '$2y$10$y3vBT72nO3PeMhARIMRiZedwRNA/VZTMrTaUgI4eC6x.XRjUMutiy', '(67) 9969-4191', 'Rua JosÃ© de Alencar 1135, apto 11', '051.234.661-21', 0, NULL),
(42, 'TESTE', 'teste@teste.com', '$2y$10$7/V6NkMwtXFE2rmJisCtOetcJ4k9RjQp6m7SNVnEN3/0OAoiINCoG', '(67) 9969-4191', 'Rua JosÃ© de Alencar 1135, apto 11', '051.234.661-18', 1, '2019-06-21 09:05:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes_ativos`
--

CREATE TABLE `clientes_ativos` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_plano` int(11) NOT NULL,
  `nome_cliente` varchar(100) NOT NULL,
  `nome_plano` varchar(100) NOT NULL,
  `valor` decimal(11,2) NOT NULL,
  `data_adesao` datetime NOT NULL,
  `data_exclusao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientes_ativos`
--

INSERT INTO `clientes_ativos` (`id`, `id_cliente`, `id_plano`, `nome_cliente`, `nome_plano`, `valor`, `data_adesao`, `data_exclusao`) VALUES
(31, 5, 3, 'Franciel', '1 ANO somente hoje', '300.00', '2019-06-15 09:05:30', '2019-12-14 15:05:30');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes_inativos`
--

CREATE TABLE `clientes_inativos` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `nome_cliente` int(11) NOT NULL,
  `email` int(11) NOT NULL,
  `telefone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes_pendentes`
--

CREATE TABLE `clientes_pendentes` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_plano` int(11) NOT NULL,
  `nome_cliente` varchar(100) NOT NULL,
  `nome_plano` varchar(100) NOT NULL,
  `valor` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fatura`
--

CREATE TABLE `fatura` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_plano` varchar(100) NOT NULL,
  `email_user` varchar(100) NOT NULL,
  `ref` int(11) NOT NULL,
  `forma` varchar(100) NOT NULL,
  `data` varchar(100) NOT NULL,
  `plano` varchar(100) NOT NULL,
  `valor` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `fatura`
--

INSERT INTO `fatura` (`id`, `id_user`, `id_plano`, `email_user`, `ref`, `forma`, `data`, `plano`, `valor`, `status`) VALUES
(17, 41, '1', ' benites.amorim@gmail.com', 509841, 'Mercado Pago', '2019-07-10 09:56:48', 'Básico', ' 50,00', 'Pendente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `planos`
--

CREATE TABLE `planos` (
  `id_plano` int(11) NOT NULL,
  `nome_plano` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `duracao_plano` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `duracao_meses` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `planos`
--

INSERT INTO `planos` (`id_plano`, `nome_plano`, `duracao_plano`, `valor`, `duracao_meses`) VALUES
(1, 'Básico', 30, '50.00', '1 Mês'),
(2, 'Pró', 90, '140.00', '3 Meses'),
(3, '1 ANO somente hoje', 365, '300.00', '12 Meses');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD KEY `idCliente` (`idCliente`);

--
-- Indexes for table `clientes_ativos`
--
ALTER TABLE `clientes_ativos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clientes_pendentes`
--
ALTER TABLE `clientes_pendentes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fatura`
--
ALTER TABLE `fatura`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `planos`
--
ALTER TABLE `planos`
  ADD PRIMARY KEY (`id_plano`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `clientes_ativos`
--
ALTER TABLE `clientes_ativos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `clientes_pendentes`
--
ALTER TABLE `clientes_pendentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fatura`
--
ALTER TABLE `fatura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `planos`
--
ALTER TABLE `planos`
  MODIFY `id_plano` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
