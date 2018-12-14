# social-media-proxy

A simple plugin to proxy instagram posts and generate a javascript list of posts:


## Usage

Add the script in your page

```html
<script src="https://social-plugin.herokuapp.com/instagram.js?user=teslamotors"></script>
```

You can access the content of the last posts of Instagram using the variable `window.intagramPosts`


## React JSX example

```javascript
  var posts=instagramPosts.map((item,index) => {
  var text=item.node.edge_media_to_caption.edges[0].node.text
  var link="https://www.instagram.com/p/"+item.node.shortcode+"/"
  var image=item.node.thumbnail_src
  var divStyle={
      backgroundImage: 'url('+image+')'
  }
  return <div url={image} onClick={getComponent.bind(this)} style={{backgroundImage: 'url('+image+')'}} key={index} className='post'><small>{text}</small></div>
        })
```

## Online example

See https://social-plugin.herokuapp.com/examples/instagram.html

