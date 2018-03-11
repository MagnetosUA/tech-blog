<?php

require __DIR__.'/vendor/autoload.php';

$client = new \GuzzleHttp\Client([
    'base_uri' => 'http://localhost:8000',
    'defaults' => [
        'exceptions' => false
    ]
]);


$title = 'Post my one';
$article = 'The post is true';
$categories = 'Category1';
$tags = 'Tag1';
$users = 'AlexVSU';
$linkToImage = 'httpkkk';

$data = [
    'title' => $title,
    'article' => $article,
    'categories' => $categories,
    'tags' => $tags,
    'users' => $users,
    'linkToImage' => $linkToImage,
];
//$data = [
//    'name' => 'alexss',
//    'password' => '123',
//    'plainPassword' => '123',
//    'email' => 'magnetos111.ua@gmail.com',
//    'role' => 'USER',
//];

$response = $client->post('/api/posts', [
    'body' => json_encode($data)
]);
echo $response;
echo "\n\n";die;
$title = 'Title';
//$response = $client->get('/api/posts/'.$title);
$response = $client->get('/api/posts');
//$response = $client->get($postUrl);



echo $response->getStatusCode();
echo $response->getBody();
echo "\n\n";
