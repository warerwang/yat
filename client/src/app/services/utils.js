'use strict';
/**
 * Created by yadongw on 15-5-6.
 */
/*global $: false */
angular.module('webappApp')
    .factory('UtilsService', function () {
        var timer = {};
        var Utils = {
            DATE_FORMAT_MMDDYYY : 1,
            getLocalTime : function(UTCTime, format){
                try{
                    var UTCDate = this.getJsDate(UTCTime),
                        offset = new Date().getTimezoneOffset(),
                        localTimeStamp = UTCDate.getTime() - offset * 60 * 1000,
                        localDate = new Date(localTimeStamp),
                        localTime = '';
                    if(format === this.DATE_FORMAT_MMDDYYY){
                        localTime = localDate.toString().split(' ').slice(1,4);
                        localTime = localTime[0] + ' ' + localTime[1] + ', ' + localTime[2];
                    }else{
                        var year = localDate.getFullYear(),
                            month = localDate.getMonth() + 1,
                            date = localDate.getDate(),
                            hour = localDate.getHours(),
                            minute = localDate.getMinutes(),
                            second = localDate.getSeconds();
                        if( month < 10 ){
                            month = '0' + month;
                        }
                        if( date < 10 ){
                            date = '0' + date;
                        }
                        if( hour < 10 ){
                            hour = '0' + hour;
                        }
                        if( minute < 10 ){
                            minute = '0' + minute;
                        }
                        if( second < 10 ){
                            second = '0' + second;
                        }

                        localTime += year + '-';
                        localTime += month + '-';
                        localTime += date + ' ';
                        localTime += hour + ':';
                        localTime += minute + ':';
                        localTime += second;
                    }

                    return localTime;
                }catch (e){
                    return '';
                }
            },

            isEmail : function (value)
            {
                if(value.match(/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/)){
                    return true;
                }else{
                    return false;
                }
            },

            getTimePeriod : function (time)
            {
                var now = new Date(),
                    date = this.getJsDate(time),
                    interval = now - date,
                    timePeriod,
                    count;
                if(interval > 14 * 24 * 3600000){
                    timePeriod = time;
                }else if(interval > 7 * 24 * 3600000){
                    timePeriod = '1 week ago';
                }else if(interval >  24 * 3600000){
                    count = Math.floor(interval / 24 / 3600000);
                    timePeriod = count + (count > 1 ? ' days ago' : ' day ago');
                }else if(interval >  3600000){
                    count = Math.floor(interval / 3600000);
                    timePeriod = count + (count > 1 ? ' hours ago' : ' hour ago');
                }else if(interval >  60000){
                    count = Math.floor(interval / 60000);
                    timePeriod = count + (count > 1 ? ' minutes ago' : ' minute ago');
                }else if(interval >= 0){
                    timePeriod = 'just now';
                }else{
                    timePeriod = '';
                }
                return timePeriod;
            },

            //YYYY-MM-DD HH:ii:ss
            getJsDate : function(date)
            {
                var dateTime = date.split(' ');
                if(dateTime.length !== 2){
                    return '';
                }
                var dates = dateTime[0].split('-');
                var times = dateTime[1].split(':');
                if(dates.length !== 3 || times.length !== 3){
                    return '';
                }

                return new Date(dates[0],dates[1] - 1,dates[2],times[0],times[1],times[2]);
            },

            confirm : function(content, callback)
            {
                $('#yat-confirm .modal-body .modal-body-content').html(content);
                $('#yat-confirm').modal('show');
                function callbackOverride(){
                    $('#yat-confirm').modal('hide');
                    callback();
                }
                $('#yat-confirm .btn-primary').unbind('click').click(callbackOverride);
            },

            htmlEncode : function(str)
            {
                return $('<div/>').text(str).html();
            },
            htmlDecode : function(str)
            {
                return $('<div/>').html(str).text();
            },

            getFileExt : function(filename)
            {
                var index = filename.lastIndexOf('.');
                if(index === -1){
                    return '';
                }else{
                    return filename.substring(index + 1).toLowerCase();
                }
            },

            rebound : function(key, callback, time){
                if(typeof timer[key] !== 'undefined'){
                    clearTimeout(timer[key]);
                }
                timer[key] = setTimeout(function(){
                    callback();
                } , time);
            }
        };
        return Utils;
    });