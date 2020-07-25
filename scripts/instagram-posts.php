
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
window.__initialDataLoaded=function(name,data){
   console.log(data);
}
window.__additionalDataLoaded=function(name,data){
   console.log(data);
   if (data.graphql)
   window.instagramPosts= data.graphql.user.edge_owner_to_timeline_media.edges;
}
<?php

// extract relevant scripts
foreach($xml->getElementsByTagName('script') as $script) { 
    $content= "/**script*/ ".$script->nodeValue."\n\n\n";
       
    if (strpos($content,"window.__initialDataLoaded(")>0){
        echo $content;
    }
    if (strpos($content,"window._sharedData")>0){
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
