<?php
	
    function mega_menu(){
       $stup_id = 206;
       $args = array(
                    'type'                     => 'post',
                    'child_of'                 => 0,
                    'orderby'                  => 'name',
                    'order'                    => 'ASC',
                    'hide_empty'               => false,
                    'include_last_update_time' => false,
                    'hierarchical'             => 1,                    
                    'pad_counts'               => false,
					'exclude' 				   => $stup_id
                    );
       
        $categories = get_categories($args);
        foreach ($categories as $cat) {
            if($cat->parent==0){
                echo "<li><a href='".get_category_link($cat->cat_ID)."'>".$cat->cat_name."</a></li>";    
            }/*else{
                echo '&nbsp;&nbsp;--- '.$cat->cat_name.' ('.$cat->category_count.')<br/>';
            }*/
            
            
        }
        
    }
	
	function startup_menu(){
        
	   $stup_id = 206;
       $args = array(
                    'type'                     => 'post',
                    'child_of'                 => $stup_id,
                    'orderby'                  => 'name',
                    'order'                    => 'ASC',
                    'hide_empty'               => false,
                    'include_last_update_time' => false,
                    'hierarchical'             => 1,                    
                    'pad_counts'               => false
                    );
       
        $categories = get_categories($args);
		if( ! $categories){
			echo '<li style="font-size: .8em">Currently not available</li>';
		}else{
			foreach ($categories as $cat) {
				echo "<li><a href='".get_category_link($cat->cat_ID)."'>".$cat->cat_name."</a></li>";
            }
        }
	}
?>