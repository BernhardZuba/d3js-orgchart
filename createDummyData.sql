CREATE TABLE IF NOT EXISTS `position` (
`id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `desc` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

INSERT INTO `position` (`id`, `parent_id`, `desc`) VALUES
(1, 0, 'Executive office'),
(2, 1, 'Sales'),
(3, 1, 'Marketing'),
(4, 1, 'Development'),
(8, 2, 'Salesman 1'),
(9, 2, 'Salesman 2'),
(10, 3, 'Person M1'),
(11, 4, 'Team 1'),
(12, 4, 'Team 2'),
(13, 4, 'Team 3'),
(14, 11, 'Developer Team1 1'),
(15, 11, 'Developer Team1 2'),
(16, 12, 'Developer Team2 1'),
(17, 12, 'Developer Team2 2'),
(18, 12, 'Developer Team2 3'),
(19, 12, 'Developer Team2 4'),
(20, 13, 'Developer Team3 1'),
(21, 13, 'Developer Team3 2'),
(22, 13, 'Developer Team3 3');

ALTER TABLE `position`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `position`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
