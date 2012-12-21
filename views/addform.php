
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
                                <th width="25%"><h4>Video Description:</h4></th><td><textarea id="description" tabindex="2" name="description" cols="40" rows="2" style="width:98% ;"/><?php echo htmlspecialchars($_POST['description']); ?></textarea></td>
                            </tr>





                            <tr style="border-top:1px solid #eeeeee;">
                                <th width="25%"><h4>Duration: <small>Enter the time in seconds.</small></h4></th><td> <input type="text" name="time" size="30" tabindex="3" value="<?php echo htmlspecialchars($_POST['time']); ?>" id="time"  style="width: ;"/>
                            </td></tr>
                            <tr style="border-top:1px solid #eeeeee;">
                                <th width="25%">

                                    <input type="radio" name="option" value="url" /><label>url</label>
                                    <input type="radio" name="option" value="upload" checked/><label>upload</label>

                            <h4>Thumbnail URL: <br /><small>Upload thumbnail or enter a URL.</small></h4></th><td><input class="upload" type="file" name="thumb"  tabindex="4"  id="thumb" />

                                <input hidden disabled="disabled" type="text" class="url" name="thumb" size="30" tabindex="6" value="<?php echo get_post_meta($_GET['id'], "videoswiper-embed-thumb", TRUE); ?>" id="thumb"  style="width: 98%;"/>
                            </td></tr>
                            <tr style="border-top:1px solid #eeeeee;">
                                <th width="25%"><h4>Embed Code: <br /><small>Remember to adjust the embed player size to match your theme!</small></h4></th><td><textarea id="embed" tabindex="5" name="embed" cols="40" rows="2" style="width: 98%;"/><?php echo stripslashes(htmlspecialchars($_POST['embed'])); ?></textarea></td>
                            </tr></tbody></table> 
                    </div>
                </div>

                <div class="postbox" style="width:28%; float: right;"><h3>Categories:</h3>
                    <div class="inside" style="margin-left:10px;">
                        <table><tbody><tr style="border-top:1px solid #eeeeee;">
                                    <td><?php
wp_category_checklist();
//wp_dropdown_categories(array('show_option_none'=>'Select category', 'hide_empty' => 0, 'name' => 'category', 'orderby' => 'id', 'hierarchical' => 1, 'tab_index' => 3)); 
?>
                                    </td></tr></tbody></table>
                    </div> </div>
                <div class="postbox" style="width:28%; float: right;"><h3>Tags:<small>seperated by comma's</small></h3>
                    <div class="inside">
                        <table><tbody><tr style="border-top:1px solid #eeeeee;">
                                    <td><input type="text" name="tags" size="30" tabindex="6" value="<?php echo htmlspecialchars($_POST['tags']); ?>" id="tags"  style="width: ;"/>
                                    </td></tr></tbody></table>
                    </div> </div>

            </div>
        </div>
    </div>

    <input type="hidden" name="submit" value="Submit Video">
    <div align="center"><input type="submit" name="submit" value="Submit Video"></div>

</form>
