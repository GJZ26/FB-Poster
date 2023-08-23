<?php
/*
Plugin Name: FB Poster - Stable Version
Plugin URI: https://github.com/GJZ26/FB-Poster
Description: Wordpress plugin to automate Facebook posts 🐵
Version: 1.0.0
Author: GJZ26
Author URI: https://github.com/GJZ26
*/

if (!defined('ABSPATH') || !function_exists('add_action')) {
    echo "Bro, you are really curious...";
    exit;
}

require_once('modules/InfoManager.php');
require_once('modules/FbRequester.php');

class FBPoster
{
    private InfoManager $infoMan;
    private FbRequester $fbReq;
    private string $meta_identifier = "fbposter";


    public function __construct()
    {
        $this->infoMan = new InfoManager();
        $this->fbReq = new FbRequester();
        $this->register();
    }
    public function activate()
    {
        $this->infoMan->createDatabases();
        flush_rewrite_rules();
    }

    public function deactivate()
    {
        flush_rewrite_rules();
    }

    private function register()
    {
        add_action('add_meta_boxes', [$this, 'add_checkbox_to_post']);

        add_action('publish_post', [$this, 'read_checkbox_status']);
        add_action('publish_post', [$this, 'postHandler']);

        add_action('admin_menu', [$this, 'add_settting_page']);

        wp_enqueue_style('fbstylesbenditodios', plugins_url('/assets/fbposter.min.css', __FILE__));
    }

    public function render_plugin_checkbox($post)
    {
?>
        <label for="tofbrepost">
            <input type="checkbox" name="tofbrepost" checked />
            Post on Facebook.
        </label>
<?php
    }

    public function add_checkbox_to_post()
    {
        add_meta_box('mi_checkbox_metabox', 'FB Poster', [$this, 'render_plugin_checkbox'], 'post', 'side');
    }

    public function read_checkbox_status($post_ID)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!current_user_can('edit_post', $post_ID)) return;
        if (get_post_status($post_ID) !== 'publish') return;

        $valor = isset($_POST['tofbrepost']) ? 'on' : 'off';

        if (metadata_exists('post', $post_ID, 'fbposter')) {
            update_post_meta($post_ID, 'fbposter', $valor);
        } else {
            add_post_meta($post_ID, 'fbposter', $valor);
        }
    }

    public function postHandler($post_ID)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!current_user_can('edit_post', $post_ID)) return;
        if (get_post_status($post_ID) !== 'publish') return;


        if (!metadata_exists('post', $post_ID, $this->meta_identifier)) return;
        if (!isset($_POST['tofbrepost'])) return;

        if ($this->infoMan->postExists($post_ID)) return;

        $appCredentials = $this->infoMan->getCredentials();
        $fbPost = $this->fbReq->postPost($post_ID, $appCredentials);

        $data =  array(
            'status' => $fbPost["status"],
            'fb_link' => $fbPost["fb_link"],
            'id_post' => $post_ID,
            'post_link' => get_permalink($post_ID),
            'log' => $fbPost["log"],
        );

        $this->infoMan->savePostLog($data);
    }

    function add_settting_page()
    {

        add_menu_page(
            'FB Poster',
            'FB Poster Setting',
            'manage_options',
            plugin_dir_path(__FILE__) . 'admin/dashboard.php',
            "",
            null,
            5
        );
    }
}

if (class_exists('FBPoster')) {
    $PluginInstance = new FBPoster();
}

register_activation_hook(__FILE__, [$PluginInstance, "activate"]);
register_deactivation_hook(__FILE__, [$PluginInstance, "deactivate"]);
