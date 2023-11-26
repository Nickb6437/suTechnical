# Task SUSU Interview Technical

- Part 1: HTML & CSS

  Create a simple webpage that includes: A contact form with the following fields: 
    - First Name
    - Last Name
    - Email Address  
    - Message 
  - Style the page using CSS to make it visually appealing.

- Part 2: PHP

  Write a PHP script that does the following:
    - Accepts user input through the form.
    - Validates the input to ensure it’s a valid email address.
    - Establish a MySQL connection using PDO
    - If the email is valid, store all inputted data in the database. 
    - Create a new table for messages.

- Part 3: SQL

  Write an SQL query in PDO that retrieves all users from the database schema that we’ve sent you. 
    - Order records bytimestamp in descending order.
    - For each user, use JOIN to list all orders from the “orders” table, display the order ID, date, amount and status.

	---
  
## Dependencies 
Concurrently: 8.2

Tailwindcss: 3.3


## Setup 
copy config.example.php in the root directory and rename to config.php.

Set your DB credentials in config.php then run
`npm install`

To sevre and watch css concurrently
`npm run dev`

To serve the site locally run 
`npm run serve`

To wtach only css 
`npm run watch:css`

To build only css
`npm run build:css`
