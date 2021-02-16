<?php


class Http
{
    /**
     * retourne le visiteur vers $url
     * @param string $url
     */
    public static function redirect(string $url): void
    {
        header("Location: $url");
        exit();
    }
}