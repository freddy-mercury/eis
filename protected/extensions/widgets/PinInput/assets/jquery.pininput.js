;(function($) {
jQuery.fn.pininput = function(options) {
	var settings = jQuery.extend({ }, options);
	return this.each(function(settings) {
		var source_input = $(this);
		var max_length = source_input.attr('maxlength');
		var pin_buttons = $('<div class="pi_container"></div>');
		source_input.after(pin_buttons);
		source_input.attr('readonly', 'on');
		for (var i = 9; i >= 0; i--) {
		   pin_buttons.prepend('<input type="button" class="pi_num" value="'+i+'" /> ');
		   if (i == 5) {
			   pin_buttons.prepend('<br/>');
		   }
		}
		$('input.pi_num', pin_buttons).bind('click', function() {
			var val = source_input.val();
			if (val.length < max_length) {
				source_input.val(val + $(this).val());
			}
		})
		var reset_button = $('<input type="button" class="pi_reset" value="reset" />');
		source_input.after(reset_button);
		reset_button.bind('click', function() {
			source_input.val('');
		})
	})
};
})(jQuery);
