/**
* Created by yadongw on 15-5-29.
*/
angular.module('webappApp')
	.directive('highLightContent', function ($timeout) {
	return {
		restrict: 'A',
		link    : function (scope, element, attr) {
			scope.$on('dataloaded', function () {
				$timeout(function () {
					$(element).find('code').each(function(i, block) {
						hljs.highlightBlock(block);
					});
				}, 0, false);
			});
		}
	};
});