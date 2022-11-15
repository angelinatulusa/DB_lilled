<?php
$kasutaja='d113375_tulusa';//d113375_tulusa  //tulusa
$server='d113375.mysql.zonevs.eu';//d113375.mysql.zonevs.eu  //localhost
$andmebaas='d113375_lilled';//d113375_lilled  //lille_pood
$salasyna='loomad2005';//loomad2005  //123456
//teeeme käsk mis ühendab andmebaasiga
$yhendus=new mysqli($server,$kasutaja,$salasyna,$andmebaas);
$yhendus->set_charset('UTF8');
/*
 * create table loomad(
   id int primary key AUTO_INCREMENT,
   loominimi varchar(15) unique,
   vanus int,
   pilt text)*/
?>