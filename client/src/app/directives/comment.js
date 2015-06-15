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
					if($('#disqus-warphp-script').length > 0 ){
						DISQUS.reset({
							reload: true
						});
					}else{
						var disqus_shortname = 'warphp',
							disqus_identifier = 'article/' + scope.article.id,
							disqus_title = scope.article.title,
							dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
						dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
						dsq.id  = 'disqus-warphp-script';
						(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
					}
				})();
			});
		}
	};
});