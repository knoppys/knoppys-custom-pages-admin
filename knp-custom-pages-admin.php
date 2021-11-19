<?php
/**
 * Plugin Name: KNP Custom Pages Admin
 * Description: Custom Pages admin menu
 * Version: 0.1.0
 * Author: Alex Knopp
 */

//Some security
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Alter the admin menu. Clean it up and add a custom pages menu item
 */
function knp_admin_menu(){

    //The role we are targeting
    $role = 'editor';
    
    //Check targeted role against current user
    $user = wp_get_current_user();
    if($user->roles[0] !== $role){
        return;
    }

    //Add a new menu item for custom page list
    add_menu_page('Pages', 'Pages', 'edit_pages', 'edit-pages', 'knp_pages_content');

    //Clean up the admin by removing some of the pages
    remove_menu_page( 'index.php' );                  //Dashboard
    remove_menu_page( 'edit.php?post_type=page' );    //Pages
    remove_menu_page( 'edit-comments.php' );          //Comments
    remove_menu_page( 'themes.php' );                 //Appearance
    remove_menu_page( 'plugins.php' );                //Plugins
    remove_menu_page( 'users.php' );                  //Users
    remove_menu_page( 'tools.php' );                  //Tools
    remove_menu_page( 'options-general.php' );        //Settings

}
add_action( 'admin_menu', 'knp_admin_menu' );

/**
 * The content for the custom page 
 */
function knp_pages_content(){

    $pages_query = get_posts([

        //This is where you add the ID's of the pages you want to show.
        //Delete the numbers and add your own comma seperated list of 
        //numbers between the brackets.
        'post__in' => [ 123 , 456 , 789 , 654 , 321 ],

        //Leave the rest as is
        'post_type' => 'page',
        'orderby' => 'ID',          
        'post_status' => array('publish'),
        'posts_per_page' => -1,
        'orderby'          => 'date',
        'order'            => 'DESC'

    ]); ?>

    <style type="text/css">
        .pages-container table {
            display: block;
            width: 100%;
            padding: 10px;
            text-align: left;
            border-collapse: collapse;
        }

        .pages-container {
            width: 90%;
            display: block;
            margin: 20px 0;
        }

        thead {}

        .pages-container table tr {
            border-bottom: 1px solid;
            width: 100%;
        }

        .pages-container table td {
            padding-right: 20px;
            padding-top: 5px;
            padding-bottom: 5px;
        }
    </style>

    <div class="pages-container">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Date (last modified)</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pages_query as $key => $page) { ?>
                    
                    <tr>
                        <td><?php echo $page->post_title; ?></td>
                        <td><?php echo $page->post_modified; ?></td>
                        <td><?php echo $page->post_status ?></td>
                        <td><a href="<?php echo get_site_url(); ?>/wp-admin/post.php?post=<?php echo $page->ID; ?>&action=edit">Edit Page</a></td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>      

<?php }