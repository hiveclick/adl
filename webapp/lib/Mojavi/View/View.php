<?php
/**
 * A view represents the presentation layer of an action. Output can be
 * customized by supplying attributes, which a template can manipulate and
 * display.
 *
 * @package    Mojavi
 * @subpackage View
 */
namespace Mojavi\View;

use Mojavi\Core\MojaviObject as MojaviObject;
use Mojavi\Controller\Controller as Controller;
use Mojavi\Exception\RenderException as RenderException;
use Mojavi\Util\Toolkit as Toolkit;

abstract class View extends MojaviObject
{

    // +-----------------------------------------------------------------------+
    // | CONSTANTS                                                             |
    // +-----------------------------------------------------------------------+

    /**
     * Show an alert view.
     *
     * @since 3.0.0
     */
    const ALERT = 'Alert';

    /**
     * Show an error view.
     *
     * @since 3.0.0
     */
    const ERROR = 'Error';

    /**
     * Show a form input view.
     *
     * @since 3.0.0
     */
    const INPUT = 'Input';

    /**
     * Skip view execution.
     *
     * @since 3.0.0
     */
    const NONE = null;

    /**
     * Show a success view.
     *
     * @since 3.0.0
     */
    const SUCCESS = 'Success';

    /**
     * Render the presentation to the client.
     *
     * @since 3.0.0
     */
    const RENDER_CLIENT = 2;

    /**
     * Do not render the presentation.
     *
     * @since 3.0.0
     */
    const RENDER_NONE = 1;

    /**
     * Render the presentation to a variable.
     *
     * @since 3.0.0
     */
    const RENDER_VAR = 4;

    // +-----------------------------------------------------------------------+
    // | PRIVATE VARIABLES                                                     |
    // +-----------------------------------------------------------------------+

    private
        $decorator          = false,
        $decoratorDirectory = null,
        $decoratorTemplate  = null,
        $directory          = null,
        $slots              = array(),
        $template           = null;


    // +-----------------------------------------------------------------------+
    // | METHODS                                                               |
    // +-----------------------------------------------------------------------+

    /**
     * Clear all attributes associated with this view.
     *
     * @return void
     */
    abstract function clearAttributes ();

    // -------------------------------------------------------------------------

    /**
     * Loop through all template slots and fill them in with the results of
     * presentation data.
     *
     * @param string A chunk of decorator content.
     *
     * @return string A decorated template.
     */
    protected function & decorate (&$content)
    {

        // alias controller
        $controller = $this->getContext()->getController();

        // get original render mode
        $renderMode = $controller->getRenderMode();

        // set render mode to var
        $controller->setRenderMode(self::RENDER_VAR);

        // grab the action stack
        $actionStack = $controller->getActionStack();

        // loop through our slots, and replace them one-by-one in the
        // decorator template
        $slots =& $this->getSlots();

        foreach ($slots as $name => &$slot)
        {

            // grab this next forward's action stack index
            $index = $actionStack->getSize();

            // forward to the first slot action
            $controller->forward($slot['module_name'], $slot['action_name']);

            // grab the action entry from this forward
            $actionEntry = $actionStack->getEntry($index);

            // set the presentation data as a template attribute
            $presentation =& $actionEntry->getPresentation();

            $this->setAttributeByRef($name, $presentation);

        }

        // put render mode back
        $controller->setRenderMode($renderMode);

        // set the decorator content as an attribute
        $this->setAttributeByRef('content', $content);

        // return a null value to satisfy the requirement
        $retval = null;

        return $retval;

    }

    // -------------------------------------------------------------------------

    /**
     * Execute any presentation logic and set template attributes.
     *
     * @return void
     */
    abstract function execute ();

    // -------------------------------------------------------------------------

    /**
     * Retrieve an attribute.
     *
     * @param string An attribute name.
     *
     * @return mixed An attribute value, if the attribute exists, otherwise
     *               null.
     */
    abstract function & getAttribute ($name);

    // -------------------------------------------------------------------------

    /**
     * Retrieve an array of attribute names.
     *
     * @return array An indexed array of attribute names.
     */
    abstract function getAttributeNames ();

    // -------------------------------------------------------------------------

    /**
     * Retrieve the current application context.
     *
     * @return \Mojavi\Core\Context The current Context instance.
     */
    public function getContext ()
    {
        return Controller::getInstance()->getContext();
    }

    // -------------------------------------------------------------------------

    /**
     * Retrieve this views decorator template directory.
     *
     * @return string An absolute filesystem path to this views decorator
     *                template directory.
     */
    public function getDecoratorDirectory ()
    {
        return $this->decoratorDirectory;
    }

    // -------------------------------------------------------------------------

    /**
     * Retrieve this views decorator template.
     *
     * @return string A template filename, if a template has been set, otherwise
     *                null.
     */
    public function getDecoratorTemplate ()
    {
        return $this->decoratorTemplate;
    }

    // -------------------------------------------------------------------------

    /**
     * Retrieve this views template directory.
     *
     * @return string An absolute filesystem path to this views template
     *                directory.
     */
    public function getDirectory ()
    {
        return $this->directory;
    }

    // -------------------------------------------------------------------------

    /**
     * Retrieve the template engine associated with this view.
     *
     * Note: This will return null for PHPView instances.
     *
     * @return mixed A template engine instance.
     */
    abstract function & getEngine ();

    // -------------------------------------------------------------------------

    /**
     * Retrieve an array of specified slots for the decorator template.
     *
     * @return array An associative array of decorator slots.
     */
    protected function & getSlots ()
    {
        return $this->slots;
    }

    // -------------------------------------------------------------------------

    /**
     * Retrieve this views template.
     *
     * @return string A template filename, if a template has been set, otherwise
     *                null.
     */
    public function getTemplate ()
    {
        return $this->template;
    }

    // -------------------------------------------------------------------------

    /**
     * Import parameter values and error messages from the request directly as
     * view attributes.
     *
     * @param array An indexed array of file/parameter names.
     * @param bool  Is this a list of files?
     * @param bool  Import error messages too?
     * @param bool  Run strip_tags() on attribute value?
     * @param bool  Run htmlspecialchars() on attribute value?
     *
     * @return void
     */
    public function importAttributes ($names, $files = false, $errors = true, $stripTags = true, $specialChars = true)
    {

        // alias $request to keep the code clean
        $request = $this->getContext()->getRequest();

        // get our array
        if ($files) {
            // file names
            $array =& $request->getFiles();
        } else {
            // parameter names
            $array =& $request->getParameters();
        }

        // loop through our parameter names and import them
        foreach ($names as &$name)
        {
            if (preg_match('/^([a-z0-9\-_]+)\{([a-z0-9\s\-_]+)\}$/i', $name, $match)) {
                // we have a parent
                $parent  = $match[1];
                $subname = $match[2];

                // load the file/parameter value for this attribute if one
                // exists
                if (isset($array[$parent]) && isset($array[$parent][$subname]))  {
                    $value = $array[$parent][$subname];

                    if ($stripTags) {

                        $value = strip_tags($value);
                    }

                    if ($specialChars) {
                        $value = htmlspecialchars($value);
                    }
                    $this->setAttribute($name, $value);
                } else
                {
                    // set an empty value
                    $this->setAttribute($name, '');
                }
            } else {
                // load the file/parameter value for this attribute if one
                // exists
                if (isset($array[$name])) {
                    $value = $array[$name];

                    if ($stripTags) {

                        $value = strip_tags($value);
                    }

                    if ($specialChars) {
                        $value = htmlspecialchars($value);
                    }
                    $this->setAttribute($name, $value);
                } else {
                    // set an empty value
                    $this->setAttribute($name, '');
                }
            }

            if ($errors) {
                if ($request->hasError($name)) {
                    $this->setAttribute($name . '_error',
                                        $request->getError($name));
                } else {
                    // set empty error
                    $this->setAttribute($name . '_error', '');
                }
            }
        }
    }

    // -------------------------------------------------------------------------

    /**
     * Initialize this view.
     *
     * @param Context The current application context.
     *
     * @return bool true, if initialization completes successfully, otherwise
     *              false.
     */
    public function initialize ($context)
    {
        // set the currently executing module's template directory as the
        // default template directory
        $module = $context->getModuleName();
        $class_name = get_class($this);
        $class_name = str_replace('View', '', $class_name);
        
        $this->template                = $class_name . ".php";
        $this->decoratorDirectory = MO_MODULE_DIR . '/' . $module .'/templates';
        $this->directory          = $this->decoratorDirectory;

        return true;

    }

    // -------------------------------------------------------------------------

    /**
     * Indicates that this view is a decorating view.
     *
     * @return bool true, if this view is a decorating view, otherwise false.
     */
    public function isDecorator ()
    {
        return $this->decorator;
    }

    // -------------------------------------------------------------------------

    /**
     * Execute a basic pre-render check to verify all required variables exist
     * and that the template is readable.
     *
     * @return void
     *
     * @throws <b>RenderException</b> If the pre-render check fails.
     */
    protected function preRenderCheck ()
    {
        if ($this->template == null) {
            // a template has not been set
            $error = 'A template has not been set';

            throw new RenderException($error);
        }

        $template = $this->directory . '/' . $this->template;

        if (!is_readable($template)) {
            // the template isn't readable
            $error = 'The template "%s" does not exist or is unreadable';
            $error = sprintf($error, $template);

            throw new RenderException($error);
        }

        // check to see if this is a decorator template
        if ($this->decorator) {
            $template = $this->decoratorDirectory . '/' . $this->decoratorTemplate;

            if (!is_readable($template)) {
                // the decorator template isn't readable
                $error = 'The decorator template "%s" does not exist or is ' .
                         'unreadable';
                $error = sprintf($error, $template);

                throw new RenderException($error);
            }
        }
    }

    // -------------------------------------------------------------------------

    /**
     * Remove an attribute.
     *
     * @param string An attribute name.
     *
     * @return mixed An attribute value, if the attribute was removed,
     *               otherwise null.
     */
    abstract function & removeAttribute ($name);

    // -------------------------------------------------------------------------

    /**
     * Render the presentation.
     *
     * When the controller render mode is View::RENDER_CLIENT, this method will
     * render the presentation directly to the client and null will be returned.
     *
     * @return string A string representing the rendered presentation, if
     *                the controller render mode is View::RENDER_VAR, otherwise
     *                null.
     */
    abstract function & render ();

    // -------------------------------------------------------------------------

    /**
     * Set an attribute.
     *
     * @param string An attribute name.
     * @param mixed  An attribute value.
     *
     * @return void
     */
    abstract function setAttribute ($name, $value);

    // -------------------------------------------------------------------------

    /**
     * Set an attribute by reference.
     *
     * @param string An attribute name.
     * @param mixed  A reference to an attribute value.
     *
     * @return void
     */
    abstract function setAttributeByRef ($name, &$value);

    // -------------------------------------------------------------------------

    /**
     * Set an array of attributes.
     *
     * @param array An associative array of attributes and their associated
     *              values.
     *
     * @return void
     */
    abstract function setAttributes ($values);

    // -------------------------------------------------------------------------

    /**
     * Set an array of attributes by reference.
     *
     * @param array An associative array of attributes and references to their
     *              associated values.
     *
     * @return void
     */
    abstract function setAttributesByRef (&$values);

    // -------------------------------------------------------------------------

    /**
     * Set the decorator template directory for this view.
     *
     * @param string An absolute filesystem path to a template directory.
     *
     * @return void
     */
    public function setDecoratorDirectory ($directory)
    {
        $this->decoratorDirectory = $directory;
    }

    // -------------------------------------------------------------------------

    /**
     * Set the decorator template for this view.
     *
     * If the template path is relative, it will be based on the currently
     * executing module's template sub-directory.
     *
     * @param string An absolute or relative filesystem path to a template.
     *
     * @return void
     */
    public function setDecoratorTemplate ($template)
    {
        if (Toolkit::isPathAbsolute($template)) {
            $this->decoratorDirectory = dirname($template);
            $this->decoratorTemplate  = basename($template);
        } else {
            $this->decoratorTemplate = $template;
        }
        // set decorator status
        $this->decorator = true;
    }

    // -------------------------------------------------------------------------

    /**
     * Set the template directory for this view.
     *
     * @param string An absolute filesystem path to a template directory.
     *
     * @return void
     */
    public function setDirectory ($directory)
    {
        $this->directory = $directory;
    }

    // -------------------------------------------------------------------------

    /**
     * Set the module and action to be executed in place of a particular
     * template attribute.
     *
     * If a slot with the name already exists, it will be overridden.
     *
     * @param string A template attribute name.
     * @param string A module name.
     * @param string An action name.
     *
     * @return void
     */
    public function setSlot ($attributeName, $moduleName, $actionName)
    {
        $this->slots[$attributeName]                = array();
        $this->slots[$attributeName]['module_name'] = $moduleName;
        $this->slots[$attributeName]['action_name'] = $actionName;
    }

    // -------------------------------------------------------------------------

    /**
     * Set the template for this view.
     *
     * If the template path is relative, it will be based on the currently
     * executing module's template sub-directory.
     *
     * @param string An absolute or relative filesystem path to a template.
     *
     * @return void
     */
    public function setTemplate ($template)
    {
        if (Toolkit::isPathAbsolute($template)) {
            $this->directory = dirname($template);
            $this->template  = basename($template);
        } else {
            $this->template = $template;
        }
    }

}
