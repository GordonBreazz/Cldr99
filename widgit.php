<?php
/**
 * Calendar99 - An easy, clean and simple way to add year post calendar on site.
 *
 *
 * @package   Calendar99
 * @author    Egor Konnov <admin@cbs-uu.ru>
 * @copyright 2022 Egor Konnov
 * @license   MIT http://opensource.org/licenses/MIT
 * @version   1
 * @link      https://github.com/GordonBreazz
 */

/*
Plugin Name:Calendar99
Plugin URI:  https://github.com/GordonBreazz
Description: An easy, clean and simple way to add year post calendar on site.
Author:        Egor Konnov
Author URI:   https://github.com/GordonBreazz
Version:      1
License:      MIT
License URI:  license.txt
Text Domain:  calendar99
Domain Path:  /languages
Requires PHP: 5.2
Requires at least: 3.6
*/

/* Виджет Calendar99 Widget */
class calendar99_widget extends WP_Widget {

    // Установка идентификатора, заголовка, имени класса и описания для виджета.
    public function __construct() {
        $widget_options = array(
            'classname' => 'fullcalendar99_widget',
            'description' => 'Календарь постов за год',
        );
        parent::__construct( 'fullcalendar99_widget', 'Calendar99', $widget_options );
    }

    // Вывод виджета в области виджетов на сайте.
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance[ 'title' ] );
        $blog_title = get_bloginfo( 'name' );
        $tagline = get_bloginfo( 'description' );

        echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title']; ?>
    <div id="cldr">
    </div>
<?php
  $category="news";
  $tag="etotdenvistorii";
  global $wp_query;
            $args = array(
                'category_name' => $category, 
                'tag' => $tag, //must use tag id for this field
                'posts_per_page' => -1,
                'post_status' => "publish",
                'order' => 'ASC'
            ); //get all posts
echo '<script>';
echo 'var links = [];';
   $posts = get_posts($args);
            foreach ($posts as $post) :
//echo '<a href="'.get_permalink($post->ID).'">'.$post->post_title.' '.get_the_date( 'n-j', $post).'</a><br>';
echo 'links["'.get_the_date( 'n-j', $post).'"]="'.get_permalink($post->ID).'";';
      //do stuff 
         endforeach;
echo '</script>';
?>
        <?php echo $args['after_widget'];
    }

    // Параметры виджета, отображаемые в области администрирования WordPress.
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : ''; ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
        <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
        </p><?php
    }

    // Обновление настроек виджета в админ-панели.
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
        return $instance;
    }

}

// Регистрация и активация виджета.
function wpschool_register_widget() {
    register_widget( 'calendar99_widget' );
}

function wpb_adding_scripts() {
 
wp_register_script('my_amazing_script', plugins_url('js/script.js', __FILE__), array(),'1', true);
 
wp_enqueue_script('my_amazing_script');
}
  
add_action( 'wp_enqueue_scripts', 'wpb_adding_scripts' );  

function wpb_adding_styles() {
wp_register_style('my_stylesheet', plugins_url('css/style.css', __FILE__));
wp_enqueue_style('my_stylesheet');
}
add_action( 'wp_enqueue_scripts', 'wpb_adding_styles' );  

add_action( 'widgets_init', 'wpschool_register_widget' );

