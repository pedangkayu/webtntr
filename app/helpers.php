<?php

function arrStatus() {
    return array(1 => "Aktif", 0 => 'Non Aktif');
}

function catHeader() {
	return array(1 => 'Top Header Menu', 2 => 'Middle Header Menu');
}

function typePost() {
	return array(0 => 'intro', 1 => 'project', 2 => 'article', 3 => 'deskripsi');
}

function StsDms() {
	return array(1 => 'statis', 2 => 'dinamis');
}

function setUrlSlug($kata){
    $new_string = strip_tags(trim($kata));
    $new_string1 = preg_replace("/[^a-zA-Z0-9-_\s]/", "", $new_string);
    $new_string2 = urlencode($new_string1);
    $new_string3 = str_replace('+','-',$new_string2);
    $new_string4 = str_replace('--','-',$new_string3);

    return strtolower($new_string4);
}

?>