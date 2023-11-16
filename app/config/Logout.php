<?php

session_destroy();
unset($_SESSION);
setcookie(session_name(), '');
