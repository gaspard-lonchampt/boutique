<?php


class Renderer
{
    //render('articles/show')
    /**
     * affiche un template html en injectant les $variables
     * @param string $path
     * @param array $variables
     */
    public static function render(string $path, array $variables = []) : void
    {
        //['var1' => 2, 'var2' => "Lior]
        //$var1 = 2;
        //$var2 = "lior";
        extract($variables);

        ob_start();
        require('templates/' . $path . '.html.php');
        $pageContent = ob_get_clean();

        require('templates/layout.html.php');
    }
}