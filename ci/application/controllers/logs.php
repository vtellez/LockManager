<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Copyright 2013 Víctor Téllez Lozano <http://vtellez.es>
 *
 *    This file is part of Bloquea.
 *
 *    Bloquea is free software: you can redistribute it and/or modify it
 *    under the terms of the GNU Affero General Public License as
 *    published by the Free Software Foundation, either version 3 of the
 *    License, or (at your option) any later version.
 *
 *    Bloquea is distributed in the hope that it will be useful, but
 *    WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 *    Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public
 *    License along with Bloquea.  If not, see
 *    <http://www.gnu.org/licenses/>.
 */

class Logs extends CI_Controller {

    public function __construct()
    {
            parent::__construct();
            $this->controlacceso->control();
    }    

	public function index($type='search')
	{
        redirect("/logs/repo/$type", 'refresh');

	}

	public function repo($section='search',$state='lock')
	{

		$where = array();

        switch($section)
        {
            case "users":
                $where['logs.type'] = "users";   
                break;

            case "auto":
                $where['logs.type'] = "auto";   
                break;

            case "results":
                break;

            default: //all
                break;   
        }

        //Get locks list
		$this->load->model('Locks_model');
		$rows = $this->Locks_model->get_logs($where,$this->config->item('num_item_pagina'),(int)$this->uri->segment(5));
        //Get total counter
        $total_counter = $this->Locks_model->get_logs_total($where);

        //Cargamos los enlaces a la paginacion
        $this->load->library('pagination');

        $config['uri_segment'] = 5;
        $config['total_rows'] = $total_counter;
        $config['base_url'] = site_url("locks/repo/$section/$state");
        $config['per_page'] = $this->config->item('num_item_pagina');
         
        $this->pagination->initialize($config);


		//Data for the view
		$data = array(
				'subtitle' => 'Gestión de eventos registrados',
				'icon' => 'icon-time',
				'section' => $section,
				'where_array' => $where,
				'rows' => $rows,
				'results' => false,
				'pagination' => $this->pagination,
				'count' => $total_counter,
			);
		$this->load->view('header',$data);
		$this->load->view('logs');
		$this->load->view('footer');
	}
}

/* EOF */
