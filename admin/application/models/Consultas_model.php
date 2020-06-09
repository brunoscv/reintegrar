<?php

class Consultas_model extends CI_Model
{
	public $table = "consultas";

	public function __construct()
	{
		parent::__construct();
	}

	public function get_horarios_disponiveis($data_consulta = false, $dia_semana_id = false, $profissionais_id) {
		return $this->db->query(" 	SELECT   x.id AS frequencia_id,
											 hp.horarios_id,
											 hp.desc_horario, 
									         hp.dias_semana_id,
											 hp.desc_dia_semana, 
											 x.dias_semana_id, 
											 x.desc_dia_semana AS dia_semana, 
											 hp.profissionais_id,
											 hp.nome_prof,
											 IFNULL (x.consultas_id, '(Vazio)') AS consultas_id, 
											 x.pacientes_id,
											 IFNULL (x.nome_pac, '(Vazio)') AS paciente,
											 IFNULL (x.createdAt, 'Disponivel para consulta.') AS data_consulta
									FROM (
											SELECT   f.id,
													 f.horarios_id, 
											         f.desc_horario, 
													 f.dias_semana_id, 
													 f.desc_dia_semana, 
													 f.consultas_id, 
													 c.pacientes_id,
													 p.nome_pac,
													 f.createdAt
											FROM vw_frequencias AS f
											INNER JOIN (consultas AS c, pacientes AS p)
											ON (c.id = f.consultas_id AND p.id = f.pacientes_id)
											WHERE f.dias_semana_id = $dia_semana_id
											      AND c.profissionais_id = $profissionais_id 
												  AND f.createdAt = '$data_consulta'
											) AS x
									RIGHT JOIN (vw_hora_profissionais AS hp)
									ON (x.horarios_id = hp.horarios_id 
									    AND x.dias_semana_id = hp.dias_semana_id)
									WHERE
										  hp.dias_semana_id = $dia_semana_id
									      AND hp.profissionais_id = $profissionais_id 
									ORDER BY hp.horarios_id")
						->result();
	}

	public function get_horarios_profissionais($horarios_profissionais = false) {
		return $this->db->query(" SELECT hp.profissionais_id,
										 p.nome_prof,
										 hp.dias_semana_id,
										 ds.desc_dia_semana,
										 hp.horarios_id,
										 h.desc_horario,
										 hp.status
								  FROM horarios_profissionais AS hp
								  INNER JOIN (dias_semana AS ds,
											  horarios AS h,
											  profissionais AS p) 
								  ON (hp.dias_semana_id = ds.id AND 
								  	  hp.horarios_id = h.id AND
									  hp.profissionais_id = p.id)
								  WHERE hp.profissionais_id = $horarios_profissionais AND 
									    hp.status = 1")
						->result();
	}
	
}