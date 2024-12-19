<?php

// function to clean the inputs and prevent from xss fails
    function clean_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        return $data;
    }

// function to validate the inputs (email/ int/ string (is the default))
    function validate_input($input, $type = 'string', $options = []) {
        $input = clean_input($input);
        
        switch($type) {
            case 'email':
                return filter_var($input, FILTER_VALIDATE_EMAIL) ? $input : false;
            case 'int':
                return filter_var($input, FILTER_VALIDATE_INT, $options) !== false ? $input : false;
            case 'string':
                $min_length = $options['min_length'] ?? 2;
                $max_length = $options['max_length'] ?? 255;
                
                return (strlen($input) >= $min_length && strlen($input) <= $max_length) ? $input : false;
            default:
                return $input;
        }
    }

?>