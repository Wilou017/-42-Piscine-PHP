CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `category` text NOT NULL,
  `nat` text NOT NULL,
  `photo` text NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `numders` text NOT NULL,
  `adress` text NOT NULL,
  `email` text NOT NULL,
  `birthdate` datetime NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `sexe` text NOT NULL,
  `size` text NOT NULL,
  `description` text NOT NULL,
  `stock` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `time_delivery` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `panier` text NOT NULL,
  `payed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `rank` int(2) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_checked` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

INSERT INTO `category` (`id`, `category`) VALUES (NULL, 'Esclaves');
INSERT INTO `category` (`id`, `category`) VALUES (NULL, 'Sportif');
INSERT INTO `category` (`id`, `category`) VALUES (NULL, 'Menteur');
INSERT INTO `category` (`id`, `category`) VALUES (NULL, 'Drole');