-- DROP TABLE IF EXISTS Part_Repair;
-- DROP TABLE IF EXISTS Repair_Job;
-- DROP TABLE IF EXISTS Repair;
-- DROP TABLE IF EXISTS Job;
-- DROP TABLE IF EXISTS Estimate;
-- DROP TABLE IF EXISTS Mechanic;
-- DROP TABLE IF EXISTS Automobile;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    admin TINYINT(1) NOT NULL,
    username VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
);

DROP TABLE IF EXISTS products;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image_url VARCHAR(255),
    price DECIMAL(10, 2),
    category VARCHAR(100),
    subcategory VARCHAR(100),
    description TEXT
);

CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    user_id INT UNSIGNED NOT NULL, 
    transaction_id VARCHAR(50) UNIQUE, 
    order_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    FOREIGN KEY (user_id) REFERENCES users(id) 
);

CREATE TABLE IF NOT EXISTS order_line_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,  
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id), 
    FOREIGN KEY (product_id) REFERENCES products(id)  
);



-- INSERT INTO users VALUES (1, 1, cole, crvaughn04@gmail.com, password_hash("password", PASSWORD_BCRYPT));

-- CREATE TABLE Automobile (
-- car_ID INT , 
-- customer_ID INT , 
-- make VARCHAR(20) ,
-- model VARCHAR(20) , 
-- manufacture_year INT(4),
-- PRIMARY KEY (car_ID),
-- FOREIGN KEY (customer_ID) REFERENCES Customer(customer_ID)
-- );

-- CREATE TABLE Mechanic (
-- mechanic_ID INT , 
-- mechanic_name VARCHAR(40) ,
-- rate INT , 
-- PRIMARY KEY (mechanic_ID)
-- );

-- CREATE TABLE Estimate (
-- estimate_ID INT , 
-- mechanic_ID INT , 
-- car_ID INT , 
-- est_cost INT , 
-- estimate_date DATE, 
-- PRIMARY KEY (estimate_ID),
-- FOREIGN KEY (mechanic_ID) REFERENCES Mechanic(mechanic_ID),
-- FOREIGN KEY (car_ID) REFERENCES Automobile(car_ID)
-- );

-- CREATE TABLE Job (
-- job_ID INT , 
-- car_ID INT , 
-- mechanic_ID INT , 
-- estimate_ID INT , 
-- job_date DATE, 
-- date_completed DATE,
-- PRIMARY KEY (job_ID),
-- FOREIGN KEY (car_ID) REFERENCES Automobile(car_ID),
-- FOREIGN KEY (mechanic_ID) REFERENCES Mechanic(mechanic_ID),
-- FOREIGN KEY (estimate_ID) REFERENCES Estimate(estimate_ID)
-- );

-- CREATE TABLE Repair (
-- repair_ID INT , 
-- repair_description VARCHAR(100),
-- time_required INT , 
-- cost INT , 
-- PRIMARY KEY (repair_ID)
-- );

-- CREATE TABLE Repair_Job (
-- repair_ID INT , 
-- job_ID INT , 
-- PRIMARY KEY (repair_ID),
-- -- PRIMARY KEY (job_ID),
-- FOREIGN KEY (repair_ID) REFERENCES Repair(repair_ID),
-- FOREIGN KEY (job_ID) REFERENCES Job(job_ID)
-- );

-- CREATE TABLE Part_Repair (
-- part_ID INT , 
-- repair_ID INT , 
-- PRIMARY KEY (part_ID),
-- -- PRIMARY KEY (repair_ID),
-- FOREIGN KEY (repair_ID) REFERENCES Repair(repair_ID)
-- );


-- Inserting dummy data --
-- INSERT INTO user (uid, email, hashPass) VALUES 
-- (1, test@test.com, test);
-- INSERT INTO Customer (customer_ID, fName, lName, addr, phone) VALUES 
-- (NULL, 'Morgan', 'Milletary', '555 NotMain St', 1234567890);


-- INSERT INTO Automobile (car_ID, customer_ID, make, model, manufacture_year) VALUES 
-- (1, 1, 'Toyota', 'Camry', 2015);

-- INSERT INTO Mechanic (mechanic_ID, mechanic_name, rate) VALUES 
-- (1, 'Joe Mechanic', 50);

-- INSERT INTO Estimate (estimate_ID, mechanic_ID, car_ID, est_cost, estimate_date) VALUES 
-- (1, 1, 1, 1000, '2024-03-14');

-- INSERT INTO Repair (repair_ID, repair_description, time_required, cost) VALUES 
-- (1, 'Replace Spark Plugs', 2, 50);

-- INSERT INTO Job (job_ID, car_ID, mechanic_ID, estimate_ID, job_date, date_completed) VALUES 
-- (1, 1, 1, 1, '2024-03-14', '2024-03-15');

-- INSERT INTO Repair_Job (repair_ID, job_ID) VALUES 
-- (1, 1);

-- INSERT INTO Part_Repair (part_ID, repair_ID) VALUES 
-- (1, 1);
	


