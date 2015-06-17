'use strict';
/* global $ */
/* global hljs */

/**
* Created by yadongw on 15-5-29.
*/
angular.module('webappApp')
	.directive('highLightContent', function ($timeout) {
	return {
		restrict: 'A',
		link    : function (scope, element) {
			scope.$on('dataloaded', function () {
				$timeout(function () {
					$(element).find('code').each(function(i, block) {
                        $(block).html($('<div/>').text($(block).html()).html());
						hljs.highlightBlock(block);
					});
				}, 0, false);
			});
		}
	};
});