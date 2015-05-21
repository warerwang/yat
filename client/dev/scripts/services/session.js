/**
 * Created by yadongw on 15-5-6.
 */

angular.module('webappApp')
.service('Session', function ($cookieStore) {
	this.access_token = $cookieStore.get("access_token");

	this.create = function (access_token) {
		this.access_token = access_token;
		$cookieStore.put("access_token", access_token);
	};
	this.destroy = function () {
		this.access_token = null;
		$cookieStore.remove("access_token");
	};
	return this;
});