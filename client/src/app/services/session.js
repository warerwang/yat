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
	this.tokenWrapper = function(resource, action) {
		var _this;
		_this = this;
		resource['_' + action] = resource[action];
		resource[action] = function(data, a2, a3, a4) {
			data = angular.extend({}, data, {
				token: _this.accessToken
			});
			return resource['_' + action](data, a2, a3, a4);
		};
		return resource;
	};
	this.wrapActions = function(resource, actions) {
		if(!actions) actions = ['get', 'delete', 'query', 'update', 'save'];
		var action, i, len, wrappedResource;
		wrappedResource = resource;
		for (i = 0, len = actions.length; i < len; i++) {
			action = actions[i];
			this.tokenWrapper(wrappedResource, action);
		}
		return wrappedResource;
	};
	return this;
});