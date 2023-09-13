<?php

namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

 
class MyHelper 
{
    public static function load_view($viewfile, $title, $level=NULL, $custom_data=NULL) 
	{
        if($level) {
            Gate::authorize($level);
        }
		return view($viewfile, [
            'title' => $title,
			'custom_data' => $custom_data,
        ]);
    }
}