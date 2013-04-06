#!/usr/bin/perl/
#
# Dovecot deny file parser
# ----------------------------------------------------------------------
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

$PATH = $ARGV[0];
require("$PATH/etc/config.pl");
require("$PATH/bin/functions.pl");

# Database connection
$dbh = DBI->connect($connectionInfo,$userid,$passwd,
					{mysql_enable_utf8=>1}) or die 
					"Can't connect to the database.\n";

open(IN,"$PATH/log/temp") or die("Can't locate file\n");

while (<IN>) 
{
	chomp($_);
	if ($_ =~ /(.+)@(.+)/)
	{
		my $value = $1;
		$domain = $2;
		my $timestamp = time;
		my $owner = "dovecot";

		# Check if the lock exists previously
		$query = "SELECT lock_id,state,date FROM locks WHERE value = '"
			     ."$value' AND type_id = $USER;";

		$sth = $dbh->prepare($query);
		$sth->execute;
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

	    	print "Updating timestamp to lock for $value\n";  

	        $sth = $dbh->prepare($query);
	        $sth->execute();
	  		}
		}
		else
		{
			# Lock does not exists. Add new lock to database
		    my $query = "INSERT INTO locks (type_id,state,value,owner,comment"
		    			.",date) VALUES ($USER,$STATE_LOCK,'$value','dovecot',''"
		    			.",$timestamp) ON DUPLICATE KEY UPDATE date ="
		    			."$timestamp;";
	    	
	    	print "Adding new lock for $value\n";	
			$sth = $dbh->prepare($query);
			$sth->execute();		
		}
	} #if
}#while

$timestamp = time;
$lock_type = $USER;
$lock_owner = 'dovecot';

# Desbloqueamos en bbdd aquellos bloqueos que ya no están en el fichero       		
$query = "UPDATE locks SET state = $STATE_UNLOCK, date ="
	     ."$timestamp, owner = '$lock_owner' where state = $STATE_LOCK AND "
	     ."date <= $SYSDATE AND type_id = $lock_type";	

$sth = $dbh->prepare($query);
$sth->execute();

# Generamos el fichero de bloqueo
$query = "SELECT value from locks where state = $STATE_LOCK AND type_id = $lock_type;";

$sth = $dbh->prepare($query);
$sth->execute();

open(OUTPUT,"> $PATH/log/output") or die("Can't create output file\n");

while (my $row = $sth->fetchrow_arrayref) 
{
	my $value = $row->[0];
	print OUTPUT "$value\n";	
	print OUTPUT "$value\@$domain\n";
}

close OUTPUT;

$sth->finish;
$dbh->disconnect;
close(IN);
exit;