# Lessons about connections between PHP & MySQL in XAMPP

Learning PHP and MySQL with XAMPP and phpmyadmin.<br>
In this project I create login panel, which can gets, sent and check data from DataBase.

All files were in folder: xampp>htdocs>osadnicy<br>
For corrected working, we must run XAMPP Control Panel and start Apache + MySQL<br>
In browser at the adress URL: http://localhost/phpmyadmin create empty DB "osadnicy" and import file "uzytkownicy.sql"

<p><b>What I have learned in this project</b></p>
	<li> I met global variable $_SESSION </li>
	<li> opening session and very important closing that one </li>
	<li> session time </li>
	<li> connected with DB - checking, inserting, getting </li>
	<li> sanitization and validation code </li>
	<li> a redirect network, redirection with conditional statement and header() </li>
	<li> MySQL query with PHP - I learned a few security features: </li>
	 - if() for checking correct query <br>
	 - protection against Injection SQL (e.g. in inputs for Login/Password) <br>
	 - displaying information about errors with query(For Dev and regular user) 
	<li> hashing with PASSWORD_DEFAULT </li>
	<li> reCAPTCHA - Implementation in the code </li>
	<li> instruction try .. catch  -  better error control mechanism </li>
	 ^ with throw new Exception(), etc.
	<li> differences between: require  VS  include </li>
	<li> method fetch_assoc() </li>
	<li> a few other basics :) </li>

