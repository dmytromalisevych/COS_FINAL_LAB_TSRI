# QR Code Generator

This is a simple QR Code Generator web application built with PHP. It allows users to generate QR codes from entered text or URLs. The application uses a flexible, modular structure and adheres to several software design principles to ensure maintainability, scalability, and clarity.

## Features
- **QR Code Generation**: Users can input any text or URL, and the program will generate a corresponding QR code.
- **Customizable QR Code Size**: Users can choose between three predefined sizes: Small (500x500), Medium (750x750), and Large (1000x1000).
- **File Download**: The generated QR code can be downloaded as a PNG file.

## Design Principles Applied
The code is designed following **8 key software design principles** to enhance readability, maintainability, and scalability:

1. **SOLID** Principles (Single Responsibility, Open/Closed, Liskov Substitution, Interface Segregation, Dependency Inversion)
    - **Single Responsibility Principle**: Each class has a single responsibility (e.g., generating QR codes, handling form data, and storing files).
    - **Open/Closed Principle**: Classes are open for extension but closed for modification. New functionality can be added by creating new classes, without modifying existing ones.
    - **Liskov Substitution Principle**: Derived classes can be substituted with base classes without affecting the system's correctness.
    - **Interface Segregation Principle**: Interfaces are designed to be specific and minimal, ensuring they are not forced to include methods that are not needed.
    - **Dependency Inversion Principle**: Dependencies are injected into classes through constructors rather than being created inside the classes.

2. **KISS** (Keep It Simple, Stupid): The code is simple, clear, and easy to understand. Unnecessary complexity is avoided.

3. **DRY** (Don’t Repeat Yourself): Code is reused where necessary, reducing redundancy.

4. **Separation of Concerns**: The code is split into different classes, each handling one aspect of the application (QR code generation, storage, and form handling).

5. **Encapsulation**: Implementation details (like how QR codes are generated and saved) are hidden from the user and other parts of the system.

6. **Favor Composition Over Inheritance**: The application is built using composition (combining simple components) instead of deep inheritance hierarchies.

7. **Validation and Error Handling**: Form data is validated, and the application handles invalid input gracefully, providing clear feedback to the user.

8. **Scalability and Maintainability**: The modular structure makes it easy to extend and maintain the application. Each class is independent and easy to test.

## Technologies Used
- **PHP**: The backend language used to handle the logic for QR code generation and user interaction.
- **QRcode Library**: [phpqrcode](https://github.com/t0k4rt/phpqrcode) library is used for generating QR codes. It provides an easy way to generate high-quality QR codes from strings.
- **HTML & CSS**: The frontend uses simple HTML and CSS for layout and styling.

## Project Structure

    Generators-QR.code/ .
    ├── assets/
    │ ├── css/ 
    │ │ └── style.css # Styles for the web page 
    │ ├── phpqrcode/ # QR code generation library 
    │ └── qrcodes/ # Folder to store generated QR codes 
    ├── src/ 
    │ ├── QRCodeGenerator.php # Class for generating QR codes 
    │ ├── QRCodeStorage.php # Class for storing QR codes 
    │ └── QRCodeFormHandler.php # Class for form validation and handling 
    ├── index.php # Main entry point 
    └── config.php # Configuration file (e.g., QR code directory path)

## Setup and Installation

1. Clone the repository:
   ```bash
   https://git.ztu.edu.ua/ipz/2023-2027/ipz-23-4/tsimbalyuck-ruslan/constructr_os/lab6_tsri.git
2. Install dependencies (if applicable, such as Composer for autoloading):
    ```bash
   composer install 
   ```
3. Ensure that the assets/qrcodes/ directory exists and is writable by the web server:
    ```bash
   mkdir -p assets/qrcodes
    chmod 777 assets/qrcodes
    ```
4. Open the index.php file in a web browser using your PHP server or OpenServer.
5. Fill out the form to generate QR codes.

## Acknowledgments
- Author's library `phpqrcode` **t0k4rt**, for the QR code generation library.

### Main moments (for lazy readers):
- Описує саму програму і її можливості.
- Перелічує застосовані принципи проєктування.
- Вказує на використані технології та бібліотеки.
- Включає інструкції для налаштування та запуску проєкту.



