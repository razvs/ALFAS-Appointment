
CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    avatar VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    aboutme VARCHAR(255) NOT NULL,	
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    mobile_number INT(50) NOT NULL,
	isadmin TINYINT(2) NOT NULL,
	isactive TINYINT(2) DEFAULT '1',	
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE clients (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,	
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    mobile_number INT(50) NOT NULL,	
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE services (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    service_name VARCHAR(50) NOT NULL,
    service_desc VARCHAR(255) NOT NULL,
    service_img VARCHAR(255) NOT NULL,
    isactive TINYINT(2) NOT NULL	
);

CREATE TABLE services_duration (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    service_id INT NOT NULL,
    service_name VARCHAR(50) NOT NULL,
    duration INT(20) NOT NULL,	
    price INT(20) NOT NULL
);

CREATE TABLE users_services (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,	
    services_duration_id INT NOT NULL,
    service_id INT NOT NULL,	
	isactive TINYINT(2) DEFAULT '1'	
);

CREATE TABLE working_times (
  id int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  user_id int(10) UNSIGNED DEFAULT NULL,
  type enum('calendar','users') DEFAULT NULL,
  monday_from time DEFAULT NULL,
  monday_to time DEFAULT NULL,
  monday_lunch_from time DEFAULT NULL,
  monday_lunch_to time DEFAULT NULL,
  monday_dayoff enum('T','F') DEFAULT 'F',
  tuesday_from time DEFAULT NULL,
  tuesday_to time DEFAULT NULL,
  tuesday_lunch_from time DEFAULT NULL,
  tuesday_lunch_to time DEFAULT NULL,
  tuesday_dayoff enum('T','F') DEFAULT 'F',
  wednesday_from time DEFAULT NULL,
  wednesday_to time DEFAULT NULL,
  wednesday_lunch_from time DEFAULT NULL,
  wednesday_lunch_to time DEFAULT NULL,
  wednesday_dayoff enum('T','F') DEFAULT 'F',
  thursday_from time DEFAULT NULL,
  thursday_to time DEFAULT NULL,
  thursday_lunch_from time DEFAULT NULL,
  thursday_lunch_to time DEFAULT NULL,
  thursday_dayoff enum('T','F') DEFAULT 'F',
  friday_from time DEFAULT NULL,
  friday_to time DEFAULT NULL,
  friday_lunch_from time DEFAULT NULL,
  friday_lunch_to time DEFAULT NULL,
  friday_dayoff enum('T','F') DEFAULT 'F',
  saturday_from time DEFAULT NULL,
  saturday_to time DEFAULT NULL,
  saturday_lunch_from time DEFAULT NULL,
  saturday_lunch_to time DEFAULT NULL,
  saturday_dayoff enum('T','F') DEFAULT 'F',
  sunday_from time DEFAULT NULL,
  sunday_to time DEFAULT NULL,
  sunday_lunch_from time DEFAULT NULL,
  sunday_lunch_to time DEFAULT NULL,
  sunday_dayoff enum('T','F') DEFAULT 'F'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE appointments (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone_number INT(50) NOT NULL,
	post_code VARCHAR(50) NOT NULL,
	address VARCHAR(255) NOT NULL,
	selected_therapist VARCHAR(50) NOT NULL,
	selected_therapist_id VARCHAR(10) NOT NULL,	
	selected_service VARCHAR(50) NOT NULL,
	selected_duration INT(20) NOT NULL,
	selected_type VARCHAR(50) NOT NULL,
	selected_date DATE DEFAULT NULL,
	selected_time time DEFAULT NULL,
	message VARCHAR(255) NOT NULL,
	payby VARCHAR(50) NOT NULL,
	amount INT NOT NULL,
	status VARCHAR(50) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP	
);

CREATE TABLE settings (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    start_time INT NOT NULL,	
    end_time INT NOT NULL,	
    before_time INT NOT NULL,	
    after_time INT NOT NULL,
    timezone VARCHAR(255) NOT NULL,
    currency VARCHAR(255) NOT NULL,
	currency_symbol VARCHAR(255) NOT NULL
);

INSERT INTO settings 
    (id, start_time, end_time, before_time, after_time, timezone, currency, currency_symbol) 
VALUES 
    (1, 8, 22, 60, 60, "Europe/London", "USD", "$");