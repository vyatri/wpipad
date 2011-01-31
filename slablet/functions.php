<?php
/**
* Wordpress Naked, a very minimal wordpress theme designed to be used as a base for other themes.
*
* Please feel free to use this code as a base for your own themes but please do leave this header intaact.
*
* Darren Beale
* info@siftware.co.uk
*
* P.S. if you're not used WP before then this link will likely be useful:
* http://codex.wordpress.org/Template_Tags (tag == php function)
* 
*

* naked_nav()
*
* @desc a wrapper for the wordpress wp_list_pages() function that
* will display one or two unordered lists:
* 1) primary nav, a ul with css id #nav - always shown even if empty
* 2) Optional secondary nav, a ul with css id #subNav
*
* TODO: default css provided to allow space for both nav 'bars' one below the other to stop the page jig
* @param obj post
* @return string (html)
*/

function naked_nav($post = 0)
{
  $output = "";
  $subNav = "";
  $params = "title_li=&depth=1&echo=0";
  // always show top level
  $output .= '<ul id="nav">';
  $output .= wp_list_pages($params);
  $output .= '</ul>';
  // second level?
  if($post->post_parent)
  {
    $params .= "&child_of=" . $post->post_parent;
  }
  else
  {
    $params .= "&child_of=" . $post->ID;
  }
  $subNav = wp_list_pages($params);
  if ($subNav)
  {
    $output .= '<ul id="subNav">';
    $output .= $subNav;
    $output .= '</ul>';
  }
  return $output;
}

/**
* @desc make the site's heading & tagline an h1 on the homepage and an h4 on internal pages
* Naked's default CSS should make the two different states look identical
*/
function do_heading()
{
  $output = "";
  if(is_home()) $output .= "<h1>"; else  $output .= "<h4>";
  $output .= "<a href='"  . get_bloginfo('url') . "'>" . get_bloginfo('name') . "</a> <span>" . get_bloginfo('description') . "</span>";
  if(is_home()) $output .= "</h1>"; else  $output .= "</h4>";
  return $output;
}
/**
* register_sidebar()
*
*@desc Registers the markup to display in and around a widget
*/

if ( function_exists('register_sidebar') )
{
  register_sidebar(array(
    'name' => 'sidebar-1',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="widgettitle">',
    'after_title' => '</h2>',
  ));
  register_sidebar(array(
    'name' => 'sidebar-2',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="widgettitle">',
    'after_title' => '</h2>',
  ));
  register_sidebar(array(
    'name' => 'FB-konek',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
  ));
  register_sidebar(array(
    'name' => 'Header-Ad',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
  ));
  register_sidebar(array(
    'name' => 'Sidebar-Ad',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
  ));
   register_sidebar(array(
    'name' => 'Sidebar-Ad-250',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
  ));
}

// menambahkan twitter dan facebook di author profile

function add_twitter_contactmethod( $contactmethods ) {
  // Add Twitter
  $contactmethods['twitter'] = 'Twitter';
 
  // Remove Yahoo IM
  unset($contactmethods['yim']);
 
  return $contactmethods;
}
add_filter('user_contactmethods','add_twitter_contactmethod',10,1);


/**
* Check to see if this page will paginate
* 
* @return boolean
*/
function will_paginate() 
{
  global $wp_query;
  if ( !is_singular() ) 
  {
    $max_num_pages = $wp_query->max_num_pages;
    
    if ( $max_num_pages > 1 ) 
    {
      return true;
    }
  }
  return false;
}

// Get URL of first image in a post
function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];
  // no image found display default image instead
  if(empty($first_img)){
  $first_img = "http://rumahdot.com/wp-content/themes/rumahdot/images/nopic.png";
}
return $first_img;
}

function dp_recent_comments($no_comments = 10, $comment_len = 110) {
    global $wpdb;
	$request = "SELECT * FROM $wpdb->comments";
	$request .= " JOIN $wpdb->posts ON ID = comment_post_ID";
	$request .= " WHERE comment_approved = '1' AND post_status = 'publish' AND post_password =''";
	$request .= " ORDER BY comment_date DESC LIMIT $no_comments";
	$comments = $wpdb->get_results($request);
	if ($comments) {
		foreach ($comments as $comment) {
			ob_start();
			?>
				<div class='komentar-terbaru'>
                                  <div class="avatar"><?php echo get_avatar( $comment->comment_author_email, 32 ); ?></div>
					<span><strong><?php echo dp_get_author($comment); ?> : </strong></span>
                                        <a href="<?php echo get_permalink( $comment->comment_post_ID ) . '#comment-' . $comment->comment_ID; ?>"><?php echo strip_tags(substr(apply_filters('get_comment_text', $comment->comment_content), 0, $comment_len)); ?>
					</a>
				</div>
			<?php
			ob_end_flush();
		}
	} else {
		echo "<div class='komentar-terbaru'>Tidak ada komentar</div>";
	}
}

function dp_get_author($comment) {
	$author = "";
	if ( empty($comment->comment_author) )
		$author = __('Anonymous');
	else
		$author = $comment->comment_author;
	return $author;
}
function get_popular_posts() {
	global $wpdb;
	$now = gmdate("Y-m-d H:i:s",time());
	$lastmonth = gmdate("Y-m-d H:i:s",gmmktime(date("H"), date("i"), date("s"), date("m")-12,date("d"),date("Y")));
	$popularposts = "SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS 'stammy' FROM $wpdb->posts, $wpdb->comments WHERE comment_approved = '1' AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish' AND post_date < '$now' AND post_date > '$lastmonth' AND comment_status = 'open' GROUP BY $wpdb->comments.comment_post_ID ORDER BY stammy DESC LIMIT 6";
	$posts = $wpdb->get_results($popularposts);
	$popular = '';
	if($posts){
		foreach($posts as $post){
			$post_title = stripslashes($post->post_title);
			$guid = get_permalink($post->ID);
			$popular .='<div class="rec-post">'.
                        '<div class="avatar"><img src="' .getphpthumburl(catch_that_image(), 'w=45&h=45&zc=1'). '" /></div>'.
                          
                          '<h4><a href="'.$guid.'" >'.$post_title.'</a></h4>'.

                          '<hr/>'.
                        '</div>';
			$i++;
		}
	}
	echo $popular;
}

function recent_posts($no_posts = 10, $excerpts = true) {
   global $wpdb;
   $request = "SELECT ID, post_title, post_excerpt FROM $wpdb->posts WHERE post_status = 'publish' AND post_type='post' ORDER BY post_date DESC LIMIT $no_posts";
   $posts = $wpdb->get_results($request);
   if($posts) {
               foreach ($posts as $posts) {
                       $post_title = stripslashes($posts->post_title);
                       $permalink = get_permalink($posts->ID);
                       $output .= '<h4><a href="' . $permalink . '" rel="bookmark" title="Permanent Link: ' . htmlspecialchars($post_title, ENT_COMPAT) . '">' . htmlspecialchars($post_title) . '</a></h4>';
                       if($excerpts) {
                               $output.= stripslashes($posts->post_excerpt);
                       }
               }
       } else {
               $output .= '<li>No posts found</li>';
       }
   echo $output;
}
function contributors() {
  global $wpdb;
   
  $authors = $wpdb->get_results("SELECT ID, user_nicename, display_name from $wpdb->users ORDER BY ID DESC");
  $limit=0;
  foreach($authors as $author) {
    /*$check1 = $wpdb->get_results("SELECT user_id from $wpdb->usermeta WHERE meta_key LIKE 'wp_capabilities' AND meta_value NOT LIKE '%subscriber%' AND user_id = '".$author->ID."'");*/
	$check1 = $wpdb->get_results("SELECT post_author from $wpdb->posts WHERE post_author = '".$author->ID."'");
    if(count($check1)>0 && $limit<21){
      echo "<li>";
      //echo "<a title='".$curauth->display_name."' href=\"".get_bloginfo('url')."/?author=";
      echo "<a title='".$author->display_name."' href=\"".get_bloginfo('url')."/author/".$author->user_nicename;
      //echo $author->ID;
      echo "\">";
      echo get_avatar($author->ID);
      echo "</a>";
      echo "</li>";
	  $limit++;
    }
	if ($limit>20){
	    break;
	}
  }
}

function topcontributors() {
  global $wpdb;
   
  $sql = "SELECT u.ID, u.display_name as display_name, u.user_nicename as user_nicename,p.id as 'postid',count(p.post_author) as 'jumpost' ".
  "from $wpdb->users u,$wpdb->posts p where u.ID=p.post_author AND p.post_status LIKE 'publish' AND p.post_type LIKE 'post' group by p.post_author order by jumpost DESC, display_name ASC LIMIT 5";
  $authors = $wpdb->get_results($sql,OBJECT); 
  foreach($authors as $author) {
  //echo get_avatar($author->ID).'<br>'.$author->user_nicename." (".$author->jumpost.") <br/>";
   
  echo '<div style="float:left;clear:left;width:100%;">';
  //echo "<h3><a href=\"".get_bloginfo('url')."/?author=";
  //echo $author->ID; 
  echo "<h3><a title=\"".$author->display_name."\" href=\"".get_bloginfo('url')."/author/".$author->user_nicename;
  echo "\">";
  echo get_avatar($author->ID);
  echo "</a>";
  echo "<a href=\"".get_bloginfo('url')."/?author=";
  echo $author->ID;
  echo "\">";
  //the_author_meta('display_name', $author->ID);
  echo $author->user_nicename." (".$author->jumpost.")";
  echo "</a></h3>";
  //echo 'Telah menulis('.$post_count.' post) ';
  echo "</div>";
  }
}

function new_excerpt_length($length) {
	return 30;
}
add_filter('excerpt_length', 'new_excerpt_length');


?>
