<?php
$api_key = 'YOUR_PIXABAY_API_KEY45698409-e2c49fabf72aba5f28045a907'; // Substitua com sua chave API da Pixabay
$api_url = 'https://pixabay.com/api/?key=' . $api_key . '&q=nature&image_type=photo&per_page=10';
$ch = curl_init($api_url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Erro na requisição: ' . curl_error($ch);
    curl_close($ch);
    exit;
}

curl_close($ch);

$data = json_decode($response, true);

if ($data && isset($data['hits'])) {
    foreach ($data['hits'] as $image) {
        echo '<div class="news-item">';
        if (isset($image['webformatURL']) && !empty($image['webformatURL'])) {
            echo '<img src="' . $image['webformatURL'] . '" alt="' . $image['tags'] . '">';
            echo '<p>URL da Imagem: ' . $image['webformatURL'] . '</p>'; // Exibe a URL para debug
        } else {
            echo '<img src="https://via.placeholder.com/300x200.png?text=Imagem+Indisponível" alt="Imagem Padrão">';
        }
        echo '<div class="news-item-content">';
        echo '<a href="' . $image['pageURL'] . '">' . $image['tags'] . '</a>'; // Usando tags como título
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p>Não foi possível carregar os artigos da API. Resposta da API:</p>';
    echo '<pre>';
    print_r($data); // Exibe os dados retornados para debugging
    echo '</pre>';
}
?>
