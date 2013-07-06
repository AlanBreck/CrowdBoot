<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

/************* INCLUDE NEEDED FILES ***************/

/*
1. library/bones.php
    - head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
    - custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once('library/bones.php'); // if you remove this, bones will break
/*
2. library/custom-post-type.php
    - an example custom post type
    - example custom taxonomy (like categories)
    - example custom taxonomy (like tags)
*/
require_once('library/project-post-type.php'); // you can disable this if you like
/*
3. library/admin.php
    - removing some default WordPress dashboard widgets
    - an example custom dashboard widget
    - adding custom login css
    - changing text in footer of admin
*/
require_once('library/admin.php'); // this comes turned off by default
/*
4. library/translation/translation.php
    - adding support for other languages
*/
require_once('library/translation/translation.php'); // this comes turned off by default
/*
5. library/custom-user-meta.php
    - adding extra meta fields for users
*/
require_once('library/custom-user-meta.php');
/*
6. library/custom-user-role.php
    - adding role 'user'
*/
require_once('library/custom-user-role.php');
/*
7. library/metabox/custom-project-meta-boxes.php
    - adding extra meta boxes for projects
*/
require_once('library/metabox/custom-project-meta-boxes.php');

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );
/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* Hide Toolbar on Frontend ********************/
add_filter('show_admin_bar', '__return_false');

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
    register_sidebar(array(
    	'id' => 'sidebar',
    	'name' => __('Sidebar', 'bonestheme'),
    	'description' => __('The first (primary) sidebar.', 'bonestheme'),
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'id' => 'left_footer_widgets',
        'name' => __('Left Footer Widgets', 'bonestheme'),
        'description' => __('Far left column footer widgets.', 'bonestheme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'id' => 'middle_footer_widgets',
        'name' => __('Middle Footer Widgets', 'bonestheme'),
        'description' => __('Middle column footer widgets.', 'bonestheme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'id' => 'right_footer_widgets',
        'name' => __('Right Footer Widgets', 'bonestheme'),
        'description' => __('The second (secondary) sidebar.', 'bonestheme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));

    /*
    to add more sidebars or widgetized areas, just copy
    and edit the above sidebar code. In order to call
    your new sidebar just use the following code:

    Just change the name to whatever your new
    sidebar's id is, for example:

    register_sidebar(array(
    	'id' => 'sidebar2',
    	'name' => __('Sidebar 2', 'bonestheme'),
    	'description' => __('The second (secondary) sidebar.', 'bonestheme'),
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));

    To call the sidebar in your template, you can just copy
    the sidebar.php file and rename it to your sidebar's name.
    So using the above example, it would be:
    sidebar-sidebar2.php

    */
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
			    <?php
			    /*
			        this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
			        echo get_avatar($comment,$size='32',$default='<path_to_url>' );
			    */
			    ?>
			    <!-- custom gravatar call -->
			    <?php
			    	// create variable
			    	$bgauthemail = get_comment_author_email();
			    ?>
			    <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
			    <!-- end custom gravatar call -->
				<?php printf(__('<cite class="fn">%s</cite>', 'bonestheme'), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__('F jS, Y', 'bonestheme')); ?> </a></time>
				<?php edit_comment_link(__('(Edit)', 'bonestheme'),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
       			<div class="alert info">
          			<p><?php _e('Your comment is awaiting moderation.', 'bonestheme') ?></p>
          		</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
    <!-- </li> is added by WordPress automatically -->
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <label class="screen-reader-text" for="s">' . __('Search for:', 'bonestheme') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'.esc_attr__('Search the Site...','bonestheme').'" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </form>';
    return $form;
} // don't remove this bracket!

// Get Gravatar URL
function get_gravatar_url( $email, $size ) {
    $hash = md5( strtolower( trim ( $email ) ) );
    echo 'http://gravatar.com/avatar/' . $hash . '?s=' . $size;
}

/************* ARCHIVES PAGES *****************/

// Add Custom Post Types to Archive.php pages
function namespace_add_custom_types( $query ) {
  if( is_category() || is_author() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
        'post', 'project'
    ));
        return $query;
    }
}
add_filter( 'pre_get_posts', 'namespace_add_custom_types' );


/************* CONVERT FANCY QUOTES TO PLAIN QUOTES *****************/
function convert_smart_quotes($string)
{
    $search = array("&#8216;",
                    "&#8217;",
                    "&#8220;",
                    "&#8221;",
                    "&#8211;");

    $replace = array("'",
                     "'",
                     '"',
                     '"',
                     '-');

    return str_replace($search, $replace, $string);
}

/************* Create States Array *****************/
function get_states_array() {
    return array(
        array( 'abbr' => 'AL', 'full_name' => 'Alabama' ),
        array( 'abbr' => 'AK', 'full_name' => 'Alaska' ),
        array( 'abbr' => 'AZ', 'full_name' => 'Arizona' ),
        array( 'abbr' => 'AR', 'full_name' => 'Arkansas' ),
        array( 'abbr' => 'CA', 'full_name' => 'California' ),
        array( 'abbr' => 'CO', 'full_name' => 'Colorado' ),
        array( 'abbr' => 'CT', 'full_name' => 'Connecticut' ),
        array( 'abbr' => 'DE', 'full_name' => 'Delaware' ),
        array( 'abbr' => 'DC', 'full_name' => 'District Of Columbia' ),
        array( 'abbr' => 'FL', 'full_name' => 'Florida' ),
        array( 'abbr' => 'GA', 'full_name' => 'Georgia' ),
        array( 'abbr' => 'HI', 'full_name' => 'Hawaii' ),
        array( 'abbr' => 'ID', 'full_name' => 'Idaho' ),
        array( 'abbr' => 'IL', 'full_name' => 'Illinois' ),
        array( 'abbr' => 'IN', 'full_name' => 'Indiana' ),
        array( 'abbr' => 'IA', 'full_name' => 'Iowa' ),
        array( 'abbr' => 'KS', 'full_name' => 'Kansas' ),
        array( 'abbr' => 'KY', 'full_name' => 'Kentucky' ),
        array( 'abbr' => 'LA', 'full_name' => 'Louisiana' ),
        array( 'abbr' => 'ME', 'full_name' => 'Maine' ),
        array( 'abbr' => 'MD', 'full_name' => 'Maryland' ),
        array( 'abbr' => 'MA', 'full_name' => 'Massachusetts' ),
        array( 'abbr' => 'MI', 'full_name' => 'Michigan' ),
        array( 'abbr' => 'MN', 'full_name' => 'Minnesota' ),
        array( 'abbr' => 'MS', 'full_name' => 'Mississippi' ),
        array( 'abbr' => 'MO', 'full_name' => 'Missouri' ),
        array( 'abbr' => 'MT', 'full_name' => 'Montana' ),
        array( 'abbr' => 'NE', 'full_name' => 'Nebraska' ),
        array( 'abbr' => 'NV', 'full_name' => 'Nevada' ),
        array( 'abbr' => 'NH', 'full_name' => 'New Hampshire' ),
        array( 'abbr' => 'NJ', 'full_name' => 'New Jersey' ),
        array( 'abbr' => 'NM', 'full_name' => 'New Mexico' ),
        array( 'abbr' => 'NY', 'full_name' => 'New York' ),
        array( 'abbr' => 'NC', 'full_name' => 'North Carolina' ),
        array( 'abbr' => 'ND', 'full_name' => 'North Dakota' ),
        array( 'abbr' => 'OH', 'full_name' => 'Ohio' ),
        array( 'abbr' => 'OK', 'full_name' => 'Oklahoma' ),
        array( 'abbr' => 'OR', 'full_name' => 'Oregon' ),
        array( 'abbr' => 'PA', 'full_name' => 'Pennsylvania' ),
        array( 'abbr' => 'RI', 'full_name' => 'Rhode Island' ),
        array( 'abbr' => 'SC', 'full_name' => 'South Carolina' ),
        array( 'abbr' => 'SD', 'full_name' => 'South Dakota' ),
        array( 'abbr' => 'TN', 'full_name' => 'Tennessee' ),
        array( 'abbr' => 'TX', 'full_name' => 'Texas' ),
        array( 'abbr' => 'UT', 'full_name' => 'Utah' ),
        array( 'abbr' => 'VT', 'full_name' => 'Vermont' ),
        array( 'abbr' => 'VA', 'full_name' => 'Virginia' ),
        array( 'abbr' => 'WA', 'full_name' => 'Washington' ),
        array( 'abbr' => 'WV', 'full_name' => 'West Virginia' ),
        array( 'abbr' => 'WI', 'full_name' => 'Wisconsin' ),
        array( 'abbr' => 'WY', 'full_name' => 'Wyoming' )
    );
}

?>