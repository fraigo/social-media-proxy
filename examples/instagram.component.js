
class InstagramPosts extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            instagramPosts: [],
            user: props.user
        };
    }

    loadUser(){
        console.log("Load User "+this.state.user)
        var self=this
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.onload = function (){
            console.log("Loaded posts",window.instagramPosts.length)
            self.setState({
                instagramPosts: window.instagramPosts
            })
        }
        script.onerror = function(e){
            console.error(e);
        }
        script.src = "/instagram.js?user=" + this.state.user
        document.body.appendChild(script)
    }

    clickComponent(e) {
        var link = e.target.getAttribute("url");
        if (link) {
            window.open(link, '_instagram')
        }
    }

    componentDidMount() {
        this.loadUser()
    }

    handleChange(event) {
        this.setState({user:event.target.value})
        //this.loadUser()
    }

    render() {
        var posts = this.state.instagramPosts.map((item, index) => {
            var text = item.node.edge_media_to_caption.edges[0].node.text
            var link = "https://www.instagram.com/p/" + item.node.shortcode + "/"
            var image = item.node.thumbnail_src
            var divStyle = {
                backgroundImage: 'url(' + image + ')'
            }
            return  <div className='post' key={item.node.id} >
                        <div className="post-content" url={image} onClick={this.clickComponent.bind(this)} style={{ backgroundImage: 'url(' + image + ')' }}  >
                            <p title={text}>{text}</p>
                        </div>
                    </div>
        })
        var noPosts=<div style={{textAlign:'center'}}>No posts for @{this.state.user}</div>
        return (
            <div>
                <h2 style={{textAlign:'center'}}>Instagram posts for </h2>
                <div style={{textAlign:'center'}}>
                    <div className="instagram-user-select">
                        @<input type="text" value={this.state.user} onChange={this.handleChange.bind(this)} />
                        <button type="button" onClick={this.loadUser.bind(this)} >Change</button>
                    </div>
                </div>
                <div>
                { posts.length ? posts : noPosts }
                </div>
            </div>
        );
    }
}
