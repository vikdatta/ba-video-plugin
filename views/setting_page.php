<?php if(isset($_POST['save'])){
   ?> <div class="wrap"><h2>&nbsp</h2>                <!-- Success message -->
                    <div class="updated" id="message" style="background-color: rgb(255, 251, 204);">
                        <p><strong>Settings saved successfully.</strong>
                         
                    </div>
                </div>    <?php
} ?>
<form method="post" name="setting">
    <table class="form-table" style="width:70%">
        <thead>
            <tr>
        <th style="width:25%">
            Default Post Status : 
        </th>
        <td> 
            <?php if(get_option('status')=='publish')
            {?>
            <input type="radio" name="poststatus" value="publish" checked/><label>Publish</label>
               <input type="radio" name="poststatus" value="draft"/><label>Draft</label></td>
            </tr> <?php } 
            if(get_option('status')=='draft')
                { ?>
            <input type="radio" name="poststatus" value="publish"/><label>Publish</label>
               <input type="radio" name="poststatus" value="draft" checked/><label>Draft</label></td>
            </tr> <?php } ?>
            <tr>
                <th>
                    Mail Admin about new posts :
                </th>
                <td> 
                     <?php if(get_option('mail')=='no')
                     { ?>
                    <input type="radio" name="mailoption" value="no" checked/><label>No</label>
               <input type="radio" name="mailoption" value="yes"/><label>Yes</label></td>
            </tr><?php }
            if(get_option('mail')=='yes')
            { ?>
             <input type="radio" name="mailoption" value="no"/><label>No</label>
               <input type="radio" name="mailoption" value="yes" checked/><label>Yes</label></td>
        </tr> <?php } ?>
        
         </thead>
    </table>
   <input type="hidden" name="save" value="save"><br />
    <div style="padding-left: 421px;"><input type="submit" name="save" value="SAVE SETTINGS"></div>
    
       
</form>