<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Blog rico em conteúdo, puxando notícias de feeds RSS e APIs.">
    <title>Blog de Conteúdo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }
        header {
            background-color: #004080;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .section {
            margin-bottom: 40px;
        }
        .section h2 {
            color: #004080;
        }
        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .news-item {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .news-item:hover {
            transform: scale(1.05);
        }
        .news-item img {
            width: 100%;
            height: auto;
            display: block;
        }
        .news-item-content {
            padding: 15px;
        }
        .news-item a {
            text-decoration: none;
            color: #004080;
            font-weight: bold;
            font-size: 18px;
            display: block;
            margin-bottom: 10px;
        }
        .news-item a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Blog de Conteúdo</h1>
    </header>

    <div class="content">
        <div class="section">
            <h2>Últimas Notícias (RSS Feed)</h2>
            <div class="news-grid">
                <?php include 'rss_feed.php'; ?>
            </div>
        </div>

        <div class="section">
            <h2>Artigos Recentes (API)</h2>
            <div class="news-grid">
                <?php include 'api_content.php'; ?>
            </div>
        </div>
    </div>
</body>
</html>
