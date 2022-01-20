<?php

 // Exit if accessed directly.

 if ( ! defined( 'ABSPATH' ) ) {

	exit;

}


Class CustomDiviMenu {

    
    private static $point;
    public function __construct() {		
        

    }

    public static function callMenu($menuLocation,$pointer){


        self::$point = $pointer;
        $shortcode_data = self::render($menuLocation);
	
        return $shortcode_data;



    }


    public static function menu($menuLocation){

        

            $locations = get_nav_menu_locations();

            $menu = get_term($locations[$menuLocation], 'nav_menu');

            $result = wp_get_nav_menu_items($locations[$menuLocation]);  


        return $result;      

        

    }

    public static function parenting($result,$parent){



        $data = array();

            foreach($result as $res):



                if($res->menu_item_parent == $parent):

                    $data[]=$res;

                endif;



            endforeach;

        //$return = self::render($data);

        return $data;

    }



    public static function render($menuLocation){

       
        $menu = self::menu($menuLocation);

        $result = self::parenting($menu,0);

        $out = '';

        $subo ='';

        $subo2 = '';

        if($result):            

            $out.= '<div class="main-menu-wrapper menu-wrap" data-mob="1" id="sub-1">';

                $out.= '<ul class="top-level-menu">';

            foreach($result as $res):
                    $target = '';
                if(self::faCheck($res->url) != ''):
                    $target = 'target="_blank"';
                endif;
                $out.= '<li><a href="'.$res->url.'" class="top-level-link custom-menu-link" '.$target.' data-level="1" data-target="#sub-'.$res->ID.'">'.$res->title.'</a>';

                $sub = self::parenting(self::menu($menuLocation),$res->ID);
                if($sub):
                    $out.= self::arrowSVG();
                endif;
                $out.=self::faCheck($res->url);
                $out.= '</li>';

                if($sub):

                    $subo.= '<div class="sub-menu-wrapper menu-wrap" data-mob="2" id="sub-'.$res->ID.'" style="display:none;">';
                       $subo.= '<ul class="sub-level-menu">';
                            $subo.= '<li class="mobile-title mobile-only"><h3 class="mobile-title-2"></h3></li>';


                    foreach($sub as $s):
                        $target = '';
                        if(self::faCheck($s->url) != ''):
                            $target = 'target="_blank"';
                        endif;
                        $last_level = self::parenting(self::menu($menuLocation),$s->ID);

                        $subo.= '<li><a href="'.$s->url.'" class="sub-level-link custom-menu-link" '.$target.' data-level="2" data-target="#sub-'.$s->ID.'">'.$s->title.'</a>';
                        if($last_level):
                            $subo.= self::arrowSVG();
                        endif;
                        $subo.=self::faCheck($s->url);
                        $subo.= '</li>';
                        if($last_level):

                            $subo2.= '<div class="third-menu-wrapper menu-wrap" data-mob="3" id="sub-'.$s->ID.'" style="display:none;">';
                            
                                $subo2.= '<ul class="third-level-menu">';
                                    $subo2.= '<li class="mobile-title mobile-only"><h3 class="mobile-title-3"></h3></li>';


                                    foreach($last_level as $ll):
                                        $target = '';
                                        if(self::faCheck($ll->url) != ''):
                                            $target = 'target="_blank"';
                                        endif;
                                        $subo2.= '<li><a href="'.$ll->url.'" class="last-level-link custom-menu-link" '.$target.' data-level="3">'.$ll->title.'</a>';
                                        $subo2.=  self::faCheck($ll->url);
                                        $subo2.= '</li>';

                                    endforeach;



                                $subo2.= '</ul><!-- ./third level menu end -->';

                            $subo2.= '</div><!-- ./third menu wrapper end -->';

                        endif;



                    endforeach;



                            $subo.= '</ul><!-- ./sub level menu end -->';

                        $subo.= '</div><!-- ./sub menu wrapper end -->';

                endif;



            endforeach;

            

                $out.= '</ul><!-- ./top level menu end -->';

            $out.= '</div><!-- ./manu wrapper end -->';



        endif;



        $data = '';

        $burger = self::hamburger();
        $data.= '<div class="full-menu" style="display:none;">';
        $data.= self::header();
        $data.= '<div class="menu-container">';
        $data.= $out.$subo.$subo2;
        $data.= '</div>';
        $data.= self::headerMobile();
        $data.= '</div>';
	$returner['menu'] = $data;
	$returner['burger'] = $burger;
        return $returner;



    }

    public static function header(){

        $header ='<div class="header">';
            $header.='<div class="header-container">';
                $header.='<div class="menu-header-logo">';
                    $header.= '<a href="/" title="home"><img src="' . get_option( 'dbm_logo_'.self::$point ) . '" class="menu-logo" alt="Menu Logo"></a>'; 
                    $header.= '<div class="mobile-only mobile-back-wrapper" data-target="0" data-id="0"><img src="'.get_site_url() . '/wp-content/plugins/divimenu/img/Pfeil-hellblau-svg.svg'.'" class="svg-element" alt="svg"><a href="#" id="mobile-back-btn">zurück</a></div>';
                    $header.='</div>';
                /*$header.='<div class="menu-header-links w-3 desktop-only">';
                
                    if(get_option( 'dbm_first_link_url_'.self::$point )):
                        $header.='<div class="inner-link"><a href="' . get_option( 'dbm_first_link_url_'.self::$point ) . '" class="header-link">'.self::linkSVG().'<div class="icon-text">'.get_option( 'dbm_first_link_name_'.self::$point ).'</div></a></div>';
                    endif;

                    if(get_option( 'dbm_second_link_url_'.self::$point )):
                        $header.='<div class="inner-link"><a href="' . get_option( 'dbm_second_link_url_'.self::$point ) . '" class="header-link">'.self::arrowSVG().'<div class="icon-text">'.get_option( 'dbm_second_link_name_'.self::$point ).'</div></a></div>';
                    endif;

                    if(get_option( 'dbm_third_link_url_'.self::$point )):
                        $header.='<div class="inner-link"><a href="' . get_option( 'dbm_third_link_url_'.self::$point ) . '" class="header-link">'.self::linkSVG().'<div class="icon-text">'.get_option( 'dbm_third_link_name_'.self::$point ).'</div></a></div>';
                    endif;

                    $header.='</div>'; */
                $header.='<div class="menu-close"><div class="menu-close-text">schliessen</div><div class="menu-close-icon">'.self::closeSVG().'</div></div>';
            $header.='</div>';
        $header.='</div>';
        return $header;

    }

    public static function headerMobile(){

        $header ='<div class="header tablet-only">';
            $header.='<div class="mobile-header-container">';
                $header.='<div class="menu-header-links mobile-links">';

                if(get_option( 'dbm_first_link_url_'.self::$point )):
                    $header.='<div class="inner-link"><a href="' . get_option( 'dbm_first_link_url_'.self::$point ) . '" class="header-link">'.self::linkSVG().'<div class="icon-text">'.get_option( 'dbm_first_link_name_'.self::$point ).'</div></a></div>';
                endif;

                if(get_option( 'dbm_second_link_url_'.self::$point )):
                    $header.='<div class="inner-link"><a href="' . get_option( 'dbm_second_link_url_'.self::$point ) . '" class="header-link">'.self::arrowSVG().'<div class="icon-text">'.get_option( 'dbm_second_link_name_'.self::$point ).'</div></a></div>';
                endif;

                if(get_option( 'dbm_third_link_url_'.self::$point )):
                    $header.='<div class="inner-link"><a href="' . get_option( 'dbm_third_link_url_'.self::$point ) . '" class="header-link">'.self::linkSVG().'<div class="icon-text">'.get_option( 'dbm_third_link_name_'.self::$point ).'</div></a></div>';
                endif;
                $header.='</div>';
            $header.='</div>';
        $header.='</div>';
        return $header;

    }

    public static function faCheck($url){

        $fawesome='';

        $domain = $_SERVER['SERVER_NAME'];
        $url_info = parse_url($url);
        if($url_info):
            if($domain == $url_info["host"]):
                $fawesome = '';
            else:
                $fawesome = self::linkSVG();
            endif;
        endif;
        return $fawesome;

    }

    public static function linkSVG(){

        $svg = '<div class="icon-svg"><svg version="1.2" baseProfile="tiny-ps" xmlns="http://www.w3.org/2000/svg" width="30" height="30">';
        $svg.= '<path id="Layer" class="shp0" d="M11.13 0.42L9.63 1.92L1.5 1.92L1.5 15.42L15 15.42L15 10.92L16.5 9.42L16.5 16.92L0 16.92L0 0.42L11.13 0.42ZM18.75 4.92L13.83 9.84L12.75 8.79L15.89 5.67L8.62 5.67C8.28 5.67 7.94 5.74 7.62 5.88C7.3 6.01 7.02 6.21 6.77 6.45C6.53 6.69 6.34 6.98 6.2 7.3C6.07 7.62 6 7.96 6 8.3C6 8.64 6.07 8.98 6.2 9.3C6.33 9.62 6.53 9.91 6.77 10.15C7.01 10.39 7.3 10.59 7.62 10.72C7.94 10.85 8.28 10.92 8.62 10.92L9 10.92L9 12.42L8.62 12.42C8.35 12.43 8.08 12.4 7.81 12.35C7.55 12.3 7.29 12.22 7.04 12.12C6.79 12.02 6.55 11.89 6.33 11.73C6.1 11.58 5.9 11.41 5.71 11.21C5.51 11.02 5.34 10.82 5.19 10.59C5.03 10.37 4.9 10.13 4.8 9.88C4.7 9.63 4.62 9.37 4.57 9.11C4.52 8.84 4.49 8.57 4.5 8.3C4.5 8.03 4.52 7.76 4.57 7.49C4.62 7.23 4.7 6.97 4.8 6.72C4.91 6.47 5.04 6.23 5.19 6C5.34 5.78 5.52 5.57 5.71 5.38C5.9 5.18 6.1 5.01 6.33 4.86C6.55 4.7 6.79 4.57 7.04 4.47C7.29 4.37 7.55 4.29 7.81 4.24C8.08 4.19 8.35 4.16 8.62 4.17L15.87 4.17L12.75 1.05L13.8 0L18.75 4.92Z" />';
        $svg.= '</svg></div>';

        return $svg;
    }

    public static function arrowSVG(){

        $arrow = '';
        $arrow.= '<div class="icon-svg"><svg version="1.2" baseProfile="tiny-ps" xmlns="http://www.w3.org/2000/svg" width="30" height="30">';
		$arrow.= '<g id="Ebene_2">';
		$arrow.= '<g id="Ebene_1-2">';
		$arrow.= '<path id="Layer" class="shp0" d="M17.41 6.38L17.93 6.91L17.41 7.45L11 13.83L10 12.75L15.09 7.66L0 7.66L0 6.16L15.05 6.16L10 1.08L11 0L17.41 6.38Z" />';
		$arrow.= '</g>';
        $arrow.= '</g>';
        $arrow.= '</svg></div>';
        return $arrow;

    }

    public static function closeSVG(){
        $close='<svg class="menu-close-svg-icon" viewBox="0 0 20 20">';
		$close.= '<path fill="none" d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z"></path>';
        $close.= '</svg>';
        return $close;
    }

    public static function searchForm(){
        
        $form = '<form role="search" method="get" id="searchform" class="searchform desktop-only dbm-form" action="/">';
            $form .='<div>';
            $form .='<input type="text" value="" placeholder="Suche" name="s" id="s">';
            $form .= '<svg id="Ebene_1" data-name="Ebene 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17.68 17.68"><defs><style>.cls-1{isolation:isolate;}.cls-2{fill:#245a7e;}</style></defs><g id="_" data-name=" " class="cls-1"><g class="cls-1"><path class="cls-2" d="M301.17,419.18A6.87,6.87,0,0,1,290,424.51L284.48,430l-1-1,5.48-5.48a6.87,6.87,0,1,1,12.2-4.34Zm-12.37,0a5.5,5.5,0,1,0,1.61-3.89A5.32,5.32,0,0,0,288.8,419.18Z" transform="translate(-283.49 -412.31)"/></g></g></svg>';
            $form .='<input type="submit" id="searchsubmit">';
            $form .='</div>';
        $form .='</form>';
      /*  $form = '<form role="search" method="get" class="et_pb_searchform desktop-only" id="dbm-form" action="/">';
        $form .='<div class="dbm-form-inner">';
        $form .='<label class="screen-reader-text" for="s">Suchen nach:</label>';
        $form .='<input type="text" name="s" placeholder="Suche" class="et_pb_s">';
        $form .='<input type="hidden" name="et_pb_searchform_submit" value="et_search_proccess">';
                
        $form .='<input type="hidden" name="et_pb_include_posts" value="yes">';
        $form .='<input type="hidden" name="et_pb_include_pages" value="yes">';
        $form .='<input type="submit" value="Suche" class="et_pb_searchsubmit" style="display:none;">';
        $form .= '<svg class="svg-icon desktop-only" viewBox="0 0 20 20">
        <path d="M18.125,15.804l-4.038-4.037c0.675-1.079,1.012-2.308,1.01-3.534C15.089,4.62,12.199,1.75,8.584,1.75C4.815,1.75,1.982,4.726,2,8.286c0.021,3.577,2.908,6.549,6.578,6.549c1.241,0,2.417-0.347,3.44-0.985l4.032,4.026c0.167,0.166,0.43,0.166,0.596,0l1.479-1.478C18.292,16.234,18.292,15.968,18.125,15.804 M8.578,13.99c-3.198,0-5.716-2.593-5.733-5.71c-0.017-3.084,2.438-5.686,5.74-5.686c3.197,0,5.625,2.493,5.64,5.624C14.242,11.548,11.621,13.99,8.578,13.99 M16.349,16.981l-3.637-3.635c0.131-0.11,0.721-0.695,0.876-0.884l3.642,3.639L16.349,16.981z"></path>
    </svg>';
        $form .='</div>';
        $form .='</form>';*/


        return $form;

    }

    public static function mobSearchForm(){
        $form = '<div class="mobile-search-f-wrapper" style="display:none;">';
        $form .= '<form role="search" method="get" id="searchform" class="searchform mobile-only dbm-form" action="/">';
        $form .='<div class="dbm-form-inner">';
        $form .='<input type="text" value="" name="s" id="s">';
        $form .= '<svg id="Ebene_1" data-name="Ebene 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17.68 17.68"><defs><style>.cls-1{isolation:isolate;}.cls-2{fill:#245a7e;}</style></defs><g id="_" data-name=" " class="cls-1"><g class="cls-1"><path class="cls-2" d="M301.17,419.18A6.87,6.87,0,0,1,290,424.51L284.48,430l-1-1,5.48-5.48a6.87,6.87,0,1,1,12.2-4.34Zm-12.37,0a5.5,5.5,0,1,0,1.61-3.89A5.32,5.32,0,0,0,288.8,419.18Z" transform="translate(-283.49 -412.31)"/></g></g></svg>';
    $form .='<input type="submit" id="searchsubmit">';
        $form .='</div>';
        $form .='</form>';
        $form .= '</div>';


        return $form;

    }

    public static function hamburger(){

            $burg='';

            $burg.='<div class="burger-wrapper"><div>'.self::searchForm().'</div>';
            $burg.='<div class="db-switcher desktop-only"><a href="'.get_option( 'dbm_switcher_link_url_'.self::$point ) .'">'.get_option( 'dbm_switcher_link_name_'.self::$point ) .'</a></div>';
           
            $burg.= '<svg id="Ebene_1" class="svg-icon mobile-only mobile-search-icon" data-name="Ebene 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17.68 17.68"><defs><style>.cls-1{isolation:isolate;}.cls-2{fill:#245a7e;}</style></defs><g id="_" data-name=" " class="cls-1"><g class="cls-1"><path class="cls-2" d="M301.17,419.18A6.87,6.87,0,0,1,290,424.51L284.48,430l-1-1,5.48-5.48a6.87,6.87,0,1,1,12.2-4.34Zm-12.37,0a5.5,5.5,0,1,0,1.61-3.89A5.32,5.32,0,0,0,288.8,419.18Z" transform="translate(-283.49 -412.31)"/></g></g></svg>';
            $burg.= self::mobSearchForm();
            $burg.='<div>Menü</div><div class="h-container">';

            $burg.='<div id="hamburger" onclick="this.classList.toggle(\'open\');">';

            $burg.='<svg width="50" height="50" viewBox="0 0 100 100">';

            $burg.='<path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />';

            $burg.='<path class="line line2" d="M 20,50 H 80" />';

            $burg.='<path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />';

            $burg.='</svg>';

            $burg.='</div>';

            $burg.='</div></div>';

        return $burg;

    }



}

