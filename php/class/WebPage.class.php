<?php

/**
 * Classe WebPage permettant de ne plus écrire l'enrobage HTML lors de la création d'une page Web.
 *
 * @startuml
 *
 *  skinparam defaultFontSize 14
 *  skinparam BackgroundColor transparent
 *
 *  class WebPage {
 *      - $head = ""
 *      - $title = null
 *      - $body = ""
 *      + __construct(string $title=null)
 *      + body() : string
 *      + head() : string
 *      + setTitle(string $title) : void
 *      + appendToHead(string $content) : void
 *      + appendCss(string $css) : void
 *      + appendCssUrl(string $url) : void
 *      + appendJs(string $js) : void
 *      + appendJsUrl(string $url) : void
 *      + appendContent(string $content) : void
 *      + toHTML() : string
 *      + getLastModification() : string
 *      + {static} escapeString(string $string) : string
 *  }
 *
 * @enduml
 */
class WebPage
{
    /**
     * Texte compris entre \<head\> et \</head\>.
     *
     * @var string
     */
    private $head = '';

    /**
     * Texte compris entre \<title\> et \</title\>.
     *
     * @var string
     */
    private $title = null;

    /**
     * Texte compris entre \<body\> et \</body\>.
     *
     * @var string
     */
    private $body = '';

    /**
     * Constructeur.
     *
     * @param string $title Titre de la page
     */
    public function __construct(string $title = null)
    {
        if (!is_null($title)) {
            $this->setTitle($title);
        }
    }

    /**
     * Retourner le contenu de $this->body.
     *
     * @return string
     */
    public function body()
    {
        return $this->body;
    }

    /**
     * Retourner le contenu de $this->head.
     *
     * @return string
     */
    public function head()
    {
        return $this->head;
    }

    /**
     * Affecter le titre de la page.
     *
     * @param string $title Le titre
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * Ajouter un contenu dans $this->head.
     *
     * @param string $content Le contenu à ajouter
     */
    public function appendToHead(string $content)
    {
        $this->head .= $content;
    }

    /**
     * Ajouter un contenu CSS dans head.
     *
     * @param string $css Le contenu CSS à ajouter
     * @see WebPage::appendToHead(string $content) : void
     *
     */
    public function appendCss(string $css)
    {
        $this->appendToHead("<style type='text/css'> $css </style>");
    }

    /**
     * Ajouter l'URL d'un controller CSS dans head.
     *
     * @param string $url L'URL du controller CSS
     * @see WebPage::appendToHead(string $content) : void
     *
     */
    public function appendCssUrl(string $url)
    {
        $this->appendToHead(<<<HTML
    <link rel="stylesheet" type="text/css" href="{$url}">

HTML
        );
    }

    /**
     * Ajouter un contenu JavaScript dans head.
     *
     * @param string $js Le contenu JavaScript à ajouter
     * @see WebPage::appendToHead(string $content) : void
     *
     */
    public function appendJs(string $js)
    {
        $this->appendToHead(<<<HTML
    <script type='text/javascript'>
    $js
    </script>

HTML
        );
    }

    /**
     * Ajouter l'URL d'un controller JavaScript dans head.
     *
     * @param string $url L'URL du controller JavaScript
     * @see WebPage::appendToHead(string $content) : void
     *
     */
    public function appendJsUrl(string $url)
    {
        $this->appendToHead(<<<HTML
    <script type='text/javascript' src='$url'></script>

HTML
        );
    }

    /**
     * Ajouter un contenu dans body.
     *
     * @param string $content Le contenu à ajouter
     */
    public function appendContent(string $content)
    {
        $this->body .= $content;
    }

    /**
     * Produire la page Web complète.
     *
     * @return string
     *
     * @throws Exception si title n'est pas défini
     */
    public function toHTML()
    {
        if (is_null($this->title)) {
            throw new Exception(__CLASS__ . ': title not set');
        }

        return <<<HTML
<!doctype html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>{$this->title}</title>
{$this->head()}
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    </head>
    <body  id="page-login-index" class="format-site  path-login chrome dir-ltr lang-fr yui-skin-sam yui3-skin-sam cours-univ-reims-fr pagelayout-login course-1 context-1 notloggedin page-login-v2 layout-full page-dark">
        <div id='page'>
{$this->body()}
        </div>
    </body>
</html>
HTML;
    }

    /**
     * Donner la date et l'heure de la dernière modification du controller principal.
     *
     * @return string
     *
     * @see http://php.net/manual/en/function.getlastmod.php
     * @see http://php.net/manual/en/function.strftime.php
     */
    public function getLastModification()
    {
        return strftime('Dernière modification de cette page le %d/%m/%Y à %Hh%M', getlastmod());
    }

    /**
     * Protéger les caractères spéciaux pouvant dégrader la page Web.
     *
     * @param string $string La chaîne à protéger
     *
     * @return string La chaîne protégée
     *
     * @see https://www.php.net/manual/en/function.htmlspecialchars.php
     */
    public static function escapeString(string $string)
    {
        return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5, 'utf-8');
    }
}
