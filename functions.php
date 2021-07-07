<?php
 add_action( 'wp_enqueue_scripts', 'college_theme_child_style' );
function college_theme_child_style() {
    // Cache the parent theme URI and path
    $uri = get_template_directory_uri();
    $path = get_template_directory();

    // Enqueue parent style
    wp_enqueue_style(
        'parent-style',
        "$uri/static/css/style.min.css",
        [],
        filemtime("$path/static/css/style.min.css"),
        'all'
    );

    // Cache the current theme URI and path
    $uri = get_stylesheet_directory_uri();
    $path = get_stylesheet_directory();

	// Enqueue child style, making sure parent style is a dependency
	wp_enqueue_style(
        'child-style',
        "$uri/style.css",
        ['parent-style'],
        filemtime("$path/style.css"),
        'all'
    );
}

if( !function_exists( 'numberToRomanRepresentation' ) ) {
    function numberToRomanRepresentation($number) {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }
}
//hide posts
function remove_menus(){
	remove_menu_page( 'edit.php' );
}
add_action( 'admin_menu', 'remove_menus' );

?>