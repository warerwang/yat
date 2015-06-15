'use strict';
/* global $ */
/* global hljs */

/**
* Created by yadongw on 15-5-29.
*/
angular.module('webappApp')
	.directive('duoshuoCommentDire', function ($location) {
	return {
		restrict: 'A',
		link    : function (scope, element) {
			scope.$on('dataloaded', function () {
				(function() {
					var el = document.createElement('div');
					el.setAttribute('data-thread-key', 'article/' + scope.article.id);//必选参数
					el.setAttribute('data-url', $location.absUrl());//必选参数
					DUOSHUO.EmbedThread(el);
					element.append(el);
				})();
			});
		}
	};
});