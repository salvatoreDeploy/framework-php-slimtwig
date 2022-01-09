<?php


namespace app\traits;


use app\src\Load;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Trait View
 * @package app\traits
 */
trait View
{
    /**
     * @var
     */
    protected $twig;

    /**
     *
     */
    protected function twig(){
        $loader = new FilesystemLoader('../app/views');
        $this->twig = new Environment($loader, [
            'debug' => true
        ]);
    }

    /**
     * @throws \Exception
     */
    protected function functions(){
        $functions = Load::file('/app/functions/twig.php');

        foreach ($functions as $function){
            $this->twig->addFunction($function);
        }
    }

    /**
     * @throws \Exception
     */
    protected function load(){
        $this->twig();

        $this->functions();
    }

    /**
     * @param $view
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    protected function view($view, $data){
        $this->load();

        $template = $this->twig->load(str_replace('.', '/', $view) . '.html');

        return $template->display($data);
    }
}