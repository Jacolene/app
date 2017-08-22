require([
	'jquery',
	'wikia.window',
	'wikia.log',
	'ext.wikia.recirculation.utils',
	'ext.wikia.recirculation.views.mixedFooter',
	'ext.wikia.recirculation.helpers.liftigniter',
	'ext.wikia.recirculation.helpers.discussions',
	'ext.wikia.recirculation.discussions',
	require.optional('videosmodule.controllers.rail')
], function ($,
             window,
             log,
             utils,
             mixedFooter,
             liftigniter,
             discussions,
             oldDiscussions,
             videosModule) {
	'use strict';

	var $mixedContentFooter = $('#mixed-content-footer'),
		$mixedContentFooterContent = $('.mcf-content'),
		railRecirculation = {
			max: 5,
			widget: 'wikia-rail',
			width: 320,
			height: 180,
			modelName: 'ns',
			opts: {
				resultType: 'cross-domain',
				domainType: 'fandom.wikia.com'
			}
		},
		mixedContentFooter = {
			nsItems: {
				max: $mixedContentFooter.data('number-of-ns-articles'),
				widget: 'wikia-impactfooter',
				width: 386,
				height: 337,
				modelName: 'ns',
				opts: {
					resultType: 'cross-domain',
					domainType: 'fandom.wikia.com'
				}
			},
			wikiItems: {
				max: $mixedContentFooter.data('number-of-wiki-articles'),
				widget: 'wikia-footer-wiki-rec',
				width: 386,
				height: 337,
				modelName: 'wiki',
				opts: {
					rule_language : window.wgContentLanguage
				}
			}
		};

	if (window.wgContentLanguage !== 'en') {
		if (videosModule) {
			videosModule('#recirculation-rail');
		}
		oldDiscussions();
		return;
	}

	// prepare & render right rail recirculation module
	liftigniter.prepare(railRecirculation).done(function (data) {
		require(['ext.wikia.recirculation.views.premiumRail'], function (viewFactory) {
			viewFactory().render(data);
		});
	});

	// prepare & render mixed content footer module
	var mixedContentFooterData = [
		liftigniter.prepare(mixedContentFooter.nsItems),
		liftigniter.prepare(mixedContentFooter.wikiItems),
		discussions.prepare()
	];
	$.when.apply($, mixedContentFooterData).done(function (nsItems, wikiItems, discussions) {
		$mixedContentFooterContent.show();
		require(['ext.wikia.recirculation.views.mixedFooter'], function (viewFactory) {
			viewFactory().render({
				nsItems: nsItems,
				wikiItems: wikiItems,
				discussions: discussions
			});
		});
	});

	// fetch data for all recirculation modules
	liftigniter.fetch('ns');

	var lazyLoadHandler = $.throttle(50, function () {
			var mcfOffset = $mixedContentFooter.offset().top,
				scrollPosition = $(window).scrollTop(),
				windowInnerHeight = $(window).height(),
				lazyLoadOffset = 500,
				aproachingMCF = scrollPosition > mcfOffset - windowInnerHeight - lazyLoadOffset;

			if (aproachingMCF) {
				liftigniter.fetch('wiki');
				discussions.fetch();
				window.removeEventListener('scroll', lazyLoadHandler);

			}
	});

	window.addEventListener('scroll', lazyLoadHandler);


	// TODO handle errors
	// TODO LI tracking
});
