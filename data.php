<?php
$data = [
    [
        'id' => 1,
        'title' => 'Obra 1',
        'price' => '10000',
        'img' => 'assets\images\Imagen 1.jpg',
        'category' => 'Abstracta'
    ],
    [
        'id' => 2,
        'title' => 'Obra 2',
        'price' => '17000',
        'img' => 'assets\images\Imagen 2.jpg',
        'category' => 'Abstracta'
    ],
    [
        'id' => 3,
        'title' => 'Obra 3',
        'price' => '20000',
        'img' => 'assets\images\Imagen 3.jpg',
        'category' => 'Abstracta'
    ],
    [
        'id' => 4,
        'title' => 'Obra 1',
        'price' => '10000',
        'img' => 'assets\images\Imagen 4.jpg',
        'category' => 'Abstracta'
    ],
    [
        'id' => 5,
        'title' => 'Obra 2',
        'price' => '17000',
        'img' => 'assets\images\Imagen 5.jpg',
        'category' => 'Abstracta'
    ],
    [
        'id' => 6,
        'title' => 'Obra 3',
        'price' => '20000',
        'img' => 'assets\images\Imagen 6.jpg',
        'category' => 'Abstracta'
    ],
    [
        'id' => 7,
        'title' => 'Obra 1',
        'price' => '10000',
        'img' => 'assets\images\Imagen 7.jpg',
        'category' => 'Abstracta'
    ],
    [
        'id' => 8,
        'title' => 'Obra 2',
        'price' => '17000',
        'img' => 'assets\images\Imagen 8.jpg',
        'category' => 'Abstracta'
    ],
    [
        'id' => 9,
        'title' => 'Obra 3',
        'price' => '20000',
        'img' => 'assets\images\Imagen 9.jpg',
        'category' => 'Abstracta'
    ],
    [
        'id' => 10,
        'title' => 'Obra 1',
        'price' => '10000',
        'img' => 'assets\images\Imagen 10.jpg',
        'category' => 'Abstracta'
    ],
    [
        'id' => 11,
        'title' => 'Obra 2',
        'price' => '17000',
        'img' => 'assets\images\Imagen 11.jpg',
        'category' => 'Abstracta'
    ],
    [
        'id' => 12,
        'title' => 'Obra 3',
        'price' => '20000',
        'img' => 'assets\images\Imagen 12.jpg',
        'category' => 'Abstracta'
    ],
    [
        'id' => 13,
        'title' => 'Obra 1',
        'price' => '10000',
        'img' => 'assets\images\Imagen 13.jpg',
        'category' => 'Abstracta'
    ],
    [
        'id' => 14,
        'title' => 'Obra 2',
        'price' => '17000',
        'img' => 'assets\images\Imagen 14.jpg',
        'category' => 'Abstracta'
    ],
    [
        'id' => 15,
        'title' => 'Obra 3',
        'price' => '20000',
        'img' => 'assets\images\Imagen 15.jpg',
        'category' => 'Abstracta'
    ],
    [
        'id' => 16,
        'title' => 'Obra 1',
        'price' => '10000',
        'img' => 'assets\images\Imagen 16.jpg',
        'category' => 'Abstracta'
    ],
    [
        'id' => 17,
        'title' => 'Obra 2',
        'price' => '17000',
        'img' => 'assets\images\Imagen 17.jpg',
        'category' => 'Abstracta'
    ],
];

// Convertir el array a formato JSON para poder usarlo en JavaScript
$jsonData = json_encode($data);

// Imprimir el JSON para que JavaScript pueda usarlo
echo "const data = $jsonData;";
?>
