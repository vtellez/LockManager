<?php
/*
 *    Copyright 2013 Víctor Téllez Lozano <vtellez@us.es>
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
class Logout extends CI_Controller {

	function Logout()
	{
                parent::__construct();
                $this->controlacceso->control();
	}
	
	function index()
        {
                $this->session->set_userdata(array());

                $this->session->sess_destroy();
		//redirect(OPENSSO_LOGOUT_URL);
                $this->controlacceso->logout();
        }

}
