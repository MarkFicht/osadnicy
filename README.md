# Lessons about connections between PHP & MySQL in XAMPP

Learning PHP and MySQL with XAMPP and phpmyadmin.
In this project I create login panel, which can gets, sent and check data from DataBase.

All files were in folder: xampp>htdocs>osadnicy
For corrected working, we must run XAMPP Control Panel and start Apache + MySQL
In browser at the adress URL: http://localhost/phpmyadmin create empty DB "osadnicy" and import file "uzytkownicy.sql"

<ol>What I have learned in this project
	<li> I met global variable $_SESSION </li>
	<li> opening session and very important closing that one </li>
	<li> session time </li>
	<li> connected with DB - checking, inserting, getting </li>
	<li> sanitization and validation code </li>
	<li> a redirect network, redirection with conditional statement and header() </li>
	<li> MySQL query with PHP - I learned a few security features: </li>
	<li> - if() for checking correct query </li>
	<li> - protection against Injection SQL (e.g. in inputs for Login/Password) </li>
	<li> - displaying information about errors with query(For Dev and regular user) </li>
	<li> hashing with PASSWORD_DEFAULT </li>
	<li> reCAPTCHA - Implementation in the code </li>
	<li> instruction try .. catch  -  better error control mechanism </li>
	<li> ^ with throw new Exception() </li>
	<li> differences between: require  VS  include </li>
	<li> method fetch_assoc() </li>
	<li> a few other basics :) </li>
</ol>

