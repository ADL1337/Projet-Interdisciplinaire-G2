<?php
require_once __DIR__ . "/../core/configuration.php";

class LDAPManager {
    private static $ldap_connection;

    # Try username and password agains the LDAP server to see if login credentials are correct
    private static function loginFromUsername(string $username, string $password) {
        $ldap_bind = self::bind($username, $password);
        return $ldap_bind;
    }

    # Todo, handle case where email is invalid (we pray that it's valid rn)
    private static function usernameFromEmail(string $email) {
        self::adminBind();
        $email_filter = "(&(objectClass=user)(mail=$email))";
        $ldap_entries = self::getEntries($email_filter);
        return @$ldap_entries[0]["samaccountname"][0];
    }

    # true if user in AD has email and password given else false
    public static function loginFromEmail(string $email, string $password) {
        $username = self::usernameFromEmail($email);
        return self::loginFromUsername($username, $password);
    }

    # get the entries for a specific filter
    private static function getEntries(string $filter) {
        $ldap_connection = self::getConnection();
        $base_dn = self::getBaseDN();
        $ldap_search = ldap_search($ldap_connection, $base_dn, $filter);
        return ldap_get_entries($ldap_connection, $ldap_search);
    }

    # Bind to LDAP with the admin account (for searching)
    private static function adminBind() {
        $password = self::getPassword();
        $username = self::getLDAPUsername();
        return self::bind($username, $password);
    }

    # Username should not be a "normal" username
    private static function bind(string $username, string $password) {
        $dn = self::ldapUserFromUsername($username);
        $ldap_connection = self::getConnection();
        return @ldap_bind($ldap_connection, $dn, $password);
    }

    # Get the domain name from config
    private static function getDN() {
        return Configuration::get('dn');
    }

    # Get the TLD from config
    private static function getTLD() {
        return Configuration::get('tld');
    }

    # Get the base DN used for searching
    private static function getBaseDN() {
        #return Configuration::get('base_dn');
        $dn = self::getDN();
        $tld = self::getTLD();
        return "dc=$dn,dc=$tld";
    }

    # Get the admin account LDAP username from config
    private static function getLDAPUsername() {
        return Configuration::get('ldap_username');
    }

    # Get the admin account password from config
    private static function getPassword() {
        return Configuration::get('ldap_password');
    }

    # Format a username to be able to bind
    private static function ldapUserFromUsername(string $username) {
        $dn = self::getDN();
        return "$dn\\$username";
    }

    # Set the connection
    private static function setConnection() {
        if (!isset(self::$ldap_connection) || self::$ldap_connection === false) {
            $ldap_connection = ldap_connect(self::getServer());
            ldap_set_option($ldap_connection, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($ldap_connection, LDAP_OPT_REFERRALS, 0);
            self::$ldap_connection = $ldap_connection;
        }
    }

    # Get the LDAP connection
    private static function getConnection() {
        self::setConnection();
        return self::$ldap_connection;
    }

    # LDAP Server address for connecting 
    private static function getServer() {
        $dn = self::getDN();
        $tld = self::getTLD();
        return "LDAP://$dn.$tld";
    }
}

?>