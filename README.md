# Ellipsis
                Ellipsis Scientific Paper Drafting Utility

Software Automation for Optimizing Scientific Paper Writing

What is it?
-----------

The Ellipsis utility is a portable markup system
enabling rapid drafting of medium quality scientific papers
in preparation for final drafting for publication.

The Latest Version
------------------

Dependencies
------------

Version %VERSION% of Ellipsis is in early development and is known
to work with specific versions of PHP and other utilities.
The user is asked to give feedback on what other versions work or don't work.
These dependencies only affect output if they are used.

    - PHP 5.4.30
    - Zend Engine v2.4.0
    - gnuplot 4.6 patchlevel 5
    - graphviz 2.38.0
    - MathJAX 2.5
    - jquery 2.1.3

Downloading
-----------

Installation
------------

Ellipsis is delivered on github.
When the archive is cloned in its own directory
and dependencies are satisfied,
the user may immediately make use of it without further 
configuration or installation.

    cd Ellipsis
    tar xvzf Ellipsis.tgz
    mkdir {foryourpaper}
    # Still must make distribution tool
    cd {foryourpaper}
    php -S localhost:443 -t .
    open -a Firefox http://localhost:443

Documentation
-------------

On a MacIntosh, the following two commands shows the builtin documentation.

    php -S localhost:443 -t .
    open -a Firefox http://localhost:443

Development
-----------

Bug Reporting
-------------

Git Access
----------

Ports
-----

Licensing
---------

-------------------------------------------------------------------------------
Copyright(c) 2015 Jonathan D. Lettvin, All Rights Reserved.

http://stackoverflow.com/questions/2304863/how-to-write-a-good-readme


