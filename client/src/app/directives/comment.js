'use strict';
/* global $ */
/* global DISQUS */

/**
* Created by yadongw on 15-5-29.
*/
angular.module('webappApp')
	.directive('commentDire', function () {
	return {
		restrict: 'A',
		link    : function (scope) {
			scope.$on('dataloaded', function () {
				(function() {
					if($('#disqus-warphp-script').length > 0 ){
						DISQUS.reset({
							reload: true
						});
					}else{
						var disqusShortname = 'warphp',
//							disqus_identifier = 'article/' + scope.article.id,
//							disqus_title = scope.article.title,
							dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
						dsq.src = '//' + disqusShortname + '.disqus.com/embed.js';
						dsq.id  = 'disqus-warphp-script';
						(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
					}
				})();
			});
		}
	};
});