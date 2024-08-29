<?php
$feed_url = 'http://feeds.bbci.co.uk/news/rss.xml'; // URL do feed RSS do site de origem
$xml = simplexml_load_file($feed_url);

$pixabay_api_key = '45698409-e2c49fabf72aba5f28045a907'; // Sua chave API da Pixabay
$pixabay_base_url = 'https://pixabay.com/api/?key=' . $pixabay_api_key . '&image_type=photo&per_page=3&q=';

if ($xml) {
    foreach ($xml->channel->item as $item) {
        echo '<div class="news-item">';

        // Tentar extrair a imagem do campo media:content
        $namespaces = $item->getNamespaces(true);
        $media = $item->children($namespaces['media']);

        if ($media && isset($media->content)) {
            $image_url = (string) $media->content->attributes()->url;
            echo '<img src="' . $image_url . '" alt="Imagem da Notícia">';
        } else {
            // Se não houver imagem no RSS, tentar buscar uma imagem relacionada no Pixabay
            $query = urlencode((string)$item->title); // Usar o título da notícia como termo de busca
            $pixabay_url = $pixabay_base_url . $query;

            $ch = curl_init($pixabay_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                echo 'Erro CURL: ' . curl_error($ch);
            }

            curl_close($ch);

            $pixabay_data = json_decode($response, true);

            if ($pixabay_data && isset($pixabay_data['hits'][0]['webformatURL'])) {
                $pixabay_image_url = $pixabay_data['hits'][0]['webformatURL'];
                echo '<img src="' . $pixabay_image_url . '" alt="Imagem da Notícia">';
            } else {
                // Fallback: Se não encontrar nenhuma imagem relacionada, exibir imagem padrão
                echo '<img src="https://via.placeholder.com/300x200.png?text=Imagem+Indisponível" alt="Imagem Padrão">';
            }
        }

        echo '<div class="news-item-content">';
        echo '<a href="' . $item->link . '">' . $item->title . '</a>';
        echo '<p>' . $item->description . '</p>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p>Não foi possível carregar as notícias do RSS.</p>';
}
?>
