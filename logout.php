<?php
session_start();
session_unset("user");
session_unset("token");
header("Location: index.php");
