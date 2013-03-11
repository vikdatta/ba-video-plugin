<?php
$post_tmp = get_post($_GET['id']);
global $current_user;
$user_id = $post_tmp->post_author;
$current_auth = $current_user->ID;

if (($current_auth == $user_id)||($current_user->caps['administrator']=='1')) {
    ?>
    <form name="post" method="post" enctype="multipart/form-data">
        <div class="wrap">
            <div id="poststuff">
                <div id="post-body">
                    <div class="postbox" style="width:70%; float: left;">
                        <div class="inside"><div align="center"><h3>Edit Video </h3></div>
                            <table class="form-table">
                                <tbody>
                                    <tr style="border-top:1px solid #eeeeee;">
                                        <th width="25%">
                                <h4>Video Title:</h4></th><td><input type="text" name="title" size="30" tabindex="1" value="<?php echo get_the_title($_GET['id']); ?>" id="title"  style="width: 98%;"/></td></tr>

                                <tr style="border-top:1px solid #eeeeee;">
                                    <th width="25%"><h4>Video Description:</h4></th><td>  
                                    <textarea id="description" tabindex="2" name="description" cols="40" rows="4" style="width: 98%;"><?php
    $con = get_post($_GET['id']);
    $des = $con->post_content;
    echo $des;
    ?></textarea></td></tr>






                                <tr style="border-top:1px solid #eeeeee;">
                                    <th width="25%"><h4>Duration: </h4></th><td>

                                <input type="text" name="time" size="30" tabindex="5" value="<?php echo get_post_meta($_GET['id'], "videoswiper-embed-time", TRUE); ?>" id="time"/><br /><b><font color="grey"><small>Enter the time in seconds.</small></font></b></td></tr>

                                <tr style="border-top:1px solid #eeeeee;">


                                    <th width="25%">

                                        <?php
                                        $url_thumb = get_post_meta($_GET['id'], "videoswiper-embed-thumb", TRUE);
                                       // echo $_GET['id'].$url_thumb;
                                        if (!(empty($url_thumb))) {
                                            ?>

                                            
                                    <h4>Thumbnail URL: <br /></h4></th><td>
                                <input type="radio" name="option" value="url" checked/><label>url</label>
                                            <input type="radio" name="option" value="upload"/><label>upload</label><br />
                                
                                <input class="upload" hidden disabled="disabled" type="file" name="thumb"  tabindex="4"  id="thumb" />

                                <input type="text" class="url" name="thumb" size="30" tabindex="6" value="<?php echo get_post_meta($_GET['id'], "videoswiper-embed-thumb", TRUE); ?>" id="thumb"  style="width: 98%; "/><br /><b><font color="grey"><small>To keep the current Thumbnail leave this field empty.</small></font></b>

                                        <br /><br /><b>Current thumbnail :</b><br />
                                        <img src="<?php echo $url_thumb ?>"  height="180" width="320"></img></td>
                                    </tr>
                                <?php } else {
                                    ?>

                                    
                                    <h4>Thumbnail URL: <br /></h4></th>
                                        
                                            <td>
                                                <input type="radio" name="option" value="url" /><label>url</label>
                                    <input type="radio" name="option" value="upload" checked/><label>upload</label><br />
                                                
                                                <input class="upload" type="file" name="thumb"  tabindex="4"  id="thumb" />

                                                <input disabled="disabled" type="text" class="url" name="thumb" size="30" tabindex="6" value="<?php echo get_post_meta($_GET['id'], "videoswiper-embed-thumb", TRUE); ?>" id="thumb"  style="display:none;"/><br /><b><font color="grey"><small>To keep the current Thumbnail leave this field empty.</small></font></b>

                                        <br /><br /><b>Current thumbnail :</b><br />
                                        <?php
                                        $vid->pages = & get_children('numberposts=1&post_mime_type=image/jpeg&post_parent=' . $_GET['id']);
                                        // print_r($pages); 
                                        $pg = $vid->pages;
                                        foreach ($pg as $attachment_id => $attachment) {
                                            //print_r($attachment);
                                            //echo "chhecking here".$attachment->ID;
                                            $vid->link = $attachment->guid;
                                            //echo $link;
                                        }
                                        ?><img src="<?php echo $vid->link ?>"  height="180" width="320"></img></td>
                                    </tr>
    <?php } ?>


                                <tr style="border-top:1px solid #eeeeee;">
                                    <th width="25%"><h4> Embed Code: </h4></th><td>
                                    <textarea id="embed" tabindex="7" name="embed" cols="40" rows="4" style="width: 98%;"><?php echo get_post_meta($_GET['id'], "videoswiper-embed-code", TRUE); ?></textarea><br /><b><font color="grey"><font color="grey"><small>Remember to adjust the embed player size to match your theme!</small></font></b> </td></tr></tbody></table>


                        </div>
                    </div>
                    <div class="postbox" style="width:28%; float: right;"><h3>Categories:</h3>
                        <div class="inside" style="margin-left:10px;">
                            <?php
    //wp_category_checklist($_GET['id']);
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
				<?php wp_category_checklist($_GET['id']);//wp_terms_checklist($post->ID, array( 'taxonomy' => $taxonomy, 'popular_cats' => $popular_ids ) ) ?>
			</ul>
		</div>
	
	</div>
	<?php
 ?>
                                    
                  
                        </div> </div>

                    <div class="postbox" style="width:28%; float: right;"><h3>Tags:</h3>
                        <div class="inside">
                            <table><tbody><tr style="border-top:1px solid #eeeeee;">
                                        <td><td>

                                            <input type="text" name="tags" size="30" tabindex="4" value="<?php
    $t = wp_get_post_tags($_GET['id']);
    foreach ($t as $v) {
        echo $v->name . ", ";
    }
    ?>" id="tags"  style="width: 98%;"/><br /><b><font color="grey"><small>Separated by comma's</small></font></font></b>
                                        </td></tr></tbody></table>
                        </div> </div>

                </div>
            </div>
        </div>
        <input type="hidden" name="editpost" value="UPDATE">
        <div align="center"><input type="submit" name="editpost" value="UPDATE"></div><br />
        <?php if (get_post_status($_GET['id']) == 'draft') { ?>
            <div align="center"><input type="submit" name="publish" value="PUBLISH POST"></div>
        <?php } ?>

    </form>
<?php
}
else
    {?>
<div class="wrap"><h2>&nbsp</h2>                <!-- Success message -->
                    <div class="updated" id="message" style="background-color: rgb(255, 251, 204);">
                        <p><strong>Sorry you are not the author of this video.</strong>
                            
                    </div>
                </div>     <?php } ?>