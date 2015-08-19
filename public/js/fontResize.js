$(document).ready(function(){
  var section = new Array(
  	'.body-content span', 
  	'.body-content h1', 
  	'.body-content h2', 
  	'.body-content h3', 
  	'.body-content h4', 
  	'.body-content p', 
  	'.body-content div', 
  	'.body-content a',

  	'.homepage-block a',
  	'.homepage-block h1', 
  	'.homepage-block h2', 
  	'.homepage-block h3', 
  	'.homepage-block h4', 
  	'.homepage-block p', 
  	'.homepage-block div', 
  	'.homepage-block a'
  	);

  section = section.join(',');

  // keep original font size tracked
  $(section).each(function(){
  	$(this).attr('data-fs', $(this).css('font-size'));
  })

  $(".resetFont").click(function(){
    $(section).each(function(){
    	$(this).css('font-size', $(this).attr('data-fs')); 
    })
  });

  // Increase Font Size
  $(".increaseFont").click(function(){
    var currentFontSize = $(section).css('font-size');
    var currentFontSizeNum = parseFloat(currentFontSize, 10);
    var newFontSize = currentFontSizeNum*1.5;
    $(section).css('font-size', newFontSize);
    return false;
  });

  // Decrease Font Size
  $(".decreaseFont").click(function(){
    var currentFontSize = $(section).css('font-size');
    var currentFontSizeNum = parseFloat(currentFontSize, 10);
    var newFontSize = currentFontSizeNum*0.8;
    $(section).css('font-size', newFontSize);
    return false;
  });
});