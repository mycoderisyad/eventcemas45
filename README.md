
# EventCemas45

Tech stack
- PHP (Laravel)
- Blade templating
- Bootstrap 5 (Mantis template)
- SQLite (development)

Bootstrap template source
- Template used: Mantis Dashboard
- Source: https://mantisdashboard.com/

Demo credentials
- Admin
	- Email: admin@eventcemas.com
	- Password: admin123
- User
	- Email: user@eventcemas.com
	- Password: user123

```powershell
php artisan migrate
php artisan db:seed --class=DemoUserSeeder
php artisan serve
```

## Screenshots

Profile dropdown (admin):

![Admin profile dropdown](screenshots/SS1.png)

Profile dropdown (user):

![User profile dropdown](screenshots/SS2.png)
