# **SportsPro Technical Support**

## Overview

The **SportsPro Technical Support** suite comprises two main applications:

1. **Product Management**: Allows administrative users to manage products related to sports management software. Users can view, add, or delete products via a simple web interface.

2. **Manage Technicians**: Enables administrative users to oversee technician details within the SportsPro Technical Support system. Admins can add, view, and delete technician records through a user-friendly web interface.

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Operations](#operations)
  - [Product Management](#product-management)
    - [Product List Page](#product-list-page)
    - [Add Product Page](#add-product-page)
  - [Manage Technicians](#manage-technicians)
    - [Technician List Page](#technician-list-page)
    - [Add Technician Page](#add-technician-page)
- [Validation](#validation)
- [Usage](#usage)
- [Key Changes](#key-changes)
- [Additional Information](#additional-information)
- [Contact](#contact)

## Features

### Product Management

- **View Products**: Display a comprehensive list of all products with details including product code, name, version, and release date.
- **Add Products**: Facilitate the addition of new products through a straightforward form interface.
- **Delete Products**: Empower users to remove products directly from the product list.

### Manage Technicians

- **View Technicians**: List all technicians along with their details such as first name, last name, email, phone, and securely hashed passwords.
- **Add Technicians**: Provide a form to input new technician details into the system with enhanced validation and password security.
- **Delete Technicians**: Allow for the removal of technician records from the database.

## Operations

### Product Management

#### Product List Page

- **Delete Button**: Clicking this will remove the selected product from the database.
- **Add Product Link**: Redirects to the `Add Product` page where new products can be added.
- **Home Link**: Returns the user to the main menu.

#### Add Product Page

- **Add Product Button**: Adds a new product to the database and displays the updated Product List page.
- **View Product List Link**: Returns to the Product List page.

### Manage Technicians

#### Technician List Page

- **Delete Button**: Removes the specified technician from the database.
- **Add Technician Link**: Directs to the `Add Technician` page for entering new technician data.

#### Add Technician Page

- **Add Technician Button**: Submits the new technician data to the database and refreshes the technician list.
- **View Technician List Link**: Returns to the Technician List page.
- **Password Security**: Passwords entered through this form are now securely hashed before being stored, ensuring no plain-text passwords are saved in the system.

## Validation

### Product Management

- **Form Validation**: Ensures that all required fields (product code, name, version, and release date) are entered on the `Add Product` page. An error page is displayed if any required fields are missing.

### Manage Technicians

- **Form Validation**: Ensures that all fields in the `Add Technician` form are filled out. If any required fields are missing, an error page is displayed indicating the omission.
- **Password Requirements**: Passwords must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character. If these criteria are not met, an error message is shown.

## Usage

### Product Management

1. **View Products**:
   - Navigate to the Product List page to view all products.
   - Use the **Delete Button** next to a product to remove it from the database.
   - Click on the **Add Product Link** to navigate to the form for adding new products.

2. **Add Products**:
   - Fill out the form with the required product details.
   - Submit the form using the **Add Product Button** to add the product to the database.
   - After submission, you'll be redirected to the updated Product List page.

### Manage Technicians

1. **View Technicians**:
   - Navigate to the Technician List page to view all technicians.
   - Use the **Delete Button** next to a technician to remove their record from the database.
   - Click on the **Add Technician Link** to navigate to the form for adding new technicians.

2. **Add Technicians**:
   - Fill out the form with the required technician details, ensuring that the password meets the specified criteria.
   - Submit the form using the **Add Technician Button** to add the technician to the database.
   - After submission, you'll be redirected to the Technician List page with the new technician included.

## Key Changes

### Manage Technicians

- **Password Hashing**:
  - Technician passwords are now securely hashed using `password_hash()` before being stored in the database.
  - This enhancement ensures that plain-text passwords are never stored, significantly improving security.

- **Improved Validation**:
  - Introduced both client-side and server-side validation for passwords.
  - Passwords must now meet strict criteria: a minimum of 8 characters, including uppercase letters, lowercase letters, numbers, and special characters.
  - This ensures that all technician accounts are secured with strong passwords.

- **Error Handling**:
  - Enhanced error logging for easier debugging and maintenance.
  - User-friendly error messages guide administrators when input does not meet validation criteria or when unexpected errors occur.

- **Session Security**:
  - Regenerated session IDs after sensitive operations to prevent session fixation attacks.
  - Ensured that session variables are properly managed and cleared when no longer needed.

## Additional Information

- **Technologies Used**:
  - **Backend**: PHP (with Object-Oriented Programming principles)
  - **Database**: MySQL (accessed via PDO)
  - **Frontend**: HTML, CSS

- **Security Considerations**:
  - **Password Security**: All passwords are hashed using `password_hash()` before storage.
  - **Input Sanitization**: All user inputs are sanitized and validated to prevent SQL injection and other security vulnerabilities.
  - **Access Control**: Role-Based Access Control (RBAC) ensures that only authorized users (e.g., admins) can perform sensitive operations like adding or deleting records.
  - **Error Logging**: Detailed error logs are maintained for debugging while generic error messages are shown to users to prevent information leakage.

## Contact

- **Project Maintainer**: Ryan Mota
- **Email**: [ryan.mota@triosstudent.com](mailto:ryan.mota@triosstudent.com)
- **GitHub**: [xGentuso](https://github.com/xGentuso)

---

**Note**: This application is part of a project exercise from "SportsPro Technical Support"
