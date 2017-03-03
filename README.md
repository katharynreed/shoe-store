# _A Whole Lot of Sole_

#### _A site to search for shoes and brands, 03/03/17_

#### By _**Katharyn Reed**_

## Description

_A Whole Lot of Sole is a web application built with Php and MySQL that a user to choose between a retailer or a brand manager and manage which retailers are attached to which shoe brands._

##Database Setup Commands
_In either terminal or phpMyadmin enter the following commands:_
* _CREATE DATABASE shoes_
* _USE shoes_
* _CREATE TABLE brands (name VARCHAR (255), id serial PRIMARY KEY)_
* _CREATE TABLE stores (name VARCHAR (255), id serial PRIMARY KEY)_
* _CREATE TABLE brands_stores (brand_id INT, store_id INT, id serial PRIMARY KEY)_
* _Navigate to localhost:8888/phpmyadmin and click on shoes, then operations, then copy the database to a new database named shoes_test;_

## Setup/Installation Requirements

* _Clone this repository to your device_
* _Start MAMP or other combination of Apache server and MySQL, and make sure the port is set to localhost:8889_
* _Install composer in the project folder_
* _Navigate to the web folder and start a development server at localhost:8000_
* _Navigate to localhost:8000 in your preferred web browser_

## Known Bugs

_No known issues_

## Support and contact details

_Please contact repository administrator for questions, support, or suggestions_

## Technologies Used

* _PHP_
* _Twig_
* _Silex_
* _MySQL_
* _Composer_
* _phpUnit_
* _Bootstrap/CSS_

### License

*This software is licensed under the MIT license*

*Copyright (c) 2017 Katharyn Reed_*
