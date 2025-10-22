<?php
/*
Uitgaande van users-tabel :
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `lastedit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `lastedit`) VALUES
(1, 'Admin', 'admin@work.nl',  '7C 6D 62 AC 72', 128, '2022-10-18 12:59:48'),
(2, 'Geert', 'geert@work.nl',  '7D 63 62 7C 72',  64, '2023-09-11 13:13:00'),
(3, 'Jeroen','jeroen@work.nl', '4B 67 79 61 48',   2, '2022-10-19 08:14:58');

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email` (`email`);

*/
function getUserByEmailAndPassword(string $email, string $password) : void
{
	$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	
	echo '<table border="0" width="100%">'
	.'<tr><td><label>email</label></td><td><textarea readonly cols="80" rows="3">'.$email.'</textarea></td></tr>'
	.'<tr><td><label>password</label></td><td><textarea readonly cols=80 rows="3">'.$password.'</textarea></td></tr>'
	.'<tr><td><label>query to run</label></td><td><textarea readonly cols="80" rows="3">'.$query.'</textarea></td></tr>'
	.'</table>';
}	

function testInjection(string $title, string $email, string $password) : void
{
	echo '<h3>'.$title.'</h3>';	
	getUserByEmailAndPassword($email, $password);
}	


testInjection(
	title		: 'No problem', 
	email		: 'geert@work.nl', 
	password	: '7D 63 62 7C 72'
);	

testInjection(
	title		: 'Get all users', 
	email		: 'geert@work.nl', 
	password	: "no-need-to-know' OR '1'='1"
);	

testInjection(
	title		: 'Get first user who\'s email starts with "g"', 
	email		: "does-not-matter' OR email IN (SELECT email FROM users WHERE email LIKE 'g%' LIMIT 1) OR '2'='1", 
	password	: "who-cares' OR password IN (SELECT password FROM users WHERE email LIKE 'g%' LIMIT 1) OR '2'='1"
);	


testInjection(
	title		: 'Don\'t try this at home!', 
	email		: 'sorry-for-the-inconveniance', 
	password	: "';DELETE FROM users WHERE '1'='1"
);	