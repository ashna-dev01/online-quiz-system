# Online Quiz Competition and Performance Evaluation System

A web-based quiz application built using PHP and MySQL. It allows users to register, log in, take quizzes from different categories, and view their scores. Administrators can manage quiz categories and questions through the admin section.

## Features

- **User Registration and Login:** Users can create accounts and log in to access the quiz system.
- **Admin Management:** Admins can manage quiz content.
- **Quiz Categories:** Questions are organised into different categories.
- **Question Management:** Add and manage questions with four answer options and the correct answer.
- **CSV Question Import:** Import quiz questions using CSV files.
- **Online Quizzes:** Users can select a category and attend quizzes.
- **Automatic Evaluation:** Submitted answers are evaluated automatically and scores are calculated.
- **Multiple Attempts:** The system maintains separate records for different quiz attempts.
- **Performance Tracking:** Quiz scores and attempt details are stored for review.

## Technologies Used

| Technology | Purpose |
|---|---|
| PHP | Backend development |
| MySQL | Database management |
| HTML5 | Page structure |
| CSS3 | Styling |
| Bootstrap 5.3.8 | Responsive user interface |
| JavaScript | Client-side functionality |
| XAMPP | Local development server |
| phpMyAdmin | Database management |

## Database Structure

**Database name:** `online_quiz_system`

The database contains five tables:

- `users` – Stores user details and login information.
- `categories` – Stores quiz categories.
- `questions` – Stores questions, answer options and correct answers.
- `quiz_attempts` – Stores quiz attempt details and scores.
- `answers` – Stores answers submitted for individual questions.

## Installation and Setup

1. Install [XAMPP](https://www.apachefriends.org/) on your computer.
2. Clone or download this repository.
3. Place the actual project folder (the inner `online-quiz-system` folder) inside XAMPP's `htdocs` directory.
4. Start Apache and MySQL from the XAMPP Control Panel.
5. Open phpMyAdmin in your browser.
6. Create a database named `online_quiz_system`.
7. Import the provided `online_quiz_system.sql` file.
8. Check the database connection settings in `config/database.php`.
9. Open the project in your browser:

   `http://localhost/online-quiz-system/`

## Project Purpose

This project was developed as part of the B.Sc. Computer Science academic curriculum. It provided practical experience in building a database-driven web application using PHP and MySQL, including user management, quiz administration, answer evaluation and result storage.

## Future Enhancements

- Timer-based quizzes
- Leaderboards and rankings
- Detailed performance analytics
- Email notifications
- Enhanced reporting features

  ## Project Credits

This project was developed as part of a B.Sc. Computer Science group academic project. I independently handled the development and implementation of the application, including the frontend, backend and database integration.


## Screenshots

## Screenshots

### Home Page
![Home Page](screenshots/home-page.png)

### Participant Dashboard
![Participant Dashboard](screenshots/participant-dashboard.png)

![Participant Dashboard 2](screenshots/participant-dashboard-2.png)

### Admin Dashboard
![Admin Dashboard](screenshots/admin-dashboard.png)

![Admin Dashboard 2](screenshots/admin-dashboard-2.png)

### Leaderboard
![Leaderboard](screenshots/leaderboard.png)


## Developed By

B.Sc. Computer Science – Academic Group Project
