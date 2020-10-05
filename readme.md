<h3>Hello!</h3>

This is the project described in:

/docs/Software Engineer (PHP) - Engineering Assessment .pdf

I spent something close to 4-5 hours on it. You can try it on any server that supports PHP, Composer and command line interface.

<h3>Setting up the project:</h3>

You'll need to download it and run "composer dump-autoload" to generate autoloader functions. After that the project is ready to go.

I decided to put input file to the /input folder. Converted file will appear in /output folder. 
A line "output_" will be aded to original file name.
So, for example, if your source file was called "example.csv", then target file will be "output_example.csv".

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

<h3>Note:</h3>

I didn't have time to finish the logic of rows conversion, so right now it basically copies input file content 
to the output file. As you stated in the documentation, the focus of this task was on code structure, cleanliness, scalability,
readability, documentation, OOP and knowledge/application of general programming principles - so I tried to build decent app structure
first and work on conversion logic later. 

According to my plan, conversion of rows should be made in /src/parsers/CsvParser::convertRows() function. I've placed a TODO comment there,
so you'll easily find it.

I hope this readme was useful and readable :). Looking forward to your opinion on all this.