# MyBizna ERP - Subscription Management System 

## Overview
The Subscription Management System is a software application designed to facilitate the management and administration of a university or educational institution. This system provides a hierarchical structure for organizing the various components of the university, including subscription levels, faculties, schools, departments, programs, courses, class years, and students. It also incorporates the concept of qualifications for tracking academic achievements.

## System Structure
The Subscription Management System follows a hierarchical structure for organizing the components of the university. The structure is as follows:

 - **Subscription:** The top-level entity representing the university. It encompasses all the faculties, schools, departments, programs, courses, and students within the university.

 - **Faculty:** Represents the major divisions within the university, such as the Faculty of Arts, Faculty of Science, Faculty of Engineering, etc. Faculties consist of various schools.

 - **School:** Refers to the intermediate units within a faculty, such as the School of Computer Science, School of Business, School of Medicine, etc. Schools consist of different departments.

 - **Department:** Represents the specific departments within a school, such as the Department of Computer Science, Department of Economics, Department of Biology, etc. Departments are responsible for offering programs.

 - **Program:** Refers to the academic programs offered by a department, such as Bachelor of Science in Computer Science, Master of Business Administration, Bachelor of Arts in English Literature, etc. Programs consist of multiple courses.

 - **Courses:** Represents the individual courses offered as part of a program. Examples include Introduction to Programming, Financial Accounting, Organic Chemistry, etc. Courses are offered in different class years.

 - **ClassYear:** Represents the specific class years within a program, such as the first year, second year, third year, etc. Each class year consists of enrolled students.

 - **Student:** Represents the individual students enrolled in a class year. Each student has a set of qualifications representing their academic achievements.

 - **Qualification:** Refers to the academic qualifications achieved by a student, such as diplomas, degrees, certificates, etc. Qualifications are associated with specific programs and indicate the student's completion of specific requirements.
  ```
    Subscription
       |
    Faculty
       |
    School
       |
    Department         Qualification
       |                    |
       ------ Program ------
                |
       ---------------------- 
       |                    |
    Learner              Courses
       |                    |
       ---------------------- 
                |
            ClassYear    
                                          

## Functionality
The Subscription Management System provides the following functionality:

 - **Hierarchy Management:** Enables the creation, modification, and deletion of subscription levels, faculties, schools, departments, programs, courses, class years, students, and qualifications.

 - **Enrollment:** Allows for the enrollment of students in specific class years and programs.

 - **Course Management:** Facilitates the creation, modification, and deletion of courses within programs.

 - **Qualification Tracking:** Enables the tracking of qualifications earned by students and their association with specific programs.

 - **Reporting:** Provides various reports and statistics on student enrollment, program completion, course offerings, etc.

 ## Requirements
Mybizna ERP version 1.0 or above

## Support
If you have any questions or need assistance, please contact our support team. We're always happy to help!

## Contributing
If you're interested in contributing to this project, please reach out to the team. We welcome pull requests and bug reports.

## License
This project is licensed under the GPL-3.0-or-later.

           
    
