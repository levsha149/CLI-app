<h3>Hello!</h3>

This is the project described in:

/docs/Software Engineer (PHP) - Engineering Assessment .pdf

I spent something close to 4-5 hours on it. You can try it on any server that supports PHP, Composer and command line interface.

* * *

<h3>Setting up the project:</h3>

First, you'll need to run "composer dump-autoload" to generate autoloader functions. After that the project is ready to go.

I decided to put input file to the /input folder. Converted file will appear in /output folder. 
A line "output_" will be aded to original file name.
So, for example, if your source file was called "example.csv", then target file will be "output_example.csv".

* * *

<h3>Command description:</h3>

The sample command that performs file conversion is <b>php converter csv file=example.csv</b>, where:

- <b>php converter</b> - entry point.

- <b>csv</b> - command name. I split each command logic to separate controllers - you'll find CsvController responsible 
for "csv" command processing in /src/controllers folder. New commands and controllers can be added in file 
"/src/bootstrap.php", see description of syntax in commentaires there.

- <b>file=example.csv</b> - required parameter, specifies a source file name. Without it script won't work. 
I made this parameter required for a case when you have several different files in /input folder.

The script will show appropriate red warning messages if you'll type something wrong 
(or a green success message if conversion was successfull).

You can also use <b>php converter help</b> to see command signature.

* * *

<h3>Project structure:</h3>

I tried to follow basic namespace and OOP logic. Main "src" folder contains next folders:

- <b>components</b> - contains main application components.

- <b>controllers</b> - each controller connects certain command with certain Parser (business logic). If you'll need another command for, let's say, PDF conversion,
PDF controller should be extended from BaseController class.

- <b>helpers</b> - auxillary logic, such as printing different stuff in CLI (Printer class) and registration of new 
commands and controllers (Registrator class). New printer and registrator classes can be extended from these basic classes, if need be.

- <b>parsers</b> - parsers for different file types, they contain the conversion logic. Think of them as equivalent to Models in MVC paradigm. Each new
file type will require new parser, extended from BaseParser class.

- <b>bootstrap.php</b> file - here you can register new commands either as controllers or anonymous functions. See comments there.

- <b>transitions</b> - here we store arrays of rules, by which data of each input file type will be converted.
Each of those rules (or transitions) is an anonymous function (or array of functions) that will be applied, for example,
to each CSV cell value (depending on that value type - string, numeric, date, etc.). Each array is stored in PHP file named by
certain file extension - csv.php for CSV files, xls.php for Excel files and so on.

* * *

<h3>Notes:</h3>

I chose the simpliest variant of transitions storing, because I tried to finish job in 4 hours. I hope I understood your 
task well in this regard. Also I skipped unit testing for the same reason - not enough time.

I did not loaded it to any public repository (as you asked in documentation), but added gitignore files for demonstration purposes. 

* * *

I hope all this was useful and readable, or at least you had fun reading this :D.
 
 Looking forward to your opinion.