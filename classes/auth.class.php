<?php

/**
 * Created by PhpStorm.
 * User: jerome
 * Date: 04/01/2018
 * Time: 09:54 PM
 */
require_once('mysql.class.php');
class Auth extends MySQL
{
    private $error = array();

    protected $score = 100;

    private $forgot_pass = array(
        'minLength'      => 6,
        'maxLength'      => 30,
        'minNumbers'     => 1,
        'minLetters'     => 1,
        'minLowerCase'   => 0,
        'minUpperCase'   => 0,
        'minSymbols'     => 1,
        'maxSymbols'     => 2,
        'allowedSymbols' => array('@','#','$','%','&','^','*','?','!'),
    );

    function __construct(){
        parent::__construct();
        if (!isset($_SESSION)) {
            session_start();
        }
    }
    public function sanitize($data){

        return $this->SQLFix($data);

    }

    public function user_exists($username){

        $uname = $this->sanitize($username);

        $this->Query("SELECT * FROM usr_users WHERE username = '$uname'");
        $count = $this->RowCount();

        return($count == 1) ? true : false;

    }

    public function user_active($username){

        $user = $this->sanitize($username);

        $this->Query("SELECT * FROM usr_users WHERE username = '$user' AND user_status = 1 ");

        $activeCount = $this->RowCount();

        return($activeCount == 1) ? true : false;

    }

    public function user_id_from_username($username){
        $username = $this->sanitize($username);
        $this->Query("SELECT * FROM usr_users WHERE username = '$username'");
        $row = $this->Row();
        $id = $row->user_id;
        return $id;

    }

    public function login($username, $password){

        $user_id = $this->user_id_from_username($username);
        $username = $this->sanitize($username);
        $password = sha1($password);

        $this->Query("SELECT * FROM usr_users WHERE username = '$username' AND password = '$password' ");
        $count = $this->RowCount();

        return($count==1) ? $user_id : false;

    }



    public function  DisplayError(){

        $err = $this->error;

        $output = array();

        foreach($err as $oneerror){

            $output[] = '<li>'.'<strong>'.$oneerror.'</strong>'.'</li>';

        }

        return '<ul>'.implode('',$output).'</ul>';
    }

    public function getError($message){

        $this->error[] = $message;

    }
    public  function getRecord($username){
        $Login_query = "SELECT * FROM usr_users WHERE username = '$username'";
        return $this->QuerySingleRowArray($Login_query,MYSQLI_ASSOC);
    }
    public function updateUserLogin($stampid,$logintime){
        $this->Query("UPDATE usr_users SET last_seen = '$logintime' WHERE user_id = $stampid ");
    }
    public function userLogout(){
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,$params["path"], $params["domain"],$params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        return 'Location:../index.php';
    }
    private function _sanitizeInputs() {
        $minPosLength = $this->forgot_pass['minNumbers'] + $this->forgot_pass['minLetters'] + $this->forgot_pass['minSymbols'];
        if ($minPosLength > $this->forgot_pass['minLength']) {
            $this->forgot_pass['minLength'] = $minPosLength;
        }
        if ($this->forgot_pass['minLength'] > $this->forgot_pass['maxLength']) {
            $this->forgot_pass['minLength'] = $this->forgot_pass['maxLength'];
        }
        if ($this->forgot_pass['minSymbols'] > $this->forgot_pass['maxSymbols']) {
            $this->forgot_pass['minSymbols'] = $this->forgot_pass['maxSymbols'];
        }
    }
    /**
     * Validate the password to the defined parameters. If a parameters is not
     * set at runtime then a default value is used.
     *
     * @param string $password The password.
     *
     * @return boolean True if password valid, otherwise false.
     */
    public function validatePassword($password) {
        // Make sure that parameters don't overlap in such a way as to make
        // validation impossible.
        $this->_sanitizeInputs();
        // Check password minimum length, return at this step.
        if (strlen($password) < $this->forgot_pass['minLength']) {
            $this->error[] = 'Password must be ' . $this->forgot_pass['minLength'] . ' characters long, current password is too short at ' . strlen($password) . ' characters.';
            return false;
        }
        // Check password maximum length, return at this step.
        if (strlen($password) > $this->forgot_pass['maxLength']) {
            $this->error[] = 'Password must be ' . $this->forgot_pass['minLength'] . ' characters long, current password is too long at ' . strlen($password) . ' characters.';
            return false;
        }
        // Check the number of numbers in the password.
        if (strlen(preg_replace('/([^0-9]*)/', '', $password)) < $this->forgot_pass['minNumbers']) {
            $this->error[] = 'Not enough numbers in password, a minimum of ' . $this->forgot_pass['minNumbers'] . ' required.';
        }
        // Check the number of letters in the password
        if (strlen(preg_replace('/([^a-zA-Z]*)/', '', $password)) < $this->forgot_pass['minLetters']) {
            $this->error[] = 'Not enough letters in password, a minimum of ' . $this->forgot_pass['minLetters'] . ' required.';
        }
        // Check the number of lower case letters in the password
        if (strlen(preg_replace('/([^a-z]*)/', '', $password)) < $this->forgot_pass['minLowerCase'] && $this->forgot_pass['minLowerCase'] != 0) {
            $this->error[] = 'Not enough lower case letters in password, a minimum of ' . $this->forgot_pass['minLowerCase'] . ' required.';
        }
        // Check the number of upper case letters in the password
        if (strlen(preg_replace('/([^A-Z]*)/', '', $password)) < $this->forgot_pass['minUpperCase'] && $this->forgot_pass['minUpperCase'] != 0) {
            $this->error[] = 'Not enough upper case letters in password, a minimum of ' . $this->forgot_pass['minUpperCase'] . ' required.';
        }
        // Check the minimum number of symbols in the password.
        if (strlen(preg_replace('/([a-zA-Z0-9]*)/', '', $password)) < $this->forgot_pass['minSymbols'] && $this->forgot_pass['maxSymbols'] != 0) {
            $this->error[] = 'Not enough symbols in password, a minimum of ' . $this->forgot_pass['minSymbols'] . ' required.';
        }
        // Check the maximum number of symbols in the password.
        if (strlen(preg_replace('/([a-zA-Z0-9]*)/', '', $password)) > $this->forgot_pass['maxSymbols']) {
            if ($this->forgot_pass['maxSymbols'] == 0) {
                $this->error[] = 'You are not allowed any symbols in password, please remove them.';
            } else {
                $this->error[] = 'Too many symbols in password.';
            }
        }
        // Check that the symbols present in the password are allowed.
        if ($this->forgot_pass['maxSymbols'] != 0) {
            $symbols = preg_replace('/([a-zA-Z0-9]*)/', '', $password);
            for ($i = 0; $i < strlen($symbols); ++$i) {
                if (!in_array($symbols[$i], $this->forgot_pass['allowedSymbols'])) {
                    $this->error[] = 'Non specified symbol ' . $symbols[$i] . ' used in password, please use one of ' . implode('', $this->forgot_pass['allowedSymbols']) . '.';
                }
            }
        }
        // If any $this->error have been encountered then return false.
        if (count($this->error) > 0) {
            return false;
        }
        return true;
    }

    /**
     * Score the password based on the level of security. This function doesn't
     * look at the parameters set up and simply scores based on best practices.
     * The function first makes sure the password is valid as there is no
     * point in scoring a password that can't be used.
     *
     * @param string $password The password to score.
     *
     * @return mixed Returns an integer score of the password strength.
     */
    public function scorePassword($password) {
        // Make sure password is valid.
        if (!$this->validatePassword($password)) {
            return 0;
        }
        if ($password == '') {
            $this->score = 0;
            return $this->score;
        }
        // Reset initial score.
        $this->score = 100;
        $passwordLetters = preg_replace('/([^a-zA-Z]*)/', '', $password);
        $letters = array();
        for ($i = 0; $i < strlen($passwordLetters); ++$i) {
            // Reduce score for duplicate letters.
            if (in_array($passwordLetters[$i], $letters)) {
                $this->score = $this->score - 5;
            }
            // Reduce score for duplicate letters next to each other.
            if (isset($passwordLetters[$i - 1]) && $passwordLetters[$i] == $passwordLetters[$i - 1]) {
                $this->score = $this->score - 10;
            }
            $letters[] = $passwordLetters[$i];
        }
        // Reduce score for duplicate numbers.
        $passwordNumbers = preg_replace('/([^0-9]*)/', '', $password);
        $numbers = array();
        for ($i = 0; $i < strlen($passwordNumbers); ++$i) {
            if (in_array($passwordNumbers[$i], $numbers)) {
                $this->score = $this->score - 5;
            }
            $numbers[] = $passwordNumbers[$i];
        }
        // Reduce score for no symbols.
        if (strlen(preg_replace('/([a-zA-Z0-9]*)/', '', $password)) == 0) {
            $this->score = $this->score - 10;
        }
        // Reduce score for words in dictionary used in password.
        $dictionary = dirname(__FILE__) . '/words.txt';
        if (file_exists($dictionary)) {
            $handle = fopen($dictionary, "r");
            $words = '';
            while (!feof($handle)) {
                $words .= fread($handle, 8192);
            }
            fclose($handle);
            $words = explode("\n", $words);
            foreach ($words as $word) {
                if (preg_match('/.*?' . trim($word) . '.*?/i', $password, $match)) {
                    $this->score = $this->score - 20;
                }
            }
        }
        if ($this->score < 0) {
            $this->score = 0;
        }
        // Return the score.
        return $this->score;
    }

    /**
     * Use the options set up in the class to create a random password that passes
     * validation. This uses certain practices such as not using the letter o or
     * the number 0 as these can be mixed up.
     *
     * @return string The generated password.
     */
    public function generatePassword() {
        // Make sure that parameters don't overlap in such a way as to make
        // validation impossible.
        $this->_sanitizeInputs();
        // Initialise variable.
        $password = '';
        // Add lower case letters.
        $lowerLetters = 'aeiubdghjmnpqrstvxyz';
        if ($this->forgot_pass['minLowerCase'] != 0) {
            for ($i = 0; $i < $this->forgot_pass['minLowerCase']; ++$i) {
                $password .= $lowerLetters[(rand() % strlen($lowerLetters))];
            }
        }
        // Add upper case letters.
        $upperLetters = 'AEUBDGHJLMNPQRSTVWXYZ';
        if ($this->forgot_pass['minUpperCase'] != 0) {
            for ($i = 0; $i < $this->forgot_pass['minUpperCase']; ++$i) {
                $password .= $upperLetters[(rand() % strlen($upperLetters))];
            }
        }
        // Add letters.
        if (($this->forgot_pass['minLowerCase'] + $this->forgot_pass['minUpperCase']) < ($this->forgot_pass['minLetters'])) {
            $password .= $lowerLetters[(rand() % strlen($lowerLetters))];
        }
        // Add numbers.
        $numbers = '23456789';
        if ($this->forgot_pass['minNumbers'] != 0) {
            for ($i = 0; $i < $this->forgot_pass['minNumbers']; ++$i) {
                $password .= $numbers[(rand() % strlen($numbers))];
            }
        }
        // Add symbols using the symbols array.
        if ($this->forgot_pass['maxSymbols'] != 0) {
            $symbols = implode('', $this->forgot_pass['allowedSymbols']);
            if ($this->forgot_pass['minSymbols'] != 0 && strlen($symbols) > 0) {
                for ($i = 0; $i < $this->forgot_pass['minSymbols']; ++$i) {
                    $password .= $symbols[(rand() % strlen($symbols))];
                }
            }
        }
        // If the created password isn't quite long enough then add some lowercase
        // letters to the password string.
        if (strlen($password) < $this->forgot_pass['minLength']) {
            while (strlen($password) < $this->forgot_pass['minLength']) {
                $password .= $lowerLetters[(rand() % strlen($lowerLetters))];
            }
        }
        // Shuffle the characters in the password.
        $password = str_shuffle($password);
        // Return the password string.
        return $password;
    }

    /**
     * Get the maximum length of password allowed.
     *
     * @param integer $maxLength The maximum length of password allowed.
     *
     * @return null
     */
    public function setMaxLength($maxLength) {
        return $this->forgot_pass['maxLength'] = $maxLength;
    }
    /**
     * The maximum character length of the password.
     *
     * @return integer The maximum character length of the password.
     */
    public function getMaxLength() {
        return $this->forgot_pass['maxLength'];
    }
    /**
     * The minimum character length of the password.
     *
     * @return integer The minimum character length of the password.
     */
    public function getMinLength() {
        return $this->forgot_pass['minLength'];
    }
    /**
     * Get the minimum length of password allowed.
     *
     * @param integer $minLength The minimum length of password allowed.
     *
     * @return null
     */
    public function setMinLength($minLength) {
        return $this->forgot_pass['minLength'] = $minLength;
    }
    /**
     * The minimum letter count in the password.
     *
     * @return integer The minimum letter count in the password.
     */
    public function getMinLetters() {
        return $this->forgot_pass['minLetters'];
    }
    /**
     * Get the symbols allowed in password.
     *
     * @return array The allowed symbols array.
     */
    public function getAllowedSymbols() {
        return $this->forgot_pass['allowedSymbols'];
    }
    /**
     * An array of symbols that can be included in the password. If an array is
     * not passed to this function then it is not stored.
     *
     * @param array|string $symbols An array of symbols that can be included in the
     *                       password. This can be a string, which will be parsed
     *                       into an array of symbols.
     *
     * @return null
     */
    public function setAllowedSymbols($symbols) {
        if (!is_array($symbols)) {
            $symbols = preg_split('//', $symbols);
        }
        // Filter the symbols to remove any non symbol characters.
        $symbols = array_filter($symbols, array($this, 'filterAllowedSymbols'));
        if (is_array($symbols)) {
            $symbols = array_unique($symbols);
            $this->allowedSymbols = $symbols;
        }
    }
    /**
     * Callback function for setAllowedSymbols() to allow non symbol characters to be
     * filtered out of the symbols array upon insertion.
     *
     * @param mixed The array item to inspect.
     *
     * @return boolean False if the item is a symbol, otherwise true.
     */
    protected function filterAllowedSymbols($character) {
        if (preg_match('/[^a-zA-Z0-9 ]/', $character) == 1) {
            return 1;
        } else {
            return 0;
        }
    }
    /**
     * Set the minimum number of symbols required in the password.
     *
     * @param integer $minSymbols The minimum number of symbols.
     *
     * @return null
     */
    public function setMinSymbols($minSymbols) {
        return $this->forgot_pass['minSymbols'] = $minSymbols;
    }
    /**
     * Get the minimum number of symbols required in the password.
     *
     * @return integer The minimum number of symbols.
     */
    public function getMinSymbols() {
        return $this->forgot_pass['minSymbols'];
    }
    /**
     * Get the minimum number of upper case letters required in the password.
     *
     * @return integer The minimum number of upper case letters.
     */
    public function getMinUpperCase() {
        return $this->forgot_pass['minUpperCase'];
    }
    /**
     * Get the minimum number of lower case letters required in the password.
     *
     * @return integer The minimum number of lower case letters.
     */
    public function getMinLowerCase() {
        return $this->forgot_pass['minLowerCase'];
    }
    /**
     * Set the maximum number of symbols required in the password.
     *
     * @param integer $maxSymbols The maximum number of symbols.
     *
     * @return null
     */
    public function setMaxSymbols($maxSymbols) {
        return $this->forgot_pass['maxSymbols'] = $maxSymbols;
    }
    /**
     * The maximum number of symbols allowed in the password.
     *
     * @return integer The maximum number of symbols allowed in the password.
     */
    public function getMaxSymbols() {
        return $this->forgot_pass['maxSymbols'];
    }


}