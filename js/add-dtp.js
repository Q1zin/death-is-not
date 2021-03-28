$(document).ready(function () {


ymaps.ready(mapInit);
			var map;
			
			function mapInit() {
				
				map = new ymaps.Map('map', {
					center: [55.7625, 37.5986], 
					zoom: 6.5
				}, {
					balloonMaxWidth: 350,
					searchControlProvider: 'yandex#search'
				});
				
				map.events.add('click', function (e) {
					if (!map.balloon.isOpen()) {
						
						var coords = e.get('coords');
						
						ymaps.geocode(coords).then(function (res) {
							
							var address = res.geoObjects.get(0).getAddressLine();
							
							map.balloon.open(coords, {
								contentHeader:'Место ДТП',
								contentBody:'<p>'+address+'</p>' +
									'<p>Координаты: ' + [
									coords[0].toPrecision(6),
									coords[1].toPrecision(6)
									].join(', ') + '</p>',
							});
							
							$('.__geo_longitude').val(coords[1].toPrecision(6));
							$('.__geo_latitude').val(coords[0].toPrecision(6));
							$('.__geo_address').val(address);
						
						});
						
					}
					else {
						map.balloon.close();
						
						$('.__geo_longitude').val('');
						$('.__geo_latitude').val('');
						$('.__geo_address').val('');
						
					}
				});
				
				map.events.add('balloonopen', function (e) {
					map.hint.close();
				});
				
			}


      	function setChecked(target) {
		var checked = $(target).find("input[type='checkbox']:checked").length;
		if (checked) {
			$(target).find('select option:first').html('Выбрано: ' + checked);
		} else {
			$(target).find('select option:first').html('Выберите из списка');
		}
	}
 
	$.fn.checkselect = function() {
		this.wrapInner('<div class="checkselect-popup"></div>');
		this.prepend(
			'<div class="checkselect-control">' +
				'<select class="form-control"><option></option></select>' +
				'<div class="checkselect-over"></div>' +
			'</div>'
		);	
 
		this.each(function(){
			setChecked(this);
		});		
		this.find('input[type="checkbox"]').click(function(){
			setChecked($(this).parents('.checkselect'));
		});
 
		this.parent().find('.checkselect-control').on('click', function(){
			$popup = $(this).next();
			$('.checkselect-popup').not($popup).css('display', 'none');
			if ($popup.is(':hidden')) {
				$popup.css('display', 'block');
				$(this).find('select').focus();
			} else {
				$popup.css('display', 'none');
			}
		});
 
		$('html, body').on('click', function(e){
			if ($(e.target).closest('.checkselect').length == 0){
				$('.checkselect-popup').css('display', 'none');
			}
		});
	};
 
  $('.checkselect').checkselect();




  $("input[type=\"checkbox\"][name=\"road_accident_participants\"]").on("click", function () {
    var beforeNum1 =  $('div.hidden').data('road_accident_participants')
    $('div.hidden').data('road_accident_participants', beforeNum1 + $(this).val());
  })

  $("input[type=\"checkbox\"][name=\"road_condition\"]").on("click", function () {
    var beforeNum2 =  $('div.hidden').data('road_condition')
    $('div.hidden').data('road_condition', beforeNum2 + $(this).val());
  })

  $("input[type=\"checkbox\"][name=\"weather\"]").on("click", function () {
    var beforeNum3 =  $('div.hidden').data('weather')
    $('div.hidden').data('weather', beforeNum3 + $(this).val());
  })




  $(".more-atr__content-btn--send").on("click", function () {
    var data = $(".main-info__wrap-first--data").val();
    var category = $(".main-info__wrap-first--category").val();
    var harm_to_health = $(".main-info__wrap-first--harm_to_health").val();
    var link_to_video = $(".main-info__wrap-first--link_to_video").val();
    var description = $(".main-info__wrap-second--description").val();
    var link_to_photo = $(".main-info__wrap-second--link_to_photo").val();
    var name = $(".main-info__wrap-second--name").val();
    var number_of_victims = $(".more-atr__content--number_of_victims--select").val();
    var the_death_toll = $(".more-atr__content--the_death_toll--select").val();
    var visibility = $(".more-atr__content--visibility--select").val();
    var cord_1 = $('.__geo_longitude').val();
    var cord_2 = $('.__geo_latitude').val();
    var address = $('.__geo_address').val();
    var road_accident_participants = $('div.hidden').data('road_accident_participants');
    var road_condition = $('div.hidden').data('road_condition');
    var weather = $('div.hidden').data('weather');

    $.ajax({
        url: 'save-dtp.php',
        method: 'GET',
        data: {"data": data, "category": category, "harm_to_health": harm_to_health, "link_to_video": link_to_video, "description": description, "link_to_photo": link_to_photo, "name": name, "number_of_victims": number_of_victims, "the_death_toll": the_death_toll, "the_death_toll": the_death_toll, "visibility": visibility, "road_accident_participants": road_accident_participants, "road_condition": road_condition, "weather": weather, "cord_1": cord_1, "cord_2": cord_2, "address": address},
        beforeSend: function () {
          inProcess = true;
        }
      }).done(function (data) {
        if (data == true) {
            window.location.href = 'https://q1zin.ru/death-is-not/dtp.php'
        } else {
            alert(data);
        }
        inProcess = false;
        data = null;
      });

  })
})