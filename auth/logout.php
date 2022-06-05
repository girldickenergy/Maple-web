<?php
    require_once "../backend/database/sessionsDatabase.php";
    TerminateCurrentSession();

    header('Location: https://maple.software/');
    die();
?>