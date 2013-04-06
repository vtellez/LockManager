#!/usr/bin/perl/
#
# Dovecot deny file parser
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

use Time::Local qw(timelocal);
use POSIX qw(strftime);

$PATH = $ARGV[0];
require("$PATH/etc/config.pl");

# Realizamos la conexión a la base de datos
$dbh = DBI->connect($connectionInfo,$userid,$passwd, {mysql_enable_utf8=>1}) or die "Can't connect to the database.\n";

open(IN,"$PATH/log/temp") or die("No puedo abrir el fichero temp!\n");

while (<IN>) {
chomp($_);
    print "INSERT INTO locks (type_id,state,value,owner,comment,date) VALUES (3,0,$_,'dovecot','',1364910209)\n";
	if($_=~/(.+) postfix\/cleanup\[(.+)\]: (.+): message-id=<(.+)>/){
		my $etiqueta = $3;
		my $mid = $4;

		my $key = "$etiqueta-mid";
		$mapa{$key} = $mid;

		my $key = "$mid-eti";
		$mapa{$key} = $etiqueta;
	}
	elsif($_=~/(.+) postfix\/qmgr\[(.+)\]: (.+): from=<(.+)>/){
		my $key = "$3-from";
		$mapa{$key} = $4;
			
		$query = "INSERT IGNORE INTO historial (message_id,estado,hto,fecha,maquina,descripcion,adicional) VALUES ('$mid',$estado,'$to',$fecha,'$maquina','$desc','$adicional');";
		$sth = $dbh->prepare($query);
		$sth->execute();

	} #elseif

}	#while principal

$dbh->disconnect;
close(IN);
exit;
