# Lifetracker

This project is a simple PHP application based on Jquery Mobile to let me track my six life goals on a daily basis with a 1 to 10 scale. It also captures my current location and lets me add tags to any one day.

The init_db.php script builds the data model into a local SQLite database. The index.php file displays the Jquery Mobile form. The insert.php script acts as the controller, sending the form's data to the SQLite database and generating a local "lifedata.csv" file for use in Excel with every insert.

The script is meant to track one entry per day. When more than one entry is entered, it replaces the older one of that same day.

There's no way within the script to modify or add older records. Consider using a script such as phpliteadmin to let you modify the database should you need.

Currently the script uses remote versions of Jquery, Jquery Mobile, and Moment.js. You can use local versions if you prefer.

This script also has no built in authentication. The intent is that only you know the URL where you host the script.

If you have any questions or comments, please send an email to mike@mikeshea.net.