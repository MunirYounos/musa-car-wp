
(function ($) {
    "use strict";

    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }

    
    
    /*==================================================================
    [ Simple slide100 ]*/

    $('.simpleslide100').each(function(){
        var delay = 7000;
        var speed = 1000;
        var itemSlide = $(this).find('.simpleslide100-item');
        var nowSlide = 0;

        $(itemSlide).hide();
        $(itemSlide[nowSlide]).show();
        nowSlide++;
        if(nowSlide >= itemSlide.length) {nowSlide = 0;}

        setInterval(function(){
            $(itemSlide).fadeOut(speed);
            $(itemSlide[nowSlide]).fadeIn(speed);
            nowSlide++;
            if(nowSlide >= itemSlide.length) {nowSlide = 0;}
        },delay);
    });


})(jQuery);

//black timer counter
function timeDateCounter(id, date){
    const dueDate = new Date(date).getTime();
    let timer = setInterval(function() {
      const today = new Date().getTime();
      const diff = dueDate - today;
      let days = Math.floor(diff / (1000 * 60 * 60 * 24));
      let hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      let minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
      let seconds = Math.floor((diff % (1000 * 60)) / 1000);
        //add zero
        function addZero(n){return (parseInt(n, 10) < 10 ? '0' : '') + n;}
        // display
        let counterId = document.getElementById(id);
      // display
        let counterInnerHtmlFR = `<span class="days"> 
        <span class="numbers"> ${days} </span>  Days <samp>|</samp></span>  
        <span class="hours"> 
        <span class="numbers"> ${addZero(hours)} </span> Hours <samp>|</samp></span> 
        <span class="minutes"> 
        <span class="numbers"> ${addZero(minutes)} </span> Minutes <samp>|</samp> </span> 
        <span class="seconds"> 
        <span class="numbers"> ${addZero(seconds)}</span> Seconds </span>`; 
        let counterWithoutDaysFR = `<span class="hours"> 
        <span class="numbers"> ${addZero(hours)} </span> Hours<samp>|</samp></span> 
        <span class="minutes"> 
        <span class="numbers"> ${addZero(minutes)} </span> Minutes <samp>|</samp> </span> 
        <span class="seconds"> 
        <span class="numbers"> ${addZero(seconds)}</span> Seconds </span> `;
      if(counterId !== null ){
        if(days <= 0){
        counterId.innerHTML = counterWithoutDaysFR;
        }else {
        counterId.innerHTML = counterInnerHtmlFR;
        }
      } else{
          return;
      }
      //hide when reach due date
      if(diff < 0){
        clearInterval(timer);
        let disN = document.querySelectorAll('.counter-wrapper');
        for(let i = 0; i<disN.length; i++){
        disN[i].style.display = 'none';
        }
      }
    }, 1000);
    }
    //cals
    let dato = '2021-04-03T23:59:59';
    timeDateCounter('date-timer', dato);