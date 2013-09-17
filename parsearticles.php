<?php include("simplehtmldom/simple_html_dom.php");
$startpage = 0; // start page of /articles catalog
$endpage = 80; // end page of /articles catalog
$count = 0;
while($startpage<=$endpage){
    $url="http://www.muktware.com/articles?page=".$startpage;
    $html = file_get_html($url);
    foreach($html->find('div') as $htmls){
        if($htmls->class == "node-inner"){
            $node_inner=str_get_html($htmls->innertext);
            // node inner scraped
            $username;
            $pubdate;
            $article;
            foreach($node_inner->find('div') as $node_inners){
                if($node_inners->class == "node-info"){
                    $node_info=str_get_html($node_inners->innertext);
                    foreach($node_info->find('span') as $span){
                        if($span->class == "username"){
                            $username=$span->innertext;
                        }
                        elseif($span->class == "time pubdate"){
                            $pubdate=$span->innertext;
                        }
                    }
                }
                elseif($node_inners->class == "header node-header"){
                    $article=str_get_html($node_inners->innertext);
                }
            }
            if($username == "Saurav Modak"){ // substitute author's name here
                echo "<b>".$username."</b> <i>".$pubdate."</i> ".$article;
                $count++;
            }
        }
    }
    $startpage++;
    }
    echo "<b>Total articles: </b>".$count;
?>