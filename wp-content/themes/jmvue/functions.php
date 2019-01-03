<?php
// Remove all default WP template redirects/lookups
remove_action('template_redirect', 'redirect_canonical');

// Redirect all requests to index.php so the Vue app is loaded and 404s aren't thrown
function remove_redirects() {
    add_rewrite_rule('^/(.+)/?', 'index.php', 'top');
}
add_action('init', 'remove_redirects');

// Load scripts
function load_vue_scripts() {
    wp_enqueue_style('jm/app.css', get_template_directory_uri() . '/dist/styles/app.css', false, null);
    wp_enqueue_script('jm/jquery.js', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', null, null, true);
    wp_enqueue_script('jm/parsley.js', get_template_directory_uri() . '/dist/scripts/parsley.js', null, null, true);
    wp_enqueue_script('jm/granim.min.js',get_template_directory_uri() . '/dist/scripts/granim.min.js', null, null, true);
    wp_enqueue_script('jm/manifest.js', get_template_directory_uri() . '/dist/scripts/manifest.js', null, null, true);
    wp_enqueue_script('jm/vendor.js', get_template_directory_uri() . '/dist/scripts/vendor.js', null, null, true);
    wp_enqueue_script('jm/app.js', get_template_directory_uri() . '/dist/scripts/app.js', null, null, true);
    // wp_enqueue_script('jm/waypoint.js', 'https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/noframework.waypoints.js', null, null, true);
    // wp_enqueue_script( 'jm/isotope.js','https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js', null, null, true);
    
    
   
}
add_action('wp_enqueue_scripts', 'load_vue_scripts', 100);

function wpb_add_google_fonts() {
    wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans|Oswald:300italic,400italic,700italic,400,700,300', false ); 
}
     
add_action( 'wp_enqueue_scripts', 'wpb_add_google_fonts' );

//custom meta rest endpoint
function wp_rest_api_alter() {
    register_rest_field( 'user',
        'tests',
        array(
          'get_callback'    => function($data, $field, $request, $type){
            if (function_exists('get_field')) {
                $post_id = 'user_'. get_current_user_id(); // user ID = 2
              return get_field('test', $post_id);
            }
            return [];
          },
          'update_callback' => null,
          'schema'          => null,
        )
    );
  } 
  add_action( 'rest_api_init', 'wp_rest_api_alter');
  

  add_action("rest_api_init", function () {


    register_rest_field(
          "user", 
          "loyalty_item_1",
        [
            "get_callback" => function ($user, $field_name, $request, $object_type) {

                return get_user_meta($user["id"], $field_name, TRUE);

            },
            "update_callback" => function ($value, $user, $field_name, $request, $object_type) {

                update_user_meta($user->ID, $field_name, $value);

            },
        ]
    );


});

$length = 10;
$offer_id = substr(str_shuffle(md5(time())),0,$length);

$offer_id_base64 = base64_encode($offer_id);

//echo $randomString;

//$offer_id = higglypiggly; // variable in script to be passed coming from object (could be any variable.)  


add_filter('acf/load_field/name=offer_monday',
         function($field) use ($offer_id_base64) { 
          // the variable after 'use' ($member_id) indicates that it is the one to 'use' from the main script.  $field is coming from 'acf/load_field'.  
	     $field['default_value'] = $offer_id_base64;
	     return $field;
	 }
 );
 

//if field is empty then add fresh new value
add_filter('acf/update_value/name=offer_monday', 'my_acf_update_value', 10, 3);
 function my_acf_update_value($value, $post_id, $field) {
   if (empty($value)) {
     $value = $field['default_value'];
   }
   return $value;
 }

//add these values to head of the page on load


  // functions.php


    
function save_educadme_courses_for_user( $user_id ) {

    if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }
    
    $args=array('post_type' => 'loyalty');
    $allposts = get_posts( $args );
    
    foreach ( $allposts as $post ) {
    update_user_meta( $user_id, $post->post_name, $_POST[$post->post_name] );
    }//end of master loop
    
    }           
    
    
    function educadme_courses_for_user( $user ) {   ?>
    
    
    
    <h3> <?php echo $post->post_name; ?> </h3>
    <span class="description">   description (what courses have you taken) </span><br>
    <table class="form-table">
        <tr>
                    <td>
                        <table>                         
            <?php $args=array('post_type' => 'loyalty');
                        $allposts = get_posts( $args );
                        foreach ( $allposts as $post ) { 
                            $max_value = get_field('max_value', $post->ID);
                            ?>
            <tr>
            <th style="border-bottom: 1px solid #000;">
            <label for="<?php echo $post->post_name; ?>"><?php echo $post->post_name; ?> (currently: <?php echo esc_attr( get_the_author_meta($post->post_name , $user->ID )); ?>)</label>
            <br>
            <span class="description" style="font-weight:bold;"></span>
            </th>
            <td style="border-bottom: 1px solid #000;">                                      
    <input type="text" name="<?php echo $post->post_name; ?>" value="<?php echo esc_attr( get_the_author_meta($post->post_name , $user->ID )); ?>"  /><label></label>
            </td>
            <td><label for="">max value</label><?php echo $max_value ?></td>
            </tr>
                        <?php } ?>
            </table>
                </td>
        </tr>
    </table>
    
    <?php }//end of function 
    
    
    add_action( 'show_user_profile', 'educadme_courses_for_user' );
    add_action( 'edit_user_profile', 'educadme_courses_for_user' );
    add_action( 'personal_options_update', 'save_educadme_courses_for_user' );
    add_action( 'edit_user_profile_update', 'save_educadme_courses_for_user' );


//programmatically register multiple fields to REST API

add_action( 'rest_api_init', 'create_api_posts_meta_field' );
 
function create_api_posts_meta_field() {
 
    // register_rest_field ( 'name-of-post-type', 'name-of-field-to-return', array-of-callbacks-and-schema() )
    register_rest_field( 'user', 'custom_user_point_value', array(
           'get_callback'    => 'get_post_meta_for_api',
           'update_callback'    => 'get_post_meta_for_api',
           'schema'          => null,
        )
    );
}
 
function get_post_meta_for_api( $object ) {
    //get the id of the post object array
    $post_id = $object['id'];
    
    //return the post meta
    return get_user_meta( $post_id );
}
    
    ?>