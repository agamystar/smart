CREATE DATABASE `dg_test`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(80) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(1, 'david', '12345', 'david@domain.com'),
(2, 'maria', '464y3y', 'maria@domain.com'),
(3, 'alejandro', 'a42352fawet', 'alejandro@domain.com'),
(4, 'emma', 'f22a3455b2', 'emma@domain.com');
