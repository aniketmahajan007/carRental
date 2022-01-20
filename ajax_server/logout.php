<?php

/***************************************************************************
 *                 				LOGOUT Server 			                    *
 ****************************************************************************/
session_start();
unset($_SESSION['user']);
unset($_SESSION['name']);
unset($_SESSION['agent']);
session_destroy();
header('Location: ../index.php');
exit;
