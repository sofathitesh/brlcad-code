<?php
/**
 * brlcad functions and definitions
 *
 * @package brlcad
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'brlcad_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function brlcad_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on brlcad, use a find and replace
	 * to change 'brlcad' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'brlcad', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'brlcad' ),
		'sidebar' => __( 'Sidebar Menu' )
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'brlcad_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // brlcad_setup
add_action( 'after_setup_theme', 'brlcad_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function brlcad_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'brlcad' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Left Sidebar', 'brlcad' ),
		'id'            => 'footer-sidebar-left',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	register_sidebar( array(
		'name'          => __( 'Footer Center Sidebar', 'brlcad' ),
		'id'            => 'footer-sidebar-center',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	register_sidebar( array(
		'name'          => __( 'Footer Right Sidebar', 'brlcad' ),
		'id'            => 'footer-sidebar-right',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
}
add_action( 'widgets_init', 'brlcad_widgets_init' );

/**
 * Enqueue scripts and styles.
 */

/* load Google's CDN */
function sp_load_jquery() {
    if ( ! is_admin() && !wp_script_is( 'jquery' ) ) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js", false, null);
        wp_enqueue_script('jquery');
    }
    if ( ! is_admin() && !wp_script_is( 'jquery' ) ) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js", false, null);
        wp_enqueue_script('jquery');
    }
}
add_action('wp_enqueue_scripts', 'sp_load_jquery');

function brlcad_scripts() {
	wp_enqueue_style( 'foundation', get_template_directory_uri() . '/css/foundation.min.css' );

	wp_enqueue_style( 'menu', get_template_directory_uri() . '/css/jquery.treemenu.css' );

	wp_enqueue_style( 'brl-cadbase', get_template_directory_uri() . '/css/base.css' );

	wp_enqueue_style( 'brl-media-queries', get_template_directory_uri() . '/css/media-queries.css' );

	wp_enqueue_style( 'brl-plugins', get_template_directory_uri() . '/css/plugins.css' );

	wp_enqueue_style( 'do-style', get_template_directory_uri() . '/css/brlcad.css' );

	wp_enqueue_style( 'google-search', get_template_directory_uri() . '/css/google-search.css' );

	wp_enqueue_style( 'brlcad-style', get_stylesheet_uri() );


//	wp_enqueue_script( 'brlcad-ui','http://code.jquery.com/ui/1.11.4/jquery-ui.js', array('jquery'), '20131225', true );

	wp_enqueue_script( 'brlcad-main', get_template_directory_uri() . '/js/main.js', array('jquery'), '20131224', true );

	wp_enqueue_script( 'brlcad-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'brlcad-jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), '', true );

	wp_enqueue_script( 'brlcad-documents', get_template_directory_uri() . '/js/jquery.treemenu.js', array(), '', true );

	wp_enqueue_script( 'doc', get_template_directory_uri() . '/js/doc.js', array(), '', true );

	wp_enqueue_script( 'brlcad-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'brlcad_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

function edit(){
	$url = explode("/", $_SERVER['SCRIPT_FILENAME']);
	$length = sizeof($url);
	$call_back_url = home_url()."/".$url[$length-3]."/".$url[$length-2]."/".$url[$length-1]."?o";
	if($_GET['mode'])
	{
		wp_redirect(home_url()."/wp-content/plugins/brlcad-docbook/edit.php?&article=".urlencode($_SERVER['SCRIPT_FILENAME'])."&url=http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."?o");
	}else
	{
	echo "<a href='".home_url()."/wp-content/plugins/brlcad-docbook/edit.php?&article=".urlencode($_SERVER['SCRIPT_FILENAME'])."&url=".$call_back_url."?o'>
	<input type='button' value='Edit'></a><br>";
}
}
function without_login_edit(){
	$url = explode("/", $_SERVER['SCRIPT_FILENAME']);
	$length = sizeof($url);
	$call_back_url = home_url()."/".$url[$length-3]."/".$url[$length-2]."/".$url[$length-1];
	if($_GET['mode'])
	{
		wp_redirect(home_url()."/wp-content/plugins/brlcad-docbook/edit.php?&article=".urlencode($_SERVER['SCRIPT_FILENAME'])."&url=http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."?o");
	}else
	{
		if(array_search("presentations", $url))
		{
			echo "<table>"; 
			echo "<tr><td>"; 
	echo "<a href='".home_url()."/wp-content/plugins/brlcad-docbook/edit.php?&article=".urlencode($_SERVER['SCRIPT_FILENAME'])."&url=".$call_back_url."'>
	<input type='button' value='Edit'></a></td><td>";			
	echo "<a href='".home_url()."/wp-content/plugins/brlcad-docbook/edit.php?&article=".str_replace("Introduction-","",$_SERVER['SCRIPT_FILENAME'])."&url=".$call_back_url."'>
	<input type='button' value='Edit Presentation'></a></td></tr></table>";			

		}else
		{
	echo "<a href='".home_url()."/wp-content/plugins/brlcad-docbook/edit.php?&article=".urlencode($_SERVER['SCRIPT_FILENAME'])."&url=".$call_back_url."'>
	<input type='button' value='Edit'></a><br>";
}
}
}
if(!function_exists(main_menu)):
function main_menu()
{
$file = fopen('../../articles/en/main_menu.html','r');
$fr = fread($file, filesize('../../articles/en/main_menu.html'));
$_COOKIE['main_menu'] = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url = explode("/",$_COOKIE["main_menu"]);
$get_url_size = sizeof($url);
$original = 'href="../../'.$url[$get_url_size-3].'/'.$url[$get_url_size-2].'/'.$url[$get_url_size-1].'"';
$replaced = 'id="unique" href="../../'.$url[$get_url_size-3].'/'.$url[$get_url_size-2].'/'.$url[$get_url_size-1].'"';
$fr =str_replace($original, $replaced, $fr);
$fr =str_replace('class="menu"','class="menuu"' , $fr);
$fr =str_replace("../x.php","#" , $fr);
$fr =str_replace("../xx.php","##" , $fr);
$fr =str_replace("../xxx.php","###" , $fr);
$fr =str_replace("../xxxx.php","####" , $fr);
$fr =str_replace("../xxxxx.php","#####" , $fr);
$fr =str_replace("../xxxxxx.php","######" , $fr);
$fr =str_replace("../xxxxxxx.php","#######" , $fr);
$fr =str_replace("../xxxxxxxx.php","########" , $fr);
$fr =str_replace("../xxxxxxxxx.php","#########" , $fr);
$fr = str_replace("<a","<a onclick='TreeMenu.toggle(this)'", $fr);
		echo $fr;
}
endif;

if(!function_exists(brlcad_language)):
function brlcad_language(){
echo "<div id='brlcad'>";
$languages = array(
	"aa"=>"South_Afriica.png",
	"sq"=>"Albania.png",
	"ar"=>"Arab_Language",
	"hy"=>"Armenia.png",
	"az"=>"Azerbaijan.png",
	"be"=>"Belarus.png",
	"bn"=>"Bangladesh.png",
	"bs"=>"Bosnia_&_Herzegovina.png",
	"bg"=>"Bulgaria.png",
	"ca"=>"Andorra.png",
	"ceb"=>"Philippines.png",
	"zh"=>"China.png",
	"hr"=>"Croatia.png",
	"cs"=>"Czech_Republic.png",
	"da"=>"Denmark.png",
	"nl"=>"Netherlands.png",
	"en"=>"United_Kingdom.png",
	"et"=>"Estonia.png",
	"fi"=>"Finland.png",
	"fr"=>"France.png",
	"ka"=>"Georgia.png",
	"de"=>"Germany.png",
	"el"=>"Greece.png",
	"ht"=>"Haiti.png",
	"ha"=>"Nigeria.png",
	"id"=>"Indonesia.png",
	"hi"=>"India.png",
	"hu"=>"Hungary.png",
	"is"=>"Iceland.png",
	"ga"=>"Ireland.png",
	"it"=>"Italy.png",
	"ja"=>"Japan.png",
	"km"=>"Viet_Nam.png",
	"ko"=>"South_Korea.png",
	"lo"=>"Thailand.png",
	"lt"=>"Lithuania.png",
	"mk"=>"Macedonia.png",
	"ms"=>"Malaysia.png",
	"mt"=>"Malta.png",
	"mi"=>"New_Zealand.png",
	"mn"=>"Mongolia.png",
	"ne"=>"Nepal.png",
	"pt"=>"Brazil.png",
	"ro"=>"Romania.png",
	"ru"=>"Russian_Federation.png",
	"sr"=>"Serbia.png",
	"sk"=>"Slovakia.png",
	"so"=>"Somalia.png",
	"es"=>"Spain.png",
	"sw"=>"Kenya.png",
	"sv"=>"Finland.png",
	"tr"=>"Turkey.png",
	"uk"=>"Ukraine.png",
	"ur"=>"Pakistan.png",
	"cy"=>"England.png",
	);
$languages_with_fullname = array(
	"aa"=>"Afrikaans",
	"sq"=>"shqip",
	"ar"=>" العربية",
	"hy"=>"Հայերէն",
	"az"=>"آذربايجانجا ديلي",
	"be"=>"Беларуская мова",
	"bs"=>"bosanski",
	"bg"=>"Bulgraian",
	"zh"=>"廣東話",
	"hr"=>"Hrvatski",
	"da"=>"dansk",
	"en"=>"English",
	"fr"=>"français",
	"ka"=>"ქართული",
	"el"=>"ελληνικά",
	"id"=>"Bahasa Indonesia",
	"hi"=>"हिन्दी",
	"hu"=>"magyar nyelv",
	"is"=>"Íslenska",
	"ga"=>"Ghaeilge",
	"it"=>"italiano",
	"ja"=>"日本語",
	"km"=>"ភាសាខ្មែរ",
	"lo"=>"ພາສາລາວ",
	"lt"=>"lietuvių kalba",
	"mk"=>"македонски",
	"mi"=>"te Reo Māori",
	"ro"=>"limba română",
	"ru"=>"Русский язык",
	"sr"=>"српски",
	"sk"=>"slovenčina",
	"es"=>"español",
	"sw"=>"Kiswahili",
	"ur"=>" اردو",	);
error_reporting(0);
$dir = explode("/", $_SERVER['SCRIPT_FILENAME']);
$length = sizeof($dir);
$dir_open = scandir("../../".$dir[$length-3]);
$count = 0;
echo "<div id='brlcad_language'><table style=''>";
foreach ($dir_open as $dir_languages) {
	if(!is_dir($dir_languages))	
		$file_search = scandir("../../".$dir[$length-3]."/".$dir_languages);
		foreach($file_search as $files){
			if(strpos($files,".php"))
			{
				$get_first_word_of_filename = explode("_",$dir[$length-1]);
 				if(preg_match("/".str_replace(".php","",$get_first_word_of_filename[0])."/", $files))
				{
					if($count % 2 != 0 )
					{
					echo "<tr style='border:1px solid #c9c9c9'><td><a href='".home_url()."/".$dir[$length-3]."/".$dir_languages."/".$files."'>
					<img style='padding-right:5%' src='".get_template_directory_uri(__FILE__)."/img/16/".$languages[$dir_languages]."' title='".$dir_languages."'></a><a href='".home_url()."/".$dir[$length-3]."/".$dir_languages."/".$files."'>".$languages_with_fullname[$dir_languages]."</a></td>
	</tr>";
}else
{
						echo "<tr style='border:1px solid black'><td><a href='".home_url()."/".$dir[$length-3]."/".$dir_languages."/".$files."'>
					<img style='padding-right:5%' src='".get_template_directory_uri(__FILE__)."/img/16/".$languages[$dir_languages]."' title='".$dir_languages."'></a><a href='".home_url()."/".$dir[$length-3]."/".$dir_languages."/".$files."'>".$languages_with_fullname[$dir_languages]."</a></td>
	</tr>";
}
					break;
				}
			}
			$count++;
		}
	}
echo "</table></div></div>";
}
endif;

if(!function_exists(google_languages)):
function google_languages(){
	echo "<br><table><tr><td><a href='#' id='menu'>Additional Languages</a></td><td>	
	<img src='".get_template_directory_uri()."/img/icons/downn.png' width='20px' id='down'>
	<img src='".get_template_directory_uri()."/img/icons/up.png' width='20px' id='up'></td></tr></table>";
?> 
<?php echo do_shortcode('[google-translator]'); ?>
 <?php
//	echo do_shortcode('[google-translator]');
 

}

endif;
if(!function_exists(up_scroll)):
function up_scroll(){
//	echo "<img src='".get_template_directory_uri()."/img/icons/scroll.png' width='50%' title='Move to top'>";
}
endif;

?>
