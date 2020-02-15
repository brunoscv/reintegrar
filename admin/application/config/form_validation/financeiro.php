<?php
$config['Financeiro'] = array(
                        array(
                                'field' => 'id',
                                'label' => '#',
                                'rules' => ''
                        ),
                        array(
                                'field' => 'profissional_id',
                                'label' => 'Profissional',
                                'rules' => 'required'
                        ),
                        array(
                            'field' => 'data_nota',
                            'label' => 'Data da Nota',
                            'rules' => 'required'
                        ),
                        array(
                            'field' => 'valor_nota',
                            'label' => 'Valor da Nota',
                            'rules' => 'required'
                        ),
                        array(
                            'field' => 'qtd_atendimentos',
                            'label' => 'Qtd. Atendimentos',
                            'rules' => 'required'
                        ),
                        array(
                                'field' => 'status',
                                'label' => 'Status',
                                'rules' => ''
                        )
                );