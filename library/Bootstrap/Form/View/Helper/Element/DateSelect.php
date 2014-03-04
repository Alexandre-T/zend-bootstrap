<?php
namespace Bootstrap\Form\View\Helper\Element;
use Zend\Form\View\Helper\FormDateSelect;

/**
 *
 * @author alexandre
 *        
 */
class DateSelect extends FormDateSelect
{
	
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