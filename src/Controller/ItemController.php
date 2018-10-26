<?php
namespace Controller;
use Model\ItemManager;
use Model\Item;
//use Twig_Loader_Filesystem;
//use Twig_Environment;


class ItemController extends AbstractController
{

    /**
     * @return mixed
     */
    public function index()
    {
        $itemManager = new ItemManager($this->getPdo());
        $items = $itemManager->selectAll();
        return $this->twig->render('item.html.twig', ['items' => $items]);
    }

    /**
     * @param int $id
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function show(int $id)
    {
        $itemManager = new ItemManager($this->getPdo());
        $item = $itemManager->selectOneById($id);
        return $this->twig->render('showItem.html.twig', ['item' => $item]);
    }

    /**
     * @param int $id
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function edit(int $id): string
    {

        $itemManager = new ItemManager($this->getPdo());
        $item = $itemManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $item->setTitle($_POST['title']);
            $itemManager->update($item);
        }

        return $this->twig->render('edit.html.twig', ['item' => $item]);
    }

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function add()
    {
        // validations des valeurs saisies dans le form

        /** @var TYPE_NAME $_SERVER */
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            /**
             * @param $data
             * @return string
             */
            function test_input($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

        // création d'un nouvel objet Item et hydratation avec les données du formulaire
        $item = new Item();
        $item->setTitle(test_input($_POST['title']));


        $itemManager = new ItemManager($this->pdo);
        // l'objet $item hydraté est simplement envoyé en paramètre de insert()
        $id = $itemManager->insert($item);
        // si tout se passe bien, redirection
        header('Location: /item/' . $id);
        exit();
        }


        // le formulaire HTML est affiché (vue à créer)
        return $this->twig->render('add.html.twig');
}

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $itemManager = new ItemManager($this->getPdo());
        $itemManager->delete($id);
        header('Location:/');
    }

}



