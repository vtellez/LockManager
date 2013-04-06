#!/usr/bin/perl/
#
# Main functions for bloquea
# -------------------------------------------------------------------------------------
#/*
# *    Copyright 2013 Víctor Téllez Lozano <contacto@vtellez.es>
# *
# *    This file is part of Bloquea.
# *
# *    Bloquea is free software: you can redistribute it and/or modify it
# *    under the terms of the GNU Affero General Public License as
# *    published by the Free Software Foundation, either version 3 of the
# *    License, or (at your option) any later version.
# *
# *    Bloquea is distributed in the hope that it will be useful, but
# *    WITHOUT ANY WARRANTY; without even the implied warranty of
# *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
# *    Affero General Public License for more details.
# *
# *    You should have received a copy of the GNU Affero General Public
# *    License along with Bloquea. If not, see
# *    <http://www.gnu.org/licenses/>.
# */

sub DaysInMonth {

	my ($nuevo,$actual)=@_;
	        			#Change lock db state to lock
					# $query = "UPDATE locks SET state = $STATE_LOCK, date ="
	    #         			."$timestamp where lock_id = $lock_id;";	
	    #	    	print "Changing state to lock for $value\n";            	
	    #         	$sth = $dbh->prepare($query);
	    #         	$sth->execute();

					# Inc lock's lock_counter
	    #         	$query = "UPDATE locks SET lock_counter = lock_counter + 1 "
	    #         			.", owner = '$owner'"
	    #         			."where lock_id = $lock_id;";
	    #         	$sth = $dbh->prepare($query);
	    #         	$sth->execute();


   return 28;
}
 
1;