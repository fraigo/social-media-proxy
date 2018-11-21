
<?php

$user = $_GET["user"];

// endpoint
$url="https://www.instagram.com/$user/";

// get HTML content
$content = file_get_contents($url);
$xml = new DOMDocument(); 
@$xml->loadHTML($content);

// extract relevant scripts
foreach($xml->getElementsByTagName('script') as $script) { 
    $content= "".$script->nodeValue;
    if (strpos($content,"_initialDataLoaded")>0){
        echo $content;
    }    
    if (strpos($content,"_sharedData")>0){
        echo $content;
    }
} 

?>
try {
    window.instagramPosts=_sharedData.entry_data.ProfilePage[0].graphql.user.edge_owner_to_timeline_media.edges
}catch(e){

}
