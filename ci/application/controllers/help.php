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

class Help extends CI_Controller {

	public function index()
	{
		//Data for the view
		$data = array(
				'subtitle' => 'Ayuda y documentación',
				'icon' => 'icon-question-sign',
			);
		$this->load->view('header',$data);
		$this->load->view('help');
		$this->load->view('footer');
	}
}

/* EOF */
