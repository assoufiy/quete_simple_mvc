<?php

// routing.php

   // 'Category'=> [
    //    ['index', '/categories', 'GET'], // action, url, HTTP method
    //    ['show', '/category/{id}', 'GET'], // action, url, HTTP method
    //],
$routes = [
    'Item' => [ // Controller
        ['index', '/', 'GET'], // action, url, HTTP method
        ['show', '/item/{id:\d+}', 'GET'], // action, url, HTTP method
        ['add', '/item/add', ['GET','POST']],
        ['edit', '/item/edit/{id:\d+}', ['GET','POST']],
        ['delete', '/item/delete/{id:\d+}', 'GET']
    ]
];
