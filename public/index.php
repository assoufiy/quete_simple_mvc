 <?php
// chargement de l'autoload en début de fichier
        require __DIR__ . '/../vendor/autoload.php';
//...

 $item = new \Controller\ItemController();
 $items = $item->index();

 ?>

