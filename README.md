# Ellipsis
## Ellipsis Scientific Paper Drafting Utility
### Software Automation for Optimizing Scientific Paper Writing

What is it?
-----------

The Ellipsis utility is a portable markup system
enabling rapid drafting of medium quality scientific papers
in preparation for final drafting for publication.

It uses the "xenofile principle",
enabling the mixing of many diverse software languages in one marked up file
to achieve a resulting draft scientific paper
that would otherwise require consolidating results from separate files.

The Latest Version
------------------

This software is a work in progress.
It is not bulletproof since it is the first version.
However, it actually works as can be see in the PDF file in the
examples/VisualPhotons/ directory.

Dependencies
------------

Version 0.0.1 of Ellipsis is in early development and is known
to work with specific versions of PHP and other utilities.
The user is asked to give feedback on what other versions work or don't work.
These dependencies only affect output if they are used.

```
PHP 5.4.30
Zend Engine v2.4.0
gnuplot 4.6 patchlevel 5
graphviz 2.38.0
MathJAX 2.5
jquery 2.1.3
```

Downloading
-----------

```
$ git clone https://github.com/jlettvin/Ellipsis.git
```

Installation
------------

Ellipsis is delivered ready-to-use from github.
When the archive is cloned in its own directory
and dependencies are satisfied,
the user may immediately make use of it without further 
configuration or installation.

Documentation
-------------

The documentation is still a work in progress.
The full documentation is available by going to the Ellipsis directory
and executing:
```
$ php -S localhost:8001 -t .
$ open -a Firefox http://localhost:8001
```

To review an example paper:
```
$ cd Ellipsis/example/VisualPhotons
$ php -S localhost:8000 -t .
$ open -a Firefox http://localhost:8000
```

Load one of the markup files into your favorite editor
to see what the markup looks like.
For instance, the file
```
Ellipsis/example/VisualPhotons/Introduction/Introduction...
```
Has a great deal of content and examples of markup usage.
These include equations, figures, gnuplot, graphviz, listings,
bullet lists, tables.

Additional features include:
* automated numbering and labelling of objects
* referencing of labelled objects
* literature referencing
* paragraph indentation
* reminders (like inline post-it notes)
* documentation immediately next to the material where it is needed
* comments
* boxes to surround text
* line breaks including a type to break below images, tables, etc...
* making resources automatically by running external programs
* some debugging ability

On a MacIntosh, the following two commands shows the builtin documentation.
```
$ cd Ellipsis
$ mkdir $USER; cd $USER; mkdir $yourpaper; cd $yourpaper
$ php -S localhost:8000 -t .
$ open -a Firefox http://localhost:8000
```

Use your choice of browser to review if you prefer other than firefox.
Use your choice of editor to create and modify files.

The development cycle generally is two steps:
1. edit one of the markup files
2. refresh the browser

For now, sections of your paper require a directory named for the section
and a file of the same name with an extension of "..." to provide content
in the directory for which it is named.
If a directory is to be served by the builtin PHP server
it must have an index.php and
it should have a ...ellipsis.png file and
it may have a favicon.ico file.

Each section of your paper (directory name) must appear in
the Ellipsis file "..." in the parent directory.
For instance, the file "..." typically contains:
```
Head
Introduction
Methods
Results
Discussion
Acknowledgments
Literature
Appendices
```

Executing "find ." on a directory containing a paper may appear as follows:
```
$ find .
.
./...
./...ellipsis.png
./Acknowledgments
./Acknowledgments/Acknowledgments...
./Appendices
./Appendices/Appendices...
./Discussion
./Discussion/Discussion...
./favicon.ico
./Head
./Head/Head...
./index.php
./Introduction
./Introduction/Introduction...
./Literature
./Literature/Literature...
./Methods
./Methods/Methods..
./Methods/Methods...
./Missing
./Missing/Missing...
./Results
./Results/Results...
```

Syntax
------

Ellipsis uses "service" modules to integrate multiple languages.
Fragments of code in these languages are executed in their native applications
as a service using a specialized "backtick" language.

### Structure of the backtick unit
`` `{servicename}.{uniqueidentifier}|{displaylabel}|{code fragment}` ``

#### Example
`` `equation.euler|The Euler Identity|e^{i\pi}+1=0` ``

This backtick enclosed unit names the "equation" function,
identifies the equation for later reference as "euler",
labels the displayed equation with "equation 1: The Euler Identity",
and submits the TeX language fragment to MathJAX for conversion to
an image of the equation
which is displayed in a scientific paper typical form.

### References
To refer to the equation in a text portion of the paper use:<br/>
`` `equation.euler` ``

Note that forward and backward references work without special effort.

### Reminders
To remind yourself of a paper preparation task,
or literally any reminder you may wish to make,
a pink colored sticky-note feature is available when you use
a question mark followed by text within the backtick unit:<br/>
`` `section?Remember to refer to that article about continental drift.` ``

### Inline documentation
To get further documentation about the equation service
a blue colored sticky-note feature can be shown temporarily
directly within the displayed output.
This sticky note formats the comments at the head of the service source file
to enable authors to have the relevant documentation at their fingertips
without searching or trying to remember where it is.  Just use:<br/>
`` `equation?` ``

### Default service parameters
If a service unit has default values associated with its use,
these may be displayed inline within the text,
much like reminders and documentation, by using:<br/>
`` `equation` ``

Development
-----------

The software comprises a suite of PHP modules prefixed with "...".
This has the effect of making the source invisible to standard
directory listings, and also makes it easy for modules to be
identified and loaded into an executing suite.

Bug Reporting
-------------

Send email to jlettvin@gmail.com.

Git Access
----------

```
$ git clone https://github.com/jlettvin/Ellipsis.git
```

Ports
-----

Licensing
---------

All files in this suite are 
    Copyright(c) 2015 Jonathan D. Lettvin, All Rights Reserved.
All files are offered under the Gnu General License 3.0
and attribution must be made to Jonathan D. Lettvin
for derivative works, modifications, or re-use of code in other works
and other locations where this code appear or get used.

-------------------------------------------------------------------------------
Copyright(c) 2015 Jonathan D. Lettvin, All Rights Reserved.

http://stackoverflow.com/questions/2304863/how-to-write-a-good-readme


