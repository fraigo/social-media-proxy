# social-media-proxy

A javscript plugin to proxy instagram posts and generate a dynamic HTML list of posts. React.js and Vue.js component example.


## Usage

Add the script in your page, using your Instagram username in `user=your-instagram-user`

```html
<script src="https://social-plugin.herokuapp.com/instagram.js?user=instagram"></script>
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

## React.js component

### Source code 

See [examples/instagram.component.js](examples/instagram.component.js)

### HTML/JSX example

`<InstagramPosts user="instagram"/>`

## Vue.js component

```javascript
Vue.component('instagram-post', {
    props:{
      post: Object
    },
    created: function(){
        var post=this.post.node;
        this.text=post.edge_media_to_caption.edges[0].node.text;
        this.link="https://www.instagram.com/p/"+post.shortcode+"/";
        this.image=post.thumbnail_src;
    },
    template:`<div class="post">
    <div class="post-content">
      <a :href="link" target="_blank">
          <img :src="image" width="100%" :alt="text" :title="text" >
      </a>
      </div>
    </div>` ,
    mounted: function(){
      window.instgrm.Embeds.process();
    }
  }
)
```

## Online example


GitHub  

[https://fraigo.github.io/social-media-proxy/examples/instagram.html](https://fraigo.github.io/social-media-proxy/examples/instagram.html)

Heroku  

[https://social-plugin.herokuapp.com/examples/instagram.html](https://social-plugin.herokuapp.com/examples/instagram.html)



## Development

Run in a local server with PHP

`php -s localhost:8000 route`

Script URL

`http://localhost:8000/instagram.js`

HTML Example URL

`http://localhost:8000/examples/instagram.html`

