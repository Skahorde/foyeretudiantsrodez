$('div').click(function() {
    if($(this).hasClass('red'))
    {
        $(this).addClass('blue').removeClass('red');
    }
    else
    {
       $(this).addClass('red').removeClass('blue');
    }
  });