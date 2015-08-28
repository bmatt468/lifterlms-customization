jQuery(document).ready(function($){
    $('.my-color-field').wpColorPicker();

    $('#enable_advanced_view').live('click', function(event) 
    {
    	event.preventDefault();
    	if ($('#enable_advanced_view').val() === 'Advanced View')
    	{
    		$('#enable_advanced_view').val('Basic View');
    		//$('#advanced_color_content').show();
    		$('#advanced_color_content').show('fast').fadeIn();
    	}
    	else
    	{
    		$('#enable_advanced_view').val('Advanced View');
    		$('#advanced_color_content').hide('fast').fadeOut();
    	}
    });
});