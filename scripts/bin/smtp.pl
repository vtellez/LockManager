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

my $owner = "qmail";
my $type = $IP;

while (<IN>) 
{
	chomp($_);
	if ($_ =~ /(.+):deny/)
	{
		my $value = $1;

		my $comment = '';
		my $subtype = 'SMTP-AUTH';

		updateState($value,$type,$owner,$subtype,$comment);
		
	}else {
		#write line
	} #if
}#while

close OUTPUT;

$sth->finish;
$dbh->disconnect;
close(IN);
exit;
