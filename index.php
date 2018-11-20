<?php

session_start();

// load monoplane
require_once('./monoplane/monoplane.php');

// run app
$cockpit->run();
