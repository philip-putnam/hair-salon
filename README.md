# _Hair Salon_

#### _Silex application that allows user to create (add), read (view), update (edit), and delete stylists and related clients to a database, 02/24/2017_

#### By _**Philip Putnam**_

## Description

_This application will display current stylists supplied from a mysql database along with the stylist's specific client list. Stylists and clients are connected in a one (stylist) to many (client) relationship held remotely in the database. The application allows the user to create new stylists and to give them specific clients, as well as to update/edit stylist/client information. The user may also delete a stylist (along with all of their clients) or a single client as well._

## Setup/Installation Requirements

### Method 1:
* _Using a web browser or terminal, clone the repository at https://github.com/philip-putnam/hair-salon __
* _Navigate to the project directory, at the top level of the project directory in a terminal, type:
> composer install --prefer-source --no-interaction
OR simply:
> composer install_
* _After composer has finished installation, navigate to the 'web' folder within the project directory using a terminal. Begin a local server in this folder and navigate to the appropriate address. Example: inside the 'web' folder type:
> php -S localhost:8000
then in a web browser, navigate to 'localhost:8000_
* _Fill in the form on the webpage and hit submit!_

### Creating MySQL database

* _Open MAMP and begin Apache & MySQL server on your computer_
* _After cloning project from Github, open terminal and navigate to the top level of the project directory_
* _in the terminal type:_
* _> /Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot_
* _> CREATE DATABASE hair_salon;_
* _> USE hair_salon;_
* _> CREATE TABLE stylists (id serial PRIMARY KEY, name VARCHAR (255));_
* _> CREATE TABLE clients (id serial PRIMARY KEY, name VARCHAR (255), stylist_id int);_
* _Open Apache server from either MAMP or navigating to localhost:<apache-port#>/MAMP/ , where <apache-port# is the port number indicated for the Apache port in MAMP Preferences..._
* _Click phpMyAdmin link, then click on the hair_salon database on the left of the screen_
* _Click the 'operations' tab, in 'Copy database to:' type hair_salon_test and select 'Structure only' then click 'Go'_

## Specifications

| Expected Behavior: application will... | Input | Output |
| ----------------- | ----- | ------ |
| 1. display all stylists held in database | user navigates to main page | "Debra Collins, George Peterson, Jose Martinez" |
| 2. save new stylist to database | "Jen Doe"  | "Debra Collins, George Peterson, Jose Martinez, Jen Doe" |
| 3. delete all stylists | click delete all button | " " (empty table within database) |
| 4. find a stylist | click stylist's name | "Debra Collins" |
| 5. update stylist information | "Debora Collins"  | "Debora Collins" |
| 6. delete a stylist | click delete "George Peterson" | "Debora Collins, Jose Martinez, Jen Doe"  |
| 7. display all clients held in database | user navigates to stylist page | "Gwen Stefani, George Clooney" |
| 8. save new client to database | "Beyonce"  | "Gwen Stefani, George Clooney, Beyonce" |
| 9. delete all clients | click delete all button | " " (empty table within database) |
| 10. find a client | click client's name | "Gwen Stefani" |
| 11. update client information | "Gwennifer Stefani"  | "Gwennifer Stefani" |
| 12. delete a client | click delete "George Clooney" | "Gwen Stefani, Beyonce"  |
| 13. return all clients belonging to stylist | click stylist's name | "Gwen Stefani, Beyonce" |


## Known Bugs

_No known bugs at this time_

## Support and contact details

_Please e-mail Philip Putnam, at staplehead989@gmail.com for support with the webpage_

## Technologies Used

_HTML_
_CSS_
_PHP_
_Bootstrap_
_Atom_
_Git_
_GitHub_
_MySQL_
_Apache_

### License

*This webpage is licensed under the MIT license*

Copyright (c) 2017 **_Philip Putnam_**
