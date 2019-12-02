#Setup
php 7.2 and PHPUnit 7.5.17

#Task

Imagine you have a bike and a driving license. You also found a job board with a list of companies offering a job. 
To get the job, you need to fulfill some requirements. There are 10.000 companies on the job board, 10 examples are as follows:

"Company A" requires an apartment or house, and property insurance.
"Company B" requires 5 door car or 4 door car, and a driver's license and car insurance.
"Company C" requires a social security number and a work permit. 
"Company D" requires an apartment or a flat or a house.
"Company E" requires a driver's license and a 2 door car or a 3 door car or a 4 door car or a 5 door car.
"Company F" requires a scooter or a bike, or a motorcycle and a driver's license and motorcycle insurance.
"Company G" requires a massage qualification certificate and a liability insurance.
"Company H" requires a storage place or a garage.
"Company J" doesn't require anything, you can come and start working immediately.
"Company K" requires a PayPal account.

Your task is to write code that will calculate for which companies you can work and for which you can't. 
You can convert the statements like "Company J requires PayPal account" to whatever form or structure you need. 

Use PHP.

# Solution explanation

to run the program run:
    
    php app.php relative_path/to/person_qualifications.txt relative_path/to/job_board.txt
  
for example: 
    
    php app.php data/raw/person_qualifications.txt data/raw/job_board.txt

Person qualifications file should contain just one sentence. You can find the example in data/raw/person_qualifications.txt. 
Job board should contain companies - one row per company job advertisement. You can find the example in data/raw/job_board.txt.

Since one of the task requirements was to use PHP I've decided to use raw PHP with help of few .txt and .php config files
to help with data storage. Although data pre processing isn't necessary I did it to be able to visualise raw data in the task
before solving it and I've decided to keep it to show some regex manipulations and enable 'user' to enter plain text. 
Although, plain text is a slippery slope since it requires a lot of validation of input in more complex scenarios.
I have also decided to create a QualificationsFactory.php. Although object it creates are simple and very similar or essentially 
the same it would be useful in real world with more specific requirements for job qualifications. 

Some known job categories are stored in enums/ which could easily be replaced with data coming directly from database. If
task was to use SQL too, I'd do some matching of criteria directly in SQL since it's better equipped for set intersections 
and data manipulations.  

This solution is in a form of PHP console command for easier use since you can just run it with PHP installed on the machine
and you don't have to setup any additional dependencies. To run tests you'll also need PHPUnit.

To see how program is used look at tests/JobSearchTest.php. If you run program from terminal you can also look at matching 
requirements output. It appears in data/results.txt also.