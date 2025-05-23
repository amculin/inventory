<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Light grey background */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Full viewport height */
            margin: 0;
        }
        .error-container {
            text-align: center;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 90%;
        }
        .error-icon {
            font-size: 8rem; /* Large icon size */
            color: #dc3545; /* Bootstrap danger color */
            margin-bottom: 20px;
        }
        .error-heading {
            font-size: 3rem;
            font-weight: bold;
            color: #343a40; /* Dark text */
            margin-bottom: 10px;
        }
        .error-subheading {
            font-size: 1.25rem;
            color: #6c757d; /* Muted text */
            margin-bottom: 30px;
        }
        .btn-home {
            background-color: #007bff; /* Bootstrap primary color */
            border-color: #007bff;
            color: #ffffff;
            padding: 10px 25px;
            font-size: 1.1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-home:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <?= $content; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
