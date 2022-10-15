<?php
    require_once "../backend/localization/localizationHandler.php";

    if (isset($_GET["l"]))
        SetLanguage($_GET["l"]);

    header("Location: ".($_GET["r"] ?? "https://maple.software"));
?>