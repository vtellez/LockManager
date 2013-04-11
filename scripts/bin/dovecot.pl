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


open(IN,"$PATH/log/temp") or die("Can't locate file\n");
open(OUTPUT,"> $PATH/log/output") or die("Can't create output file\n");

my $owner = "dovecot";
my $type = $USER;

while (<IN>) 
{
	chomp($_);
	if ($_ =~ /(.+)@(.+)/)
	{
		my $value = $1;
		$domain = $2;
		
		my $comment = '';
		my $subtype = 'us.es';

		updateState($value,$type,$owner,$subtype,$comment);


	} #if
}#while



# Database connection
$dbh = DBI->connect($connectionInfo,$userid,$passwd,
					{mysql_enable_utf8=>1}) or die 
					"Can't connect to the database.\n";

$timestamp = time;


# Desbloqueamos en bbdd aquellos bloqueos que ya no están en el fichero       		
$query = "UPDATE locks SET state = $STATE_UNLOCK, date ="
	     ."$timestamp, owner = '$owner' where state = $STATE_LOCK AND "
	     ."date <= $SYSDATE AND type_id = $type";	

$sth = $dbh->prepare($query);
$sth->execute();

# Generamos el fichero de bloqueo
$query = "SELECT value from locks where state = $STATE_LOCK AND type_id = $type;";

$sth = $dbh->prepare($query);
$sth->execute();


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
