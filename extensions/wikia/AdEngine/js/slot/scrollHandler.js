/*global define*/
define('ext.wikia.adEngine.slot.scrollHandler', [
	'ext.wikia.adEngine.adContext',
	'ext.wikia.adEngine.adHelper',
	'wikia.log',
	'wikia.document',
	'wikia.window'
], function (adContext, adHelper, log, doc, win) {
	'use strict';
	var logGroup = 'ext.wikia.adEngine.slot.scrollHandler',
		isRefreshed = {},
		reloadedView = {},
		context = adContext.getContext(),
		config = context.opts.scrollHandlerConfig || {
			oasis: {
				PREFOOTER_LEFT_BOXAD: {
					reloadedViewMax: 1
				},
				PREFOOTER_RIGHT_BOXAD: {
					reloadedViewMax: 1
				}
			},
			mercury: {
				MOBILE_PREFOOTER: {
					reloadedViewMax: 1
				}
			}
		},
		// 'mercury' value is not set in context.targeting.skin yet
		skin = context.targeting.skin === 'oasis' ? 'oasis' : 'mercury';

	function init() {
		if (context.opts.enableScrollHandler)  {
			config = config[skin];
			prepareSettings();
			registerSlotEvents();
		}
	}

	function prepareSettings() {
		for (var slotName in config) {
			if (config.hasOwnProperty(slotName)) {
				isRefreshed[slotName] = false;
				reloadedView[slotName] = 0;
			}
		}
	}

	function registerSlotEvents() {
		win.addEventListener('scroll', adHelper.throttle(function () {
			log('Scroll event listener has been added', 'debug', logGroup);
			for (var slotName in config) {
				if (config.hasOwnProperty(slotName)) {
					onScroll(slotName);
				}
			}
		}));
	}

	function refreshSlot(slotName) {
		reloadedView[slotName] += 1;
		if (skin === 'oasis') {
			win.adslots2.push([slotName]);
		} else {
			win.Mercury.Modules.Ads.getInstance().pushSlotToQueue(slotName);
		}
	}

	function onScroll(slotName) {
		if (config[slotName].hasOwnProperty('reloadedViewMax') &&
			config[slotName].reloadedViewMax >= 0 &&
			config[slotName].reloadedViewMax <= reloadedView[slotName]) {
			return;
		}

		var status = isReached(doc.getElementById(slotName));
		if (!isRefreshed[slotName] && status) {
			log(['refreshSlot', slotName + ' has been refreshed'], 'debug', logGroup);
			refreshSlot(slotName);
			isRefreshed[slotName] = true;
		} else if (!status) {
			isRefreshed[slotName] = false;
		}
	}

	function isReached(el) {
		return win.innerHeight + win.scrollY >= getTopPos(el);
	}

	function getTopPos(el) {
		for (var topPos = 0; el !== null; topPos += el.offsetTop, el = el.offsetParent);
		return topPos;
	}

	function getReloadedViewCount(slotName) {
		if (reloadedView.hasOwnProperty(slotName)) {
			return reloadedView[slotName];
		}

		return null;
	}

	adContext.addCallback(function () {
		prepareSettings();
	});

	return {
		init: init,
		getReloadedViewCount: getReloadedViewCount
	};
});
