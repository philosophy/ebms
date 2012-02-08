<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function get_post_var($key) {
    if (array_key_exists($key, $_POST) === true) {
        return trim($_POST[$key]);
    } else {
        return NULL;
    }
}

function fetch_get_var($key) {
    if (array_key_exists($key, $_GET) === true) {
        return trim($_GET[$key]);
    } else {
        return NULL;
    }
}

function get_session_var($key, $info = NULL) {
    if ($info != NULL) {
        if (array_key_exists($key, $_SESSION[$info]) === true) {
            return trim($_SESSION[$info][$key]);
        } else {
            return NULL;
        }
    } else {
        if (array_key_exists($key, $_SESSION) === true) {
            return trim($_SESSION[$key]);
        } else {
            return NULL;
        }
    }
}

function get_value($key, $array) {
    if (array_key_exists($key, $array) === true) {
        return trim($array[$key]);
    } else {
        return NULL;
    }
}

function is_valid_email($email) {
    $regex = '/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/';
    if (preg_match($regex, $email)) {
        return true;
    } else {
        return false;
    }
}

/*
 * Validates the format of date - YYYY-MM-DD HH:MM:SS
 */

function is_valid_date($date) {
    $regex = '/^([0-9]{4}-)([0-9]{2}-)([0-9]{2}) ([0-9]{2}:)([0-9]{2}:)([0-9]{2})$/';
    if (preg_match($regex, $date)) {
        return true;
    } else {
        return false;
    }
}

/*
 * check if date format is yyyy-mm-dd only
 */

function check_date_format($date) {
    $regex = '/^([0-9]{4}-)([0-9]{2}-)([0-9]{2})$/';
    if (preg_match($regex, $date)) {
        return true;
    } else {
        return false;
    }
}

function send_json_response($type, $httpcode, $message, $data = array()) {
    if ($type == ERROR_LOG) {
        // error response
        $json = array('code' => $httpcode, 'message' => $message);
    } else {
        // success response
        $json = array('code' => $httpcode, 'message' => $message, 'data' => $data);
    }

    echo json_encode($json);
}

function is_empty_null_value($var) {
    if (empty($var) == true || is_null($var) == true || isset($var) == false) {
        return true;
    } else {
        return false;
    }
}

function is_name_valid($name) {
    $regex = '/^[A-Za-z ]+$/';
    if (preg_match($regex, $name)) {
        return true;
    } else {
        return false;
    }
}

function is_country_valid($country) {
    $countries = array("AFGHANISTAN", "ALBANIA", "ALGERIA", "AMERICAN SAMOA", "ANDORRA", "ANGOLA", "ANGUILLA", "ANTARCTICA", "ANTIGUA AND BARBUDA", "ARGENTINA",
        "ARMENIA", "ARUBA", "AUSTRALIA", "AUSTRIA", "AZERBAIJAN", "BAHAMAS", "BAHRAIN", "BANGLADESH", "BARBADOS", "BELARUS", "BELGIUM", "BELIZE", "BENIN", "BERMUDA", "BHUTAN", "BOLIVIA", "BOSNIA AND HERZEGOWINA",
        "BOTSWANA", "BOUVET ISLAND", "BRAZIL", "BRITISH INDIAN OCEAN TERRITORY", "BRUNEI DARUSSALAM", "BULGARIA", "BURKINA FASO", "BURUNDI", "CAMBODIA", "CAMEROON", "CANADA",
        "CAPE VERDE", "CAYMAN ISLANDS", "CENTRAL AFRICAN REPUBLIC", "CHAD", "CHILE", "CHINA", "CHRISTMAS ISLAND", "COCOS (KEELING) ISLANDS", "COLOMBIA", "COMOROS", "CONGO",
        "CONGO, THE DEMOCRATIC REPUBLIC OF THE", "COOK ISLANDS", "COSTA RICA", "COTE D'IVOIRE", "CROATIA (local name: Hrvatska)", "CUBA", "CYPRUS",
        "CZECH REPUBLIC", "DENMARK", "DJIBOUTI", "DOMINICA", "DOMINICAN REPUBLIC", "EAST TIMOR", "ECUADOR", "EGYPT", "EL SALVADOR", "EQUATORIAL GUINEA",
        "ERITREA", "ESTONIA", "ETHIOPIA", "FALKLAND ISLANDS (MALVINAS)", "FAROE ISLANDS", "FIJI", "FINLAND", "FRANCE", "FRANCE, METROPOLITAN", "FRENCH GUIANA",
        "FRENCH POLYNESIA", "FRENCH SOUTHERN TERRITORIES", "GABON", "GAMBIA", "GEORGIA", "GERMANY", "GHANA", "GIBRALTAR", "GREECE", "GREENLAND", "GRENADA",
        "GUADELOUPE", "GUAM", "GUATEMALA", "GUINEA", "GUINEA-BISSAU", "GUYANA", "HAITI", "HEARD AND MC DONALD ISLANDS", "HOLY SEE (VATICAN CITY STATE)",
        "HONDURAS", "HONG KONG", "HUNGARY", "ICELAND", "INDIA", "INDONESIA", "IRAN (ISLAMIC REPUBLIC OF)", "IRAQ", "IRELAND", "ISRAEL", "ITALY", "JAMAICA",
        "JAPAN", "JORDAN", "KAZAKHSTAN", "KENYA", "KIRIBATI", "KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF", "KOREA, REPUBLIC OF", "KUWAIT", "KYRGYZSTAN",
        "LAO PEOPLE'S DEMOCRATIC REPUBLIC", "LATVIA", "LEBANON", "LESOTHO", "LIBERIA", "LIBYAN ARAB JAMAHIRIYA", "LIECHTENSTEIN", "LITHUANIA", "LUXEMBOURG",
        "MACAU", "MACEDONIA, THE FORMER YUGOSLAV REPUBLIC", "MADAGASCAR", "MALAWI", "MALAYSIA", "MALDIVES", "MALI", "MALTA", "MARSHALL ISLANDS", "MARTINIQUE",
        "MAURITANIA", "MAURITIUS", "MAYOTTE", "MEXICO", "MICRONESIA, FEDERATED STATES OF", "MOLDOVA, REPUBLIC OF", "MONACO", "MONGOLIA", "MONTSERRAT",
        "MOROCCO", "MOZAMBIQUE", "MYANMAR (Burma)", "NAMIBIA", "NAURU", "NEPAL", "NETHERLANDS", "NETHERLANDS ANTILLES", "NEW CALEDONIA", "NEW ZEALAND",
        "NICARAGUA", "NIGER", "NIGERIA", "NIUE", "NORFOLK ISLAND", "NORTHERN MARIANA ISLANDS", "NORWAY", "OMAN", "PAKISTAN", "PALAU", "PANAMA", "PAPUA NEW GUINEA",
        "PARAGUAY", "PERU", "PHILIPPINES", "PITCAIRN", "POLAND", "PORTUGAL", "PUERTO RICO", "QATAR", "REUNION", "ROMANIA", "RUSSIAN FEDERATION",
        "RWANDA", "SAINT KITTS AND NEVIS", "SAINT LUCIA", "SAINT VINCENT AND THE GRENADINES", "SAMOA", "SAN MARINO", "SAO TOME AND PRINCIPE",
        "SAUDI ARABIA", "SENEGAL", "SEYCHELLES", "SIERRA LEONE", "SINGAPORE", "SLOVAKIA (Slovak Republic)", "SLOVENIA", "SOLOMON ISLANDS", "SOMALIA",
        "SOUTH AFRICA", "SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS", "SPAIN", "SRI LANKA", "ST. HELENA", "ST. PIERRE AND MIQUELON", "SUDAN",
        "SURINAME", "SVALBARD AND JAN MAYEN ISLANDS", "SWAZILAND", "SWEDEN", "SWITZERLAND", "SYRIAN ARAB REPUBLIC", "TAIWAN, PROVINCE OF CHINA",
        "TAJIKISTAN", "TANZANIA, UNITED REPUBLIC OF", "THAILAND", "TOGO", "TOKELAU", "TONGA", "TRINIDAD AND TOBAGO", "TUNISIA", "TURKEY", "TURKMENISTAN",
        "TURKS AND CAICOS ISLANDS", "TUVALU", "UGANDA", "UKRAINE", "UNITED ARAB EMIRATES", "UNITED KINGDOM", "UNITED STATES", "UNITED STATES MINOR OUTLYING ISLANDS",
        "URUGUAY", "UZBEKISTAN", "VANUATU", "VENEZUELA", "VIET NAM", "VIRGIN ISLANDS (BRITISH)", "VIRGIN ISLANDS (U.S.)", "WALLIS AND FUTUNA ISLANDS",
        "WESTERN SAHARA", "YEMEN", "YUGOSLAVIA (now Serbia and Montenegro)", "ZAMBIA", "ZIMBABWE");

    if (in_array($country, $countries)) {
        return true;
    } else {
        return false;
    }
}

function update_session_bookmarks_info($user_event, $userid) {
    $user_event->setUserId($userid);
    $_SESSION['profile_info']['total_bookmarks'] = $user_event->countBookmarkedEvents();
    $_SESSION['profile_info']['bookmark_ids'] = $user_event->fetchBookmarkIds();
}

?>