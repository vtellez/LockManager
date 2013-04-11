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

class Locks_model extends CI_Model {

   function __construct()
    {
        parent::__construct();
    }

    
    function get_locks($where_array,$limit,$offset)
    {
        //Inner join
        $this->db->select("*");
        $this->db->from('locks');
        $this->db->join('lock_types', "locks.type_id = lock_types.type_id");
        $this->db->where($where_array);
        $this->db->order_by('date', 'desc'); 
        $this->db->limit($limit,$offset);
        return $this->db->get();
    }

    function get_locks_total($where_array)
    {
        //Inner join
        $this->db->select("*");
        $this->db->from('locks');
        $this->db->join('lock_types', "locks.type_id = lock_types.type_id");
        $this->db->where($where_array);
        return $this->db->get()->num_rows();
    }

    
    function get_lock_types()
    {
        return $this->db->get('lock_types');
    }


    function get_lock($lockId)
    {
        //Inner join
        $this->db->select("*");
        $this->db->from('locks');
        $this->db->join('lock_types', "locks.type_id = lock_types.type_id");
        $this->db->where('lock_id',$lockId);
        $locks = $this->db->get();
        $lock = $locks->row();

        if ( $locks->num_rows != 1)
        {
            return false;
        }else
        {
            return $lock;
        }
    }

    function add_lock($lock_type,$state,$value,$comment)
    {

        $owner = 'web_creator';
        $query ="INSERT INTO locks (type_id,subtype,state,value,owner,comment,date,lock_counter) VALUES ($lock_type,'NULL',$state,'$value','$owner','$comment',".time().",1) ON DUPLICATE KEY UPDATE state = $state;";
        $result = $this->db->query($query);
    }

}

/* EOF */
