$(document).ready(function(){

    $("#amount-you-pay").numeric({negative : false, decimalPlaces : 2});
    $("#amount-author-earn").numeric({negative : false, decimalPlaces : 2})

    $("#amount-you-pay").keyup(function(event){
        if(event.keyCode == 13){
           var val = $(this).val();
           var valmax = $( ".slider-range-you-pay" ).slider('option','max');
           if(val < valmax)
           {
            $( ".slider-range-you-pay" ).slider('option','value', val);
           }
           else
           {
            $( ".slider-range-you-pay" ).slider('option','value', valmax);
           }
        }
    });

    $("#amount-author-earn").keyup(function(event){
        if(event.keyCode == 13){
           var val = $(this).val();
           var valmax = $( ".slider-range-author-earn" ).slider('option', 'max');
           if(val < valmax)
           {
            $( ".slider-range-author-earn" ).slider('option', 'value', val);
           }
           else
           {
            $( ".slider-range-author-earn" ).slider('option', 'value', valmax);
           }
        }
    });

    $( ".slider-range-you-pay" ).slider({
          orientation: "horizontal",
          range: "min",
          min: 0,
          step : 0.5,
          max: (SUGGESTED_PRICE * 2 == 0) ? 50 : SUGGESTED_PRICE,
          value: MINIMUM_PRICE * 1.2,
          change: function( event, ui ) {
            $('#amount-you-pay').val(ui.value);
          },
          slide: function( event, ui ) {
             if( ui.value < MINIMUM_PRICE ){
                   return false;
             }
             $('#amount-you-pay').val(ui.value);
             var value = ui.value * 90/100 ;
             $( ".slider-range-author-earn" ).slider('option','value',value);
          }
    });

    $( ".slider-range-author-earn" ).slider({
          orientation: "horizontal",
          range: "min",
          min : 0,
          step : 0.5,
          max: (SUGGESTED_PRICE * 2 * 90/100 == 0) ? 45 : SUGGESTED_PRICE,
          value: MINIMUM_PRICE * 1.2 * 90/100,
          change: function( event, ui ) {
            $('#amount-author-earn').val(ui.value);
          },
          slide: function( event, ui ) {
             if( ui.value < MINIMUM_PRICE * 90 / 100 ){

                   return false;
             }
             $('#amount-author-earn').val(ui.value);
             var value = ui.value * 100/90 ;
             $( ".slider-range-you-pay" ).slider('option', 'value', value);
          }
    });

    $('.item-book').find('.readmore').click(function(){
        $(this).parent().prev().css({'max-height' : 'fit-content'});
        $(this).hide();
        $(this).next().show();
    });

    $('.item-book').find('.readless').click(function(){
       $(this).parent().prev().css('max-height', '18em');
       $(this).hide();
       $(this).prev().show();
    });

    function setStyleInitForDescriptionBook() {
      $('.item-book').each(function(key, value) {
          var height = $(value).find('.wrap-des').height();
          if (height > 250) {
            $(value).find('.wrap-des').addClass('trimmed');
            $(value).find('.show-more').show();
          } else {
            $(value).find('.show-more').hide();
          }
      });
    }

    setStyleInitForDescriptionBook();

});
