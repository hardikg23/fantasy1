(function($){
    $.fn.countdown = function (options){
        var settings = {
            'date' : null ,
            'currentDate' : null
        };
        if(options){
            $.extend(settings, options);
        }

        if(Date.parse(settings['currentDate']))
        {
            currentDate=Date.parse(settings['currentDate'])/1000;
        }
        else{
            var cDate=settings['currentDate'];
            var eDate=settings['date'];
            var arr=new Array();
            arr=cDate.split(" ");
            var date=arr[0]+"T"+arr[1];
            var Mdate=new Date(date);
            currentDate=Date.parse(Mdate)/1000;
        }

        this_sel=$(this);
        function count_exec(){
        if(Date.parse(settings['date']))
        {
            eventDate = Date.parse(settings['date'])/1000;
        }else{
                arr=eDate.split(" ");
                date=arr[0]+"T"+arr[1];
                Mdate=new Date(date);
                eventDate=Date.parse(Mdate)/1000;
            }

            currentDate += 1;
            seconds = eventDate - currentDate;
            if(seconds > 0)
            {
                days = Math.floor(seconds / (60*60*24));
                seconds -= days * 60 * 60 * 24;

                hours = Math.floor(seconds / (60*60));
                seconds -= hours * 60 * 60;

                minutes = Math.floor(seconds / 60);
                seconds -= minutes * 60;

                if(days<10)
                    days='0'+days;
                if(hours<10)
                    hours='0'+hours;
                if(minutes<10)
                    minutes='0'+minutes;
                if(seconds<10)
                    seconds='0'+seconds;
            }else{
                days='00';
                hours='00';
                minutes='00';
                seconds='00';
            }

            timeLeft=' <span class="number-wrapper"><div class="line"></div><div class="caption">DAYS</div><span class="number day">'+days+'</span></span>\n\
                     <span class="number-wrapper"><div class="line"></div><div class="caption">HOUS</div><span class="number day">'+hours+'</span></span>\n\
                     <span class="number-wrapper"><div class="line"></div><div class="caption">MINS</div><span class="number day">'+minutes+'</span></span>\n\
                     <span class="number-wrapper"><div class="line"></div><div class="caption">SECS</div><span class="number day">'+seconds+'</span></span>';

            this_sel.html(timeLeft);
        }

        count_exec();
        interval = setInterval(count_exec, 1000);
    }
})(jQuery);
