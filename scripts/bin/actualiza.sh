#!/bin/sh
#
# Main update shell scripts for Bloquea
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

RUTA=`echo /home/victortellez/projects/bloquea/scripts`;
FLAG=`echo $RUTA/bin/flag_lock`;

if [ -f $FLAG ]; then
	#El bloqueo esta activo por otra ejecución concurrente de indexado
	exit
else
	#Creamos el flag de bloqueo
	touch $FLAG

	date
	echo ""
	echo "------------------------------------------------------------------"
	echo "         >>>>> Procesando logs de bloqueos remotos"
	echo "------------------------------------------------------------------"
	echo ""

	grep -v '#' $RUTA/etc/hosts | while read line 
	do
		HOST=`echo $line |  cut -d , -f1`
	    IP=`echo $line |  cut -d , -f2`
	    LOG=`echo $line |  cut -d , -f3`
	    PROGRAMA=`echo $line |  cut -d , -f4`

	    echo "Descargando el log $LOG de $HOST......."
	    scp root@$IP:$LOG $RUTA/log/$HOST

	    echo ""
		echo "Ejecutando $PROGRAMA sobre $RUTA/log/$HOST";

		cp $RUTA/log/$HOST $RUTA/log/temp

		time perl $RUTA/bin/$PROGRAMA $RUTA
		echo "Ejecución completada."
		echo ""

		rm $RUTA/log/temp

		echo "Nuevo fichero $LOG generado con éxito."
		echo ""

	    echo "Subiendo el log $LOG a $HOST......."
	    #scp $RUTA/log/output root@$IP:$LOG
	    rm $RUTA/log/output

	done


	SYSDATE=`date +%s`;
	echo "Update SYSDATE in config file to $SYSDATE"
	sed '$d' $RUTA/etc/config.pl > $RUTA/etc/config.pl.swp
	echo -n "\$SYSDATE = $SYSDATE;" >> $RUTA/etc/config.pl.swp
	mv $RUTA/etc/config.pl.swp $RUTA/etc/config.pl

	date

	#Liberamos el flag de bloqueo
	rm $FLAG
	#rm $RUTA/log/output
fi