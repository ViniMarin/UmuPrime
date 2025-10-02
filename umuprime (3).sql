-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/10/2025 às 16:46
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
-- Banco de dados: `umuprime`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `caracteristicas_imoveis`
--

CREATE TABLE `caracteristicas_imoveis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `imovel_id` bigint(20) UNSIGNED NOT NULL,
  `caracteristica` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `caracteristicas_imoveis`
--

INSERT INTO `caracteristicas_imoveis` (`id`, `imovel_id`, `caracteristica`, `created_at`, `updated_at`) VALUES
(13, 1, 'PISCINA', '2025-09-01 03:17:01', '2025-09-01 03:17:01'),
(14, 1, 'CHURRASQUEIRA', '2025-09-01 03:17:01', '2025-09-01 03:17:01');

-- --------------------------------------------------------

--
-- Estrutura para tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagens_imoveis`
--

CREATE TABLE `imagens_imoveis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `imovel_id` bigint(20) UNSIGNED NOT NULL,
  `caminho_imagem` varchar(255) NOT NULL,
  `legenda` varchar(255) DEFAULT NULL,
  `ordem` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `imagens_imoveis`
--

INSERT INTO `imagens_imoveis` (`id`, `imovel_id`, `caminho_imagem`, `legenda`, `ordem`, `created_at`, `updated_at`) VALUES
(1, 1, 'imoveis/YnDC03zDcnuEZ9xpq3ogbzmZ0eJlNpBozuniuyk7.jpg', NULL, 0, '2025-09-01 01:06:07', '2025-09-01 01:06:07'),
(3, 1, 'imoveis/qidfm1ne7akBKKt9WeQNthTy3o2PxUsyzrvoA4qL.jpg', NULL, 1, '2025-09-01 02:37:15', '2025-09-01 02:37:15'),
(5, 4, 'imoveis/gCGLJU6rDspWQYXukYIOS1vba7bKfTqUDBwKkWve.jpg', NULL, 0, '2025-09-01 17:21:22', '2025-09-01 17:21:22'),
(6, 5, 'imoveis/aaNK8XqIlkhrLVn5Ubiuo6GyU0iME5QNjdlg9zNl.jpg', NULL, 0, '2025-09-02 20:33:28', '2025-09-02 20:33:28');

-- --------------------------------------------------------

--
-- Estrutura para tabela `imoveis`
--

CREATE TABLE `imoveis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `referencia` varchar(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `tipo_negocio` enum('aluguel','venda') NOT NULL,
  `tipo_imovel` varchar(255) NOT NULL,
  `valor` decimal(12,2) NOT NULL,
  `valor_condominio` decimal(10,2) DEFAULT NULL,
  `valor_iptu` decimal(10,2) DEFAULT NULL,
  `endereco` varchar(255) NOT NULL,
  `numero` varchar(255) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `estado` char(2) NOT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `area_total` decimal(8,2) DEFAULT NULL,
  `area_construida` decimal(8,2) DEFAULT NULL,
  `quartos` int(11) DEFAULT NULL,
  `banheiros` int(11) DEFAULT NULL,
  `vagas_garagem` int(11) DEFAULT NULL,
  `suites` int(11) DEFAULT NULL,
  `andar` int(11) DEFAULT NULL,
  `mobiliado` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('disponivel','vendido','alugado','indisponivel') NOT NULL DEFAULT 'disponivel',
  `destaque` tinyint(1) NOT NULL DEFAULT 0,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `imoveis`
--

INSERT INTO `imoveis` (`id`, `referencia`, `titulo`, `descricao`, `tipo_negocio`, `tipo_imovel`, `valor`, `valor_condominio`, `valor_iptu`, `endereco`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `cep`, `area_total`, `area_construida`, `quartos`, `banheiros`, `vagas_garagem`, `suites`, `andar`, `mobiliado`, `status`, `destaque`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 'UMU', 'Casa do Vinicius', 'Casa boa', 'venda', 'terreno', 20000.00, 250.00, NULL, 'RUA AVELINO ROVERON', NULL, NULL, 'Verde', 'Umuarama', 'PR', NULL, 80.00, 80.00, 1, NULL, NULL, NULL, NULL, 0, 'disponivel', 0, NULL, NULL, '2025-09-01 01:06:07', '2025-09-02 20:17:38'),
(4, 'UMU', 'Trabalho', NULL, 'aluguel', 'sala_comercial', 80000.00, 0.25, 0.10, 'Rua da Casa dela', '2122', NULL, 'CENTRO', 'Umuarama', 'PR', '99999999', 500.00, 300.00, 4, 3, 3, 2, NULL, 0, 'disponivel', 0, NULL, NULL, '2025-09-01 17:08:37', '2025-09-02 23:38:57'),
(5, 'UMU', 'Casa da Bianca', 'CASA', 'venda', 'sobrado', 800000.00, NULL, 500.00, 'Rua da Casa dela', '2121', 'NÃO TEM', 'CENTRO', 'Umuarama', 'PR', '99999999', 500.00, 425.00, 7, 5, 8, 5, NULL, 0, 'disponivel', 0, NULL, NULL, '2025-09-02 20:33:28', '2025-09-03 22:36:56');

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2025_08_26_030117_create_imoveis_table', 1),
(7, '2025_08_26_030123_create_caracteristicas_imoveis_table', 1),
(8, '2025_08_26_030123_create_imagens_imoveis_table', 1),
(9, '2025_08_31_000000_create_imagens_table', 1),
(10, '2025_09_01_000656_add_andar_to_imoveis_table', 2),
(11, '2025_09_01_002646_alter_estado_column_on_imoveis_table', 3),
(12, '2025_09_01_140302_remove_unique_referencia_from_imoveis_table', 4),
(13, '2025_10_02_132257_create_site_settings_table', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hero_image` varchar(255) DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `site_settings`
--

INSERT INTO `site_settings` (`id`, `hero_image`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'banners/A7AiR3DXbQvmHTNW1BVDRkIKEiKJ2ONuc64faWxL.jpg', 1, '2025-10-02 16:34:31', '2025-10-02 16:34:31');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrador UmuPrime', 'admin@umuprime.com.br', NULL, '$2y$12$Xj9.8pBGzgo/C/5gY4B29.E5AAzvyUf/LEZKCf3ocMWWBdnhJ22Ce', NULL, '2025-09-01 01:03:15', '2025-09-01 01:03:15');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `caracteristicas_imoveis`
--
ALTER TABLE `caracteristicas_imoveis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caracteristicas_imoveis_imovel_id_foreign` (`imovel_id`);

--
-- Índices de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices de tabela `imagens_imoveis`
--
ALTER TABLE `imagens_imoveis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imagens_imoveis_imovel_id_foreign` (`imovel_id`);

--
-- Índices de tabela `imoveis`
--
ALTER TABLE `imoveis`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Índices de tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices de tabela `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `site_settings_updated_by_index` (`updated_by`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `caracteristicas_imoveis`
--
ALTER TABLE `caracteristicas_imoveis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `imagens_imoveis`
--
ALTER TABLE `imagens_imoveis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `imoveis`
--
ALTER TABLE `imoveis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `caracteristicas_imoveis`
--
ALTER TABLE `caracteristicas_imoveis`
  ADD CONSTRAINT `caracteristicas_imoveis_imovel_id_foreign` FOREIGN KEY (`imovel_id`) REFERENCES `imoveis` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `imagens_imoveis`
--
ALTER TABLE `imagens_imoveis`
  ADD CONSTRAINT `imagens_imoveis_imovel_id_foreign` FOREIGN KEY (`imovel_id`) REFERENCES `imoveis` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
