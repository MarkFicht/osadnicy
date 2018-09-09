# Lessons about connections between PHP & MySQL in XAMPP

Learning PHP and MySQL with XAMPP and phpmyadmin.<br>
In this project I create login panel, which can gets, sent and check data from DataBase.

### Installation and configuration

You need instal localhost, XAMPP. <br>
All files were in folder: xampp/htdocs/osadnicy <br>
For corrected working, we must run XAMPP Control Panel and start 2 options: Apache + MySQL<br>
In URL: http://localhost/phpmyadmin create empty DB "osadnicy" and import file "uzytkownicy.sql" from our repo.

## Built of ...

- [Clear PHP, without frameworks]
- [MySQL]
- [HTML, CSS]

## What I discovered
<ul>
	<li> I met global variable $_SESSION </li>
	<li> opening session and very important closing that one </li>
	<li> session time </li>
	<li> connected with DB - checking, inserting, getting </li>
	<li> sanitization and validation code </li>
	<li> a redirect network, redirection with conditional statement and header() </li>
	<li> MySQL query with PHP - I learned a few security features: 
		<ul>
			<li> if() for checking correct query </li> 
	 		<li> protection against Injection SQL (e.g. in inputs for Login/Password) </li> 
	 		<li> displaying information about errors with query(For Dev and regular user) </li> 
		</ul>
	</li>
	<li> hashing with PASSWORD_DEFAULT </li>
	<li> reCAPTCHA - Implementation in the code </li>
	<li> instruction try .. catch  -  better error control mechanism 
		<ul>
			<li> with throw new Exception(), etc. </li>
		</ul>
	</li>
	<li> differences between: require  VS  include </li>
	<li> method fetch_assoc() </li>
	<li> a few other basics :) </li>
</ul>

## Further idea for development

In the future I will learn more about Back-end. I am thinking about choosing between: PHP or NodeJS or mastering Firebase. </br>
I am currently focusing on technologies from the frontend, but the goal is, to stay full stack.

