<?php 

namespace Zuz;

class Config {

    const DEBUG = 1;
    const VERSION = "3.0.1";
    const SEPERATOR = "@@";
    const HASH_KEY_LENGTH = 10;
    const MEMORY_LIMIT = -1; 
    const TIME_LIMIT = 0; 
    const TIME_ZONE = "UTC"; 
    const APP_TYPE = "UI";

    /** Database Details */    
    const DB_HOST = "localhost";
    const DB_PORT = 3306;
    const DB_NAME = "";
    const DB_USER = "";
    const DB_PASS = "";
    const DB_CHARSET = "utf8";
    const DB_COLLATE = "";

    const MAIL_HOST = "";
    const MAIL_PORT = 587;
    const MAIL_USER = "";
    const MAIL_PASS = "";

    /**SECURE KEY */
    const SECURE_KEY = "";

    /**
     * User Session Cookies
     */
    const SESS_FIX = "__";
    const SESS_UI = "ui";
    const SESS_UT = "ut";
    const SESS_UD = "ud";
    const SESS_SI = "si";

    /**APPNAME */
    const APP_NAME = "";

    /**BASEURL */
    const BASEURL = "";
    
    /**
     * This email account will be used to send email notifications
     */
    const EMAIL_ACCOUNT = "";
    /**
     * This email account is public email account for users to contact you.
     */
    const PUBLIC_EMAIL_ACCOUNT = "";
    const PUBLIC_ADDRESS = "";

    /**
     * Send Verification Code or Link
     * 1 = Link
     * 0 = Code
     */
    const EMAIL_VERIFICATION_MODE = 1;

    /** 
     * API URL KEY
     * If BASEURL + THIS KEY we are at restapi
     */
    const API_URL_KEY = "";

    const CURRENCY = "";
    const CURRENCY_CODE = "";
    const DATE_FORMAT = "Y-m-d";

    //SOCIAL
    const TELEGRAM_LINK = "";
    const SKYPE_LINK = "";

    //PAPAL
    const PAYPAL_MODE = "";
    const PAYPAL_BUSINESS = "";

    //STRIPE    
    const STRIPE_KEY = "";
    const STRIPE_SECRET = "";
    

}
?>