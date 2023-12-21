<?php

class RedirectManager {
    public static function redirect($location) {
        header("Location: $location");
        exit();
    }
}

?>