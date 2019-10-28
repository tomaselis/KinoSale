<?php
namespace App\Helper;
class InputHelper
{
    //validacija
    //apdirbimai teksto, skaiciu
    //password generatoriai
    public static function passwordGenerator($password)
    {
        return md5(md5($password.'salt'));
    }
    public static function PasswordMatch($password, $password2)
    {
        if ($password === $password2) {
            return true;
        }
        return false;
    }
    public static function prepareEmail($str)
    {
        $str = strtolower($str);
        return $str;
    }
    public static function emailValid($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
    public static function uniqueEmail($email)
    {
        $db = new \Core\Database();
        $db->select()->from('users')->where('email', $email);
        if ($db->get()) {
            return false;
        }
        return true;
    }
    public static function checkEmail($email)
    {
        $email = self::prepareEmail($email);
        if (self::uniqueEmail($email) && self::emailValid($email)) {
            return true;
        }
        return false;
    }
}