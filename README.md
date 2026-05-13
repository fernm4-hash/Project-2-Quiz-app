# Project 2: Quiz App

## Project Introduction

## Features
- User signup/login
- Randomized quiz questions
- User gets to pick question amount
- shows past quiz attempts
- Profile statistics
- Leaderboard
- Results review


## Running the Project

- This project was developed using XAMPP with Apache and MySQL

## Database Tables

## Database Schema

### users table

| Column | Type | Description |
|---|---|---|
| id | INT, Primary Key, Auto Increment | Unique user ID |
| username | VARCHAR(50) | User's username |
| email | VARCHAR(100) | User's email address |
| password | VARCHAR(255) | Hashed password |
| created_at | TIMESTAMP | Date account was created |

### scores table

| Column | Type | Description |
|---|---|---|
| id | INT, Primary Key, Auto Increment | Unique score ID |
| user_id | INT | ID of the user who took the quiz |
| score | INT | Number of questions answered correctly |
| total_questions | INT | Number of questions in the quiz |
| percentage | DOUBLE/FLOAT | Score percentage |
| created_at | TIMESTAMP | Date the quiz was taken |




