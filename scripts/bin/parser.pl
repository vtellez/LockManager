#!/usr/bin/perl/
#
# Bloquea main lock files parser
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
$HOST = $ARGV[1];
$PROGRAM = $ARGV[2];

require("$PATH/etc/config.pl");
require("$PATH/bin/functions.pl");

open(IN,"$PATH/log/temp") or die("Can't locate file\n");
open(OUTPUT,"> $PATH/log/$HOST.output") or die("Can't create output file\n");

$owner = "parser";
$type = $USER;
$subtype = '';

if ($PROGRAM eq "dovecot")
{
		$owner = "dovecot";
		$type = $USER;
		$DOVECOT = 1;
}elsif ($PROGRAM eq "smtp"){
		$owner = "qmail";
		$type = $IP;
		$SMTP = 1;
}elsif ($PROGRAM eq "qevents"){
		$owner = "qmail-scanner";
		$type = $PHISHING;
		$QEVENTS = 1;
}elsif ($PROGRAM eq "iptables"){
		$owner = "owncloud";
		$type = $HDD;
		$IPTABLES = 1;
}

while (<IN>) 
{
	chomp($_);
	if ($_ =~ /(.+)@(.+)/ && $DOVECOT)
	{
		my $value = $1;
		$domain = $2;
		$subtype = $domain;
		updateState($value,$type,$owner,$subtype);
	} 
	elsif ($_ =~ /(.+):deny/ && $SMTP)
	{
		my $value = $1;
		$subtype = 'SMTP-AUTH';
		if($HOST eq "entrada_smtp2")
		{
			$subtype = "MX";
		}
		updateState($value,$type,$owner,$subtype);
	}
	elsif ($_ =~ /^[^#](.+)\tPolicy-(.+):\t(.+)/ && $QEVENTS)
	{
		my $value = $1;
		$subtype = $2;
		updateState($value,$type,$owner,$subtype);			
	}
	elsif ($_ =~ /-A INPUT -s (.+) -j REJECT/ && $IPTABLES)
	{
		my $value = $1;
		$subtype = 'IP';
		$value =~ s/\/32//;
		updateState($value,$type,$owner,$subtype);
	}
	else 
	{
		#write line
		print OUTPUT "$_\n";	
	}

}#while

# Database connection
$dbh = DBI->connect($connectionInfo,$userid,$passwd,
					{mysql_enable_utf8=>1}) or die 
					"Can't connect to the database.\n";

$timestamp = time;

# Unlock all locks that they have deleted from file
$query = "UPDATE locks SET state = $STATE_UNLOCK, date ="
	     ."$timestamp, owner = '$owner' where state = $STATE_LOCK AND "
	     ."date <= $SYSDATE AND type_id = $type";

if ($PHISHING eq 1)
{
	$query = $query.";";
}else{
	$query = $query." AND subtype = '$subtype';";	
}

$sth = $dbh->prepare($query);
$sth->execute();

print "$query\n";



# # Generamos el fichero de bloqueo
# $query = "SELECT value from locks where state = $STATE_LOCK AND type_id = $type"
# 		." AND subtype ='$subtype';";

# $sth = $dbh->prepare($query);
# $sth->execute();


# while (my $row = $sth->fetchrow_arrayref) 
# {
# 	my $value = $row->[0];
# 	print OUTPUT "$value\n";	
# 	print OUTPUT "$value\@$domain\n";
# }




$sth->finish;
$dbh->disconnect;
close(IN);
close (OUTPUT);
exit;