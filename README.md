# Rock, Paper, Scissors

#### This application is based on Kohana, because i'm very familiar in the usage.
You can find my code in the following directories:
- PHP `modules/micro`
- Javascript `assets/js/micro.js`
- CSS `assets/css/micro.css`
- SQL (You have to import the install.sql) `sql_import/install.sql`

Also please make sure, that you've changed the database configuration in: `modules/database/config/database.php`

The `Rock Paper Scissors` game logic can be found in `modules/micro/classes/RPS`. Everything else about HTTP / AJAX Request Handling, Session, Templateing can be found in `modules/micro/classes/Helper` and the `Micro "Core"` in `module/micro/classes/Kohana/Micro.php`. All models for the application can be found in `application/classes/Model`. The views in `application/views` (based on HTML, CSS, jQuery, Smarty, Bootstrap, jGrowl).
In the project directory you can find a very small database administration tool `(adminer.php)`, just in the case you won't use HeidiSQL / MySQL Workbench.