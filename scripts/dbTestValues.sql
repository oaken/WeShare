SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+02:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `weshare`
--

--
-- Contenu de la table `friends`
--

INSERT INTO `friends` (`IdUser`, `IdFriend`, `Status`) VALUES(1, 10, 1);
INSERT INTO `friends` (`IdUser`, `IdFriend`, `Status`) VALUES(1, 11, 0);
INSERT INTO `friends` (`IdUser`, `IdFriend`, `Status`) VALUES(10, 1, 1);
INSERT INTO `friends` (`IdUser`, `IdFriend`, `Status`) VALUES(11, 12, 2);
INSERT INTO `friends` (`IdUser`, `IdFriend`, `Status`) VALUES(12, 10, 0);
INSERT INTO `friends` (`IdUser`, `IdFriend`, `Status`) VALUES(10, 11, 0);

--
-- Contenu de la table `movies`
--

INSERT INTO `movies` (`IdMovie`, `Name`, `Synopsis`, `DateOfRecord`, `Poster`) VALUES(1, 'Transformers', 'des robots qui veulent détruirent le monde (enfin non mais bon c''est compliquer)', '2007-00-00', 'http://upload.wikimedia.org/wikipedia/en/thumb/6/66/Transformers07.jpg/220px-Transformers07.jpg');
INSERT INTO `movies` (`IdMovie`, `Name`, `Synopsis`, `DateOfRecord`, `Poster`) VALUES(2, 'Avatar', 'Les Schtroumpfs en balade dans la galaxie', '2009-00-00', 'http://ia.media-imdb.com/images/M/MV5BMTYwOTEwNjAzMl5BMl5BanBnXkFtZTcwODc5MTUwMw@@._V1._SY317_CR0,0,214,317_.jpg');
INSERT INTO `movies` (`IdMovie`, `Name`, `Synopsis`, `DateOfRecord`, `Poster`) VALUES(3, 'Inception', '', '2010-00-00', 'http://ia.media-imdb.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1._SY317_.jpg');

--
-- Contenu de la table `moviesmarks`
--

INSERT INTO `moviesmarks` (`IdMovie`, `IdUser`, `Mark`, `UserComment`) VALUES(1, 1, 3, 'C''est cool');
INSERT INTO `moviesmarks` (`IdMovie`, `IdUser`, `Mark`, `UserComment`) VALUES(2, 10, 0, 'm''ok');
INSERT INTO `moviesmarks` (`IdMovie`, `IdUser`, `Mark`, `UserComment`) VALUES(3, 11, 5, NULL);

--
-- Contenu de la table `moviesstaffs`
--

INSERT INTO `moviesstaffs` (`IdMovie`, `IdStaff`, `StaffWork`) VALUES(2, 2, 'realisateur');
INSERT INTO `moviesstaffs` (`IdMovie`, `IdStaff`, `StaffWork`) VALUES(1, 3, 'actrice');
INSERT INTO `moviesstaffs` (`IdMovie`, `IdStaff`, `StaffWork`) VALUES(3, 1, 'acteur');

--
-- Contenu de la table `staffs`
--

INSERT INTO `staffs` (`IdStaff`, `LastName`, `FirstName`, `BornDate`, `Bio`, `Picture`) VALUES(1, 'DiCaprio', 'Leonardo', '1974-11-11', 'Leonardo DiCaprio, né le 11 novembre 1974 à Los Angeles en Californie, est un acteur, scénariste et producteur de cinéma américain.', 'http://upload.wikimedia.org/wikipedia/commons/thumb/8/8f/LeonardoDiCaprioNov08.jpg/220px-LeonardoDiCaprioNov08.jpg');
INSERT INTO `staffs` (`IdStaff`, `LastName`, `FirstName`, `BornDate`, `Bio`, `Picture`) VALUES(2, 'Cameron', 'James', '1954-08-16', 'James Francis Cameron est un réalisateur, scénariste et producteur canadien, né le 16 août 1954 à Kapuskasing (Ontario, Canada). Il a réalisé, écrit ou produit les films Terminator (1984), Aliens, le retour (1986), Abyss (1989), Terminator 2 (1991), True Lies (1994), Titanic (1997), Les fantômes du Titanic (2003) et Avatar (2009).', 'http://upload.wikimedia.org/wikipedia/commons/thumb/5/50/JamesCameronDec09.jpg/220px-JamesCameronDec09.jpg');
INSERT INTO `staffs` (`IdStaff`, `LastName`, `FirstName`, `BornDate`, `Bio`, `Picture`) VALUES(3, 'Fox', 'Megan', '1986-05-16', 'Megan Denise Fox, née le 16 mai 1986 à Oak Ridge dans le Tennessee, est une actrice, mannequin et comédienne de doublage américaine.', 'http://upload.wikimedia.org/wikipedia/commons/thumb/0/06/MeganFoxTIFFSept2011.jpg/220px-MeganFoxTIFFSept2011.jpg');

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`IdUser`, `RegisterDate`, `Pseudo`, `Password`, `Mail`, `LastName`, `FirstName`, `BornDate`, `Address`, `City`, `Country`, `Phone`, `Avatar`) VALUES(1, '2012-04-18', 'Dacove', '1234', 'tresson@intechinfo.fr', 'Tresson', 'Ludovic', '1992-06-07', 'somewhere else', 'epinay', 'france', '0612143720', 'http://image.noelshack.com/fichiers/2012/16/1334866612-Green_by_heise.jpg');
INSERT INTO `users` (`IdUser`, `RegisterDate`, `Pseudo`, `Password`, `Mail`, `LastName`, `FirstName`, `BornDate`, `Address`, `City`, `Country`, `Phone`, `Avatar`) VALUES(10, '2012-04-19', 'Froutch', '12345', 'aarnal@intechinfo.fr', 'Arnal', 'Alexandre', '1991-05-03', 'same as the guy before me', 'blablaville', 'france', '0000000000', 'http://www.mypokecard.com/fr/Galerie/my/galery/S263jyPNfCli.jpg');
INSERT INTO `users` (`IdUser`, `RegisterDate`, `Pseudo`, `Password`, `Mail`, `LastName`, `FirstName`, `BornDate`, `Address`, `City`, `Country`, `Phone`, `Avatar`) VALUES(11, '2012-04-20', 'Proust', '12345', 'proust@intechinfo.fr', 'Proust', 'François', '1992-05-03', '37 rip', 'moon', 'space', '0101010101', 'http://www.cabourg.net/IMG/arton54.jpg');
INSERT INTO `users` (`IdUser`, `RegisterDate`, `Pseudo`, `Password`, `Mail`, `LastName`, `FirstName`, `BornDate`, `Address`, `City`, `Country`, `Phone`, `Avatar`) VALUES(12, '2012-04-20', 'Ricard', '12345', 'ricard@intechinfo.fr', 'Ricard', 'Vincent', '1992-05-03', '37 rue picard', 'Paris', 'France', '0202020202', 'http://www.weimax.com/images/Ricard_Vincent_Pouring_Tastes.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
