<?php

// Start of PECL pthreads 3.1.6

/**
 * The default options for all Threads, causes pthreads to copy the environment
 * when new Threads are started
 * @link https://php.net/manual/en/pthreads.constants.php
 */
define('PTHREADS_INHERIT_ALL', 1118481);

/**
 * Do not inherit anything when new Threads are started
 * @link https://php.net/manual/en/pthreads.constants.php
 */
define('PTHREADS_INHERIT_NONE', 0);

/**
 * Inherit INI entries when new Threads are started
 * @link https://php.net/manual/en/pthreads.constants.php
 */
define('PTHREADS_INHERIT_INI', 1);

/**
 * Inherit user declared constants when new Threads are started
 * @link https://php.net/manual/en/pthreads.constants.php
 */
define('PTHREADS_INHERIT_CONSTANTS', 16);

/**
 * Inherit user declared classes when new Threads are started
 * @link https://php.net/manual/en/pthreads.constants.php
 */
define('PTHREADS_INHERIT_CLASSES', 4096);

/**
 * Inherit user declared functions when new Threads are started
 * @link https://php.net/manual/en/pthreads.constants.php
 */
define('PTHREADS_INHERIT_FUNCTIONS', 256);

/**
 * Inherit included file information when new Threads are started
 * @link https://php.net/manual/en/pthreads.constants.php
 */
define('PTHREADS_INHERIT_INCLUDES', 65536);

/**
 * Inherit all comments when new Threads are started
 * @link https://php.net/manual/en/pthreads.constants.php
 */
define('PTHREADS_INHERIT_COMMENTS', 1048576);

/**
 * Allow new Threads to send headers to standard output (normally prohibited)
 * @link https://php.net/manual/en/pthreads.constants.php
 */
define('PTHREADS_ALLOW_HEADERS', 268435456);

