CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `photo` text NOT NULL,
  `nom` text NOT NULL,
  `color` text NOT NULL,
  `size` text NOT NULL,
  `description` text NOT NULL,
  `stock` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `time_delivery` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `rank` int(2) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_checked` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;