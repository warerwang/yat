'use strict';

/**
 * @ngdoc service
 * @name webappApp.category
 * @description
 * # category
 * Service in the webappApp.
 */
angular.module('webappApp')
  .factory('Category', function () {
        var categorys;
        return {
            setCategorys: function(data){
                categorys = data;
            },
            getCategory: function(cid){
                var category;
                for(var i in categorys){
                    if(categorys[i].id == cid){
                        category = categorys[i];
                        break;
                    }
                }
                return category;
            },
            getCategorys: function(){
                return categorys
            }
        }
  });
