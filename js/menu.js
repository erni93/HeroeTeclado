$(document).ready(function() {
  
  // On click, remove class on active element, add it to the new one
  
  $('.menu-principal>li>a').click(function(e) {
    
    $('.menu-principal>li>a.'+$(this).attr('id')+'-active').removeClass($(this).attr('id')+'-active');
    $(this).addClass($(this).attr('id')+'-active');
    
    // Scroll to anchor
    
    $('html,body').animate({scrollTop: $($(this).attr('href')).offset().top - 50},'slow');
    
    e.preventDefault();
    return false;
    
  });
  
  // On scroll, remove class on active element and add it to the new one
  
  $(document).scroll(function() {
     
     var position = Math.floor($(this).scrollTop() / 800) + 1;
//console.log( $('.menu-principal>li>a.'+ $('.menu-principal>li:nth-of-type('+position+')>a').attr('id')));
    /*$('.menu-principal>li>a.'+ $('.menu-principal>li:nth-of-type('+position+')>a').attr('id')+'-active').removeClass($('.menu-principal>li:nth-of-type('+position+')>a').attr('id')+'-active');
    $('.menu-principal>li>a.link-' + position).addClass($('.menu-principal>li:nth-of-type('+position+')>a').attr('id')+'-active');*/
    var objetoAdd=$('.menu-principal>li:nth-of-type('+position+')>a');
    var objetoRem=$('.menu-principal>li:nth-of-type('+position+')>a.link-'+position);
    var clase= objetoAdd.attr('id')+'-active';
    //console.log(objetoRem.attr('id'));
    objetoRem.removeClass(clase);
    objetoAdd.addClass(clase);

  });
  
});