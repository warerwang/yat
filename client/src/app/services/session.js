'use strict';
/**
 * Created by yadongw on 15-5-6.
 */

angular.module('webappApp')
.service('Session', function ($cookieStore) {
	this.accessToken = $cookieStore.get('access_token');

	this.create = function (accessToken) {
		this.accessToken = accessToken;
		$cookieStore.put('access_token', accessToken);
	};
	this.destroy = function () {
		this.accessToken = null;
		$cookieStore.remove('access_token');
	};
	return this;
});