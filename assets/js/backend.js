jQuery(document).ready(function($){
    if ($('#advanced_mode').val() == '0')
    {
    	$('#advanced_color_content').hide();
    }
    else if ($('#advanced_mode').val() == '1')
    {
		$('#enable_advanced_view').val('Basic View');
		$('#advanced_color_content').show('fast').fadeIn();
		$('#wpbody-content > div.wrap > form > table > tbody > tr:nth-child(2)').hide('fast').fadeOut();
		$('#wpbody-content > div.wrap > form > table > tbody > tr:nth-child(3)').hide('fast').fadeOut();
    }

    var myOptions = {
	    change: function(event, ui)
	    {
	    	$('#theme_select').val('custom');

	    	if (event['target']['id'] == 'primary-master')
	    	{	    		
	    		var color = event['target']['parentElement']['parentElement']['children'][0]['style']['backgroundColor'];

	    		$('.primary-color').val($(this).val());
	    		$('#advanced_color_content > table:nth-child(3) > tbody > tr:nth-child(1) > td > div.wp-picker-container > a').css('background-color',color);
				$('#advanced_color_content > table:nth-child(6) > tbody > tr:nth-child(2) > td > div.wp-picker-container > a').css('background-color',color);
				$('#advanced_color_content > table:nth-child(9) > tbody > tr:nth-child(2) > td > div.wp-picker-container > a').css('background-color',color);
				$('#advanced_color_content > table:nth-child(9) > tbody > tr:nth-child(4) > td > div.wp-picker-container > a').css('background-color',color);
				$('#advanced_color_content > table:nth-child(9) > tbody > tr:nth-child(5) > td > div.wp-picker-container > a').css('background-color',color);
	    	}
	    	else if (event['target']['id'] == 'secondary-master')
	    	{
	    		var color = event['target']['parentElement']['parentElement']['children'][0]['style']['backgroundColor'];
	    		
	    		$('.secondary-color').val($(this).val());
	    		$('#advanced_color_content > table:nth-child(3) > tbody > tr:nth-child(2) > td > div.wp-picker-container > a').css('background-color',color);
	    	}
	    }
	};

    $('.my-color-field').wpColorPicker(myOptions);

    $('#enable_advanced_view').live('click', function(event) 
    {
    	event.preventDefault();
    	if ($('#enable_advanced_view').val() === 'Advanced View')
    	{
    		$('#enable_advanced_view').val('Basic View');
    		$('#advanced_color_content').show('fast').fadeIn();
    		$('#wpbody-content > div.wrap > form > table > tbody > tr:nth-child(2)').hide('fast').fadeOut();
    		$('#wpbody-content > div.wrap > form > table > tbody > tr:nth-child(3)').hide('fast').fadeOut();
    		$('#advanced_mode').val('1');
    	}
    	else
    	{
    		$('#enable_advanced_view').val('Advanced View');
    		$('#advanced_color_content').hide('fast').fadeOut();
    		$('#wpbody-content > div.wrap > form > table > tbody > tr:nth-child(2)').show('fast').fadeIn();
    		$('#wpbody-content > div.wrap > form > table > tbody > tr:nth-child(3)').show('fast').fadeIn();
    		$('#advanced_mode').val('0');
    	}
    });

    $('#theme_select').change(function(event) 
    {
    	// Change everything back to default
    	if ($(this).val() === 'default') 
		{
			$('.wp-picker-default').click();
			$('#theme_select').val('default');
		}
		else if ($(this).val() === 'blue')
		{
			$('#llms_customization_form > table > tbody > tr:nth-child(2) > td > div.wp-picker-container > a').css('background-color','rgb(0,127,255)');
			$('#advanced_color_content > table:nth-child(3) > tbody > tr:nth-child(1) > td > div.wp-picker-container > a').css('background-color','rgb(0,127,255)');
			$('#advanced_color_content > table:nth-child(6) > tbody > tr:nth-child(3) > td > div.wp-picker-container > a').css('background-color','rgb(0,127,255)');
			$('#advanced_color_content > table:nth-child(9) > tbody > tr:nth-child(2) > td > div.wp-picker-container > a').css('background-color','rgb(0,127,255)');
			$('#advanced_color_content > table:nth-child(9) > tbody > tr:nth-child(4) > td > div.wp-picker-container > a').css('background-color','rgb(0,127,255)');
			$('#advanced_color_content > table:nth-child(9) > tbody > tr:nth-child(5) > td > div.wp-picker-container > a').css('background-color','rgb(0,127,255)');			

			$('#llms_customization_form > table > tbody > tr:nth-child(3) > td > div.wp-picker-container > a').css('background-color','rgb(0,95,239)');
			$('#advanced_color_content > table:nth-child(3) > tbody > tr:nth-child(3) > td > div.wp-picker-container > a').css('background-color','rgb(0,95,239)');

			$('#advanced_color_content > table:nth-child(3) > tbody > tr:nth-child(2) > td > div.wp-picker-container > a').css('background-color','rgb(254,254,254)');
			$('#advanced_color_content > table:nth-child(3) > tbody > tr:nth-child(4) > td > div.wp-picker-container > a').css('background-color','rgb(254,254,254)');
			$('#advanced_color_content > table:nth-child(6) > tbody > tr:nth-child(2) > td > div.wp-picker-container > a').css('background-color','rgb(254,254,254)');
			$('#advanced_color_content > table:nth-child(6) > tbody > tr:nth-child(4) > td > div.wp-picker-container > a').css('background-color','rgb(254,254,254)');

			$('#advanced_color_content > table:nth-child(6) > tbody > tr:nth-child(1) > td > div.wp-picker-container > a').css('background-color','rgb(51,51,51)');

			$('#advanced_color_content > table:nth-child(9) > tbody > tr:nth-child(1) > td > div.wp-picker-container > a').css('background-color','rgb(204,204,204)');

			$('#advanced_color_content > table:nth-child(9) > tbody > tr:nth-child(3) > td > div.wp-picker-container > a').css('background-color','rgb(241,241,241)');

			$('.primary-color').val('#007fff');
			$('.secondary-color').val('#005fef');
			$('.text-color').val('#fefefe');
			$('.secondary-black').val('#333333');
			$('.incomplete-lesson-icon').val('#CCCCCC');
			$('.progress-bar-base').val('#f1f2f1');
			$('#theme_select').val('blue');
		}
		else if ($(this).val() === 'green')
		{
			$('#llms_customization_form > table > tbody > tr:nth-child(2) > td > div.wp-picker-container > a').css('background-color','rgb(80,200,120)');
			$('#advanced_color_content > table:nth-child(3) > tbody > tr:nth-child(1) > td > div.wp-picker-container > a').css('background-color','rgb(80,200,120)');
			$('#advanced_color_content > table:nth-child(6) > tbody > tr:nth-child(3) > td > div.wp-picker-container > a').css('background-color','rgb(80,200,120)');
			$('#advanced_color_content > table:nth-child(9) > tbody > tr:nth-child(2) > td > div.wp-picker-container > a').css('background-color','rgb(80,200,120)');
			$('#advanced_color_content > table:nth-child(9) > tbody > tr:nth-child(4) > td > div.wp-picker-container > a').css('background-color','rgb(80,200,120)');
			$('#advanced_color_content > table:nth-child(9) > tbody > tr:nth-child(5) > td > div.wp-picker-container > a').css('background-color','rgb(80,200,120)');			

			$('#llms_customization_form > table > tbody > tr:nth-child(3) > td > div.wp-picker-container > a').css('background-color','rgb(31,198,87)');
			$('#advanced_color_content > table:nth-child(3) > tbody > tr:nth-child(3) > td > div.wp-picker-container > a').css('background-color','rgb(31,198,87)');

			$('#advanced_color_content > table:nth-child(3) > tbody > tr:nth-child(2) > td > div.wp-picker-container > a').css('background-color','rgb(254,254,254)');
			$('#advanced_color_content > table:nth-child(3) > tbody > tr:nth-child(4) > td > div.wp-picker-container > a').css('background-color','rgb(254,254,254)');
			$('#advanced_color_content > table:nth-child(6) > tbody > tr:nth-child(2) > td > div.wp-picker-container > a').css('background-color','rgb(254,254,254)');
			$('#advanced_color_content > table:nth-child(6) > tbody > tr:nth-child(4) > td > div.wp-picker-container > a').css('background-color','rgb(254,254,254)');

			$('#advanced_color_content > table:nth-child(6) > tbody > tr:nth-child(1) > td > div.wp-picker-container > a').css('background-color','rgb(51,51,51)');

			$('#advanced_color_content > table:nth-child(9) > tbody > tr:nth-child(1) > td > div.wp-picker-container > a').css('background-color','rgb(204,204,204)');

			$('#advanced_color_content > table:nth-child(9) > tbody > tr:nth-child(3) > td > div.wp-picker-container > a').css('background-color','rgb(241,241,241)');

			$('.primary-color').val('#50c878');
			$('.secondary-color').val('#1fc657');
			$('.text-color').val('#fefefe');
			$('.secondary-black').val('#333333');
			$('.incomplete-lesson-icon').val('#CCCCCC');			
			$('.progress-bar-base').val('#f1f2f1');
			$('#theme_select').val('green');
		}
		else if ($(this).val() === 'orange')
		{
			$('#llms_customization_form > table > tbody > tr:nth-child(2) > td > div.wp-picker-container > a').css('background-color','rgb(255,153,102)');
			$('#advanced_color_content > table:nth-child(3) > tbody > tr:nth-child(1) > td > div.wp-picker-container > a').css('background-color','rgb(255,153,102)');
			$('#advanced_color_content > table:nth-child(6) > tbody > tr:nth-child(3) > td > div.wp-picker-container > a').css('background-color','rgb(255,153,102)');
			$('#advanced_color_content > table:nth-child(9) > tbody > tr:nth-child(2) > td > div.wp-picker-container > a').css('background-color','rgb(255,153,102)');
			$('#advanced_color_content > table:nth-child(9) > tbody > tr:nth-child(4) > td > div.wp-picker-container > a').css('background-color','rgb(255,153,102)');
			$('#advanced_color_content > table:nth-child(9) > tbody > tr:nth-child(5) > td > div.wp-picker-container > a').css('background-color','rgb(255,153,102)');			

			$('#llms_customization_form > table > tbody > tr:nth-child(3) > td > div.wp-picker-container > a').css('background-color','rgb(255,132,71)');
			$('#advanced_color_content > table:nth-child(3) > tbody > tr:nth-child(3) > td > div.wp-picker-container > a').css('background-color','rgb(255,132,71)');

			$('#advanced_color_content > table:nth-child(3) > tbody > tr:nth-child(2) > td > div.wp-picker-container > a').css('background-color','rgb(254,254,254)');
			$('#advanced_color_content > table:nth-child(3) > tbody > tr:nth-child(4) > td > div.wp-picker-container > a').css('background-color','rgb(254,254,254)');
			$('#advanced_color_content > table:nth-child(6) > tbody > tr:nth-child(2) > td > div.wp-picker-container > a').css('background-color','rgb(254,254,254)');
			$('#advanced_color_content > table:nth-child(6) > tbody > tr:nth-child(4) > td > div.wp-picker-container > a').css('background-color','rgb(254,254,254)');

			$('#advanced_color_content > table:nth-child(6) > tbody > tr:nth-child(1) > td > div.wp-picker-container > a').css('background-color','rgb(51,51,51)');

			$('#advanced_color_content > table:nth-child(9) > tbody > tr:nth-child(1) > td > div.wp-picker-container > a').css('background-color','rgb(204,204,204)');
			
			$('#advanced_color_content > table:nth-child(9) > tbody > tr:nth-child(3) > td > div.wp-picker-container > a').css('background-color','rgb(241,241,241)');

			$('.primary-color').val('#ff9966');
			$('.secondary-color').val('#ff8447');
			$('.text-color').val('#fefefe');
			$('.secondary-black').val('#333333');
			$('.incomplete-lesson-icon').val('#CCCCCC');			
			$('.progress-bar-base').val('#f1f2f1');
			$('#theme_select').val('orange');
		}
    });

    $('.my-color-field').change(function(event) 
    {
    	$('#theme_select').val('custom');
    });
});