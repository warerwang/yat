'use strict';
/* global $ */
/* global hljs */

/**
* Created by yadongw on 15-5-29.
*/
angular.module('webappApp')
	.directive('commentDire', function ($timeout) {
	return {
		restrict: 'A',
		link    : function (scope, element) {
			scope.$on('dataloaded', function () {
				(function() {
					var ds = document.createElement('script');
					ds.type = 'text/javascript';ds.async = true;
					ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
					ds.charset = 'UTF-8';
					(document.getElementsByTagName('head')[0]
					|| document.getElementsByTagName('body')[0]).appendChild(ds);
				})();
			});
		}
	};
});