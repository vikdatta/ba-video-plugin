<form name="post" method="post" enctype="multipart/form-data">
    <div class="wrap"><div  align="center"><h1></h1></div>
        <div id="poststuff">
            <div id="post-body">

                <div class="postbox" style="width:70%; float: left;">
                    <div class="inside"><div align="center"><h3>Add a New Video </h3></div>
                        <table class="form-table">
                            <tbody>
                                <tr style="border-top:1px solid #eeeeee;">
                                    <th width="25%"><h4>Video Title:&nbsp;</h4></th><td width="75%"><input type="text" name="title" size="30" tabindex="1" value="<?php echo htmlspecialchars($_POST['title']); ?>" id="title" style="width: 98%;"/></td>
                            </tr>                   
                            <tr style="border-top:1px solid #eeeeee;">
                                <th width="25%"><h4>Video Description:</h4></th><td><textarea id="description" tabindex="2" name="description" cols="40" rows="4" style="width:98% ;"/><?php echo htmlspecialchars($_POST['description']); ?></textarea></td>
                            </tr>





                            <tr style="border-top:1px solid #eeeeee;">
                                <th width="25%"><h4>Duration: </h4></th><td> <input type="text" name="time" size="30" tabindex="3" value="<?php echo htmlspecialchars($_POST['time']); ?>" id="time"  style="width:98% ;"/><br /><b><font color="grey"><small>Enter the time in seconds.</small></font></b>
                            </td></tr>
                            <tr style="border-top:1px solid #eeeeee;">
                                <th width="25%">

                                   

                            <h4>Thumbnail URL: <br /></h4></th><td>
                            
                            
                             <input type="radio" name="option" value="url" /><label>url</label>
                                    <input type="radio" name="option" value="upload" checked/><label>upload</label><br />
                            
                            <input class="upload" type="file" name="thumb"  tabindex="4"  id="thumb" />

                                <input hidden disabled="disabled" type="text" class="url" name="thumb" size="30" tabindex="6" value="<?php echo get_post_meta($_GET['id'], "videoswiper-embed-thumb", TRUE); ?>" id="thumb"  style="width: 98%; display:none;"/><br /><b><font color="grey"><small>Upload thumbnail or enter a URL.</small></font></b>
                            </td></tr>
                            <tr style="border-top:1px solid #eeeeee;">
                                <th width="25%"><h4>Embed Code: <br /></h4></th><td><textarea id="embed" tabindex="5" name="embed" cols="40" rows="4" style="width: 98%;"/><?php echo stripslashes(htmlspecialchars($_POST['embed'])); ?></textarea><br /><b><font color="grey"><small>Remember to adjust the embed player size to match your theme!</small></font></b></td>
                            </tr></tbody></table> 
                    </div>
                </div>

                <div class="postbox" style="width:28%; float: right;"><h3>Categories:</h3>
                    <div class="inside" style="margin-left:10px;">
                        <?php
//
//wp_dropdown_categories(array('show_option_none'=>'Select category', 'hide_empty' => 0, 'name' => 'category', 'orderby' => 'id', 'hierarchical' => 1, 'tab_index' => 3)); 
?>         <?php
    //echo "here";

        $taxonomy = 'category';
	
        global $post;
	$box=array('taxonomy' => 'category');
	$defaults = array('taxonomy' => 'category');
	if ( !isset($box['args']) || !is_array($box['args']) )
		$args = array();
	else
		$args = $box['args'];
	extract( wp_parse_args($args, $defaults), EXTR_SKIP );
	$tax = get_taxonomy($taxonomy);

	?>
	<div id="taxonomy-<?php echo $taxonomy; ?>" class="categorydiv">
		<ul id="<?php echo $taxonomy; ?>-tabs" class="category-tabs">
			<li class="tabs"><a href="#<?php echo $taxonomy; ?>-all" tabindex="3"><?php echo $tax->labels->all_items; ?></a></li>
			<li class="hide-if-no-js"><a href="#<?php echo $taxonomy; ?>-pop" tabindex="3"><?php _e( 'Most Used' ); ?></a></li>
		</ul>

		<div id="<?php echo $taxonomy; ?>-pop" class="tabs-panel" style="display: none;">
			<ul id="<?php echo $taxonomy; ?>checklist-pop" class="categorychecklist form-no-clear" >
				<?php $popular_ids = wp_list_categories('number=5&show_count=1&orderby=count&order=DESC&title_li='); //$popular_ids = wp_popular_terms_checklist($taxonomy); ?>
			</ul>
		</div>

		<div id="<?php echo $taxonomy; ?>-all" class="tabs-panel">
			<?php
            $name = ( $taxonomy == 'category' ) ? 'post_category' : 'tax_input[' . $taxonomy . ']';
            echo "<input type='hidden' name='{$name}[]' value='0' />"; // Allows for an empty term set to be sent. 0 is an invalid Term ID and will be ignored by empty() checks.
            ?>
			<ul id="<?php echo $taxonomy; ?>checklist" class="list:<?php echo $taxonomy?> categorychecklist form-no-clear">
				<?php wp_category_checklist();//wp_terms_checklist($post->ID, array( 'taxonomy' => $taxonomy, 'popular_cats' => $popular_ids ) ) ?>
			</ul>
		</div>
	
	</div>
	<?php
 ?>
                                    
                    </div> </div>
                <div class="postbox" style="width:28%; float: right;"><h3>Tags:</h3>
                    <div class="inside">
                        <table><tbody><tr style="border-top:1px solid #eeeeee;">
                                    <td><input type="text" name="tags" size="30" tabindex="6" value="<?php echo htmlspecialchars($_POST['tags']); ?>" id="tags"  style="width: ;"/><br /><b><font color="grey"><small>Separated by comma's</small></font></b>
                                    </td></tr></tbody></table>
                    </div> </div>

            </div>
   
        </div>
    </div>

    <input type="hidden" name="submit" value="Submit Video">
    <div align="center"><input type="submit" name="submit" value="Submit Video"></div>

</form>
