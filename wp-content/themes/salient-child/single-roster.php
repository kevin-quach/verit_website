<?php 
/*
 * Template Name: FC Roster
 * Description: FC Roster Page
*/

// composer auto loader
require __DIR__.'/vendor/autoload.php';

define('BENCHMARK_ENABLED', false);
define('LOGGER_ENABLED', false);
define('LOGGER_ENABLE_PRINT_TIME', false);

// parse characters
// view Lodestone/Modules/Routes for more urls.

$option = 'fc';
$id = isset($argv[2]) ? trim($argv[2]) : false;
if (!$option) {
    die('Please provide an option: character, fc, ls');
}

// create api instance
$api = new \Lodestone\Api;

// switch on options
$hash = false;
switch($option) {
    case 'character':
        $data = $api->getCharacter(15831245);
        break;

    case 'character_friends':
        $data = $api->getCharacterFriends($id ? $id : 730968);
        break;

    case 'fc':
        $data = $api->getFreeCompanyMembers($id ? $id : '9234490298434916243');
        break;

    case 'ls':
        $data = $api->getLinkshellMembers($id ? $id : '19984723346535274');
        break;

    case 'devposts':
        $data = $api->getDevPosts();
        break;

    case 'lodestone_topics':
        $data = $api->getLodestoneTopics();
        break;
}

if (!$data) {
    print_r("\nNo data, was the command correct? > ". $option);
    print_r("\n");
    die;
}

$data = json_encode($data);



get_header(); 
nectar_page_header($post->ID); 

//full page
$fp_options = nectar_get_full_page_options();
extract($fp_options);

?>


	
	<div class="<?php if($page_full_screen_rows != 'on') echo 'container'; ?> main-content">
		
		<div class="row">
			
			<?php 


			 //buddypress
			 global $bp; 
			 if($bp && !bp_is_blog_page()) echo '<h1>' . get_the_title() . '</h1>';
			
			 //fullscreen rows
			 if($page_full_screen_rows == 'on') echo '<div id="nectar_fullscreen_rows" data-animation="'.$page_full_screen_rows_animation.'" data-row-bg-animation="'.$page_full_screen_rows_bg_img_animation.'" data-animation-speed="'.$page_full_screen_rows_animation_speed.'" data-content-overflow="'.$page_full_screen_rows_content_overflow.'" data-mobile-disable="'.$page_full_screen_rows_mobile_disable.'" data-dot-navigation="'.$page_full_screen_rows_dot_navigation.'" data-footer="'.$page_full_screen_rows_footer.'" data-anchors="'.$page_full_screen_rows_anchors.'">';

				 if(have_posts()) : while(have_posts()) : the_post(); 
					
					 the_content(); 

				 endwhile; endif; 
				
			if($page_full_screen_rows == 'on') echo '</div>'; ?>




			<div class="roster-wrapper" id="rosterWrap">
					
			</div>
	
		</div><!--/row-->
		
	</div><!--/container-->


<script type="text/javascript">
    
var stuff = <?php print $data; ?>;



console.info("THE OBJECT", stuff.members);



</script>

<?php get_footer(); ?>


<script type="text/javascript">
	
jQuery(function($) {

	for(var i = 0; i < stuff.members.length; i++) {
	 var str = "<li><img class='avatar' src='" + stuff.members[i].avatar + "'><span class='name'>" + stuff.members[i].name + "</span><span class='rank'><img class='rankicon' src='" + stuff.members[i].rankicon + "'>" + stuff.members[i].rank + "</span></li>";
	 $("#rosterWrap").append(str);
	}

});

</script>