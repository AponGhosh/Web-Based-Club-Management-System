# Web-Based-Club-Management-System


## Project Overview

This web-based system is designed to streamline operations for the ULAB Computer Programming Club (UCPC), addressing challenges in member registration, event management, and communication. The platform provides a centralized solution for club executives, advisors, and members to interact efficiently.

## Key Features

- **Member Registration**: Simplified online registration process for club membership
- **Event Management**: 
  - Posting upcoming events with details (date, venue, description)
  - Showcasing past events with outcomes and photos
  - Online event registration for members
- **Admin Dashboard**: 
  - Manage member lists
  - Add/update/delete events
  - View event participation
- **User Accounts**: Secure login system for members and administrators
- **Information Hub**: 
  - Club mission and vision
  - Event calendar
  - Social media integration

## Used Technology

**Frontend:**
- HTML5, CSS3, JavaScript
  
**Backend:**
- PHP (server-side scripting)
- MySQL (database management)

**Development Tools:**
- Visual Studio Code (IDE)
- XAMPP (local server environment)
- phpMyAdmin (database management)
- Git/GitHub (version control)

## System Architecture

The system follows a Model-View-Controller (MVC) architecture with:

1. **Presentation Layer**: HTML/CSS/JavaScript for UI
2. **Application Layer**: PHP for business logic
3. **Data Layer**: MySQL for data storage

## Database Schema

The system uses five main tables:

1. **Admin**: `(Full Name, Email, Username, Password)`
2. **Member**: `(Full Name, Student ID, Email, Contact, Password)`
3. **Event Participant**: `(Full Name, Student ID, Email, Contact)`
4. **Recent Event**: `(RE_ID, Title, Date, Venue, Description)`
5. **Upcoming Event**: `(UE_ID, Title, Date, Venue, Description)`

## Diagrams
![ER-Diagram](https://github.com/AponGhosh/Web-Based-Club-Management-System/blob/main/ER-Diagram.png)
![UML-Class-Diagram](https://github.com/AponGhosh/Web-Based-Club-Management-System/blob/main/UML-Class-Diagram.png)

## Installation Guide

1. **Prerequisites**:
   - XAMPP server installed
   - PHP 7.0+ 
   - MySQL 5.7+

2. **Setup Instructions**:
   ```bash
   # Clone the repository
   git clone https://github.com/AponGhosh/Web-Based-Club-Management-System.git
   
   # Move the project folder to your XAMPP htdocs directory
   mv Web-Based-Club-Management-System /path/to/xampp/htdocs/
   
   # Import the database
   - Access phpMyAdmin
   - Create a new database named 'ulab_cpc'
   - Create tables with the mentioned attributes in the database/ directory
   
