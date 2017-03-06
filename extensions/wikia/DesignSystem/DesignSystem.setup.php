<?php
/**
 * Design System Extension
 */

$wgExtensionCredits['api'][] = [
	'name' => 'Design System',
	'descriptionmsg' => 'design-system-desc',
	'version' => 1.0,
	'url' => 'https://github.com/Wikia/app/tree/dev/extensions/wikia/DesignSystem'
];

// i18n
$wgExtensionMessagesFiles['DesignSystem'] = __DIR__ . '/DesignSystem.i18n.php';

// services
$wgAutoloadClasses[ 'DesignSystemGlobalFooterService' ] = __DIR__ . '/services/DesignSystemGlobalFooterService.class.php';
$wgAutoloadClasses[ 'DesignSystemGlobalNavigationService' ] = __DIR__ . '/services/DesignSystemGlobalNavigationService.class.php';
$wgAutoloadClasses[ 'DesignSystemGlobalNavigationWallNotificationsService' ] = __DIR__ . '/services/DesignSystemGlobalNavigationWallNotificationsService.class.php';

// helpers
$wgAutoloadClasses[ 'DesignSystemHelper' ] = __DIR__ . '/DesignSystemHelper.class.php';
$wgAutoloadClasses[ 'DesignSystemHooks' ] = __DIR__ . '/DesignSystemHooks.class.php';

// hooks
$wgHooks[ 'BeforePageDisplay' ][] = 'DesignSystemHooks::onBeforePageDisplay';
$wgHooks[ 'WikiaSkinTopScripts' ][] = 'addJsVariables';

/**
 * MW1.19 - ResourceLoaderStartUpModule class adds more variables
 * @param array $vars JS variables to be added at the bottom of the page
 * @param OutputPage $out
 * @return bool return true - it's a hook
 */
function addJsVariables( Array &$vars, &$scripts ) {
	wfProfileIn( __METHOD__ );

	$vars[ 'wgOnSiteNotificationsApiUrl' ] = F::app()->wg->OnSiteNotificationsApiUrl;

	wfProfileOut( __METHOD__ );

	return true;
}
