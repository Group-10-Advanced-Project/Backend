# Enterprise Resource Planning

## Project Description

A lot of companies tend to grow quickly without having the proper infrastructure to do so. To make up for that, they go for several third party applications that they have no control over and have to use several of or, and its becoming very common, they make their own all inclusive software to manage all their business needs in one centralized application.

## Expected Solution Description

An ERP system is required. For the sake of simplicity we will only be handling a small part of the HR process now as an admin. An admin can't sign up, but is added by one of the existing admins.

Every admin should be able to track several aspects of the HR process.
He/She should be able to:
1. Create and manage employees and their profiles (Web App).
2. Create and manage admins (Web App)
3. Create and manage teams. (Web App)
4. Create and manage projects. (Web App)
5. Assign employees to teams. (Web App)
6. Assign teams to projects. (Web App)
7. Create KPIs for every employee. (Web App)
8. Evaluate employee KPIs. (Web and Mobile App)
9. Generate Reports (Web and Mobile Apps)

## Employees
- Every employee must have a profile.
- An admin can go over a list of employees that can be filtered by team and project and select any employee profile to be viewed and edited.
- An employee should have a unique id that must be automatically generated, first name, last name, email, phone number, picture. Any thing else you like to add would be fine.
- An employee must be assigned to only one team.
- Employees can't sign in. Only admins can.

## Teams and Projects
- A team can have several projects.
- Every employee must have a role in the project (chosen from a predefined list)
- Several teams can work on the same project.

## KPIs
- Think of the KPIs as skills and milestones the employee must learn and improve in for the sake of getting promotions and staying in the company.
- Every employee may have several KPIs.
- Several employees may have a KPI with the same name, however this KPI must be unique. Example: if employee X has KPI "Project Management", it is not the same as employee Y's "Project Management" KPI. They should have separate entries.
- Every employee must have a certain evaluation for every KPI. You can choose the type of evaluation yourself. It can be 1 to 10, or A,B,C... or whatever you want. Make sure you state what the evaluation system you choose is.
- The admin must be able to evaluate the KPIs of each employee from the mobile app as well as the web.
- You must keep track of every KPI change along with its date. (You must not lose the old data).


## Reports
- Through the mobile app, the admin can generate employee reports.
- There are three kinds of reports:
  1. Employee project report: Shows all the projects the employee took part in and their role in it.
  2. Employee KPI reports:
    - Overall KPI list with current values.
    - Individual KPI change over time with graph.

<hr>

## Rules and Restrictions
- You can't delete a project while it has teams related to it.
- You can't delete a team while it has employees assigned to it.
- Employees can only be assigned to one team but team can be assigned to several projects.
- All the business rules and requirements are very important and should be amended (unless otherwise stated or communicated).
- There are no restrictions on the user interface and design, it just needs to be user friendly and intuitive.
- The candidate should not be using packages or libraries that achieves / solves a key requirement of the solution (Like managing KPIs).

<hr>

## Evaluation Criteria
The evaluation criteria are divided into 2 main parts:
1. Overall project completion :
  - All the business rules and requirements should be achieved and met.
  - The solution should have the functional work flow as described in the expected solution.
  - The solution should be working properly and provided the expected results.
2. The code is to be examined to check for the good programming practices, including but not limited to :
  - Performance optimization,
  - Secure coding,
  - OOP (Object-oriented programming).
  - Re-usability and maintainability.
