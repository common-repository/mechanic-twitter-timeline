<?php
/*
Plugin Name: Mechanic Twitter Timeline
Plugin URI: http://www.adityasubawa.com/blog/post/87/mechanic-twitter-timeline-wordpress-plugin.html
Description: Display simple Twitter Timeline Status As a Widget
Version: 1.1
Author: Aditya Subawa
Author URI: http://www.adityasubawa.com
*/
class wp_tweetmechanic extends WP_Widget{
    
    function __construct(){
     $params=array(
            'description' => 'Display Twitter Timeline Status as a Widgets', //deskripsi  dari plugin  yang di tampilkan
            'name' => 'Mechanic - Twitter Timeline'  //title dari plugin
        );
        
        parent::__construct('wp_tweetmechanic', '', $params); 
    }
    
    public function form($instance){
       ?>
<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<p><font size="3">Style & Color:</font></p>
<p><label for="<?php echo $this->get_field_id('tw_title_color'); ?>">Twitter Username Color: <input class="widefat" id="<?php echo $this->get_field_id('tw_title_color'); ?>" name="<?php echo $this->get_field_name('tw_title_color'); ?>" type="text" value="<?php echo $instance['tw_title_color']; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('tw_font_color'); ?>">Font Color: <input class="widefat" id="<?php echo $this->get_field_id('tw_font_color'); ?>" name="<?php echo $this->get_field_name('tw_font_color'); ?>" type="text" value="<?php echo $instance['tw_font_color']; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('twlink_font_color'); ?>">Font Link Color: <input class="widefat" id="<?php echo $this->get_field_id('twlink_font_color'); ?>" name="<?php echo $this->get_field_name('twlink_font_color'); ?>" type="text" value="<?php echo $instance['twlink_font_color']; ?>" /></label></p>
<p><font size='2'>To change the font color, fill the field with the HTML color code. example: #333 </font></p>
<p><font size='2'><a href="http://www.adityasubawa.com/colorpickers.php" target="_blank">Click here</a> to select another color variation.</font></p>
<p><font size="3">Display:</font></p>
<p><label for="<?php echo $this->get_field_id('tw_width'); ?>">Width (px): <input class="widefat" id="<?php echo $this->get_field_id('tw_width'); ?>" name="<?php echo $this->get_field_name('tw_width'); ?>" type="text" value="<?php echo $instance['tw_width']; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('tw_height'); ?>">Height (px): <input class="widefat" id="<?php echo $this->get_field_id('tw_height'); ?>" name="<?php echo $this->get_field_name('tw_height'); ?>" type="text" value="<?php echo $instance['tw_height']; ?>" /></label></p>
<p><font size='2'><i>Set your Width and Height of the widget. Example: width: 200, height: 150.</i></font></p>
<p><font size="3">Setup:</font></p>
<p><label for="<?php echo $this->get_field_id('tw_username'); ?>">Twitter Username: <input class="widefat" id="<?php echo $this->get_field_id('tw_username'); ?>" name="<?php echo $this->get_field_name('tw_username'); ?>" type="text" value="<?php echo $instance['tw_username']; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('tw_avatar'); ?>"><?php _e('Disable avatar on timeline?'); ?><input type="checkbox" class="checkbox" <?php checked( $instance['tw_avatar'], 'on' ); ?> id="<?php echo $this->get_field_id('tw_avatar'); ?>" name="<?php echo $this->get_field_name('tw_avatar'); ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('tw_button'); ?>"><?php _e('Enable follow button?'); ?><input type="checkbox" class="checkbox" <?php checked( $instance['tw_button'], 'on' ); ?> id="<?php echo $this->get_field_id('tw_button'); ?>" name="<?php echo $this->get_field_name('tw_button'); ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('author_credit'); ?>"><?php _e('Give credit to plugin author?'); ?><input type="checkbox" class="checkbox" <?php checked( $instance['author_credit'], 'on' ); ?> id="<?php echo $this->get_field_id('author_credit'); ?>" name="<?php echo $this->get_field_name('author_credit'); ?>" /></label></p>
<p><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=ZMEZEYTRBZP5N&lc=ID&item_name=Aditya%20Subawa&item_number=426267&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted" target="_blank"><img src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" alt="<?_e('Donate')?>" /></a></p>

	   <?php
    }
    
    public function widget($args, $instance){
      extract($args, EXTR_SKIP);
    $authorcredit = isset($instance['author_credit']) ? $instance['author_credit'] : false ; // give plugin author credit
    echo $before_widget;
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
	$twfontcolor= $instance['tw_font_color'];
	$twlinkfontcolor= $instance['twlink_font_color'];
	$twwidth= $instance['tw_width'];
	$twheight= $instance['tw_height'];
	$twusername= $instance['tw_username'];
	$twtitle= $instance['tw_title_color'];
	$followbutton = isset($instance['tw_button']) ? $instance['tw_button'] : false ;
	$twavatar = isset($instance['tw_avatar']) ? $instance['tw_avatar'] : false ; 
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;?>
	<div style="background:transparent; padding-top:5px;padding-left:8px">
    <script src="http://widgets.twimg.com/j/2/widget.js"></script>
    <script>
    new TWTR.Widget({
    version: 2,
    type: 'profile',
    rpp: 10,
    interval: 3000,
    width: <?php echo $twwidth; ?>,
    height: <?php echo $twheight; ?>,
    theme: {
    shell: {
    background: 'transparent',
	size:2,
    color: '<?php echo $twtitle; ?>'
    },
    tweets: {
    background: 'transparent',
    color: '<?php echo $twfontcolor; ?>',
    links: '<?php echo $twlinkfontcolor; ?>'
    }
    },
    features: {
    scrollbar: false,
    loop: true,
    live: true,
    hashtags: true,
	timestamp: true,
	<?php
	 if ($twavatar) { ?>
    avatars: false,
	<?php }else{ ?> 
	avatars: true,
	<?php } ?>   
    behavior: 'default'
    }
    }).render().setUser('<?php echo $twusername; ?>').start();
    </script>
    </div>
    <br />
    <?php
    if ($followbutton) { ?>
	<div class="twitter"> 
    <!-- Twitter --> 
    <iframe title="" style="width: 300px; height: 20px;" class="twitter-follow-button" src="http://platform.twitter.com/widgets/follow_button.html#_=1319978796351&amp;
    align=&amp;button=blue&amp;id=twitter_tweet_button_0&amp;
    lang=en&amp;link_color=&amp;screen_name=<?php echo $twusername; ?>&amp;show_count=&amp;
    show_screen_name=&amp;text_color=" frameborder="0" scrolling="no"></iframe>
    </div>
<!-- Twitter End -->
			<?php } ?>   
<?php
	 if ($authorcredit) { ?>
			<p style="font-size:10px;">
				Plugins by <a href="http://balimechanicweb.net" title="Bali Web Design">Bali Web Design</a>
			</p>
			<?php }
	echo $after_widget;
  }
}
add_action('widgets_init', 'register_wp_tweetmechanic');
function register_wp_tweetmechanic(){
    register_widget('wp_tweetmechanic');
}
?>