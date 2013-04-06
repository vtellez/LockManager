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

	public function index()
	{

		//Get locks list
		$this->load->model('Locks_model');
		$locks = $this->Locks_model->get_locks();

		//Data for the view
		$data = array(
				'subtitle' => 'Gestión de bloqueos',
				'icon' => 'icon-lock',
				'locks' => $locks,
			);
		$this->load->view('header',$data);
		$this->load->view('locks');
		$this->load->view('footer');
	}


}

/* EOF */
