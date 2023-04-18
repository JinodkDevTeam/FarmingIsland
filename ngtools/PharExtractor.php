<?php
declare(strict_types=1);

$phar_directory = "virions/libasynql_dev-199.phar";
$destination = "virions/libasynql_dev-199";

$phar = new Phar($phar_directory);
$phar->extractTo($destination);