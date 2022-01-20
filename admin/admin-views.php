<?php
//General Admin Page
function dbmGeneral(){ ?>
    <div class="wrap">
        <h2>Custom Menu General Settings</h2>
        <form class="custom-menu-settings" method="post" action="options.php">
            <?php
                settings_fields( 'dbmGeneral_settings' );
                do_settings_sections( 'dbmGeneral_settings' );
                submit_button();
            ?>
        </form>
        <style>
            .custom-menu-settings table tr:nth-child(even){
                background:white;
            }
            .custom-menu-settings table tr:nth-child(odd){
                background:lightgray;
            }
        </style>
    </div> <?php
}

function dbm_sections() {

    add_settings_section( 'dbm_header_settings', 'Header settings', false, 'dbmGeneral_settings' );

}

add_action( 'admin_init', 'dbm_sections' );

function dbm_fields() {

    add_settings_field( 'dbm_logo_1', 'Logo School Menu', 'dbmFields_1', 'dbmGeneral_settings', 'dbm_header_settings' );
    add_settings_field( 'dbm_logo_2', 'Logo Comunity Menu', 'dbmFields_2', 'dbmGeneral_settings', 'dbm_header_settings' );
    add_settings_field( 'dbm_menu_selector_1', 'Select School Menu', 'dbmSelect', 'dbmGeneral_settings', 'dbm_header_settings' );
    add_settings_field( 'dbm_menu_selector_2', 'Select Comunity Menu', 'dbmSelect_2', 'dbmGeneral_settings', 'dbm_header_settings' );
    add_settings_field( 'dbm_first_link_name_1', 'First Link for School Menu', 'dbmFirstLink_1', 'dbmGeneral_settings', 'dbm_header_settings' );
    add_settings_field( 'dbm_first_link_name_2', 'First Link for Community Menu', 'dbmFirstLink_2', 'dbmGeneral_settings', 'dbm_header_settings' );
    add_settings_field( 'dbm_second_link_name_1', 'Second Link for School Menu', 'dbmSecondLink_1', 'dbmGeneral_settings', 'dbm_header_settings' );
    add_settings_field( 'dbm_second_link_name_2', 'Second Link for Community Menu', 'dbmSecondLink_2', 'dbmGeneral_settings', 'dbm_header_settings' );
    add_settings_field( 'dbm_third_link_name_1', 'Third Link for School Menu', 'dbmThirdLink_1', 'dbmGeneral_settings', 'dbm_header_settings' );
    add_settings_field( 'dbm_third_link_name_2', 'Third Link for Community Menu', 'dbmThirdLink_2', 'dbmGeneral_settings', 'dbm_header_settings' );
    add_settings_field( 'switcher_link_name_1', 'Switcher For Comunity Menu', 'dbmComLink_1', 'dbmGeneral_settings', 'dbm_header_settings' );
    add_settings_field( 'switcher_link_name_2', 'Switcher For School Menu', 'dbmComLink_2', 'dbmGeneral_settings', 'dbm_header_settings' );
    
}

add_action( 'admin_init', 'dbm_fields' );

function dbmFields_1() {
      
    echo '<div style="background:lightgray;padding:10px"><input name="dbm_logo_1" id="dbm_logo_1" type="text" value="' . get_option( 'dbm_logo_1' ) . '" /></div>';
   
}

function dbmFields_2() {
      
    echo '<div style="background:white;padding:10px"><input name="dbm_logo_2" id="dbm_logo_2" type="text" value="' . get_option( 'dbm_logo_2' ) . '" /></div>';
   
}

function dbmFirstLink_1(){
    echo '<div style="background:lightgray;padding:10px">';
    echo '<label for="dbm_first_link_name_1">Neme for First Link <br><b>NOW: '. get_option( 'dbm_first_link_name_1' ) .'</b></label><br>';
    echo '<input name="dbm_first_link_name_1" id="dbm_first_link_name_1" type="text" value="' . get_option( 'dbm_first_link_name_1' ) . '" /><br>';
    echo '<label for="dbm_first_link_url_1">URL for First Link <br><b>NOW: '. get_option( 'dbm_first_link_url_1' ) .'</b></label><br>';
    echo '<input name="dbm_first_link_url_1" id="dbm_first_link_url_1" type="text" value="' . get_option( 'dbm_first_link_url_1' ) . '" />';
    echo '</div>';
}

function dbmFirstLink_2(){
    echo '<div style="background:white;padding:10px">';
    echo '<label for="dbm_first_link_name_2">Neme for First Link <br><b>NOW: '. get_option( 'dbm_first_link_name_2' ) .'</b></label><br>';
    echo '<input name="dbm_first_link_name_2" id="dbm_first_link_name_2" type="text" value="' . get_option( 'dbm_first_link_name_2' ) . '" /><br>';
    echo '<label for="dbm_first_link_url_2">URL for First Link <br><b>NOW: '. get_option( 'dbm_first_link_url_2' ) .'</b></label><br>';
    echo '<input name="dbm_first_link_url_2" id="dbm_first_link_url" type="text" value="' . get_option( 'dbm_first_link_url_2' ) . '" />';
    echo '</div>';
}

function dbmSecondLink_1(){
    echo '<div style="background:lightgray;padding:10px">';
    echo '<label for="dbm_second_link_name_1">Neme for Second Link <br><b>NOW: '. get_option( 'dbm_second_link_name_1' ) .'</b></label><br>';
    echo '<input name="dbm_second_link_name_1" id="dbm_second_link_name_1" type="text" value="' . get_option( 'dbm_second_link_name_1' ) . '" /><br>';
    echo '<label for="dbm_second_link_url">URL for Second Link <br><b>NOW: '. get_option( 'dbm_second_link_url_1' ) .'</b></label><br>';
    echo '<input name="dbm_second_link_url_1" id="dbm_first_link_url_1" type="text" value="' . get_option( 'dbm_second_link_url_1' ) . '" />';
    echo '</div>';
}

function dbmSecondLink_2(){
    echo '<div style="background:white;padding:10px">';
    echo '<label for="dbm_second_link_name_2">Neme for Second Link <br><b>NOW: '. get_option( 'dbm_second_link_name_2' ) .'</b></label><br>';
    echo '<input name="dbm_second_link_name_2" id="dbm_second_link_name_2" type="text" value="' . get_option( 'dbm_second_link_name_2' ) . '" /><br>';
    echo '<label for="dbm_second_link_url_2">URL for Second Link <br><b>NOW: '. get_option( 'dbm_second_link_url_2' ) .'</b></label><br>';
    echo '<input name="dbm_second_link_url_2" id="dbm_first_link_url_2" type="text" value="' . get_option( 'dbm_second_link_url_2' ) . '" />';
    echo '</div>';
}

function dbmThirdLink_1(){
    echo '<div style="background:lightgray;padding:10px">';
    echo '<label for="dbm_third_link_name_1">Neme for Third Link <br><b>NOW: '. get_option( 'dbm_third_link_name_1' ) .'</b></label><br>';
    echo '<input name="dbm_third_link_name_1" id="dbm_second_link_name" type="text" value="' . get_option( 'dbm_third_link_name_1' ) . '" /><br>';
    echo '<label for="dbm_third_link_url_1">URL for Third Link <br><b>NOW: '. get_option( 'dbm_third_link_url_1' ) .'</b></label><br>';
    echo '<input name="dbm_third_link_url_1" id="dbm_third_link_url_1" type="text" value="' . get_option( 'dbm_third_link_url_1' ) . '" />';
    echo '</div>';
}

function dbmThirdLink_2(){
    echo '<div style="background:white;padding:10px">';
    echo '<label for="dbm_third_link_name_2">Neme for Third Link <br><b>NOW: '. get_option( 'dbm_third_link_name_2' ) .'</b></label><br>';
    echo '<input name="dbm_third_link_name_2" id="dbm_second_link_name_2" type="text" value="' . get_option( 'dbm_third_link_name_2' ) . '" /><br>';
    echo '<label for="dbm_third_link_url_2">URL for Third Link <br><b>NOW: '. get_option( 'dbm_third_link_url_2' ) .'</b></label><br>';
    echo '<input name="dbm_third_link_url_2" id="dbm_third_link_url_2" type="text" value="' . get_option( 'dbm_third_link_url_2' ) . '" />';
    echo '</div>';
}

function dbmComLink_1(){
    echo '<div style="background:lightgray;padding:10px">';
    echo '<label for="dbm_switcher_link_name_1">Switcher Name For Comunity Menu <br><b>NOW: '. get_option( 'dbm_switcher_link_name_1' ) .'</b></label><br>';
    echo '<input name="dbm_switcher_link_name_1" id="dbm_second_link_name" type="text" value="' . get_option( 'dbm_switcher_link_name_1' ) . '" /><br>';
    echo '<label for="dbm_switcher_link_url_1">Switcher Link For Comunity Menu <br><b>NOW: '. get_option( 'dbm_switcher_link_url_1' ) .'</b></label><br>';
    echo '<input name="dbm_switcher_link_url_1" id="dbm_switcher_link_url_1" type="text" value="' . get_option( 'dbm_switcher_link_url_1' ) . '" />';
    echo '</div>';
}

function dbmComLink_2(){
    echo '<div style="background:white;padding:10px">';
    echo '<label for="dbm_switcher_link_name_2">Switcher Name For School Menu <br><b>NOW: '. get_option( 'dbm_switcher_link_name_2' ) .'</b></label><br>';
    echo '<input name="dbm_switcher_link_name_2" id="dbm_second_link_name_2" type="text" value="' . get_option( 'dbm_switcher_link_name_2' ) . '" /><br>';
    echo '<label for="dbm_switcher_link_url_2">Switcher Link For School Menu <br><b>NOW: '. get_option( 'dbm_switcher_link_url_2' ) .'</b></label><br>';
    echo '<input name="dbm_switcher_link_url_2" id="dbm_switcher_link_url_2" type="text" value="' . get_option( 'dbm_switcher_link_url_2' ) . '" />';
    echo '</div>';
}

function dbmSelect(){

    $selector = get_registered_nav_menus();  
    echo '<p>Calling this menu. Use shortcode [dbm-divi-menu target=1]</br>';
    echo '<div style="background:lightgray;padding:10px"><select name="dbm_menu_selector_1" id="dbm_selector">';
    echo '<option value="'.get_option('dbm_menu_selector_1').'">'.get_option('dbm_menu_selector_1').'</option>';
    foreach($selector as $key => $val):
        echo '<option value="'.$key.'">'.$val.'</option>';
    endforeach;
    echo '</select></div>';

}

function dbmSelect_2(){

    $selector = get_registered_nav_menus(); 
    echo '<p>Calling this menu. Use shortcode [dbm-divi-menu target=2]<br>'; 
    echo '<div style="background:white;padding:10px"><select name="dbm_menu_selector_2" id="dbm_selector">';
    echo '<option value="'.get_option('dbm_menu_selector_2').'">'.get_option('dbm_menu_selector_2').'</option>';
    foreach($selector as $key => $val):
        echo '<option value="'.$key.'">'.$val.'</option>';
    endforeach;
    echo '</select></div>';

}

function Setting_() {
    register_setting( 'dbmGeneral_settings', 'dbm_logo_1' );
    register_setting( 'dbmGeneral_settings', 'dbm_logo_2' );
    register_setting( 'dbmGeneral_settings', 'dbm_menu_selector_1' );
    register_setting( 'dbmGeneral_settings', 'dbm_menu_selector_2' );
    register_setting( 'dbmGeneral_settings', 'dbm_first_link_name_1' );
    register_setting( 'dbmGeneral_settings', 'dbm_first_link_url_1' );
    register_setting( 'dbmGeneral_settings', 'dbm_first_link_name_2' );
    register_setting( 'dbmGeneral_settings', 'dbm_first_link_url_2' );     
    register_setting( 'dbmGeneral_settings', 'dbm_second_link_name_1' );
    register_setting( 'dbmGeneral_settings', 'dbm_second_link_url_1' );
    register_setting( 'dbmGeneral_settings', 'dbm_second_link_name_2' );
    register_setting( 'dbmGeneral_settings', 'dbm_second_link_url_2' );
    register_setting( 'dbmGeneral_settings', 'dbm_third_link_name_1' );
    register_setting( 'dbmGeneral_settings', 'dbm_third_link_url_1' );
    register_setting( 'dbmGeneral_settings', 'dbm_third_link_name_2' );
    register_setting( 'dbmGeneral_settings', 'dbm_third_link_url_2' );
    register_setting( 'dbmGeneral_settings', 'dbm_switcher_link_name_1' );
    register_setting( 'dbmGeneral_settings', 'dbm_switcher_link_url_1' );
    register_setting( 'dbmGeneral_settings', 'dbm_switcher_link_name_2' );
    register_setting( 'dbmGeneral_settings', 'dbm_switcher_link_url_2' );
}
   
add_action( 'admin_init', 'Setting_' );