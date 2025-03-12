<!DOCTYPE html>
<html>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Dev Web Camp <?= $title ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="/build/css/app.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AfnW-lCvcFQEC1rLu1AJ3khODZYfRfwDKGYIZ_ZKHxSL3spx69_YCCgPtXJuYqT1BQyuEwBEhRs_HYGh" data-sdk-integration-source="button-factory"></script>
    <link rel="shortcut icon" href="/build/img/favicon.webp" type="image/webp">
</head>

<body style="overflow-x: hidden;">
    <?php include_once __DIR__ . "/templates/header.php" ?>
    <?= $content ?>
    <?php include_once __DIR__ . "/templates/footer.php" ?>
    <?= $script ?? "" ?>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            anchorPlacement: 'top-bottom'
        });
    </script>
    <script src="/build/js/main.min.js"></script>
</body>

</html>