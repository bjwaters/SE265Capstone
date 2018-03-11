<?php



$videoLink = "https://youtu.be/LEcbagW4O-s";

$link = preg_split('~=~', $videoLink, PREG_SPLIT_OFFSET_CAPTURE);
if(count($link) == 1)
{
    echo "TEST";
    $link = preg_split('~be/~', $videoLink, PREG_SPLIT_OFFSET_CAPTURE);
}

$videoEmbed = $link[1];
print_r($link);



    ?>

<div>
    <iframe width='560' height='315' src='https://www.youtube.com/embed/<?=$videoEmbed ?>' frameborder='0' allowfullscreen></iframe>
</div>

<iframe width="560" height="315" src="https://www.youtube.com/embed/LEcbagW4O-s" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

LEcbagW4O-s