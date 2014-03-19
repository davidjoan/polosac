<script type='text/javascript'>

	$(document).ready(function() {
	
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek'
			},	
			buttonText:      {today:'hoy dia',month:'mes',week:'semana',day:'dia'},
			monthNames:      ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
			monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
			dayNames:        ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
			dayNamesShort:   ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
			allDayText:      'todo el dia',
						
			editable: false,
			events: '<?php echo $sf_user->isAdmin()?url_for('@schedule_programacion'):url_for('@schedule_detail_programacion');?>',
			
			eventDrop: function(event, delta) {
				alert(event.title + ' was moved ' + delta + ' days\n' +
					'(should probably update your database)');
			},
			
			loading: function(bool) {
				if (bool) $('#loading').show();
				else $('#loading').hide();
			}
			
		});
		
	});

</script>
<style type='text/css'>

	#loading {
		position: absolute;
		top: 5px;
		right: 5px;
		}

	#calendar {
		width: 900px;
		margin: 0 auto;
		}

</style>

<div class="title"> Programación de Viajes </div>
<div class="subtitle">&nbsp;</div>
<br/>
<div id='loading' style='display:none'>cargando...</div>
<div id='calendar'></div>