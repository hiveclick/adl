<?php
/**
 * SessionStorage allows you to store persistent Mojavi data in the user
 * session.
 *
 * <b>Optional parameters:</b>
 *
 * # <b>auto_start</b>   - [Yes]    - Should session_start() automatically be
 *                                    called?
 * # <b>session_name</b> - [Mojavi] - The name of the session.
 *
 * @package    Mojavi
 * @subpackage Storage
 */
namespace Mojavi\Storage;

class SessionStorage extends Storage
{

    // +-----------------------------------------------------------------------+
    // | METHODS                                                               |
    // +-----------------------------------------------------------------------+

    /**
     * Initialize this Storage.
     *
     * @param Context A Context instance.
     * @param array   An associative array of initialization parameters.
     *
     * @return bool true, if initialization completes successfully, otherwise
     *              false.
     *
     * @throws <b>InitializationException</b> If an error occurs while
     *                                        initializing this Storage.
     */
    public function initialize ($context, $parameters = null)
    {

        // initialize parent
        parent::initialize($context, $parameters);

        // set session name
        $sessionName = $this->getParameter('session_name', 'Mojavi');

        session_name($sessionName);
        
        if(isset($_GET[$sessionName]) && strlen(trim($_GET[$sessionName])) > 10) {
            session_id($_GET[$sessionName]);
        } elseif(isset($_POST[$sessionName]) && strlen(trim($_POST[$sessionName])) > 10) {
            session_id($_POST[$sessionName]);
        }

        if ($this->getParameter('auto_start', true))
        {

            // start our session
            session_start();

        }

    }

    // -------------------------------------------------------------------------

    /**
     * Read data from this storage.
     *
     * The preferred format for a key is directory style so naming conflicts can
     * be avoided.
     *
     * @param string A unique key identifying your data.
     *
     * @return mixed Data associated with the key.
     */
    public function & read ($key)
    {

        $retval = null;

        if (isset($_SESSION[$key]))
        {
            $retval = $_SESSION[$key];
        }

        return $retval;

    }

    // -------------------------------------------------------------------------

    /**
     * Remove data from this storage.
     *
     * The preferred format for a key is directory style so naming conflicts can
     * be avoided.
     *
     * @param string A unique key identifying your data.
     *
     * @return mixed Data associated with the key.
     */
    public function & remove ($key)
    {

        $retval = null;

        if (isset($_SESSION[$key]))
        {

            $retval =& $_SESSION[$key];

            unset($_SESSION[$key]);

        }

        return $retval;

    }

    // -------------------------------------------------------------------------

    /**
     * Execute the shutdown procedure.
     *
     * @return void
     */
    public function shutdown ()
    {

        // don't need a shutdown procedure because read/write do it in real-time

    }

    // -------------------------------------------------------------------------

    /**
     * Write data to this storage.
     *
     * The preferred format for a key is directory style so naming conflicts can
     * be avoided.
     *
     * @param string A unique key identifying your data.
     * @param mixed  Data associated with your key.
     *
     * @return void
     */
    public function write ($key, &$data)
    {
        #$sess_data = serialize($data);
        #print_r($data);
        #$_SESSION[$key] = $sess_data;
        $_SESSION[$key] = & $data;

    }

}

