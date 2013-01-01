jQuery(function(){
    jQuery("#title").validate({
        expression: "if (VAL.match(/([^\s])/)) return true; else return false;",
        message: "Enter a title"
    });
    jQuery("#time").validate({
        expression: "if (VAL.match(/^[0-9]+$/)) return true; else return false;",
        message: "Enter time as a number"
    });
    jQuery("#embed").validate({
        expression: "if (VAL.match(/(<iframe.+?[<\/iframe>])$/)) return true; else return false;",
        message: "Enter correct embed code"
    });
    jQuery("#thumb").validate({
        
    });
       
     jQuery("td input").change(function(){
            var option=jQuery(this).val(); 
    
            if(option=='url')
            {
                jQuery('.url').removeAttr('disabled');
                jQuery('.upload').hide();
                jQuery('.upload').attr('disabled','disabled');
                jQuery('.url').show();
            }
            if(option=='upload')
            {
                jQuery('.upload').removeAttr('disabled');
                jQuery('.url').hide();
                jQuery('.url').attr('disabled','disabled');
                jQuery('.upload').show();
            }
    
        })
   });
        
        ////////////////////////// new js //////////////////
        
        
        
        
        
      jQuery(document).ready( function(jQuery) {
          
          
          
          /////////////////////////////////////////////////////////////
          
          
          
          
          
          //////////////////////////////////////////////////////////

	var newCat, noSyncChecks = false, syncChecks, catAddAfter;

	jQuery('#link_name').focus();
	// postboxes
	//postboxes.add_postbox_toggles('link');

	// category tabs
        
        function getAllUserSettings() {
	if ( 'object' !== typeof userSettings )
		return {};

	return wpCookies.getHash('wp-settings-' + userSettings.uid) || {};
}
        
        
            function getUserSetting( name, def ) {
	var obj = getAllUserSettings();

	if ( obj.hasOwnProperty(name) )
		return obj[name];

	if ( typeof def != 'undefined' )
		return def;

	return '';
}
        
	jQuery('#category-tabs a').click(function(){
		var t = jQuery(this).attr('href');
		jQuery(this).parent().addClass('tabs').siblings('li').removeClass('tabs');
		jQuery('.tabs-panel').hide();
		jQuery(t).show();
		if ( '#categories-all' == t )
			deleteUserSetting('cats');
		else
			setUserSetting('cats','pop');
		return false;
	});
	if ( getUserSetting('cats') )
		jQuery('#category-tabs a[href="#categories-pop"]').click();

	// Ajax Cat
	newCat = jQuery('#newcat').one( 'focus', function() { jQuery(this).val( '' ).removeClass( 'form-input-tip' ) } );
	jQuery('#link-category-add-submit').click( function() { newCat.focus(); } );
	syncChecks = function() {
		if ( noSyncChecks )
			return;
		noSyncChecks = true;
		var th = jQuery(this), c = th.is(':checked'), id = th.val().toString();
		jQuery('#in-link-category-' + id + ', #in-popular-category-' + id).prop( 'checked', c );
		noSyncChecks = false;
	};

	catAddAfter = function( r, s ) {
		jQuery(s.what + ' response_data', r).each( function() {
			var t = jQuery(jQuery(this).text());
			t.find( 'label' ).each( function() {
				var th = jQuery(this), val = th.find('input').val(), id = th.find('input')[0].id, name = jQuery.trim( th.text() ), o;
				jQuery('#' + id).change( syncChecks );
				o = jQuery( '<option value="' +  parseInt( val, 10 ) + '"></option>' ).text( name );
			} );
		} );
	};
  /*      jQuery.fn.wpList = function( settings ) {
	this.each( function() {
		var _this = this;
		this.wpList = { settings: jQuery.extend( {}, wpList.settings, { what: wpList.parseClass(this,'list')[1] || '' }, settings ) };
		jQuery.each( fs, function(i,f) { _this.wpList[i] = function( e, s ) { return wpList[f].call( _this, e, s ); }; } );
	} );
	wpList.init.call(this);
	this.wpList.process();
	return this;
}; 
        
        jQuery('#categorychecklist').wpList( {
		alt: '',
		what: 'link-category',
		response: 'category-ajax-response',
		addAfter: catAddAfter
	} );
   */

	jQuery('a[href="#categories-all"]').click(function(){deleteUserSetting('cats');});
	jQuery('a[href="#categories-pop"]').click(function(){setUserSetting('cats','pop');});
	if ( 'pop' == getUserSetting('cats') )
		jQuery('a[href="#categories-pop"]').click();

	jQuery('#category-add-toggle').click( function() {
		jQuery(this).parents('div:first').toggleClass( 'wp-hidden-children' );
		jQuery('#category-tabs a[href="#categories-all"]').click();
		jQuery('#newcategory').focus();
		return false;
	} );

	jQuery('.categorychecklist :checkbox').change( syncChecks ).filter( ':checked' ).change();
});

