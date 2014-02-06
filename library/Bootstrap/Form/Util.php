<?php
namespace Bootstrap\Form;
use Bootstrap\Exception\InvalidParameterException;

/**
 *
 * @author alexandre
 *        
 */
class Util
{

    /**
     * Form type Basic
     *
     * @var string
     */
    const FORM_TYPE_BASIC = 'basic';

    /**
     * Form type Horizontal
     *
     * @var string
     */
    const FORM_TYPE_HORIZONTAL = 'horizontal';

    /**
     * Form type Inline
     *
     * @var string
     */
    const FORM_TYPE_INLINE = 'inline';

    /**
     * Form css class for very small device (phone)
     *
     * @var string
     */
    const DEVICE_XS = 'col-xs-';

    /**
     * Form css class for small device (tablet and landscape phone)
     *
     * @var string
     */
    const DEVICE_SM = 'col-sm-';

    /**
     * Form css class for medium device (standard desktop)
     *
     * @var string
     */
    const DEVICE_MD = 'col-md-';

    /**
     * Form css class for large device (large desktop)
     *
     * @var string
     */
    const DEVICE_LG = 'col-lg-';

    /**
     * Form css class offset for very small device (phone)
     *
     * @var string
     */
    const OFFSET_XS = 'col-xs-offset-';

    /**
     * Form css class offset for small device (tablet and landscape phone)
     *
     * @var string
     */
    const OFFSET_SM = 'col-sm-offset-';

    /**
     * Form css class offset for medium device (desktop)
     *
     * @var string
     */
    const OFFSET_MD = 'col-md-offset-';

    /**
     * Form css class offset for large device (large desktop)
     *
     * @var string
     */
    const OFFSET_LG = 'col-lg-offset-';

    /**
     * Supported form types
     *
     * @var array
     */
    protected $supportedFormTypes = array(
            self::FORM_TYPE_BASIC,
            self::FORM_TYPE_HORIZONTAL,
            self::FORM_TYPE_INLINE
    );

    /**
     * Size of label col for very small device
     *
     * @var integer
     */
    protected $xsColSize = 0;

    /**
     * Size of label col for small device
     *
     * @var integer
     */
    protected $smColSize = 4;

    /**
     * Size of label col for medium device like desktop
     *
     * @var integer
     */
    protected $mdColSize = 0;

    /**
     * Size of label col for large device
     *
     * @var integer
     */
    protected $lgColSize = 0;

    /**
     * Default form type
     *
     * @var string
     */
    protected $defaultFormType = self::FORM_TYPE_BASIC;

    /**
     * Override the DefaultZendViewHelper
     *
     * @var boolean
     */
    protected $overrideZendHelper = true;

    /**
     * Constructor
     *
     * @param string|null $defaultFormType            
     */
    public function __construct ($defaultFormType = self::FORM_TYPE_BASIC, $override = true)
    {
        $this->setDefaultFormType($defaultFormType);
        $this->overrideZendHelper = (boolean) $override;
    }

    /**
     * Returns the default form type
     *
     * @return string
     */
    public function getDefaultFormType ()
    {
        return $this->defaultFormType;
    }

    /**
     * Sets the default form type
     *
     * @param string $defaultFormType            
     */
    public function setDefaultFormType ($defaultFormType)
    {
        if (! $this->isFormTypeSupported($defaultFormType)) {
            $defaultFormType = self::FORM_TYPE_BASIC;
        }
        $this->defaultFormType = $defaultFormType;
    }

    /**
     * Is the specified form type supported?
     *
     * @param string $formType            
     * @return bool
     */
    public function isFormTypeSupported ($formType)
    {
        return in_array($formType, $this->supportedFormTypes);
    }

    /**
     * Filters the specified form type and returns it - if null, uses the
     * default, otherwise checks if the type is supported
     *
     * @param
     *            $formType
     * @return string
     * @throws \Bootstrap\Exception\InvalidParameterException
     */
    public function filterFormType ($formType)
    {
        if (is_null($formType)) {
            $formType = $this->getDefaultFormType();
        }
        if (! $this->isFormTypeSupported($formType)) {
            throw new InvalidParameterException(
                    sprintf("Form type '%s' is not supported.", $formType));
        }
        return $formType;
    }

    /**
     *
     * @return the $override
     */
    public function getOverride ()
    {
        return $this->overrideZendHelper;
    }

    /**
     *
     * @param boolean $override            
     */
    public function setOverride ($override = true)
    {
        $this->overrideZendHelper = (boolean) $override;
    }

    /**
     * Return positive integer filtered value else 0
     *
     * @param mixed $value            
     * @return integer
     */
    public function filterSize ($value)
    {
        $filter = filter_var($value, FILTER_VALIDATE_INT, 
                array(
                        'options' => array(
                                'default' => 0,
                                'min_range' => 0,
                                'max_range' => 11
                        )
                ));
        if ($filter) {
            return $filter;
        } else {
            return 0;
        }
    }
    /**
     * Return the css class when for each colsize specified
     * 
     * @return string
     */
    public function getCss(){
        $result = array();
        if($this->xsColSize){
            $result[] = self::DEVICE_XS . $this->xsColSize; 
        }
        if($this->smColSize){
        	$result[] = self::DEVICE_SM . $this->smColSize;
        }
        if($this->mdColSize){
        	$result[] = self::DEVICE_MD . $this->mdColSize;
        }
        if($this->lgColSize){
        	$result[] = self::DEVICE_LG . $this->lgColSize;
        }
        return implode(' ',$result);
    }
    /**
     * Return the css class for each colsize specified
     * 
     * @return string
     */
    public function getOffsetCss(){
        $result = array();
        if($this->xsColSize){
            $result[] = self::OFFSET_XS . $this->xsColSize; 
        }
        if($this->smColSize){
        	$result[] = self::OFFSET_SM . $this->smColSize;
        }
        if($this->mdColSize){
        	$result[] = self::OFFSET_MD . $this->mdColSize;
        }
        if($this->lgColSize){
        	$result[] = self::OFFSET_LG . $this->lgColSize;
        }
        return implode(' ',$result);
    }
    /**
     * Return the width css class colsize specified
     *
     * @return string
     */
    public function getWidthCss(){
    	$result = array();
    	if($this->xsColSize){
    		$result[] = self::DEVICE_XS . ( 12 - $this->xsColSize);
    	}
    	if($this->smColSize){
    		$result[] = self::DEVICE_SM . ( 12 - $this->smColSize);
    	}
    	if($this->mdColSize){
    		$result[] = self::DEVICE_MD . ( 12 - $this->mdColSize);
    	}
    	if($this->lgColSize){
    		$result[] = self::DEVICE_LG . ( 12 - $this->lgColSize);
    	}
    	return implode(' ',$result);
    }
    /**
	 * @return the $xsColSize
	 */
	public function getXsColSize() {
		return $this->xsColSize;
	}

	/**
	 * @param number $xsColSize
	 */
	public function setXsColSize($xsColSize = 0) {
		$this->xsColSize = $this->filterSize($xsColSize);
	}

	/**
	 * @return the $smColSize
	 */
	public function getSmColSize() {
		return $this->smColSize;
	}

	/**
	 * @param number $smColSize
	 */
	public function setSmColSize($smColSize = 0) {
		$this->smColSize = $this->filterSize($smColSize);
	}

	/**
	 * @return the $mdColSize
	 */
	public function getMdColSize() {
		return $this->mdColSize;
	}

	/**
	 * @param number $mdColSize
	 */
	public function setMdColSize($mdColSize = 0) {
		$this->mdColSize = $this->filterSize($mdColSize);
	}

	/**
	 * @return the $lgColSize
	 */
	public function getLgColSize() {
		return $this->lgColSize;
	}

	/**
	 * @param number $lgColSize
	 */
	public function setLgColSize($lgColSize = 0) {
		$this->lgColSize = $this->filterSize($lgColSize);
	}



}

?>