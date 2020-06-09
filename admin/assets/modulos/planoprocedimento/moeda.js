;(function($){
    $.fn.maskedcoin = function() {
       return this.each(function(){
          $(this).bind('keypress',_maskedcoin.money)
       })
    };
 var _maskedcoin = {
    money: function() {
       var el = this
       ,exec = function(v) {
          v = v.replace(/\D/g,"");
          v = new String(Number(v));
          var len = v.length;
          if (1== len)
             v = v.replace(/(\d)/,"0,0$1");
          else if (2 == len)
             v = v.replace(/(\d)/,"0,$1");
          else if (len > 2) {
             v = v.replace(/(\d{2})$/,',$1');
             if (len > 5) {
                var x = len - 5
                ,er = new RegExp('(\\d{'+x+'})(\\d)');
                v = v.replace(er,'$1.$2');
             }
          }
          return v;
       };
       setTimeout(function(){
          el.value = exec(el.value);
       },1);
    }
 }
 })(jQuery)