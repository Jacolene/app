/* jshint ignore:start */ define( 'communitypage.templates.mustache', [], function() { 'use strict'; return {
    "CommunityPageSpecial_index" : '{{{inspectlet}}}{{>pageHeader}}<div class="CommunityPageContainer"><div class="CommunityPageMainContent">{{>callToActionModule}}{{>communityTodoListModule}}</div><div class="community-page-rail">{{>adminsModule}}{{>moderatorsModule}}{{#contributorsModuleEnabled}}{{>contributorsModule}}{{/contributorsModuleEnabled}}{{>recentlyJoinedModule}}{{>helpModule}}</div></div>',"adminsModule" : '<div class="community-page-admins-module community-page-module community-page-module-box">{{#topAdminsData}}{{>topAdmins}}{{/topAdminsData}}</div>',"allAdmins" : '<div class="community-page-all-contributors-legend">{{allAdminsLegend}}</div><ul class="reset top-contributors">{{#allAdminsList}}<li class="community-page-contributors-list-item"><div><div class="badge-container">{{{badge}}}</div><div class="avatar-container"><a data-tracking="all-admins-user-avatar" href="{{profilePage}}">{{{avatar}}}</a></div></div><div class="community-page-contributor-details"><a data-tracking="all-admins-user" href="{{profilePage}}">{{userName}}</a>{{#isAdmin}}<span class="community-page-subtle">{{admin}}</span>{{/isAdmin}}</div><div class="community-page-details">{{timeAgo}}</div></li>{{/allAdminsList}}{{^allAdminsList}}<div class="community-page-zero">{{noAdminText}}<a href="{{noAdminHref}}">{{noAdminContactText}}</a></div>{{/allAdminsList}}</ul>',"allMembers" : '<div class="community-page-all-contributors-legend">{{allContributorsLegend}}</div><ul class="reset top-contributors">{{#members}}<li class ="community-page-contributors-list-item {{#isCurrent}}community-page-current-contributor{{/isCurrent}}"><div><div class="badge-container">{{{badge}}}</div><div class="avatar-container"><a data-tracking="all-members-user-avatar" href="{{profilePage}}">{{{avatar}}}</a></div></div><div class="community-page-contributor-details"><a data-tracking="all-members-user" href="{{profilePage}}">{{userName}}</a>{{#isAdmin}}<span class="community-page-subtle">{{admin}}</span>{{/isAdmin}}</div><div class="community-page-details">{{timeAgo}}</div></li>{{/members}}{{^members}}<div class="community-page-zero">{{noMembersText}}</div>{{/members}}{{#haveMoreMembers}}<li class="community-page-contributors-list-item"><div class="contributor-details"><a href="{{moreMembersLink}}">{{moreMembersText}}</a></div></li>{{/haveMoreMembers}}</ul>',"benefitsModal" : '<a href="#" class="close community-page-benefits-modal-close" title="close">close</a><a href="{{ buttonUrl }}" class="community-page-benefits-modal-area"><section class="community-page-benefits-container" data-track="benefits-image"><img class="community-page-benefits-image" src="{{ benefitsImageUrl }}" /></section><section class="community-page-benefits-content"><section class="community-page-benefits-modal-text"><h2 class="community-page-benefits-modal-main-title" data-track="main-title">{{ mainTitle }}</h2><span class="community-page-benefits-modal-edit-icon" data-track="edit-icon"></span><div class="community-page-benefits-modal-message"><h3 class="community-page-benefits-modal-section-title" data-track="edit-title">{{ editSubtitle }}</h3><p>{{ editText }}</p></div><span class="community-page-benefits-modal-connect-icon" data-track="connect-icon"></span><div class="community-page-benefits-modal-message"><h3 class="community-page-benefits-modal-section-title" data-track="connect-title">{{ connectSubtitle }}</h3><p>{{ connectText }}</p></div><span class="community-page-benefits-modal-search-icon" data-track="explore-icon"></span><div class="community-page-benefits-modal-message"><h3 class="community-page-benefits-modal-section-title" data-track="explore-title">{{ exploreSubtitle }}</h3><p>{{ exploreText }}</p></div></section><section class="community-page-benefits-modal-action-point"><div class="community-page-entry-point-button" data-track="entry-point-button">{{ buttonText }}</div></section></section></a>',"callToActionModule" : '<div class="community-page-cards-module"><div class="community-page-cards-module-header">{{cardModules.heading}}</div><div class="community-page-cards-module-block">{{#cardModules.modules}}{{>cardModule}}{{/cardModules.modules}}{{#defaultModules.modules}}{{>cardModule}}{{/defaultModules.modules}}</div></div>',"cardModule" : '<section class="community-page-card-module" data-tracking="community-page-insights-{{type}}"><div class="community-page-card-module-header"><div class="community-page-card-module-header-icon"><svg width="48" height="48"><use xlink:href="/extensions/wikia/CommunityPage/images/{{{icon}}}.svg#icon"></use></svg></div><span>{{title}}</span></div>{{#description}}<div class="community-page-card-module-description">{{description}}</div>{{/description}}<div class="community-page-card-module-list reset">{{#pages}}<div class="community-page-card-module-list-item"><span class="community-page-card-module-article-data"><a href="{{link.editlink}}" data-tracking="page-link"><span>{{link.text}}</span></a></span></div>{{/pages}}</div><div class="community-page-card-module-footer">{{#helplink}}<div class="community-page-card-module-help"><a href="{{helplink}}">{{{helpicon}}}</a></div>{{/helplink}}{{#fulllistlink}}<a class="community-page-card-module-full-list-link" href="{{fulllistlink}}" data-tracking="view-full-list">{{cardModules.messages.fulllist}}</a>{{/fulllistlink}}{{#actionlink}}<a class="community-page-card-module-full-list-link" href="{{actionlink}}" data-tracking="action-link">{{actiontext}}</a>{{/actionlink}}</div></section>',"communityTodoListModule" : '{{#communityTodoListModule}}{{#showTodoListModule}}<section class="community-page-todo-list-module"><div class="community-page-todo-list-module-header-wrapper"><div class="community-page-todo-list-module-header">{{heading}}</div>{{#showEditLink}}<div class="community-page-todo-list-module-edit"><a data-tracking="community-page-todo-list-module-edit" href="{{editUrl}}" target="_blank">{{{editIcon}}}{{editList}}</a></div>{{/showEditLink}}</div><div class="community-page-todo-list-module-description">{{description}}</div>{{#isZeroState}}<div class="community-page-todo-list-module-zerostate">{{{zeroStateText}}}</div>{{/isZeroState}}{{^isZeroState}}<div class="community-page-todo-list-module-content">{{{data}}}</div>{{/isZeroState}}</section>{{/showTodoListModule}}{{/communityTodoListModule}}',"contributorsModule" : '<div class="community-page-module contributors-module">{{#topContributors}}{{>topContributors}}{{/topContributors}}</div>',"firstEditModal" : '<div class="community-page-header-image"></div><div class="community-page-first-edit-heading">{{heading}}</div><div class="community-page-first-edit-subheading">{{subheading}}</div><div class="community-page-first-edit-getstarted"><a href="{{getStartedLink}}" class="community-page-first-edit-button" data-tracking="first-edit-get-started">{{getStarted}}</a></div><div class="community-page-first-edit-maybelater"><a href="#" id="community-page-first-edit-maybelater-button" data-tracking="first-edit-maybe-later">{{maybeLater}}</a></div>',"helpModule" : '<div class="community-page-help-module community-page-module community-page-module-box"><div class="community-page-module-section-title">{{{helpModule.titleIcon}}}<span class="community-page-help-module-title">{{helpModule.title}}</span></div><div class="community-page-help-module-links"><a data-tracking="help-page-edit-page-link" href="{{helpModule.editPageLink}}">{{helpModule.editPage}}</a><br/><a data-tracking="help-page-add-links-page-link" href="{{helpModule.addLinksPageLink}}">{{helpModule.addLinks}}</a><br/><a data-tracking="help-page-add-new-page-link" href="{{helpModule.addNewPageLink}}">{{helpModule.addNewPage}}</a></div><a data-tracking="help-page-policy-link" class="community-page-policy-link" href="{{helpModule.communityPolicyLink}}">{{{helpModule.communityPolicyIcon}}}<span class="community-page-help-module-policy-title">{{helpModule.communityPolicy}}</span></a></div>',"loadingError" : '<div>{{loadingError}}</div>',"modalHeader" : '<ul class="reset modal-nav"><li class="modal-nav-all"><a data-tracking="modal-tab-all" id="modalTabAll" class="modal-tab-link" href="#">{{allText}} <span id="allCount">{{allMembersCount}}</span></a></li><li class="modal-nav-admins"><a data-tracking="modal-tab-admins" id="modalTabAdmins" class="modal-tab-link" href="#">{{adminsText}} <span id="allAdminsCount">{{allAdminsCount}}</span></a></li>{{#contributorsModuleEnabled}}<li class="modal-nav-leaderboard"><a data-tracking="modal-tab-leaderboard" id="modalTabLeaderboard" class="modal-tab-link" href="#">{{leaderboardText}}</a></li>{{/contributorsModuleEnabled}}</ul>',"modalLoadingScreen" : '<div class="throbber-placeholder"></div>',"moderatorsModule" : '{{#topModeratorsData}}{{#topModeratorsModuleEnabled}}<div class="community-page-module community-page-moderators-module"><section class="community-page-moderators-module-section"><div class="community-page-module-section-title">{{topModeratorsHeaderText}}</div><div class="top-moderators">{{#topModerators}}<div class="community-page-moderators-list-item"><div><div class="badge-container">{{{badge}}}</div><div class="avatar-container"><a data-tracking="top-moderators-user-avatar" href="{{profilePage}}" title="{{userName}}">{{{avatar}}}</a></div></div><div class="community-page-moderator-details"><a data-tracking="top-moderators-user" href="{{profilePage}}">{{userName}}</a></div></div>{{/topModerators}}</div></section></div>{{/topModeratorsModuleEnabled}}{{/topModeratorsData}}',"pageHeader" : '<div class="community-page-header {{#heroImageUrl}}community-page-header-cover" style="background-image: url({{heroImageUrl}});{{/heroImageUrl}}"><div class="community-page-header-content"><div class="community-page-header-welcome-message">{{{headerWelcomeMsg}}}</div><div class="community-page-subheader-welcome-message">{{{subheaderWelcomeMsg}}}</div></div></div>',"recentlyJoined" : '<section class="community-page-contributors-module-section community-page-recently-joined">{{#haveNewMembers}}<div class="community-page-module-section-title">{{recentlyJoinedHeaderText}}</div><div class="community-page-recently-joined-members">{{#members}}<div><div class="badge-container">{{{badge}}}</div><div class="avatar-container"><a data-tracking="recently-joined-user-avatar" href="{{profilePage}}" title="{{userName}}">{{{avatar}}}</a></div></div>{{/members}}</div>{{/haveNewMembers}}</section>',"recentlyJoinedModule" : '<div class="community-page-recently-joined-module community-page-module contributors-module">{{#recentlyJoined}}{{>recentlyJoined}}{{/recentlyJoined}}</div>',"topAdmins" : '<div class="community-page-module-section-title">{{topAdminsHeaderText}}</div><div class="community-page-admins-list reset">{{#topAdminsList}}<div class="community-page-admin-item"><div><div class="badge-container">{{{badge}}}</div><div class="avatar-container"><a data-tracking="top-admins-user-avatar" href="{{profilePage}}" title="{{userName}}">{{{avatar}}}</a></div></div><div class="community-page-contributor-details"><a data-tracking="top-admins-user" href="{{profilePage}}">{{userName}}</a></div></div>{{/topAdminsList}}{{^topAdminsList}}<div class="community-page-zero">{{noAdminText}}<a href="{{noAdminHref}}">{{noAdminContactText}}</a></div>{{/topAdminsList}}</div><div class="community-page-admins-text">{{adminsText}}</div>{{#haveOtherAdmins}}<a id="openModalTopAdmins" class="community-page-admins-view-all" data-tracking="view-all-admins" href="">{{otherAdmins}}</a>{{/haveOtherAdmins}}',"topContributors" : '<section class="community-page-contributors-module-section"><div class="community-page-module-section-title">{{topContributorsHeaderText}}</div><div class="top-contributors">{{#contributors}}<div class="community-page-contributors-list-item"><div><div class="badge-container">{{{badge}}}</div><div class="avatar-container"><a data-tracking="top-contributors-user-avatar" href="{{profilePage}}" title="{{userName}}">{{{avatar}}}</a></div></div><div class="community-page-contributor-rank">{{count}}.</div><div class="community-page-contributor-details"><a data-tracking="top-contributors-user" href="{{profilePage}}">{{userName}}</a><span class="community-page-subtle">{{contributionsText}}</span></div></div>{{/contributors}}{{^contributors}}<div class="community-page-zero">{{noContribsText}}</div>{{/contributors}}</div></section>',"topContributorsModal" : '{{^isAnon}}<div class="user-details"><div><div class="badge-container">{{{userBadge}}}</div><div class="avatar-container">{{{userAvatar}}}</div></div><div class="community-page-rank"><span>{{userRank}} <small>/ {{weeklyEditorCount}}</small></span><span class="community-page-subtle">{{yourRankText}}</span></div><div class="user-contrib-count"><span>{{userContribCount}}</span><span class="community-page-subtle">{{userContributionsText}}</span></div></div>{{/isAnon}}<ul class="reset top-contributors">{{#contributors}}<li class="community-page-contributors-list-item"><div><div class="badge-container">{{{badge}}}</div><div class="avatar-container"><a data-tracking="top-contributors-user-avatar" href="{{profilePage}}">{{{avatar}}}</a></div></div><div class="community-page-contributor-rank">{{count}}.</div><div class="community-page-contributor-details"><a data-tracking="top-contributors-user" href="{{profilePage}}">{{userName}}</a>{{#isAdmin}}<span class="community-page-subtle">{{admin}}</span>{{/isAdmin}}</div><div class="community-page-details">{{contributionsText}}</div></li>{{/contributors}}{{^contributors}}<div class="community-page-zero">{{noContribsText}}</div>{{/contributors}}</ul>',
    "done": "true"
  }; }); /* jshint ignore:end */