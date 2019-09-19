<?php

namespace App\Filter;
use Illuminate\Http\Request;

class Filter
{
	/**
     * create class instance
     *
     * @var array
     */
	public static function factory() {
		return new self;
    }

	public $label = '';
    public $name = '';
	public $value = '';
	public $placeholder = '';
    public $options = [];

	/**
     * Basic parameter settings
     *
     * @var array
     */
    public function label($label) {
        $this->label = "<label>$label</label>";
        return $this;
    }

	public function name($name) {
		$this->name = $name;
		return $this;
	}

	public function value($value) {
		if (isset($value)) {
			$this->value = $value;
		}
		return $this;
	}

	public function placeholder($placeholder) {
		$this->placeholder = $placeholder;
		return $this;
	}

    public function options($options) {
        $this->options = $options;
        return $this;
    }

	/**
     * filter functions
     *
     * @var array
     */
	public function input() {
        return "
        	<div class='p-2'>
                $this->label
        		<input 
        			type='text' 
        			class='form-control' 
        			name='$this->name'
        			value='$this->value'
        			placeholder='$this->placeholder'
        		>
        	</div>
        ";
    }

    public function select() {
        $html = '';

        if (count($this->options)) {

            foreach ($this->options as $key => $value) {
                $selected = isset($this->value) ? $key == $this->value ? 'selected' : '' : '';
                $html.= "<option value='$key' $selected>$value</option>";
            }

            return "
            	<div class='p-2'>
                    $this->label <select name='$this->name' class='form-control'>$html</select>
            	</div>
            ";
        }
    }
}
