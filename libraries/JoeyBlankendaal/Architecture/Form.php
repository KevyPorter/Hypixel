<?php
/**
 * Library: JoeyBlankendaal/Architecture/Form
 * Validates forms with rules set by the user.
 * 
 * @author Joey Blankendaal <joeyblankendaal@gmail.com>
 * @copyright (c) Joey Blankendaal 2014
 * @date 22 November 2014
 * @version 1.0.2
 */

class Form
{
    private $post;
    private $validationRules;
    private $validationErrors;
    
    public function openForm($action = '', $method = 'POST')
    {
        $form = '<form action="' . $action . '" method="' . $method . '">';
        
        return $form;
    }
    
    public function closeForm()
    {
        $form = '</form>';
        
        return $form;
    }
    
    public function setField($type, $name, $label = '', $example = '')
    {
        $field = '';
        
        if (isset($label))
        {
            $field .= '<label for="' . $name . '">' . $label . '</label>';
        }
        
        if (isset($example))
        {
            $field .= ' <span class="example">' . $example . '</span>';
        }
        
        if (isset($this->validationErrors[$name]))
        {
            $field .= '<noscript><p class="error-message">' . $this->validationErrors[$name] . '</p></noscript>';
        }
        
        $field .= '<p><input id="' . $name . '" type="' . $type . '" name="' . $name . '"';
        
        if (isset($this->validationErrors[$name]))
        {
            $field .= ' class="error" title="' . $this->validationErrors[$name] . '"';
        }
        
        if (isset($this->post[$name]))
        {
            $field .= ' value="' . $this->post . '"';
        }
        
        $field .= ' /></p>';
        
        return $field;
    }
    
    public function setCheckbox($name, $label = '', $example = '')
    {
        $checkbox = '';
        
        if (isset($label))
        {
            $checkbox .= '<label for="' . $name . '">' . $label . '</label>';
        }
        
        if (isset($example))
        {
            $checkbox .= ' <span class="example">' . $example . '</span>';
        }
        
        if (isset($this->validationErrors[$name]))
        {
            $checkbox .= '<p class="error-message">' . $this->validationErrors[$name] . '</p>';
        }
        
        $checkbox .= '<input type="hidden" name="' . $name . '" value="" />';
        
        if (isset($this->post[$name]) && $this->post[$name] != NULL)
        {
            $checkbox .= '<p><input type="checkbox" name="' . $name . '" value="checked" checked="checked" /></p>';
        }
        else
        {
            $checkbox .= '<p><input type="checkbox" name="' . $name . '" value="checked" /></p>';
        }
        
        return $checkbox;
    }
    
    public function setRadio($name, $label = '', $options, $example = '')
    {
        $radio = '';
        
        if (isset($label))
        {
            $radio .= '<label for="' . $name . '">' . $label . '</label>';
        }
        
        if (isset($example))
        {
            $radio .= ' <span class="example">' . $example . '</span>';
        }
        
        if (isset($this->validationErrors[$name]))
        {
            $radio .='<p class="error-message">' . $this->validationErrors[$name] . '</p>';
        }
        
        $radio .= '<input type="hidden" name="' . $name . '" value="" />';
        
        foreach ($options as $option => $value)
        {
            if (isset($this->post[$name]) && $this->post[$name] == $value)
            {
                $radio .= '<p><input type="radio" name="' . $name . '" value="' . $value . '" checked="checked" /> ' . $option . '</p>';
            }
            else
            {
                $radio .= '<p><input type="radio" name="' . $name . '" value="' . $value . '" /> ' . $option . '</p>';
            }
        }
        
        return $radio;
    }
    
    public function setSelect($name, $label = '', $options, $example = '')
    {
        $select = '';
        
        if (isset($label))
        {
            $select .= '<label for="' . $name . '">' . $label . '</label>';
        }
        
        if (isset($example))
        {
            $select .= ' <span class="example">' . $example . '</span>';
        }
        
        if (isset($this->validationErrors[$name]))
        {
            $select .= '<p class="error-message">' . $this->validationErrors[$name] . '</p>';
        }
        
        $select .= '<p><select name="' . $name . '">';
        
        foreach ($options as $option => $value)
        {
            if (isset($this->post[$name]) && $this->post[$name] == $value)
            {
                $select .= '<option value="' . $value . '" selected="selected">' . $option . '</option>';
            }
            else
            {
                $select .= '<option value="' . $value . '">' . $option . '</option>';
            }
        }
        
        $select .= '</select></p>';
        
        return $select;
    }
    
    public function setSubmit($name, $value)
    {
        $submit = '<input type="submit" name="' . $name . '" value="' . $value . '" />';
        
        return $submit;
    }
    
    public function setValidation($arrayName, $rules)
    {
        $this->validationRules[$arrayName] = $rules;
    }
    
    public function validateFields($postArray)
    {
        array_pop($postArray);
        $this->post = $postArray;
        
        foreach ($this->post as $key => $value)
        {
            $value = trim($value);
            
            if (array_key_exists($key, $this->validationRules))
            {
                foreach ($this->validationRules[$key] as $rule => $ruleValue)
                {
                    if (method_exists($this, $rule))
                    {
                        $this->$rule($key, $value, $ruleValue);
                    }
                }
            }
        }
        
        if (empty($this->validationErrors))
        {
            return true;
        }
    }
    
    private function required($key, $value, $ruleValue)
    {
        if (empty($value) && $ruleValue == true)
        {
            $this->validationErrors[$key] = 'This field is required.';
        }
    }
    
    private function validEmail($key, $value, $ruleValue)
    {
        if (!preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', $value) && $ruleValue == true)
        {
            if (!isset($this->validationErrors[$key]) && !empty($value))
            {
                $this->validationErrors[$key] = 'Enter a valid email address.';
            }
        }
    }
    
    private function validURL($key, $value, $ruleValue)
    {
        if (!preg_match('/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/', $value) && $ruleValue == true)
        {
            if (!isset($this->validationErrors[$key]) && !empty($value))
            {
                $this->validationErrors[$key] = 'Enter a valid URL.';
            }
        }
    }
    
    private function match($key, $value, $ruleValue)
    {
        if ($value != $this->post[$ruleValue])
        {
            $this->validationErrors[$key] = 'This field is not identical.';
        }
    }
    
    private function minLength($key, $value, $ruleValue)
    {
        if (strlen($value) < $ruleValue)
        {
            if (!empty($value))
            {
                $this->validationErrors[$key] = 'This field has a minimum of ' . $ruleValue . ' characters.';
            }
        }
    }
    
    private function maxLength($key, $value, $ruleValue)
    {
        if (strlen($value) > $ruleValue)
        {
            if (!empty($value))
            {
                $this->validationErrors[$key] = 'This field has a maximum of ' . $ruleValue . ' characters.';
            }
        }
    }
    
    private function exactLength($key, $value, $ruleValue)
    {
        if (strlen($value) != $ruleValue)
        {
            if (!empty($value))
            {
                $this->validationErrors[$key] = 'This field is required to be exactly ' . $ruleValue . ' characters.';
            }
        }
    }
    
    private function alpha($key, $value, $ruleValue)
    {
        if (!preg_match('/^([a-z])+$/i', $value))
        {
            if (!isset($this->validationErrors[$key]) && !empty($value))
            {
                $this->validationErrors[$key] = 'This field can only contain alphabetical characters.';
            }
        }
    }
    
    private function alphaNumeric($key, $value, $ruleValue)
    {
        if (!preg_match('/^([a-z0-9])+$/i', $value))
        {
            if(!isset($this->validationErrors[$key]) && !empty($value))
            {
                $this->validationErrors[$key] = 'This field can only contain alphanumerical characters.';
            }
        }
    }
    
    private function numeric($key, $value, $ruleValue)
    {
        if (!preg_match('/^[\-+]?[0-9]*\.?[0-9]+$/', $value))
        {
            if(!isset($this->validationErrors[$key]) && !empty($value))
            {
                $this->validationErrors[$key] = 'This field can only contain numeric characters.';
            }
        }
    }
    
    private function lessThan($key, $value, $ruleValue)
    {
        if (preg_match('/^[\-+]?[0-9]*\.?[0-9]+$/', $value))
        {
            if ($value >= $ruleValue)
            {
                if (!isset($this->validationErrors[$key]) && !empty($value))
                {
                    $this->validationErrors[$key] = 'This field has to be less than ' . $ruleValue . ' characters.';
                }
            }
        }
        else
        {
            if (!isset($this->validationErrors[$key]) && !empty($value))
            {
                $this->validationErrors[$key] = 'This field can only contain numbers.';
            }
        }
    }
    
    private function greaterThan($key, $value, $ruleValue)
    {
        if (preg_match('/^[\-+]?[0-9]*\.?[0-9]+$/', $value))
        {
            if ($value <= $ruleValue)
            {
                if (!isset($this->validationErrors[$key]) && !empty($value))
                {            
                    $this->validationErrors[$key] = 'This field has to be greater than ' . $ruleValue . ' characters.';
                }
            }
        }
        else
        {
            if (!isset($this->validationErrors[$key]) && !empty($value))
            {
                $this->validationErrors[$key] = 'This field can only contain numbers.';
            }
        }
    }
    
    public function getField($key)
    {
        if (isset($_POST[$key]))
        {
            return $_POST[$key];
        }
        else
        {
            throw new Exception('Field ' . htmlspecialchars($key) . ' not found.');
        }
    }
}