<?php 

// namespaces
define( "NS_WIKIA_FORUM_BOARD", 2000 );
define( "NS_WIKIA_FORUM_BOARD_THREAD", 2001 );
define( "NS_WIKIA_FORUM_TOPIC_BOARD", 2002 );


$wgExtensionNamespacesFiles['Forum'] = __DIR__ . '/Forum.namespaces.php';
wfLoadExtensionNamespaces( 'Forum', array( NS_WIKIA_FORUM_BOARD, NS_WIKIA_FORUM_BOARD_THREAD, NS_WIKIA_FORUM_TOPIC_BOARD ) );

//add this namespace to list of wall namespaces
$app->registerNamespaceControler( NS_WIKIA_FORUM_BOARD, 'ForumController', 'board',  true);
$app->registerNamespaceControler( NS_WIKIA_FORUM_TOPIC_BOARD, 'ForumController', 'board',  true);

$wgWallNS[] = NS_WIKIA_FORUM_BOARD;
$wgWallNotifyEveryoneNS[] = NS_WIKIA_FORUM_BOARD;
$wgWallVotesNS[] = NS_WIKIA_FORUM_BOARD;
$wgWallThreadCloseNS[] = NS_WIKIA_FORUM_BOARD;
$wgWallTopicsNS[] = NS_WIKIA_FORUM_BOARD;