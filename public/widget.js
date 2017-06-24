!function (Brickrouge) {

	const SearchCombo = new Class ({

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

	Brickrouge.register('SearchCombo', (element, options) => SearchCombo(element, options))

} (Brickrouge);
