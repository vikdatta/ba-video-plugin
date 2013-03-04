<?php
add_action( 'admin_footer', 'idealien_mediaDefault_script' );
add_action( 'admin_footer-post.php', 'idealien_mediaDefault_script' );

function idealien_mediaDefault_script()
{
    ?>
<script type="text/javascript">
jQuery(document).ready(function($){
wp.media.controller.Library.prototype.defaults.contentUserSetting=false;
});
</script>

add_image_size('thmb',50,50,TRUE);

<?php } ?>