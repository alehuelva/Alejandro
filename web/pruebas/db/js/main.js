$(function(){
  var video = $('video')[0],
      canvas = $('canvas')[0],
      ctx = canvas.getContext('2d');
  
  // Flip Canvas in Y Axis
  ctx.scale(1.0, -1.0);
  
  setInterval(function(){
    ctx.drawImage(video, 0, -canvas.height, canvas.width,  canvas.height);
  }, 33)
 
})