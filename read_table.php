<?php 

 	$rezult_str = '
		<div id="add">
			<span class="long1"> </span>
			<span class="long2"> </span>
			<span class="long3"> </span>
			<span class="short1"> </span>
			<span class="but">
				<img class="refresh" src="/pictogram/refresh.png" title="Оновити">
				<img class="add" src="/pictogram/add.png" title="Додати користувача">
			</span>
		</div>';
foreach(file("auth.src") as $k){
		$k=rtrim($k);
		list($l,$p,$ip,$gr)=explode(" ",$k);
		$rezult_str = $rezult_str.'
		<div id="list-'.$l.'">
			<span class="long1" >'.$l.'</span>
			<span class="long2">'.$p.' </span>
			<span class="long3">'.$ip.' </span>
			<span class="short1">'.$gr.'</span>
			<span class="but">
				<img class="edit" data-id="'.$l.'" src="/pictogram/edit.png" title="Редагувати дані користувача">
				<img class="accept" data-id="'.$l.'" src="/pictogram/accept.png" title="Зберегти редагування">
				<img class="delete" data-id="'.$l.'" src="/pictogram/delete.png" title="Видалити користувача">
			</span>
		</div>';
	}	
 
	echo ($rezult_str);
?>

<script language="javascript">

	$('.refresh').click(function() {
		$("#auth_result_table").load('/auth/read_table.php');
	});

	$('.add').click(function() {
//			alert ('Чого б я ото княпав ???');
			
			$('#add').replaceWith('<div id="add"><input type="text" class="long1" name="loginfld"><input type="password" class="long2" name="passfld"><input i type="text" class="long3" name="ipfld" value="*"><input id="addgr" type="text" class="short1" name="grfld" value="2"><span class="but"><img class="accept" src="/pictogram/accept.png" title="Додати користувача"><img class="delete" src="/pictogram/delete.png" title="Відмінити дію"></span></div>');
			
			$('.accept').click(function() {
				
			var readlogin = $('[name=loginfld]').val();
			var readpass = $('[name=passfld]').val();
			var readip = $('[name=ipfld]').val();
			var readgr = $('[name=grfld]').val();
			
			$.ajax({
				type: "POST", 
				async: false,
				cache: false,
				url: "/auth/auth_reg.php", 
				data: "loginfld="+readlogin+"&passfld="+readpass+"&ipfld="+readip+"&grfld="+readgr,
				success: function() {
						
						$("#auth_result_table").load('/auth/read_table.php');	
					},
					error: function(jqXHR, exception)
					{   
					 $("#auth_result_msg").html('<p>ERROR:</p>');
						if (jqXHR.status === 0) {
							alert('НЕ подключен к интернету!');
							} else if (jqXHR.status == 404) {
								alert('НЕ найдена страница запроса [404])');
							} else if (jqXHR.status == 500) {
							alert('НЕ найден домен в запросе [500].');
							} else if (exception === 'parsererror') {
							alert("Ошибка в коде: \n"+jqXHR.responseText);
							} else if (exception === 'timeout') {
							alert('Не ответил на запрос.');
							} else if (exception === 'abort') {
							alert('Прерван запрос Ajax.');
							} else {
							alert('Неизвестная ошибка:\n' + jqXHR.responseText);
						}
					}
				});


			
			});
			
			$('.delete').click(function() {
				("#auth_result_table").load('/auth/read_table.php');
			});
			
		});
	
	$('.edit').click(function() {
//			alert ('Не буду я редагувати ' + $(this).data('id') + ' !!!');
			$('#list-'+$(this).data('id')).replaceWith('<div id="add"><input type="text" class="long1" name="loginfld" value="' + $(this).data('id') + '"><input type="text" class="long2" name="passfld" value="' + $('#list-'+$(this).data('id')+' .long2').text() + '"><input type="text" class="long3" name="ipfld" value="' + $('#list-'+$(this).data('id')+' .long3').text() + '"><input type="text" class="short1" name="grfld" value="' + $('#list-'+$(this).data('id')+' .short1').text() + '"><span class="but"><img class="accept" src="/pictogram/accept.png" title="Додати користувача"><img class="delete" src="/pictogram/delete.png" title="Відмінити дію"></span></div>');			
			$('[name=loginfld]').attr('readonly', true);
			$('.accept').click(function() {
				var readlogin = $('[name=loginfld]').val();
				var readpass = $('[name=passfld]').val();
				var readip = $('[name=ipfld]').val();
				var readgr = $('[name=grfld]').val();
		
				/*alert ('SAVE='+readlogin+' '+readpass+' '+readip+' '+readgr);*/
				$.ajax({
					type: "POST", 
					async: false,
					cache: false,
					url: "/auth/auth_save.php", 
					data: "loginfld="+readlogin+"&passfld="+readpass+"&ipfld="+readip+"&grfld="+readgr,
					success: function() {
							$("#auth_result_table").load('/auth/read_table.php');	
					},
					error: function(jqXHR, exception)
					{   
					 $("#auth_result_msg").html('<p>ERROR:</p>');
						if (jqXHR.status === 0) {
							alert('НЕ подключен к интернету!');
							} else if (jqXHR.status == 404) {
								alert('НЕ найдена страница запроса [404])');
							} else if (jqXHR.status == 500) {
							alert('НЕ найден домен в запросе [500].');
							} else if (exception === 'parsererror') {
							alert("Ошибка в коде: \n"+jqXHR.responseText);
							} else if (exception === 'timeout') {
							alert('Не ответил на запрос.');
							} else if (exception === 'abort') {
							alert('Прерван запрос Ajax.');
							} else {
							alert('Неизвестная ошибка:\n' + jqXHR.responseText);
						}
					}
				});
				
		
			});
		
		
		
		
		});
	
	$('.delete').click(function() {
			//alert ('Шандарахнути ' + $(this).data('id') + ' ???');
			var confirmLogin =  $(this).data('id');
			event.preventDefault(); // выключaем стaндaртную рoль элементa
			$('#overlay').fadeIn(200); // show podlojka
			$('#confirm_form').css('display', 'block') // убирaем у мoдaльнoгo oкнa display: none;
							.animate({opacity: 1, top: '50%'}, 100); // плaвнo прибaвляем прoзрaчнoсть oднoвременнo сo съезжaнием вниз
							
			$('#btn_ok').click(function() {
			  
				$.ajax({
					type: "POST", 
					async: false,
					cache: false,
					url: "/auth/auth_del.php", 
					data: "loginfld="+confirmLogin,
					success: function() {
						$("#auth_result_msg").html('<p>Delete completed!</p>');
						$('#confirm_form')
							.animate({opacity: 0, top: '45%'}, 200,  // плaвнo меняем прoзрaчнoсть нa 0 и oднoвременнo двигaем oкнo вверх
								function(){ // пoсле aнимaции
								$(this).css('display', 'none'); // делaем ему display: none;
								$('#overlay').fadeOut(400); // скрывaем пoдлoжку
								}
							);
						$("#auth_result_table").load('/auth/read_table.php');	
					},
					error: function(jqXHR, exception)
					{   
					 $("#auth_result_msg").html('<p>ERROR:</p>');
						if (jqXHR.status === 0) {
							alert('НЕ подключен к интернету!');
							} else if (jqXHR.status == 404) {
								alert('НЕ найдена страница запроса [404])');
							} else if (jqXHR.status == 500) {
							alert('НЕ найден домен в запросе [500].');
							} else if (exception === 'parsererror') {
							alert("Ошибка в коде: \n"+jqXHR.responseText);
							} else if (exception === 'timeout') {
							alert('Не ответил на запрос.');
							} else if (exception === 'abort') {
							alert('Прерван запрос Ajax.');
							} else {
							alert('Неизвестная ошибка:\n' + jqXHR.responseText);
						}
					}
				});
	
			});
			$('#btn_cancel').click(function() {
			   
				$("#auth_result_msg").html('');
				$('#confirm_form').animate({opacity: 0, top: '45%'}, 200,  // плaвнo меняем прoзрaчнoсть нa 0 и oднoвременнo двигaем oкнo вверх
						function(){ // пoсле aнимaции
						$(this).css('display', 'none'); // делaем ему display: none;
						$('#overlay').fadeOut(200); // скрывaем пoдлoжку
						}
				);
				$("#auth_result_table").load('/auth/read_table.php');
			});
			
			
			
});	






		
</script>
