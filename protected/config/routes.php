<?php
/**
 * A list of url rules to be used by the url manager.
 *
 * Format: pattern => route
 *
 * @see http://www.yiiframework.com/doc/api/CUrlRule
 * @see http://www.yiiframework.com/doc/api/CUrlManager#rules-detail
 */
return array(
    '/' => 'forum/index',
    'rss.xml' => 'post/feed',
    'signup' => 'user/signup',
    'settings' => 'user/edit',
    'login' => 'site/login',
    'logout' => 'site/logout',
    'user' => 'user/list',
    'user/<id:\d+>' => 'user/view',
    'forum/<id:\d+>/<slug:[a-z0-9-+]+>' => 'forum/view',
    'topic/<id:\d+>/<slug:[a-z0-9-+]+>' => 'topic/view',
    'topic/new' => 'topic/create',
    'post' => 'post/list',
    'forum/<id:\d+>/topic/new' => 'topic/create',
); 