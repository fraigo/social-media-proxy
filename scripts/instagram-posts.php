
<?php

header("Content-type: text/javascript");

$user = @$_GET["user"];

if (!$user){
    die("console.error('No Instagram User specified. Use: instagram.js?user=USERNAME')");
}


// endpoint
$url="https://www.instagram.com/$user/";

// get HTML content
$content = file_get_contents($url);
$xml = new DOMDocument(); 
@$xml->loadHTML($content);

?>
window.__additionalDataLoaded=function(name,data){
   console.log(data);
   window.instagramPosts= data.graphql.user.edge_owner_to_timeline_media.edges;
}

<?

// extract relevant scripts
foreach($xml->getElementsByTagName('script') as $script) { 
    $content= "".$script->nodeValue;
       
    if (strpos($content,"/".$user."/")>0){
        echo $content;
    }
} 

?>
try {
    window.instagramPosts=_sharedData.entry_data.ProfilePage[0].graphql.user.edge_owner_to_timeline_media.edges
}catch(e){
    console.error("Could not fetch Instagram posts : " + e)
    window.instagramPosts=[]
}
