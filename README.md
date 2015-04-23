# Ellipsis
## Scientific Paper Drafting Utility
### Software Automation for Optimizing Scientific Paper Writing

What is it?
-----------

Writing scientific papers is difficult because the tools are cumbersome.
Configuring a variety of programs and libraries
and making them cooperate to yield a paper in final form
takes substantial time and skill.

The purpose of Ellipsis is to reduce the time and skill burden on the author,
and make drafting the paper into a simple rapid development process,
much as software engineers often develop for their own convenience.

The Ellipsis utility is a portable markdown system
enabling rapid drafting of medium quality scientific papers
in preparation for final drafting before publication.

It uses the "xenofile principle",
enabling the mixing of many diverse software languages in one markdown file
to achieve a resulting draft scientific paper
that would otherwise require consolidating results from separate files.

In other words, gnuplot syntax, graphviz syntax, TeX syntax
and a variety of others may all be used in the same markdown
and used to drive their native programs to generate objects
required for display by the draft.

Each xenofile external language is supported by a "service" module
which implements a convenient low-syntax shim to that language.
New service modules are fairly simple to write and
support for additional external languages can be accomplished
in minutes to hours.

Both the service modules and base set of Ellipsis services
occupy modules with a special comment syntax wherein
documentation is supposed to reside for display at run-time on need.
Builtin documentation, sticky-note reminders, and other conveniences
are quick at hand using the simple backtick unit syntax.
See below for details on the backtick syntax.

Here is a link to an
[incomplete draft PDF](https://github.com/jlettvin/Ellipsis/blob/master/example/VisualPhotons/VisualPhotons.pdf)
written entirely using Ellipsis in less than a day.

Here is a snippet of markdown to illustrate figures and literature references:
```
In fact, color perception is independent of wavelength
`reference.LettvinColorsOfThings`.
The scientific labelling for RGB in retinal photoreceptor absorption
is LMS for Long, Medium, and Short.
However, since photography and displays use RGB,
they will be used interchangeably.

`figure.2points|<br />2 white points|
{width="128" height="128"}
hyperacuity0.original.png`
`figure.2onretina|<br />Retinal image with a 1mm pupil|
{width="128" height="128"}
hyperacuity1.saturate.png`
___The retinal image of two white RGB point sources
incident on the human retina after traversing a 1mm pupil
appears as an inchoate blur incapable of being resolved
by Rayleigh criterion, Sparrow limit, or even
traditional use of Fourier transform coupled with Nyquist sampling.
```

Here is another example snippet showing a xenofile use of gnuplot:
```
`gnuplot.Airy|Airy(x,y)|
{width="256" height="256"}
radius(a,x,y)=pi*sqrt((a*x)**2+(a*y)**2);
wave(a,x,y)=2*besj1(radius(a,x,y))/(radius(a,x,y));
Airy(a,x,y)=wave(a,x,y)**2;
cubeAiry(a,x)=10*Airy(a,x,0)*(a*x)**3;
set xrange[-4.22:4.22]; set yrange[-4.22:4.22]; set zrange[0:1];
set isosamples 101,101; set pm3d at b; splot Airy(1,x,y);
`
```

Objects may also be generated on-the-fly using the
"make" service module.
It is used in the sample paper to generate the
photoreceptor mosaic images.

The Latest Version
------------------

This software is a work in progress.
It is not bulletproof since it is the first version.
However, it actually works as can be see in the PDF file in the
examples/VisualPhotons/ directory.

Requirements
------------

Ellipsis must occupy a parent directory from the paper you wish to draft.
It need not be an immediate parent, but it must be in the chain of parents.

PHP of recent vintage is required due to the use of modern syntactic sugar
such as [] instead of array().
Ellipsis was begun on PHP version 5.4.30.
This was updated to 5.4.38 recently, but this probably works with 5.3.

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

Load one of the markdown files into your favorite editor
to see what the markdown looks like.
For instance, the file
```
Ellipsis/example/VisualPhotons/Introduction/Introduction...
```
Has a great deal of content and examples of markdown usage.
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
1. edit one of the markdown files
2. refresh the browser

For now, sections of your paper require a directory named for the section
and a file of the same name with an extension of "..." to provide content
in the directory for which it is named.
If a directory is to be served by the builtin PHP server
it must have an index.php and
it should have a ...ellipsis.png file and
it may have a favicon.ico file.

Each section of your paper (directory name) must appear in
the Ellipsis file "...Content" in the parent directory.
For instance, the file "...Content" typically contains:
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
./...Content
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
as a service using a specialized "backtick" markup.

### Structure of the backtick unit
* `` `{servicename}.{uniqueidentifier}|{displaylabel}|{code fragment}` ``
* `` `$service.$id|$label|$code` ``  # PHP nomenclature

The code fragment may also, in some cases, be prefixed by
HTML attributes to modify positioning of the object in the form:
```
{attribute = "value", attribute = "value"}
```

#### Example
`` `equation.euler|The Euler Identity|e^{i\pi}+1=0` ``

This backtick enclosed unit names the "equation" service,
identifies the equation for later reference as "euler",
labels the displayed equation with text resembling
"equation 1: The Euler Identity",
and submits the TeX language fragment to MathJAX for conversion to
an image of the equation
which is displayed in a form typical of scientific papers.

### References
Most services generate a visual object in the body of a draft paper.
These objects are identified both by type and by a sequence number
within the type, much as they are in scientific papers.
Figure<sup>1</sup> will appear both with the object itself
and at every reference made to it using the syntax described here.
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
This sticky note formats
special comments at the head of the service source file
that have been specially commented with three slashes instead of two.
Authors have the relevant documentation at their fingertips
without searching or trying to remember where it is.  Just use:<br/>
`` `equation?` ``

A special form is available to output a complete review of
modules and documentation.<br/>
`` `symboltable` ``

### Default service parameters
If a service unit has default values associated with its use,
these may be displayed inline within the text,
in a gray colored sticky-note.
much like reminders and documentation, by using:<br/>
`` `equation` ``

### Sticky-notes are conveniences
There is no impact on content other than making temporary space
for a sticky note within the draft paper.
Removing the sticky-note markdown eliminates the note.

### Available modules
These will change (mostly increase) as development continues.

|    $service        | function                                             |
| -------------------| -----------------------------------------------------|
|    \`bulleted\`    | makes a bullet list                                  |
|    \`box\`         | draws a single line box around its $code             |
|    \`comment\`     | makes an undisplayed annotation in the source        |
|    \`dirtree\`     | makes a list of files in the paper's directory tree  |
|    \`equation\`    | uses MathJAX to generate a math display              |
|    \`figure\`      | displays an image (jpeg, gif, png, and more...)      |
|    \`gnuplot\`     | makes a plot                                         |
|    \`graphviz\`    | makes a graph                                        |
|    \`listing\`     | shows source code from a file                        |
|    \`make\`        | runs an external program (shell)                     |
|    \`reference\`   | makes a reference to literature                      |
|    \`table\`       | makes a table                                        |
|    \`timestamp\`   | makes a timestamp                                    |

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
```
Copyright(c) 2015 Jonathan D. Lettvin, All Rights Reserved.
```
All files are offered under the Gnu General License 3.0
and attribution must be made to Jonathan D. Lettvin
at least for derivative works, modifications, or re-use of code in other works
and other locations where this code appear or get used.

-------------------------------------------------------------------------------
Copyright(c) 2015 Jonathan D. Lettvin, All Rights Reserved.

http://stackoverflow.com/questions/2304863/how-to-write-a-good-readme


