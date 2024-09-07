use canteen;
-- Create table menu
CREATE TABLE IF NOT EXISTS menu (
    item_name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    category VARCHAR(50) NOT NULL,
    Timing VARCHAR(20) NOT NULL,
    PRIMARY KEY (item_name)
);

-- Create table employee
CREATE TABLE IF NOT EXISTS employee (
    emp_id INT NOT NULL AUTO_INCREMENT,
    emp_name VARCHAR(100) NOT NULL,
    emp_age INT NOT NULL,
    emp_gender CHAR(1) NOT NULL,
    emp_address VARCHAR(255) NOT NULL,
    emp_contact VARCHAR(20) NOT NULL,
    emp_post VARCHAR(50) NOT NULL,
    PRIMARY KEY (emp_id)
);

-- Create table login
CREATE TABLE IF NOT EXISTS login (
    loginid INT NOT NULL AUTO_INCREMENT,
    Username VARCHAR(100) NOT NULL,
    passwordHash VARCHAR(255) NOT NULL,
    PRIMARY KEY (loginid),
    FOREIGN KEY (loginid) REFERENCES employee(emp_id)
);

-- Create table customer
CREATE TABLE IF NOT EXISTS customer (
    customer_number INT NOT NULL AUTO_INCREMENT,
    customer_name VARCHAR(255) NOT NULL,
    customer_order DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (customer_number)
);

-- Create table inventory
CREATE TABLE IF NOT EXISTS inventory (
    item VARCHAR(100) NOT NULL,
    quantity INT NOT NULL,
    `in stock` VARCHAR(10) NOT NULL,
    PRIMARY KEY (item)
);

-- Create table orders
CREATE TABLE IF NOT EXISTS orders (
    order_id INT NOT NULL AUTO_INCREMENT,
    item_name VARCHAR(100) NOT NULL,
    customer_name VARCHAR(255) NOT NULL,
    service_provider INT NOT NULL,
    PRIMARY KEY (order_id),
    FOREIGN KEY (item_name) REFERENCES menu(item_name),
FOREIGN KEY (service_provider) REFERENCES employee(emp_id)

);
