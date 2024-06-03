<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Заметки</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link <?= $_SERVER['REQUEST_URI'] == '/index' ?: 'active'?>" href="/index">Главная</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $_SERVER['REQUEST_URI'] == '/create' ?: 'active'?>" href="/create">Создать заметку</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>
    <main class="p-5">
        <?= $content ?>
    </main>
    <footer>
        <style>
            .card-title span {
                font-size: 12px;
                vertical-align: middle;
            }

            .notes {
                display: grid;
                grid-template-columns: repeat(4, 250px);
                gap: 100px;
            }

        </style>
    </footer>
</body>
</html>