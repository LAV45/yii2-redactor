/**
 * @author Alexander V. Sergeyev <sim.on@ua.fm>
 */

if (typeof RedactorPlugins === 'undefined') var RedactorPlugins = {};

RedactorPlugins.ace = {
	init: function()
	{
		this.buttonRemove('html');
		this.buttonAddFirst('ace', 'Ace editor', this.initAce);
		$('.re-ace').removeClass('re-ace').addClass('re-html');
	},
	initAce: function()
	{

	}
}