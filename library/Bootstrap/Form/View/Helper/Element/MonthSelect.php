<?php
namespace Bootstrap\Form\View\Helper\Element;
use Zend\Form\View\Helper\FormMonthSelect;
use Zend\Form\ElementInterface;

/**
 *
 * @author alexandre
 *        
 */
class MonthSelect extends FormMonthSelect
{
	/* (non-PHPdoc)
	 * @see \Zend\Form\View\Helper\FormMonthSelect::render()
	 */
	public function render(ElementInterface $element) {
		// TODO Optimize
		$resultat = '<div class="row"><div class="col-sm-6">';
		$resultat .= str_replace('</select> <select', '</select></div><div class="col-sm-6"><select', parent::render($element));
		$resultat .= '</div></div>';
		return $resultat;
		
	}
	
	/**
	 * Retrieve the FormSelect helper
	 *
	 * @return FormSelect
	 */
	protected function getSelectElementHelper()
	{
		if ($this->selectHelper) {
			return $this->selectHelper;
		}
	
		if (method_exists($this->view, 'plugin')) {
			$this->selectHelper = $this->view->plugin('bs_select');
		}
	
		return $this->selectHelper;
	}
}

?>