<?php
session_start();
session_unset();
session_destroy();
header(header: "Location: index.php?logged_out=true"); // redirect to the homepage or login page