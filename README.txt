Laravel version - 7.30.4
php - 7.2.31

How to setup the project

Step 1 : Clone project
1. Clone the project from following link.
	https://github.com/chitsuwai/Assignment
	
Step 2 : Create a database
1. Open schema folder.
2. Open schema.sql and copy the line.
3. Run the query in mysql to create a database.


Step 3 : Create .env file
1. Copy .env.example and paste in current directory.
2. Change the file name to .env. 
3. Change DB_DATABASE;DB_USERNAME;DB_PASSWORD


Step 4 : Run the following command in command line
1. Open command line and go to project folder.
2. Run 'composer install'
3. Run 'php artisan key:generate'
4. Run 'php artisan migrate'
5. Run 'php artisan serve' and generate a link.
6. Run the link on browser
