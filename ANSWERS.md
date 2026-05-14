Scenario Answers
S1 - Overtime Claims Module

1. Database Tables:
-'overtime claims' - id, user_id, date, hours, reason, status (Pending/Approve/Rejected), timestamps
-'users' - user_id, first_name, last_name, email, role (staff/manager)

2. Backend Endpoints:
-'GET /overtime-claims' - list all claims
-'POST /overtime-claims' - submite a new claim
-'PATCH /overtime-claims/{id}' - approve or reject a claim

3. Frontend Pages
-Submit form (date, hours, reason)
-Claims list table with status badges
-Approve/Reject buttons visible to manager only

4. Permissions:
-Staff can only submit and view their own claims
-Managers can view all claims and update status
-Middleware protects the PATCH endpoint from staff access


S2 - Status still show pending

1. Check the controller's 'update()' method - confirm '$leaveRequest->save()' or 'update' is actually being called
2. Check the database directly - query the record to see if the status actually changed in the DB
3. Check the route - confirm the PATCH route is hitting the right controller method and the ID is being passed correctly
4. Check for caching - ensure the list view is fetching fresh data from the DB, not a cached result


S3 - Accidental .env commit
1. Immediately inform my supervisor/senior developer about the exposed key
2. Revoke the API key from the service provider — assume it is already compromised
3. Generate a new API key and update it in the .env file locally
4. Remove .env from Git history using git filter-branch or git filter-repo
5. Force push the cleaned history: git push --force
6. Add .env to .gitignore if it isn't already
7. Notify the team so everyone pulls the updated history
8. Check API logs for any unauthorised usage during the exposure window


About Me

1. Strongest in PHP/Laravel backend
2. I want to learn get deeper into software development such as learning react, node.js
3. Past Project - [EcoXP](https://github.com/VinceyLincey/Eco-XP) — A gamified web platform built with PHP, JavaScript and MySQL that encourages environmental conservation through challenges and a points reward system. The hardest part was building the admin analytics dashboard with real-time stats and making it fully responsive for mobile. I learned how to manage role-based access (participant/staff/admin/event manager), structure a multi-role system, and write cleaner SQL queries.
4. 12 Week Internship. Confirmed. Preferred start date: [20 July 2026]. University states - Internship period[20 Jul 2026 / 09 Oct 2026] Might consider extending