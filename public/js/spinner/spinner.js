var c = document.getElementById('spinner'),
    s = c.getContext('2d'),
    w = c.width = window.innerWidth,
    h = c.height = window.innerHeight,
    d, l,
    t = 0;

document.body.appendChild(c);

function init() {
  reset();
  loop();
}
function draw() {
  var z = 15 - Math.sin(t) * 15 - Math.cos(t);
  s.fillStyle = 'rgba(0, 0, 0, 0.025)';
  s.fillRect(0, 0, w, h);
  for (var i = 0; i < l; i++) {
    var r = ((i * d / 3) / l) * Math.sin((z * 100) + i),
        x = Math.sin(i) * r + (w / 2),
        y = Math.cos(i) * r + (h / 2);
    s.beginPath();
    s.fillStyle = colorSpinner;
    s.fillRect(x, y, 1, 1);
  }
  t += 0.00001;
}

function reset() {
  w = c.width = window.innerWidth;
  h = c.height = window.innerHeight;
  d = Math.min(w, h) - 50;
  l = Math.round(d / 10);
}

function loop() {
  requestAnimationFrame(loop);
  draw();
}

window.addEventListener('resize', reset);

function inicioSpinner(){
  if (typeof colorSpinner == "undefined" || colorSpinner == null){
    // var colorSpinner = '#E91E63';
  }
  $('section').hide();
  $('#spinner').css('background-color', colorSpinner);
  $('#spinner').css('display', 'block');
  init();
}

function finSpinner(){
  $('#spinner').css('display', 'none');
  $('section').show();
}
