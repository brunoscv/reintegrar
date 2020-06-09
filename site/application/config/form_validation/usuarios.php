<?php
$config['Usuarios'] = array(
							array(
									'field' => 'senha',
									'label' => 'Senha',
									'rules' => 'required'
							),
							array(
									'field' => 'senha2',
									'label' => 'Senha',
									'rules' => 'required|matches[senha]'
							),
							array(
									'field' => 'usuario',
									'label' => 'Usuario',
									'rules' => 'required|strtolower'
							),
							array(
									'field' => 'nome',
									'label' => 'Nome',
									'rules' => 'required'
							),
							array(
									'field' => 'email',
									'label' => 'E-mail',
									'rules' => 'valid_email'
							),		
					);