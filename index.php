<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PLTS-Monitoring</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container">
        <?php include('./components/header.php'); ?>
        <main>
            <?php
            // Get the page parameter, default to 'home'
            $page = isset($_GET['page']) ? $_GET['page'] : 'home';

            // Sanitize the input to prevent security issues
            $allowedPages = ['home', 'curve', 'detail', 'event'];
            if (in_array($page, $allowedPages)) {
                include('./screens/' . $page . '/' . $page . '.php');
            } else {
                echo '<h1>Page Not Found</h1>';
            }
            ?>
        </main>
        <?php include('./components/footer.php'); ?>
    </div>
    <!-- <script src="js/script.js"></script> -->
</body>

</html>