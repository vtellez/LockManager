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

class Locks extends CI_Controller {

    public function __construct()
        {
                parent::__construct();
                $this->controlacceso->control();
        }


	public function index($type='search')
	{
        redirect("/locks/repo/$type", 'refresh');

	}

	public function repo ($section='search',$state='lock')
	{

        $where = array();
        $owner = "";
        $value = "";
        $lock_type = "";
        $results = false;
        
        $query = $this->input->post('query');
      
        if($query)
        {
            $results = true;
            $section = 'results';
            $lock_type = $this->input->post('lock_type');
            $state = $this->input->post('state');
            $value = $this->input->post('value');
            $owner = $this->input->post('owner');
        }

        switch($state)
        {
            case "lock":
                $where['state'] = $this->config->item('lock_state');  
                break;

            case "unlock":
                $where['state'] = $this->config->item('unlock_state');  
                break;

            default: //all
                break;  
        }

        switch($section)
        {
            case "user":
                $where['locks.type_id'] = $this->config->item('user_type');   
                break;

            case "ip":
                $where['locks.type_id'] = $this->config->item('ip_type');   
                break;

            case "phishing":
                $where['locks.type_id'] = $this->config->item('phishing_type');   
                break;

            case "hdd":
                $where['locks.type_id'] = $this->config->item('hdd_type');   
                break;

            case "results":
                if ($lock_type != "Cualquiera")
                {
                    $where['locks.type_id'] = $lock_type;   
                }

                if ($value)
                {
                    $temp = str_replace("*", "%", $value);
                    $where['value like'] = $temp;   
                }

                if ($owner)
                {
                    $temp = str_replace("*", "%", $owner);
                    $where['owner like'] = $temp;   
                }

                break;

            default: 
                break;   
        }

        //Get locks list
		$this->load->model('Locks_model');
		$locks = $this->Locks_model->get_locks($where,$this->config->item('num_item_pagina'),(int)$this->uri->segment(5));
        //Get total counter
        $total_counter = $this->Locks_model->get_locks_total($where);

        //Cargamos los enlaces a la paginacion
        $this->load->library('pagination');

        $config['uri_segment'] = 5;
        $config['total_rows'] = $total_counter;
        $config['base_url'] = site_url("locks/repo/$section/$state");
        $config['per_page'] = $this->config->item('num_item_pagina');
         
        $this->pagination->initialize($config);

		$data = array(
				'subtitle' => 'Gestión de bloqueos',
				'icon' => 'icon-lock',
                'section' => $section,
                'state' => $state,
				'locks' => $locks,
                'lock_types' => $this->Locks_model->get_lock_types(),
                'locks_count' => $total_counter,
                'where_array' => $where,
                'pagination' => $this->pagination,
                'results' => $results,
			);
		$this->load->view('header',$data);
		$this->load->view('locks');
		$this->load->view('footer');
	}


    public function add()
    {
        $query = $this->input->post('query');
     
        if($query)
        {
            $section = 'results';
            $lock_type = $this->input->post('lock_type');
            $state = $this->input->post('state');
            $value = $this->input->post('value');
            if(!$state){
                $state = $this->config->item('unlock_state');
            }
            $comment = $this->input->post('comments');

            $this->load->model('Locks_model');
            $this->Locks_model->add_lock($lock_type,$state,$value,$comment);            
        }         
        redirect("/locks/repo/all", 'refresh');
    }



    public function view($lockId)
    {
        /*
         * Lock detailed view
         *
        */

		//Get locks list
		$this->load->model('Locks_model');
		$lock = $this->Locks_model->get_lock($lockId);
        
        $error = false;
        if(!$lock)
        {
            redirect("/locks/repo/search", 'refresh');
        }
		
        //Data for the view
		$data = array(
				'subtitle' => 'Vista detallada de bloqueo',
				'icon' => 'icon-lock',
                'lock' => $lock,
			);
		$this->load->view('header',$data);
		$this->load->view('detailed_view');
		$this->load->view('footer');
    }


}

/* EOF */
