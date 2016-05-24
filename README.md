![ActionPress](http://nickcousins.co.uk/actionpress.png)

##Because "read more" isn't good enough
Turn your "More" links into a bespoke call-to-action for each post. Rather than have "Read more" or "[...]" after your excerpt, you could have "See Bob's garden up close" in a post about a beautiful garden, or "Try our tasty sauce" in a bolognese sauce recipe.

For example, here's a post about interior design:

![An example Wordpress post with a "read more" link that reads "See our top tips for cosification"](http://nickcousins.co.uk/actionpress-screenshot.png)

The more link reads "See our top tips for cosification", because this relates directly to the post content, and is set in the post editing screen like this:

![Screenshot of Wordpress post editing with ActionPress meta-box](http://nickcousins.co.uk/actionpress-metabox.png)

##Installation

1. Download and unzip plugin from https://github.com/NickCousins/ActionPress/archive/master.zip
2. Ensure the directory is called `actionpress` and place it into `wp-content/plugins/`
3. Go to the plugins tab in your Wordpress admin area, and click on *Activate* on the ActionPress plugin

##Usage

1. Create a new post, or edit an existing post
2. You'll see a new meta-box above the *Update* or *Publish* button that says *Post Action*
3. Enter your call-to-action for this post and press the *Update* or *Publish* button to save changes.

Any posts with no call-to-action text defined will have a read more link that simply says "Read more". But you don't want that!

##Customisation
If you want to customise the style of your ActionPress more link, simply target the .actionpress_more class.

The default styling is simple:
```
.actionpress_more{
    display:block;
    margin:10px auto;
}
```

###Troubleshooting
By default, ActionPress has a priority of 20. This means that it applies its changes to the more link after all other changes (up to 19). It discards the previous more link entirely, therefore any changes up to 19th in the queue will be discarded.
If you want to filter ActionPress, make your filter priority > 20.

Any other problems, tweet me *@nickpcousins*
