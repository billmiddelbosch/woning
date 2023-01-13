<?php

function getData($pdo, $nr)
{
    //set map api url
    $url = "https://jumba.nl/assets/sitemap/map-1.xml";

    //call api
    $data = file_get_contents($url);
    $array = explode("\n", $data);

    //split json;
    return substr($array[$nr], 26);
}
