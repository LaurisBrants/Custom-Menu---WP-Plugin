<?php

 // Exit if accessed directly.

 if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

Class Icons extends CustomDiviMenu {

    public function __construct() {		

        parent::__construct();

    }

    public static function closeSVG(){
        return 'x';
    }

}