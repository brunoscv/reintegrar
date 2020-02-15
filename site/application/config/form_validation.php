<?php
if( file_exists($filePath = APPPATH.'config'._DS_.'form_validation'._DS_.strtolower(get_active_class()).'.php') )
	include($filePath);
