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

sub updateState {
	my ($value,$type,$owner,$subtype)=@_;

	$new_state = $STATE_UNLOCK;


	# Database connection
	$dbh = DBI->connect($connectionInfo,$userid,$passwd,
					{mysql_enable_utf8=>1}) or die 
					"Can't connect to the database.\n";

	my $timestamp = time;

    # Check if the lock exists previously
	$query = "SELECT lock_id,state,date FROM locks WHERE value = '"
		     ."$value' AND type_id = $type AND subtype = '$subtype';";

	$sth = $dbh->prepare($query);
    $sth->execute();
	my @row;

	if ( $sth->rows )
	{
		@row = $sth->fetchrow_array(  );
		
		my $lock_id = $row[0];
		my $lock_state = $row[1];
		my $lock_date = $row[2];

    	if ( ($SYSDATE >= $lock_date) && ($lock_state eq $STATE_UNLOCK) )
    	{
        		# Change lock db state to lock
				$query = "UPDATE locks SET state = $STATE_LOCK, date ="
             			."$timestamp, owner = '$owner' where lock_id = $lock_id;";	
    	    	print "Changing state to lock for $value\n";            	
             	$sth = $dbh->prepare($query);
             	$sth->execute();

             	$new_state = $STATE_LOCK;

				# Inc lock's lock_counter
             	$query = "UPDATE locks SET lock_counter = lock_counter + 1 "
             			.", owner = '$owner'"
             			."where lock_id = $lock_id;";
             	$sth = $dbh->prepare($query);
             	$sth->execute();
    	}

    	# Update timestamp
    	if ( $lock_state eq $STATE_LOCK )
    	{
			$query = "UPDATE locks SET date = $timestamp where lock_id = $lock_id;";	

			$new_state = $STATE_LOCK;

	    	print "Updating timestamp for $value\n";  

	        $sth = $dbh->prepare($query);
            $sth->execute();
  		}
	}
	else
	{
		# Lock does not exists. Add new lock to database
	    my $query = "INSERT INTO locks (type_id,subtype,state,value,owner"
	    			.",date,birth_date) VALUES ($type,'$subtype',$STATE_LOCK,'$value','$owner'"
	    			.",$timestamp,$timestamp) ON DUPLICATE KEY UPDATE date ="
	    			."$timestamp;";

	    $new_state = $STATE_LOCK;
    	
    	print "Adding new lock for $value\n";	
		$sth = $dbh->prepare($query);
        $sth->execute();
	}


$sth->finish;
$dbh->disconnect;
	
	return $new_state;
}



sub setLog {
	my ($value,$type,$owner,$subtype)=@_;

	$new_state = $STATE_UNLOCK;

	# Database connection
	$dbh = DBI->connect($connectionInfo,$userid,$passwd,
					{mysql_enable_utf8=>1}) or die 
					"Can't connect to the database.\n";

	my $timestamp = time;

    # Check if the lock exists previously
	$query = "SELECT lock_id,state,date FROM locks WHERE value = '"
		     ."$value' AND type_id = $type AND subtype = '$subtype';";

	$sth = $dbh->prepare($query);
    $sth->execute();
	my @row;

	if ( $sth->rows )
	{
		@row = $sth->fetchrow_array(  );
		
		my $lock_id = $row[0];
		my $lock_state = $row[1];
		my $lock_date = $row[2];

    	if ( ($SYSDATE >= $lock_date) && ($lock_state eq $STATE_UNLOCK) )
    	{
        		# Change lock db state to lock
				$query = "UPDATE locks SET state = $STATE_LOCK, date ="
             			."$timestamp, owner = '$owner' where lock_id = $lock_id;";	
    	    	print "Changing state to lock for $value\n";            	
             	$sth = $dbh->prepare($query);
             	$sth->execute();

             	$new_state = $STATE_LOCK;

				# Inc lock's lock_counter
             	$query = "UPDATE locks SET lock_counter = lock_counter + 1 "
             			.", owner = '$owner'"
             			."where lock_id = $lock_id;";
             	$sth = $dbh->prepare($query);
             	$sth->execute();
    	}

    	# Update timestamp
    	if ( $lock_state eq $STATE_LOCK )
    	{
			$query = "UPDATE locks SET date = $timestamp where lock_id = $lock_id;";	

			$new_state = $STATE_LOCK;

	    	print "Updating timestamp for $value\n";  

	        $sth = $dbh->prepare($query);
            $sth->execute();
  		}
	}
	else
	{
		# Lock does not exists. Add new lock to database
	    my $query = "INSERT INTO locks (type_id,subtype,state,value,owner"
	    			.",date,birth_date) VALUES ($type,'$subtype',$STATE_LOCK,'$value','$owner'"
	    			.",$timestamp,$timestamp) ON DUPLICATE KEY UPDATE date ="
	    			."$timestamp;";

	    $new_state = $STATE_LOCK;
    	
    	print "Adding new lock for $value\n";	
		$sth = $dbh->prepare($query);
        $sth->execute();
	}


$sth->finish;
$dbh->disconnect;
	
	return $new_state;
}




 
1;