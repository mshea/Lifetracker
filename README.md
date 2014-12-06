# Lifetracker

Lifetracker is a PHP web-based application using Jquery Mobile to track goals, habits, and any key-value pairs that defines our lives.

The PHP application contains two pages: index.php which handles the input from a mobile device and controller.php which takes the input from the index.php page, saves the data to a sqlite3 database, and exports a CSV called "lifedata.csv".

The "tags" text area can store words, phrases, or key value pairs. Each tag set is split by a comma. Each of the categories has default tags you can click on. When you click on them, they are automatically added to the textarea. You should customize these tags to fit the activities you perform often enough to track.

You can also store key value pairs in the tags textarea by entering something like "Steps:13405" to tie a number to an activity or "Read:15" to track the minutes you've read that day. A "Thinking About:" tag can give you a microjournal to record your main thoughts each day. 

All of the data is saved to a csv file called "lifedata.csv" with three columns: datetime, key, and value. If no value is given, the value is 1. This file lets you perform a pivot sort in Excel so you can see all the times something was tagged or count the total sum of values for a given key.

The flexibility of the data schema makes it easy to write new forms to track specific things all of which send the same key value pairs to the back-end database and csv export. You can find an example with the sleep.php form that tracks whether you've slept well or poorly. The only required element is datetime.

There's no way within the script to modify or add older records. I've included phpliteadmin.php to modify the database.

Currently Lifetracker uses remote versions of Jquery, Jquery Mobile, and Moment.js. You can use local versions if you prefer.

Lifetracker also has no built in authentication. The intent is that only you know the URL where you host the script.

There is also two R scripts that generate svg visualizations from the lifedata.csv file. These displays are based on the works of Edward Tufte from the Visual Display of Quantitative Information. This R script is based on the default output of this app and will require a fair bit of tweaking if you change the six primary goals.

## Installation

You'll need to be able to host PHP applications on your webserver to run this app. You will also need to be proficient in both PHP and Javascript to modify this program to fit your needs. It's not really written to support a lot of different users, I wrote it strictly for myself but wanted to share it as well.

Assuming you can do that, follow the steps below:

1. Copy all the files to a web-accessible URL that executes PHP.
2. Run "init_db.php" from your browser.
3. Contemplate the goals you want to score. The defaults are "Create", "Relax", "Love", "Befriend", "Health", and "Happiness". You will have to edit these in the index.php file.
4. Change your default tags in the index.php script. You only need to change the name of the tag. Jquery takes care of the rest.

If you have any questions or comments, please send an email to mike@mikeshea.net.