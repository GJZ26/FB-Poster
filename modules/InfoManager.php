<?php

if (!defined('ABSPATH') || !function_exists('add_action')) {
    echo "Bro, you are really curious...";
    exit;
}

class InfoManager
{
    private string $post_table_name = "fbposter";
    private string $settings_table_name = "fbposetting";
    private string $meta_identifier = "fbposter";

    public function createDatabases()
    {
        $this->createPostTable();
        $this->createSettingTable();
    }

    public function dropAllTables()
    {
        $this->dropPostTable();
        $this->dropSettingTable();
        $this->removeMetaInfo();
    }

    public function postExists($post_ID)
    {
        return $this->countPostsByID($post_ID);
    }

    public function getCredentials()
    {
        return $this->getAppInfo();
    }

    public function savePostLog($data)
    {
        $this->saveNewPostRegister($data);
    }

    public function check_update($tocheck, $dataReceiver)
    {
        if (count($dataReceiver) == 0) return $tocheck;
        $result = [
            "id" => "1",
            "token" => ($dataReceiver["tokenfb"] == null) ? $tocheck["token"] : $dataReceiver["tokenfb"],
            "delay" => $dataReceiver["delay"],
            "extra" => $dataReceiver["extra"],
            "add_description" => ($dataReceiver["addDescriptionFB"] == "on") ? "1" : "0",
            "upper" => ($dataReceiver["upperTitleFB"] == "on") ? "1" : "0",
            "long_uri" => ($dataReceiver["useLongURIFb"] == "on") ? "1" : "0"
        ];

        $diff = array_diff_assoc($result, $tocheck);

        if (!empty($diff)) {
            $this->saveNewAppInfo($result);
        }

        return $result;
    }

    public function updateAppIDIntoDB($data)
    {
        $this->updateAppID($data);
    }

    private function createPostTable()
    {
        global $wpdb;
        $table = $wpdb->prefix . $this->post_table_name;

        $query = "CREATE TABLE IF NOT EXISTS $table (
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            status ENUM('Programado', 'Publicado', 'Error', 'No disponible'),
            fb_link VARCHAR(255),
            id_post BIGINT UNSIGNED,
            post_link VARCHAR(255),
            log TEXT
        )";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        $query = $wpdb->prepare($query);
        dbDelta($query);
    }

    private function createSettingTable()
    {
        global $wpdb;

        $table = $wpdb->prefix . $this->settings_table_name;
        $query = "CREATE TABLE IF NOT EXISTS $table (
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            token TEXT,
            idapp TEXT,
            delay INT,
            extra TEXT,
            add_description BOOLEAN,
            upper BOOLEAN,
            long_uri BOOLEAN
        )";

        $query = $wpdb->prepare($query);
        dbDelta($query);

        $query = "INSERT IGNORE INTO $table (id, token, delay,extra,add_description,upper,long_uri)
        VALUES (1, '', 10, '', 1, 1, 1);";
        $query = $wpdb->prepare($query);
        $wpdb->query($query);
    }

    private function dropPostTable()
    {
        global $wpdb;

        $table = $wpdb->prefix . $this->post_table_name;

        $query = "DROP TABLE IF EXISTS $table";
        $query = $wpdb->prepare($query);
        $wpdb->query($query);
    }

    private function dropSettingTable()
    {
        global $wpdb;

        $table = $wpdb->prefix . $this->settings_table_name;

        $query = "DROP TABLE IF EXISTS $table";
        $query = $wpdb->prepare($query);
        $wpdb->query($query);
    }

    private function removeMetaInfo()
    {
        global $wpdb;

        $table = $wpdb->prefix . "postmeta";
        $query = "DELETE FROM $table WHERE meta_key = '$this->meta_identifier'";
        $query = $wpdb->prepare($query);
        $wpdb->query($query);
    }

    private function countPostsByID($ID)
    {
        global $wpdb;

        $table = $wpdb->prefix . $this->post_table_name;
        $query = $wpdb->prepare("SELECT * FROM $table WHERE id_post = %d", $ID);
        $result = $wpdb->get_var($query);

        return $result > 0;
    }

    private function getAppInfo()
    {
        global $wpdb;

        $table = $wpdb->prefix . $this->settings_table_name;
        $query = $wpdb->prepare("SELECT * FROM $table WHERE id=%d", 1);

        return (array) $wpdb->get_results($query)[0];
    }

    private function saveNewPostRegister($data)
    {
        global $wpdb;
        $table = $wpdb->prefix . $this->post_table_name;
        $wpdb->insert($table, $data);
    }

    private function saveNewAppInfo($dataToSave)
    {
        global $wpdb;

        $table = $wpdb->prefix . $this->settings_table_name;
        $data = array(
            'token' => $dataToSave["token"],
            'delay' => $dataToSave["delay"],
            'extra' => $dataToSave["extra"],
            'add_description' => $dataToSave["add_description"],
            'upper' => $dataToSave["upper"],
            'long_uri' => $dataToSave["long_uri"]
        );

        // Preparar la consulta preparada
        $query = $wpdb->prepare(
            "UPDATE $table SET 
        token = %s,
        delay = %d,
        extra = %s,
        add_description = %d,
        upper = %d,
        long_uri = %d",
            $data['token'],
            $data['delay'],
            $data['extra'],
            $data['add_description'],
            $data['upper'],
            $data['long_uri']
        );

        $wpdb->query($query);
    }

    private function updateAppID($datapp)
    {
        if (isset($datapp["error"]) || empty($datapp)) return;

        global $wpdb;

        $table = $wpdb->prefix . $this->settings_table_name;
        $data = array(
            'idapp' => $datapp["id"]
        );

        $query = $wpdb->prepare(
            "UPDATE $table SET 
            idapp = %s",
            $data['idapp']
        );

        $wpdb->query($query);
    }
}
