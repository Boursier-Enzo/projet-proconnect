<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>ProConnect</title>
        <link rel="stylesheet" href="assets/css/styles.css" />
        <link rel="stylesheet" href="assets/css/auth.css" />
        <link rel="stylesheet" href="assets/css/dashboard.css" />
        <link rel="stylesheet" href="assets/css/header.css" />
        <link rel="stylesheet" href="assets/css/footer.css" />
    </head>
    <body>

        <!-- Header -->
        <?php include "ui/header.php" ?>

        <!-- Auth -->
        <?php include "pages/auth.php" ?>

        <!-- Dashboard -->
        <?php include "pages/dashboard.php" ?>
        

        <!-- Footer -->
        <?php include "ui/footer.php" ?>

        <script src="assets/js/script.js"></script>
    </body>
</html>
