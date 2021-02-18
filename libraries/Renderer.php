<?php


class Renderer
{
    //render('articles/show')
    /**
     * Affiche un template html en injectant les $variables
     * 
     * @param string&array $path $variables
     * 
     */
    public static function render(string $path, array $variables = []) : void
    {
        //['var1' => 2, 'var2' => "Lior]
        //$var1 = 2;
        //$var2 = "lior";
        extract($variables);

        ob_start();
        include'templates/' . $path . '.html.php';
        $pageContent = ob_get_clean();

        include'templates/layout.html.php';
    }
}