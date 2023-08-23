<?php

if (!defined('ABSPATH') || !function_exists('add_action')) {
    echo "Bro, you are really curious...";
    exit;
}

class FbRequester
{
    private string $api_uri = "https://graph.facebook.com/v17.0/";
    private string $app_uri = "https://www.facebook.com/";

    public function __construct()
    {
        // If u need to exec something before instance
    }

    public function postPost($post_ID, $credentials)
    {
        $accessToken = $credentials["token"];
        $titulo = get_the_title($post_ID);

        $extra = empty($credentials["extra"]) ? "" : "\n\n" . $credentials["extra"];

        $og_description = get_post_meta($post_ID, 'rank_math_description', true);
        $og_description = empty($og_description) ? "\n\n" . get_the_excerpt($post_ID) : "\n\n" . $og_description;

        $link = $credentials["long_uri"] == "1" ? "\n\n" . get_permalink($post_ID) : "\n\n" . get_the_guid($post_ID);

        $message = $credentials["upper"] == "1" ? mb_strtoupper($titulo) : $titulo;
        $message = $credentials["add_description"] == "1" ? $message . $og_description : $message;
        $message = $message . $extra;
        $message = $message . "\n\n" . $link;


        $url = $this->api_uri . $credentials["idapp"] . "/feed";

        $data = array(
            'message' => $message,
            'access_token' => $accessToken,
            'link' => $link,
            'published' => false,
            'scheduled_publish_time' => time() + ($credentials["delay"] * 60)
        );

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $response = json_decode(curl_exec($ch), true);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);


        curl_close($ch);

        return array(
            'fb_link' => isset($response["id"]) ? $this->app_uri . $response["id"] : "",
            'status' => empty($response["error"]) ? 'Programado' : 'Error',
            'log' => json_encode($response)
        );
    }

    public function getAppInfo($credentials)
    {
        if (empty($credentials["token"])) return ["nop" => "nopnop"];

        $url = $this->api_uri . "me?fields=picture%7Burl%7D%2Cname%2Capp_id&access_token=" . $credentials["token"];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return json_decode($response, true);
    }
}
