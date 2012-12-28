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
                                    <textarea id="description" tabindex="2" name="description" cols="40" rows="2" style="width: 98%;"><?php
    $con = get_post($_GET['id']);
    $des = $con->post_content;
    echo $des;
    ?></textarea></td></tr>






                                <tr style="border-top:1px solid #eeeeee;">
                                    <th width="25%"><h4>Duration: <small>Enter the time in seconds.</small> </h4></th><td>

                                    <input type="text" name="time" size="30" tabindex="5" value="<?php echo get_post_meta($_GET['id'], "videoswiper-embed-time", TRUE); ?>" id="time"/></td></tr>

                                <tr style="border-top:1px solid #eeeeee;">


                                    <th width="25%">

                                        <?php
                                        $url_thumb = get_post_meta($_GET['id'], "videoswiper-embed-thumb", TRUE);
                                        if (!(empty($url_thumb))) {
                                            ?>

                                            <input type="radio" name="option" value="url" checked/><label>url</label>
                                            <input type="radio" name="option" value="upload"/><label>upload</label>
                                    <h4>Thumbnail URL: <br /><small>To keep the current Thumbnail leave this field empty.</small></h4></th><td><input class="upload" hidden disabled="disabled" type="file" name="thumb"  tabindex="4"  id="thumb" />

                                        <input type="text" class="url" name="thumb" size="30" tabindex="6" value="<?php echo get_post_meta($_GET['id'], "videoswiper-embed-thumb", TRUE); ?>" id="thumb"  style="width: 98%; "/>

                                        <br /><b>Current thumbnail :</b><br />
                                        <img src="<?php echo $url_thumb ?>"  height="180" width="320"></img></td>
                                    </tr>
                                <?php } else {
                                    ?>

                                    <input type="radio" name="option" value="url" /><label>url</label>
                                    <input type="radio" name="option" value="upload" checked/><label>upload</label>
                                    <h4>Thumbnail URL: <br /><small>To keep the current Thumbnail leave this field empty.</small></h4></th><td><input class="upload" type="file" name="thumb"  tabindex="4"  id="thumb" />

                                        <input disabled="disabled" type="text" class="url" name="thumb" size="30" tabindex="6" value="<?php echo get_post_meta($_GET['id'], "videoswiper-embed-thumb", TRUE); ?>" id="thumb"  style="display:none;"/>

                                        <br /><b>Current thumbnail :</b><br />
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
                                    <th width="25%"><h4> Embed Code: <small>Remember to adjust the embed player size to match your theme!</small></h4></th><td>
                                    <textarea id="embed" tabindex="7" name="embed" cols="40" rows="2" style="width: 98%;"><?php echo get_post_meta($_GET['id'], "videoswiper-embed-code", TRUE); ?></textarea> </td></tr></tbody></table>


                        </div>
                    </div>
                    <div class="postbox" style="width:28%; float: right;"><h3>Categories:</h3>
                        <div class="inside" style="margin-left:10px;">
                            <table><tbody><tr style="border-top:1px solid #eeeeee;">
                                        <td><?php
    wp_category_checklist($_GET['id']);
    ?></td></tr></tbody></table>
                        </div> </div>

                    <div class="postbox" style="width:28%; float: right;"><h3>Tags:<small>seperated by comma's</small></h3>
                        <div class="inside">
                            <table><tbody><tr style="border-top:1px solid #eeeeee;">
                                        <td><td>

                                            <input type="text" name="tags" size="30" tabindex="4" value="<?php
    $t = wp_get_post_tags($_GET['id']);
    foreach ($t as $v) {
        echo $v->name . ", ";
    }
    ?>" id="tags"  style="width: 98%;"/>
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