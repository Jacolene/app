<?php
$wgExtensionMessagesFiles['ArticleVideo'] = __DIR__ . '/ArticleVideo.i18n.php';
$wgAutoloadClasses['ArticleVideoContext'] = __DIR__ . '/ArticleVideoContext.class.php';
$wgAutoloadClasses['ArticleVideoHooks'] = __DIR__ . '/ArticleVideo.hooks.php';
$wgAutoloadClasses['ArticleVideoController'] = __DIR__ . '/ArticleVideoController.class.php';
$wgAutoloadClasses['ArticleVideoInternalController'] = __DIR__ . '/ArticleVideoInternalController.php';

$wgHooks['BeforePageDisplay'][] = 'ArticleVideoHooks::onBeforePageDisplay';
$wgHooks['GetPreferences'][] = '\ArticleVideoHooks::onGetPreferences';
$wgHooks['MakeGlobalVariablesScript'][] = 'ArticleVideoHooks::onMakeGlobalVariablesScript';

$wgResourceModules['ext.ArticleVideo.jw'] = [
	'scripts' => [
		'skins/oasis/js/jwplayer/node_modules/jwplayer-fandom/dist/wikiajwplayer.js',
		'extensions/wikia/ArticleVideo/scripts/featured-video.jwplayer.autoplay.js',
		'extensions/wikia/ArticleVideo/scripts/featured-video.cookies.js',
		'extensions/wikia/ArticleVideo/scripts/featured-video.jwplayer.session.js',
		'extensions/wikia/ArticleVideo/scripts/featured-video.jwplayer.instant.js',
	],
];

$wgExtensionFunctions[] = function () {
	JSMessages::registerPackage( 'ArticleVideo', [
		'articlevideo-attribution-from',
	] );
};

JSMessages::enqueuePackage( 'ArticleVideo', JSMessages::EXTERNAL );
