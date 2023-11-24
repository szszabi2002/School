$(document).ready(function () {
  $('.navbar-nav li').click(function (x) {
    $('.navbar-nav li').removeClass('active');
    $(event.target).parent().addClass('active');
  });
});

function showCircuit() {
  $('#circuit').change(function (o) {
    switch (o.target.value) {
      case 'ITA':
        $('#circuitimage').attr('src', 'img/monza.jpg');
        $('#f1sound')[0].play();
        break;
      case 'HUN':
        $('#circuitimage').attr('src', 'img/hungaroring.jpg');
        break;
      case 'BEL':
        $('#circuitimage').attr('src', 'img/spa.jpg');
        break;
      case 'MON':
        $('#circuitimage').attr('src', 'img/monaco.jpg');
        break;

      default:
        break;
    }
  });
}

//---------------------------------------------------------

function calculate() {
  var palya=document.getElementById('circuit').value;
  var korido=document.getElementById('laptime').value/3600;
  if(korido && palya){
      switch(palya){
          case 'ITA':document.getElementById('averagespeed').value=(5.793/korido).toString()+" km/h";break;
          case 'BEL':document.getElementById('averagespeed').value=(7.004/korido).toString()+" km/h";break;
          case 'MON':document.getElementById('averagespeed').value=(3.337/korido).toString()+" km/h";break;
          case 'HUN':document.getElementById('averagespeed').value=(4.381/korido).toString()+" km/h";break;
          default:break;
      }
  }
}