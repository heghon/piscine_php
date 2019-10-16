#!/usr/bin/php
<?php
    echo implode(array_filter(explode(' ', trim($argv[1]))), " ") . "\n";
?>