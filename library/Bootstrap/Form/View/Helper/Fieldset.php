<?php
namespace Bootstrap\Form\View\Helper;

use Bootstrap\Exception\UnsupportedElementTypeException;
use Bootstrap\Util;
use Bootstrap\Form\Util as FormUtil;
use Zend\Form\View\Helper\AbstractHelper as AbstractFormViewHelper;
use Zend\I18n\Translator\TranslatorAwareInterface;
use Zend\Form\FieldsetInterface;
use Zend\Form\ElementInterface;

/**
 * Fieldset Form Helper
 *
 * @package zend-bootstrap
 * @copyright Alexandre-T (c) - http://www.at-it.fr
 * @license Apache License v2 https://github.com/Alexandre-T/zend-bootstrap/blob/master/LICENSE
 * @link https://github.com/Alexandre-T/zend-bootstrap
 * @link http://www.at-it.fr
 * @author alexandre
 *        
 */
class Fieldset extends AbstractFormViewHelper implements TranslatorAwareInterface
{

    /**
     *
     * @var Util
     */
    protected $bootstrapUtil;

    /**
     *
     * @var FormUtil
     */
    protected $formUtil;

    /**
     * Constructor
     * 
     * @param \Bootstrap\Util $Util            
     * @param \Bootstrap\Form\FormUtil $formUtil            
     */
    public function __construct(Util $bootstrapUtil, FormUtil $formUtil)
    {
        $this->bootstrapUtil = $bootstrapUtil;
        $this->formUtil = $formUtil;
    }

    /**
     * Returns fieldset opening tag and legend tag when defined
     *
     * @param FieldsetInterface $fieldset            
     * @param string|null $formType            
     * @param array $displayOptions            
     * @return string
     */
    public function openTag(FieldsetInterface $fieldset, $formType = null, array $displayOptions = array())
    {
        $formType = $this->formUtil->filterFormType($formType);
        $class = $fieldset->getAttribute('class');
        if (array_key_exists('class', $displayOptions)) {
            $class = $this->bootstrapUtil->addWords($displayOptions['class'], $class);
        }
        $escapeHtmlAttrHelper = $this->getEscapeHtmlAttrHelper();
        $class = $this->bootstrapUtil->escapeWords($class, $escapeHtmlAttrHelper);
        $fieldset->setAttribute('class', $class);
        if ($class) {
            $classAttrib = sprintf(' class="%s"', $class);
        } else {
            $classAttrib = '';
        }
        $html = sprintf('<fieldset%s>', $classAttrib);
        $legend = $fieldset->getOption('legend');
        if ($legend && (! array_key_exists('display_legend', $displayOptions) || $displayOptions['display_legend']) && ($formType == FormUtil::FORM_TYPE_HORIZONTAL || $formType == FormUtil::FORM_TYPE_VERTICAL)) {
            // Translate
            if (null !== ($translator = $this->getTranslator())) {
                $legend = $translator->translate($legend, $this->getTranslatorTextDomain());
            }
            // Escape
            $escapeHelper = $this->getEscapeHtmlHelper();
            $legend = $escapeHelper($legend);
            $html .= "<legend>$legend</legend>";
        }
        return $html;
    }

    /**
     * Returns the fieldset closing tag
     * 
     * @return string
     */
    public function closeTag()
    {
        return '</fieldset>';
    }

    /**
     * Renders the fieldset content
     * 
     * @param FieldsetInterface $fieldset            
     * @param string|null $formType            
     * @param array $displayOptions            
     * @param bool $displayButtons            
     * @param bool $renderErrors            
     * @throws \Bootstrap\Form\Exception\UnsupportedElementTypeException
     * @return string
     */
    public function content(FieldsetInterface $fieldset, $formType = null, array $displayOptions = array(), $displayButtons = true, $renderErrors = true)
    {
        $renderer = $this->getView();
        if (! method_exists($renderer, 'plugin')) {
            // Bail early if renderer is not pluggable
            return '';
        }
        $formType = $this->formUtil->filterFormType($formType);
        //$rowHelper = $renderer->plugin('form_row');
        $iterator = $fieldset->getIterator();
        $html = '';
        if (array_key_exists('fieldsets', $displayOptions)) {
            $displayOptionsFieldsets = $displayOptions['fieldsets'];
        } else {
            $displayOptionsFieldsets = array();
        }
        if (array_key_exists('elements', $displayOptions)) {
            $displayOptionsElements = $displayOptions['elements'];
        } else {
            $displayOptionsElements = array();
        }
        // Iterate over all fieldset elements and render them
        foreach ($iterator as $elementOrFieldset) {
            $elementName = $elementOrFieldset->getName();
            $elementBareName = $this->formUtil->getBareElementName($elementName);
            if ($elementOrFieldset instanceof FieldsetInterface) {
                // Fieldset
                /* @var $elementOrFieldset FieldsetInterface */
                // Get fieldset display options
                if (array_key_exists($elementBareName, $displayOptionsFieldsets)) {
                    $displayOptionsFieldset = $displayOptionsFieldsets[$elementBareName];
                } else {
                    $displayOptionsFieldset = array();
                }
                $html .= "\n" . $this->render($elementOrFieldset, $formType, $displayOptionsFieldset, true, true, $renderErrors);
            } elseif ($elementOrFieldset instanceof ElementInterface) {
                // Element
                /* @var $element ElementInterface */
                if (! $displayButtons && in_array($elementOrFieldset->getAttribute('type'), array(
                    'submit',
                    'reset',
                    'button'
                ))) {
                    // We should ignore 'button' elements and this is a 'button' element, so skip the rest of the iteration
                    continue;
                }
                // Get element display options
                if (array_key_exists($elementBareName, $displayOptionsElements)) {
                    $displayOptionsElement = $displayOptionsElements[$elementBareName];
                } else {
                    $displayOptionsElement = array();
                }
                //$html .= "\n" . $rowHelper($elementOrFieldset, $formType, $displayOptionsElement, $renderErrors);
            } else {
                // Unsupported item type
                throw new UnsupportedElementTypeException('Fieldsets may contain only fieldsets or elements.');
            }
        }
        return $html;
    }

    /**
     *
     * @param FieldsetInterface $fieldset            
     * @param string|null $formType            
     * @param array $displayOptions            
     * @param bool $displayButtons
     *            Should buttons found in this fieldset be rendered?
     * @param bool $renderFieldsetTag
     *            Should we render the <fieldset> tag around the fieldset?
     * @param bool $renderErrors            
     * @return string
     */
    public function render(FieldsetInterface $fieldset, $formType = null, array $displayOptions = array(), $displayButtons = true, $renderFieldsetTag = true, $renderErrors = true)
    {
        $formType = $this->formUtil->filterFormType($formType);
        $html = '';
        if ($renderFieldsetTag) {
            $html .= $this->openTag($fieldset, $formType, $displayOptions);
        }
        $html .= "\n" . $this->content($fieldset, $formType, $displayOptions, $displayButtons, $renderErrors);
        if ($renderFieldsetTag) {
            $html .= "\n" . $this->closeTag();
        }
        return $html;
    }

    /**
     *
     * @param FieldsetInterface|null $fieldset            
     * @param string|null $formType            
     * @param array $displayOptions            
     * @param bool $displayButtons
     *            Should buttons found in this fieldset be rendered?
     * @param bool $renderFieldsetTag
     *            Should we render the <fieldset> tag around the fieldset?
     * @param bool $renderErrors            
     * @return string
     */
    public function __invoke(FieldsetInterface $fieldset = null, $formType = null, array $displayOptions = array(), $displayButtons = true, $renderFieldsetTag = true, $renderErrors = true)
    {
        if (is_null($fieldset)) {
            return $this;
        }
        return $this->render($fieldset, $formType, $displayOptions, $displayButtons, $renderFieldsetTag, $renderErrors);
    }
}