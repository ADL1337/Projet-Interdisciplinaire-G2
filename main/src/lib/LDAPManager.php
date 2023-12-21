<?php

use LDAP\Connection;
use PSpell\Config;

require_once __DIR__ . "/../core/configuration.php";

class LDAPManager {
    private static Connection $ldap_connection;

    private static function loginFromUsername(string $username, string $password) {
        $ldap_bind = self::bind($username, $password);
        return $ldap_bind;
    }

    private static function usernameFromEmail(string $email) {
        self::adminBind();
        $email_filter = "(&(objectClass=user)(mail=$email))";
        $ldap_entries = self::getEntries($email_filter);
        return @$ldap_entries[0]["samaccountname"][0];
    }

    public static function loginFromEmail(string $email, string $password) {
        $username = self::usernameFromEmail($email);
        return self::loginFromUsername($username, $password);
    }

    private static function getEntries(string $filter) {
        return ldap_get_entries(self::getConnection(), ldap_search(self::getConnection(), self::getBaseDN(), $filter));
    }

    # Bind to LDAP with the admin account (for searching)
    private static function adminBind() {
        return @ldap_bind(self::getConnection(), self::getLDAPUsername(), self::getPassword());
    }

    # Username should not be a LDAP User
    private static function bind(string $username, string $password) {
        return @ldap_bind(self::getConnection(), self::ldapUserFromUsername($username), $password);
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
        return 'dc=' . self::getDN() . 'dc=' . self::getTLD();
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
        return self::getDN() . '\\' . $username;
    }

    # Set the connection
    private static function setConnection() {
        if (!isset(self::$ldap_connection) || self::$ldap_connection === false) {
            self::$ldap_connection = ldap_connect(self::getServer());
        }
    }

    # Get the LDAP connection
    private static function getConnection() {
        self::setConnection();
        return self::$ldap_connection;
    }

    # LDAP Server address for connecting
    private static function getServer() {
        return "LDAP://" . Configuration::get('dn') . Configuration::get('tld');
    }
}   

?>