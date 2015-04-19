<?php
/// ...body.php
/// 
/// $dirs is a numbered list of named directories to walk.
/// $argv is a command-line arguments list, elements of the section identifier.
///
/// $argv is collected into a $prefix used to label $dir sections.
///
/// If a named directory is accompanied by a file of the same name
/// but suffixed with '...', then this is the main text of the section.
/// Contents of the directory are subsections to this main text.
/// Within the subsection, an existing index.php file is executed in
/// a recursed php session along with an enhanced $prefix.
///
function body($dirs, $argv) {
    /// If no directories are specified, return an empty string.
    if (!$dirs or !is_array($dirs)) return '';

    /// Generate $prefix for use with labelling listed content.
    $sep = DIRECTORY_SEPARATOR;
    $buf = '';
    $prefix = is_array($argv) ? implode('.', array_slice($argv, 1)) : '';
    if ($prefix) $prefix .= '.';

    /// Walk the list of directories, expressing section content.
    foreach ($dirs as $n => $dir) {
        $label = "{$prefix}{$n}";
        if ($n != 0) {
            /// Generate the section title.
            /// The title of the first section named in '...' is not shown.
            $buf .= '<br clear="all">'."<h2>{$label} {$dir}</h2>".PHP_EOL;
        }

        /// Express the section content from its ellipsis markup file.
        $filename = "{$dir}...";
        //$filename = "{$dir}{$sep}{$dir}...";
        if (is_dir($dir)) {
            $cwd = getcwd();
            chdir($dir);
            if (is_readable($filename)) {
                $buf .= interpret(
                    file_get_contents($filename),
                    $prefix
                    //.$n
                )
                ;
            }
            chdir($cwd);
        }

        /// Express subsections, extending the $prefix as needed.
        if (is_dir($dir)) {
            // Save cwd, change to specified, express, and restore cwd.
            $cwd = getcwd();
            chdir($dir);
            if (is_readable('index.php')) $buf .= `php index.php {$label}`;
            chdir($cwd);
        }
    }
    /// Express the entire result as an HTML division.
    return "<div>{$buf}</div>".PHP_EOL;
}
?>
