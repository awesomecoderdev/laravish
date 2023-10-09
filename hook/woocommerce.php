<?php

add_filter ( 'woocommerce_account_menu_items', 'user_menu_one_more_link' );
if(!function_exists("user_menu_one_more_link")){
    function user_menu_one_more_link( $menu_links ){

        // we will hook "anyuniquetext123" later
        $newKeyValue = array( '../tags' => __('Manage FAS-IDs') );

        // or in case you need 2 links
        // $new = array( 'link1' => 'Link 1', 'link2' => 'Link 2' );

        // array_slice() is good when you want to add an element between the other ones
        // see also https://stackoverflow.com/questions/3353745/how-to-insert-element-into-arrays-at-specific-position
        $menu_links = array_slice( $menu_links, 0, 1, true )
            + $newKeyValue
            + array_slice( $menu_links, 1, NULL, true );

        return $menu_links;

    }
}