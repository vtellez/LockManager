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

class Ws extends CI_Controller {

	function changeLockState($lockId)
	{
       //Obetenemos el valor actual si existe
        $this->db->where('lock_id',$lockId);
        $rows = $this->db->get('locks');
        $row =  $rows->row();

        if ($rows->num_rows != 1) {
            exit; //Lock does not exists
        }else{
            switch ($row->state) {
                case $this->config->item('lock_state'):
                    $new_state = $this->config->item('unlock_state');
                    break;
                case $this->config->item('unlock_state'):
                    $new_state = $this->config->item('lock_state');
                    break;
            }
        }
            $current = time();
            $owner = 'web';
            $data = array(
                       'state' => $new_state,
                       'date' => $current,
                       'owner' => $owner,
            );
            $this->db->where('lock_id', $lockId);
            $this->db->update('locks', $data); 

         $this->output->set_output(date("d/m/Y, H:i",$current)."#$owner");
	}
}

/* EOF */
