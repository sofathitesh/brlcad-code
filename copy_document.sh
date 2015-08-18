#!/bin/bash
brlcad_resource_path="/home/smile/mybrlcadcode/brlcad/trunk/"
wordpress_path="/var/www/html/docbook/"
username='hiteshsofat'
password='hitesh@123'
#SVN Commit

#update clone repo
cd $brlcad_resource_path
sed -i 's/BRLCAD_EXTRADOCS_PHP "Build MAN page output from DocBook documentation" ON/BRLCAD_EXTRADOCS_PHP "Build MAN page output from DocBook documentation" OFF/g' "CMakeLists.txt"
svn update
output=$(svn diff)
if [ ! -z "$output" ]
	then	
		svn commit -m  "hitesh sofat updates" --non-interactive --username  $username --password $password
		svn update
		sed -i 's/BRLCAD_EXTRADOCS_PHP "Build MAN page output from DocBook documentation" OFF/BRLCAD_EXTRADOCS_PHP "Build MAN page output from DocBook documentation" ON/g' "CMakeLists.txt"
		./configure
		make
	#Create the directory in wordpress root folder
	if [ -d $wordpress_path -a -d $brlcad_resource_path ];
		then 
			cd $wordpress_path
			directory[0]=articles
			directory[1]=books
			directory[2]=lessons
			directory[3]=man1
			directory[4]=man3
			directory[5]=man5
			directory[6]=mann
			directory[7]=presentations
			directory[8]=specifications

			language_directory[0]=en
			language_directory[1]=es
			language_directory[2]=it
			language_directory[3]=ru
			language_directory[4]=hy

			for (( i =0; i < "${#directory[@]}"; i++ ))
			do 
				if [ -d "${directory[$i]}" ];
				then 
					mkdir -p "${directory[$i]}"
					echo "${directory[$i]} directory is overrided"
				else
					mkdir "${directory[$i]}"
					echo "${directory[$i]} directory is sucessfully created"
				fi
			done
			for (( i =0; i < "${#directory[@]}"; i++ ))
			do 
				if [ "$(ls -A ${directory[$i]})" ];
				then
					cd $brlcad_resource_path 
					cp -r share/doc/html/"${directory[$i]}"/* "$wordpress_path/${directory[$i]}"
					echo "${directory[$i]} is copied into articles directory"
					cd $wordpress_path 
				for ((j=0; j < "${#language_directory[@]}"; j++))
				do
					if  [ -d "${directory[$i]}/${language_directory[$j]}" ]
					then
					if [ "$i" -eq 0 ] && [ "$j" -eq 0 ]
						then
							echo "ok"
							sed -i 's/<div class="menu">/<div class="menuu">/g' "${directory[$i]}/${language_directory[$j]}/main_menu.html"
							sed -i 's/<div class="article">//g' "${directory[$i]}/${language_directory[$j]}/main_menu.html"
							sed -i 's/<div class="titlepage">//g' "${directory[$i]}/${language_directory[$j]}/main_menu.html"
							sed -i 's/<div class="itemizedlist">//g' "${directory[$i]}/${language_directory[$j]}/main_menu.html"
							sed -i 's/ class="itemizedlist"//g' "${directory[$i]}/${language_directory[$j]}/main_menu.html"
							sed -i 's/ class="listitem"//g' "${directory[$i]}/${language_directory[$j]}/main_menu.html"
							sed -i 's/<[/]div>//g' "${directory[$i]}/${language_directory[$j]}/main_menu.html"
							sed -i 's/<p>//g' "${directory[$i]}/${language_directory[$j]}/main_menu.html"
							sed -i 's/<[/]p>//g' "${directory[$i]}/${language_directory[$j]}/main_menu.html"
							sed -i 's/<hr><[/]hr>//g' "${directory[$i]}/${language_directory[$j]}/main_menu.html"
							sed -i 's/<body><ul>/<body><div class="menu"><ul id="itemizedlist">/g' "${directory[$i]}/${language_directory[$j]}/main_menu.html"
							sed -i 's/<\/body><\/html>/<\/div>/g' "${directory[$i]}/${language_directory[$j]}/main_menu.html"

					fi

						sed -i 's/<?xml version="1.0" encoding="UTF-8"?>//g' "${directory[$i]}/${language_directory[$j]}/"*.php

					else
						echo "${directory[$i]}/${language_directory[$j]}/ directory not found"
					fi
				done
			else
				cd $brlcad_resource_path 
				cp -r share/doc/html/"${directory[$i]}"/* "$wordpress_path/${directory[$i]}"
				echo "${directory[$i]} is copied into articles directory"
				cd $wordpress_path 	
				for ((j=0; j < "${#language_directory[@]}"; j++))
				do
					if  [ -d "${directory[$i]}/${language_directory[$j]}" ]
					then					
					if [ "$i" -eq 0 ] && [ "$j" -eq 0 ]
						then
							echo "ok"
							sed -i 's/<div class="menu">/<div class="menuu">/g' "${directory[$i]}/${language_directory[$j]}/main_menu.html"							
							sed -i 's/<div class="article">//g' "${directory[$i]}/${language_directory[$j]}/main_menu.html"
							sed -i 's/<div class="titlepage">//g' "${directory[$i]}/${language_directory[$j]}/main_menu.html"
							sed -i 's/<div class="itemizedlist">//g' "${directory[$i]}/${language_directory[$j]}/main_menu.html"
							sed -i 's/ class="itemizedlist"//g' "${directory[$i]}/${language_directory[$j]}/main_menu.html"
							sed -i 's/ class="listitem"//g' "${directory[$i]}/${language_directory[$j]}/main_menu.html"
							sed -i 's/<[/]div>//g' "${directory[$i]}/${language_directory[$j]}/main_menu.html"
							sed -i 's/<p>//g' "${directory[$i]}/${language_directory[$j]}/main_menu.html"
							sed -i 's/<[/]p>//g' "${directory[$i]}/${language_directory[$j]}/main_menu.html"
							sed -i 's/<hr><[/]hr>//g' "${directory[$i]}/${language_directory[$j]}/main_menu.html"
							sed -i 's/<body><ul>/<body><div class="menu"><ul id="itemizedlist">/g' "${directory[$i]}/${language_directory[$j]}/main_menu.html"
							sed -i 's/<\/body><\/html>/<\/div>/g' "${directory[$i]}/${language_directory[$j]}/main_menu.html"

					fi
						sed -i 's/<?xml version="1.0" encoding="UTF-8"?>//g' "${directory[$i]}/${language_directory[$j]}/"*.php
					else
						echo "${directory[$i]}/${language_directory[$j]}/ directory not found"
					fi
				done
			fi 
		done
	else
		echo "Source or destination resource not found"
	fi
else
	echo "Nothing changes is found"
fi
