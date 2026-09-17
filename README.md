# Knight's Tour

School project developed using PHP and MySQL.

The goal is to move the knight across an 8x8 chessboard using the standard L-shaped chess moves, while avoiding visiting the same position more than once.

## Technologies Used

- PHP
- MySQL
- HTML
- CSS
- PHP Sessions

## Features

- 8x8 chessboard
- Initial knight position at [0,0]
- Calculation of valid moves
- Storage of previously visited positions
- Prevention of revisiting already used squares
- Game reset functionality

## Setup

1. Import `database.sql` into MySQL.

2. Copy `config.example.php` and rename it to `config.php`.

3. Add your MySQL credentials inside `config.php`.

4. Start the project using PHP:

   `php -S localhost:8000`

5. Open the following address in your browser:

   `http://localhost:8000`

## Notes

This project was originally developed as a school project and was later restored and fixed to make it compatible with modern versions of PHP and MySQL.