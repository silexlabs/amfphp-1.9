<?php
// $Id$

header('Content-Type: text/plain; charset=utf-8');

try {

    /**
     * This is an array of all "pending" directories to search.
     * Recursive searching works using a stack of "jobs" rather than
     * by recursion.
     */

    $aisDirectory = array();
    $aisDirectory[] = dirname(__FILE__);

    /**
     * This is a list of absolute filenames. Each item is a test to run.
     * Once sorted alphabetically, the tests will be run in that order.
     */

    $aisTest = array();

    while (($sDirectory = array_pop($aisDirectory)) !== NULL) {
        echo 'Scanning "' . $sDirectory . '"...' . "\n";

        if (($rDirectory = @opendir($sDirectory)) === FALSE) {
            continue;
        }

        while (($sItem = readdir($rDirectory)) !== FALSE) {

            // Ignore hidden files like ".", "..", ".svn", etc.

            if ($sItem[0] === '.') {
                continue;
            }

            $sItemDirectory = $sDirectory . DIRECTORY_SEPARATOR . $sItem;

            // There should be no escape from the directory,
            // so symbolic links are not allowed.

            if (is_link($sItemDirectory)) {
                continue;
            }

            if (is_dir($sItemDirectory)) {
                $aisDirectory[] = $sItemDirectory;
            }
            else
            if (is_file($sItemDirectory)) {
                if (preg_match('/^Test\-.+\.php$/DuX', $sItem) === 1) {
                    $aisTest[] = $sItemDirectory;
                }
            }
        }

        closedir($rDirectory);
    }

    // Sort the list of tests so that the order does not
    // depend on the filesystem.

    sort($aisTest); // do not mind if it doesn't work

    foreach ($aisTest as $sTest) {
        echo 'Running "' . $sTest . '"...' . "\n";
        include_once $sTest;
    }
}
catch (Exception $e) {
    echo 'Uncaught exception during program execution!' . "\n";
    echo '"' . $e->getMessage() . '"' . "\n";
    exit(1);
}
?>