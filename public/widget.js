!function (Brickrouge) {

	Brickrouge.Widget.SearchCombo = new Class ({

		initialize: function(el, options)
		{
			this.element = el
			this.element.getChildren().addEvents ({

				focus: function()
				{
					el.classList.add('focus')
				},

				blur: function()
				{
					el.classList.remove('focus')
				}

			});
		}

	})

	Brickrouge.register('SearchCombo', function (element, options) {

		return new Brickrouge.Widget.SearchCombo(element, options)

	})

} (Brickrouge);
