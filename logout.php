<?php
session_start();
session_unset();
session_destroy();
header(header: "index.php"); // redirect to the homepage or login page

