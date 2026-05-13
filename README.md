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

| Column | Type | 
|---|---|
| id | INT, Primary Key, Auto Increment |
| username | VARCHAR(50) |
| email | VARCHAR(100) | 
| password | VARCHAR(255) | 
| created_at | TIMESTAMP | 

### scores table

| Column | Type | Description |
|---|---|---|
| id | INT, Primary Key, Auto Increment | 
| user_id | INT | 
| score | INT | 
| total_questions | INT | 
| percentage | DOUBLE/FLOAT | 
| created_at | TIMESTAMP |




