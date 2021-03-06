/**
 * @author Alexander V. Sergeyev <sim.on@ua.fm>
 */

if (typeof RedactorPlugins === 'undefined') var RedactorPlugins = {};

RedactorPlugins.ace = {
	init: function()
	{
		var $redactor = this;
			
		this.buttonRemove('html');
		this.buttonAddFirst('ace', 'Ace editor');
		this.buttonGet('ace')
			.click(
				function(){
					if ($redactor.opts.visual) {
						$redactor.toggleCode(false);

								$redactor.$source
									.before('<div id="ace-editor"></div>')
									.hide();
								$redactor.buttonActive('ace');
								$redactor.$toolbar
									.find('a.re-ace')
									.removeClass('redactor_button_disabled');

								var editor = ace.edit("ace-editor");
								// Settings
								editor.getSession().setMode("ace/mode/html");
								editor.setTheme("ace/theme/monokai");
								editor.getSession().setUseSoftTabs(true);
								editor.getSession().setUseWrapMode(true);
								editor.setShowPrintMargin(false);
								editor.setAutoScrollEditorIntoView(true);
								editor.setOption("maxLines", 30);
								editor.setOption("enableEmmet", true);

								editor.getSession().setValue($redactor.$source.val());
								editor.getSession().on('change', function() {
									$redactor.$source.val(editor.getSession().getValue());
								});

					} else {
						$redactor.toggleVisual();
						$redactor.$box.find('#ace-editor').remove();
						$redactor.buttonInactive('ace');


					}

				}
			);
	}
}