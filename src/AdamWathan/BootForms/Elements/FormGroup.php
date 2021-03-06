<?php namespace AdamWathan\BootForms\Elements;

use AdamWathan\Form\Elements\Element;
use AdamWathan\Form\Elements\Label;

class FormGroup extends Element
{
	protected $label;
	protected $control;
	protected $helpBlock;

	public function __construct(Label $label, Element $control)
	{
		$this->label = $label;
		$this->control = $control;
		$this->addClass('form-group');
	}

	public function render()
	{		
		$html  = '<div';
		$html .= $this->renderAttributes();
		$html .= '>';
		$html .=  $this->label;
		$html .=  $this->control;
		$html .= $this->renderHelpBlock();

		$html .= '</div>';

		return $html;
	}

	public function helpBlock(HelpBlock $helpBlock)
	{
		$this->helpBlock = $helpBlock;
		return $this;
	}

	protected function renderHelpBlock()
	{
		if ($this->helpBlock) {
			return $this->helpBlock->render();
		}

		return '';
	}

	public function __call($method, $parameters)
	{
		call_user_func_array(array($this->control, $method), $parameters);
		return $this;
	}
}