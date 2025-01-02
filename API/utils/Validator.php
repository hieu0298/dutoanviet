<?php
class Validator {
    private $errors = [];

    public function validate($data, $rules) {
        foreach ($rules as $field => $rule) {
            $rules = explode('|', $rule);
            
            foreach ($rules as $rule) {
                if ($rule === 'required') {
                    if (!isset($data[$field]) || empty($data[$field])) {
                        $this->errors[$field][] = ucfirst($field) . " is required";
                    }
                }
                
                if (strpos($rule, 'min:') === 0) {
                    $min = substr($rule, 4);
                    if (isset($data[$field]) && strlen($data[$field]) < $min) {
                        $this->errors[$field][] = ucfirst($field) . " must be at least $min characters";
                    }
                }
                
                if ($rule === 'email') {
                    if (isset($data[$field]) && !filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
                        $this->errors[$field][] = "Invalid email format";
                    }
                }
                
                if ($rule === 'phone') {
                    if (isset($data[$field]) && !preg_match("/^[0-9]{10}$/", $data[$field])) {
                        $this->errors[$field][] = "Invalid phone number format";
                    }
                }
            }
        }
    }

    public function passes() {
        return empty($this->errors);
    }

    public function errors() {
        return $this->errors;
    }
} 