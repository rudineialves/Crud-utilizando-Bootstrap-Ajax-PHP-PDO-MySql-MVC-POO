
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `name`, `email`, `login`, `password`, `active`) VALUES
(1, 'Joao da Silva', 'joao@silva.com.br', 'jsilva', 'silva123', 1),
(2, 'Pedro Pereira', 'p.pereira@gmail.com', 'ppereira', 'pereirada', 1),
(3, 'José de Souza', 'souza@souza.com', 'souza', 'sosouza', 1);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;