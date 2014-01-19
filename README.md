# Lifetracker

This project is a simple PHP application based on Jquery Mobile to let me track my six life goals on a daily basis with a 1 to 10 scale. It also captures my current location and lets me add tags to any one day.

The init_db.php script builds the data model into a local SQLite database. The index.php file displays the Jquery Mobile form. The insert.php script acts as the controller, sending the form's data to the SQLite database and generating a local "lifedata.csv" file for use in Excel with every insert.

The "tags" text area can store individual words split by spaces similar to Twitter hash tags. Each of the categories has default tags you can click on. When you click on them, they are automatically added to the textarea. You should customize these tags to fit the activities you perform often enough to track.

You can also store key / value pairs in the tags textarea by entering something like "steps:13405" to tie a number to an activity or something like "read:15" to track the minutes you've read that day. These key value pairs are dumped out on every submit into a file called "tags.csv". All tags are saved to this csv file. If no value is given, the default value is "1". This file lets you perform a pivot sort in Excel so you can see all the times something was tagged or count the total sum of values for a given key.

The script is meant to track one entry per day. When more than one entry is entered, it replaces the older one of that same day.

There's no way within the script to modify or add older records. Consider using a script such as phpliteadmin to let you modify the database should you need.

Currently the script uses remote versions of Jquery, Jquery Mobile, and Moment.js. You can use local versions if you prefer.

This script also has no built in authentication. The intent is that only you know the URL where you host the script.

## Installation

You'll need to be able to host PHP applications on your webserver to run this app. You will also need to be proficient in both PHP and Javascript to modify this program to fit your needs. It's not really written to support a lot of different users, I wrote it strictly for myself but wanted to share it as well.

Assuming you can do that, follow the steps below:

1. Copy all the files to a web-accessible URL that executes PHP.
2. Contemplate the goals you want to score. The defaults are "Create", "Relax", "Love", "Befriend", "Health", and "Happiness". You will have to edit these in init_db.php, index.php, and insert.php.
3. Change your default tags in the index.php script. You only need to change the name of the tag. Jquery takes care of the rest.

If you have any questions or comments, please send an email to mike@mikeshea.net.