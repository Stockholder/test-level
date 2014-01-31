$(document).ready(function() {

	/* Questões */
	//Mostrar questões
	$('.showQuestions').click(function(event){
		var test_id = $(this).data('id');
		var loadQuestions = $('.loadQuestions[data-id="'+test_id+'"]');
		if(loadQuestions.is(':visible')){
			loadQuestions.hide();
			$(this).html('Mostrar questões');
		}else{
			questionsReload(loadQuestions);
		}
	});

	//Adicionar Questões
	$('.addQuestion').click(function() {
		$('#myModalLabelQuestion').html("Criar questão");
		var test_id = $(this).data('id');
		$('#myModal').data('id', test_id);
		$('#myModal').modal('show');
	});

	//Modal tasks
	$('#myModal').on('shown', function() {
	});

	$('#myModal').on('hidden', function() {
		$('#myModal').modal('hide');
		$('.errors').html('');
		$('#formQuestion')[0].reset();
		$('#myModal').removeData('question_id');
		$('input[name=path]').val('');
		$('audio.audioQuestion').html('');
		$('.audioPathEdit').html('<audio class="audioPath" controls="controls"></audio>');
	});

	//Save questions
	$("#saveQuestion").bind('click',function () {
		var form = $('#formQuestion');
		var data = form.serialize();
		var method = form.attr('method');
		var url = form.attr('action');
		var test_id = $('#myModal').data('id');
		var loadQuestions = $('.loadQuestions[data-id="'+test_id+'"]');

		if(typeof($('#myModal').data('question_id')) != 'undefined' ){
			var question_id =  $('#myModal').data('question_id') ;
			data = data+'&_method=PATCH';
			url = APP_URL+'/questions/'+question_id;
		}else{
			data = data+'&test_id='+test_id;
		}

		$.ajax({
			type: method,
			url: url,
			data: data
		})
		.success(function(s) {
			$('#myModal').modal('toggle');
			questionsReload(loadQuestions);
		})
		.error(function(e) {
			if(e.status != 400){
				alert('Ocorreu um erro interno, favor consultar o administrador');
			}else{
				$('.errors').html('');
				var errorMessage = JSON.parse(e.responseText);
				var errorPlace = document.createElement('ul');
				errorPlace = $(errorPlace).addClass('errorPlace');
				$.each(errorMessage, function(index, val) {
					$('.errors').append('<li class="error">'+val+'</li>');
				});
			}
		})
	});

	$("#myaudio").change(function(){
		var audio = $("input[type='file']").get(0).files[0];
		readFile(audio, function(e) {
			var result = e.target.result;  // here I get a binary string of my original audio file
			encodedData = btoa(result);  // encode it to base64
			encodedData = "data:audio/mp3;base64,"+encodedData;
			$("audio").html("<source src=\""+encodedData+"\"/>");    //add the source to audio
			$('input[name=path]').val(encodedData);
		});
	});

	$('.editQuestion').click(function(event) {
		$('#myModalLabelQuestion').html("Editar questão");
		var description = $(this).data('description');
		var audio_id = $(this).data('audio');
		var question_id = $(this).data('id');
		var test_id = $(this).parent().parent().parent().parent().parent().data('id');
		$('#formQuestion').find('#description').val(description);
		$('#formQuestion').find('#audio_id').val(audio_id);
		$('#myModal').data('id', test_id);
		$('#myModal').data('question_id', question_id);
		$('.audioPathEdit').html('');
 		$(this).parent().parent().parent().find('.audioPath').clone().appendTo('.audioPathEdit');
 		$('input[name=path]').val($('.audioPathEdit').children('.audioPath').children().attr('src'));
		$('#myModal').modal('show');
	});

	$('.showAlternatives').click(function(){
		var question_id = $(this).data('id');
		var loadAlternatives = $('.loadAlternatives[data-id="'+question_id+'"]');
		if(loadAlternatives.is(':visible')){
			loadAlternatives.hide();
			$(this).html('Mostrar alternativas');
		}else{
			alternativesReload(loadAlternatives);
		}
	});

	$('.addAlternative').click(function(event) {
		var question_id = $(this).data('id');
		$('#myModalAlternative').data('id', question_id);
		$('#myModalAlternative').modal('show');
	});

	//Modal
	$('#myModalAlternative').on('shown', function() {

	});

	$('#myModalAlternative').on('hidden', function() {
		// $('#myModalAlternative').modal('hide');
		$('.errors').html('');
		$('#formAlternative')[0].reset();
	});

	//Save questions
	$("#saveAlternative").bind('click',function () {
		var form = $('#formAlternative');
		var data = form.serialize();
		var method = form.attr('method');
		var url = form.attr('action');
		var question_id = $('#myModalAlternative').data('id');
		var loadAlternatives = $('.loadAlternatives[data-id="'+question_id+'"]');

		data = data+'&question_id='+question_id;

		$.ajax({
			type: method,
			url: url,
			data: data
		})
		.success(function(s) {
			$('#myModalAlternative').modal('toggle');
			alternativesReload(loadAlternatives);
		})
		.error(function(e) {
			if(e.status != 400){
				alert('Ocorreu um erro interno, favor consultar o administrador');
			}else{
				$('.errors').html('');
				var errorMessage = JSON.parse(e.responseText);
				var errorPlace = document.createElement('ul');
				errorPlace = $(errorPlace).addClass('errorPlace');
				$.each(errorMessage, function(index, val) {
					$('.errors').append('<li class="error">'+val+'</li>');
				});
			}
		})
		.done(function( data ) {
			// console.log('done',data);
		});
	});

	$('.changeCorrect').click(function(event) {
		var option = $(this).data('option');
		var alternative_id = $(this).data('id');
		var question_id = $(this).data('question');
		var url = APP_URL+'/alternatives/changeCorrect';
		var method = 'POST';
		var data = {'alternative_id' : alternative_id, 'option' : option, 'question_id': question_id };
		var loadAlternatives = $('.loadAlternatives[data-id="'+question_id+'"]');
		$.ajax({
			type: method,
			url: url,
			data: data
		})
		.success(function(s) {
			alternativesReload(loadAlternatives);
		}).error(function(e) {
			alert('Ocorreu um erro interno, favor consultar o administrador');
		})
		.done(function( data ) {

		});
	});

	$('*').click(function(event) {
		event.stopImmediatePropagation();
	});

});

function questionsReload(element) {
	var test_id = element.data('id');
	$('.showQuestions[data-id="'+test_id+'"]').html('Ocultar questões');
	element.html('');
	element.append($('<div style="text-align:center"><img src="http://ri.magazineluiza.com.br/rao2012/images/loader.gif" width="100" height="100"/></div>'));
	setTimeout(function(){
		element.load(APP_URL+'/questions/showByTest/'+test_id);
	},1000);
	element.show();
}

function alternativesReload(element) {
	var question_id = element.data('id');
	$('.showAlternatives[data-id="'+question_id+'"]').html('Ocultar alternativas');
	element.html('');
	element.append($('<div style="text-align:center"><img src="http://ri.magazineluiza.com.br/rao2012/images/loader.gif" width="100" height="100"/></div>'));
	setTimeout(function(){
		element.load(APP_URL+'/alternatives/showByQuestion/'+question_id);
	},1000);
	element.show();
}

function readFile(file, onLoadCallback){
	var reader = new FileReader();
	reader.onload = onLoadCallback;
	reader.readAsBinaryString(file);
}