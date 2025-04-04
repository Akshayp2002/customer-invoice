Project README
Overview
This project includes a login system for admin users and a simple admin portal with two main sections: Customer and Invoice. Admins can manage customers and invoices through a user-friendly interface.

Requirements
Login Page

Fields for Username and Password.

Authentication based on database entries for admin users.

Redirect to admin portal upon successful login.

Admin Portal

Navigation for Customer and Invoice sections.

Modules
Customer Management
List Page: Display all customers.

Create Page: Add a new customer (Name, Phone, Email, Address).

Edit Page: Modify existing customer details.

Invoice Management
List Page: Display all invoices.

Create Page: Add a new invoice (Customer, Date, Amount, Status).

Edit Page: Modify existing invoice details.

Service Methods
getCustomer(): Fetch all customers.

handleCustomer(Request $request): Handle customer creation/update.

getInvoice(): Fetch all invoices.

handleInvoice(Request $request): Handle invoice creation/update.

Setup
Clone the repository.

Run composer install to install dependencies.

Set up your database and configure .env file.

Migrate the database using php artisan migrate --seed.

    'name'           => 'Admin One',
    'email'          => 'admin1@gmail.com',
    'password'       => 'password',

    'name'           => 'Admin Two',
    'email'          => 'admin2@gmail.com',
    'password'       => 'password',

Once logged in, use the navigation bar to manage Customers and Invoices.