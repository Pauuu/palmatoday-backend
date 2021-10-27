<?php
include "simple_html_dom.php";
$html = file_get_html('http://www.majorcadailybulletin.com/news/local.html');

$news = [];

// Find all titles
foreach ($html->find('h2') as $element) {

    // For each element 'h2' tag, searches the first 'a' tag and changes it's atribute, the 'href'
    $link = $element->find("a");

    if ($link) {

        // $inner = $element->find("a")[0]->innertext;  // es lo mismo que el de abajo
        $inner = $element->find("a", 0)->innertext;
        $link[0]->href = 'https://www.majorcadailybulletin.com/' . $link[0]->href;

        $news = array_merge($news, [
            [
                "header" => $inner,
                "link" => $link[0]->href
            ]
        ]);
    }
}

$jsonNews = json_encode($news, JSON_PRETTY_PRINT);
header("Content-type:application/json");
echo "\n " . $jsonNews;


$arrayNews = json_decode($jsonNews);

    // foreach ($arrayNews as $new) {
    //     $header = $new->header;
    //     $link = $new->link;

    //     echo "<a href=" . $link . ">" . $header . "</a>";
    //     echo "<br>";
    // }
