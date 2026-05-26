<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="/assets/js/utils.js" defer></script>
    <link rel="stylesheet" href="/assets/css/global.css">
    <title>Document</title>
</head>

<body>

    <body>
        <?php require "../app/views/partials/navbar.view.php"; ?>

        <main>
            <?php require "../app/views/" . $content . ".view.php"; ?>

            <!-- obvestila -->
            <?php if (isset($_SESSION['napaka'])): ?>
                <script>
                    const napaka = <?= json_encode($_SESSION['napaka']) ?>;
                    console.log("napaka");
                </script>
                <?php unset($_SESSION['napaka']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['uspeh'])): ?>
                <script>
                    const uspeh = <?= json_encode($_SESSION['uspeh']) ?>;
                    console.log("uspeh");
                </script>
                <?php unset($_SESSION['uspeh']); ?>
            <?php endif; ?>
        </main>

    </body>
</body>

</html>