SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Banco de dados: `cinetech`

-- --------------------------------------------------------

--
-- Estrutura para tabela `filmes`
--

CREATE TABLE `filmes` (
  `id` int NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` text,
  `capa` varchar(255) DEFAULT NULL,
  `trailer` varchar(255) DEFAULT NULL,
  `data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `data_lancamento` date DEFAULT NULL,
  `duracao` int DEFAULT NULL,
  `trailer_iframe` text,
  `genero_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `filmes`
--

INSERT INTO `filmes` (`id`, `titulo`, `descricao`, `capa`, `trailer`, `data_cadastro`, `data_lancamento`, `duracao`, `trailer_iframe`, `genero_id`) VALUES
(2, 'Nosferatu', 'Uma nova adaptação do clássico do terror, Nosferatu é um conto gótico sobre a obsessão de um terrível vampiro por uma mulher assombrada. A história se passa nos anos de 1800 na Alemanha e acompanha o rico e misterioso Conde Orlok (Bill Skarsgård) na busca por um novo lar. O vendedor de imóveis Thomas Hutter (Nicholas Hoult) fica responsável por conduzir os negócios de Orlok e, então, viaja para as montanhas da Transilvânia para prosseguir com as burocracias da nova propriedade do nobre. O que Thomas não esperava era encontrar o mal encarnado. Todos ao seu redor lhe indicam abandonar suas viagens, enquanto, longe dali, Ellen (Lily-Rose Depp) é continuamente perturbada por sonhos assustadores que se conectam com o suposto homem que Thomas encontrará e que vive sozinho num castelo em ruínas nos Cárpatos. A estranha relação entre Ellen e a criatura a fará sucumbir a algo sombrio e tenebroso?', 'img/67fa24f42255b-Nosferatu.jpeg', 'https://www.youtube.com/watch?v=NW9VWrIxJqw', '2025-04-08 18:57:20', '2025-01-02', 132, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/NW9VWrIxJqw?si=v8RhvDrWADRAW5tl\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 5),
(9, 'Mercenários', 'Eles estão de volta e trouxeram reforço! O lendário grupo de mercenários liderado por Barney Ross (Sylvester Stallone) tem uma nova missão explosiva: impedir o início da Terceira Guerra Mundial. Quando as coisas saem do controle, Christmas (Jason Statham) e os novos membros da equipe (Megan Fox, 50 Cent e Tony Jaa) são recrutados para impedir que o pior aconteça. Prepare-se para perder o fôlego neste novo capítulo de uma das maiores franquias de ação da história!', 'img/Mercenarios.jpeg', 'https://www.youtube.com/watch?v=KkXzTf2AA_s', '2025-04-03 20:30:31', '2023-09-21', 103, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/KkXzTf2AA_s?si=KrFSmosjqMWh4uLA\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 2),
(24, 'Shrek', 'Em um pântano distante vive Shrek (Mike Myers), um ogro solitário que vê, sem mais nem menos, sua vida ser invadida por uma série de personagens de contos de fada, como três ratos cegos, um grande e malvado lobo e ainda três porcos que não têm um lugar onde morar. Todos eles foram expulsos de seus lares pelo maligno Lorde Farquaad (John Lithgow). Determinado a recuperar a tranquilidade de antes, Shrek resolve encontrar Farquaad e com ele faz um acordo: todos os personagens poderão retornar aos seus lares se ele e seu amigo Burro (Eddie Murphy) resgatarem uma bela princesa (Cameron Diaz), que é prisioneira de um dragão. Porém, quando Shrek e o Burro enfim conseguem resgatar a princesa logo eles descobrem que seus problemas estão apenas começando.', 'img/67fa24d91f808-download (1).jpeg', 'https://www.youtube.com/watch?v=CwXOrWvPBPk', '2025-04-12 08:20:54', '2001-06-22', 89, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/CwXOrWvPBPk?si=p2ewkmWzT9XqCR7k\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 19);

-- --------------------------------------------------------

--
-- Estrutura para tabela `generos`
--

CREATE TABLE `generos` (
  `id` int NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `generos`
--

INSERT INTO `generos` (`id`, `nome`) VALUES
(2, 'Ação'),
(19, 'Animação'),
(3, 'Aventura'),
(4, 'Comédia'),
(6, 'Ficção Científica'),
(5, 'Terror');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Índices de tabela `filmes`
--
ALTER TABLE `filmes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `filmes`
--
ALTER TABLE `filmes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `generos`
--
ALTER TABLE `generos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
