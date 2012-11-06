jQuery(function($) {
	var popup;
	
	$.fn.oauth = function(options) {
		options = $.extend({
			id: '',
			name: "Oauth",
			popup: {
				width: 450,
				height: 380
			}
		}, options);
		
		return this.each(function() {
			var $th = $(this);
			$th.click(function() {
				if (popup !== undefined)
					popup.close();

				var redirect_uri, url = redirect_uri = this.href;
				var centerWidth = ($(window).width() - options.popup.width) / 2;
				var centerHeight = ($(window).height() - options.popup.height) / 2;
				popup = window.open(url, options.name, "width=" + options.popup.width + ",height=" + options.popup.height + ",left=" + centerWidth + ",top=" + centerHeight + ",resizable=yes,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=yes");
				popup.focus();
				return false;
			});
		});
	};
});