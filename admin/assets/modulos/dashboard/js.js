$(function () {
	$(document).ready(function () {

		$("body").on('click', '.salvarPresencaAtendimento', function (event) {
			var consultas_id = $(this).attr("consultas_id");
			var dias_semana_id = $(this).attr("dias_semana_id");
			var horarios_id = $(this).attr("horarios_id");
			var horario_consulta_id = $(this).attr("horario_consulta_id");
			var status_faturamento = $(this).attr("status_faturamento");
			$.ajax({
				url: base_url + 'dashboard/salvar_atendimentos/' + consultas_id + '/' + dias_semana_id + '/' + horarios_id + '/' + horario_consulta_id + '/' + status_faturamento,
				type: "POST",
				dataType: 'json',
				data: {
					consultas_id: consultas_id,
					dias_semana_id: dias_semana_id,
					horarios_id: horarios_id,
					horario_consulta_id: horario_consulta_id,
					status_faturamento: status_faturamento,
				},
				success: function (data) {
					console.log(data);
					$('#presenca_consulta_' + horario_consulta_id).html("");
					var json_obj = data.consultas; //parse JSON
					if (data.sucesso == true) {
						for (var i in json_obj) {
							var template = $('#consultas-template').html();
							Mustache.parse(template); // optional, speeds up future uses
							var rendered = Mustache.to_html(template, json_obj[i]);
							$('#presenca_consulta').html(rendered);
						}
						toastr.success("Ação Completada com Sucesso");
					} else {
						toastr.error("Ação não pode ser executada");
					}
				},
				complete: function (data) {
					console.log(data);
				}
			});
		});

		$("body").on('click', '.salvarPresencaReposicao', function (event) {
			var consultas_id = $(this).attr("consultas_id");
			var dias_semana_id = $(this).attr("dias_semana_id");
			var horarios_id = $(this).attr("horarios_id");
			var horario_consulta_id = $(this).attr("horario_consulta_id");
			$.ajax({
				url: base_url + 'dashboard/salvar_reposicoes/' + consultas_id + '/' + dias_semana_id + '/' + horarios_id + '/' + horario_consulta_id,
				type: "POST",
				dataType: 'json',
				data: {
					consultas_id: consultas_id,
					dias_semana_id: dias_semana_id,
					horarios_id: horarios_id,
					horario_consulta_id: horario_consulta_id,
				},
				success: function (data) {
					console.log(data);
					$('#presenca_reposicao_' + horario_consulta_id).html("");
					var json_obj = data.consultas; //parse JSON
					if (data.sucesso == true) {
						for (var i in json_obj) {
							var template = $('#reposicao-template').html();
							Mustache.parse(template); // optional, speeds up future uses
							var rendered = Mustache.render(template, json_obj[i]);
							$('#presenca_reposicao').append(rendered);
						}
						toastr.success("Ação Completada com Sucesso");
					} else {
						toastr.error("Ação não pode ser executada");
					}
				},
				complete: function (data) {
					console.log(data);
				}
			});
		});

		$("body").on('click', '#atualizarAtendimentos', function (event) {
			event.preventDefault();
			$.ajax({
				url: base_url + 'dashboard/atualizar_atendimentos/',
				type: "POST",
				dataType: 'json',
				data: {},
				beforeSend: function () {
				},
				success: function (data) {
					console.log(data.atendimentos);
					var json_obj = data.atendimentos; //parse JSON
					if (data.sucesso == true) {
						for (var i in json_obj) {
							$('#atendimentos_realizados').html("");
							var template = $('#atendimentos-template').html();
							Mustache.parse(template); // optional, speeds up future uses
							var rendered = Mustache.render(template, json_obj[i]);
							$('#atendimentos_realizados').append(rendered);
							console.log(json_obj[i].horario_consulta_id);
						}
						toastr.success("Ação Completada com Sucesso");
					} else {
						toastr.error("Ação não pode ser executada");
					}
				},
				complete: function (data) {
					//console.log(data);
				}
			});
		});

		$("body").on('click', '.resetar_atendimento_realizado', function (event) {
			var consultas_id = $(this).attr("consultas_id");
			var dias_semana_id = $(this).attr("dias_semana_id");
			var data_consulta = $(this).attr("data_consulta");
			swal({
				title: "Você tem certeza disso?",
				text: "Você irá resetar o status desse atendimento!!",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Sim! Pode deletar",
				cancelButtonText: "Não, Cancela!",
				showLoaderOnConfirm: true,
				closeOnConfirm: false,
				closeOnCancel: false
			},
				function (isConfirm) {
					if (isConfirm) {
						$.ajax({
							url: base_url + 'dashboard/resetar_consultas_realizadas/' + consultas_id + '/' + data_consulta + '/' + dias_semana_id,
							type: "POST",
							dataType: 'json',
							data: {
								consultas_id: consultas_id,
								data_consulta: data_consulta,
								dias_semana_id: dias_semana_id,
							},
							beforeSend: function () {
							},
							success: function (data) {
								console.log(data.atendimentos);
								var json_obj = data.atendimentos; //parse JSON
								if (data.sucesso == true) {
									for (var i in json_obj) {
										$('#atendimentos_realizados').html("");
										var template = $('#atendimentos-template').html();
										Mustache.parse(template); // optional, speeds up future uses
										var rendered = Mustache.render(template, json_obj[i]);
										$('#atendimentos_realizados').append(rendered);
										console.log(json_obj[i].horario_consulta_id);
									}

								} else {
									swal("Cancelado", "O status do seu atendimento foi mantido :)", "error");
								}
							},
							complete: function (data) {
								setTimeout(function () {
									swal("Deletado!", "Você reiniciou o status desse atendimento.", "success");
									window.location.href = "admin/dashboard";
								}, 3000);

							}
						});
					} else {
						swal("Cancelado", "O status do seu atendimento foi mantido :)", "error");
					}
				});
		});

		$("body").on('click', '.anotacoes', function (event) {
			var consultas_id = $(this).attr("consultas_id");
			window.location.href = ""

		});
	});
});