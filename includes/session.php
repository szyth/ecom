<?php

/***
 * Created by PhpStorm.
 ***/
class MySessionHandler implements SessionHandlerInterface
{
    private $database = null;

    public function __construct($sessionDBconnectionUrl)
    {
        /***
         * Just setting up my own database connection. Use yours as you need.
         ***/

        require_once "connection.inc.php";
        $this->database = new DatabaseObject($sessionDBconnectionUrl);

        // Set handler to overide SESSION
        session_set_save_handler(
            array($this, "open"),
            array($this, "close"),
            array($this, "read"),
            array($this, "write"),
            array($this, "destroy"),
            array($this, "gc")
        );
        register_shutdown_function('session_write_close');
        session_start();
    }

    /**
     * Open
     */
    public function open($savepath, $id)
    {
        // If successful
        $this->database->getSelect("SELECT `data` FROM sessions WHERE id = ? LIMIT 1", $id, TRUE);
        if ($this->database->selectRowsFoundCounter() == 1) {
            // Return True
            return true;
        }
        // Return False
        return false;
    }
    /**
     * Read
     */
    public function read($id)
    {
        // Set query
        $readRow = $this->database->getSelect('SELECT `data` FROM sessions WHERE id = ? LIMIT 1', $id, TRUE);
        if ($this->database->selectRowsFoundCounter() > 0) {
            return $readRow['data'];
        } else {
            return '';
        }
    }

    /**
     * Write
     */
    public function write($id, $data)
    {
        // Create time stamp
        $access = time();

        // Set query
        $dataReplace[0] = $id;
        $dataReplace[1] = $access;
        $dataReplace[2] = $data;
        if ($this->database->noReturnQuery('REPLACE INTO sessions(id,access,`data`) VALUES (?, ?, ?)', $dataReplace)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Destroy
     */
    public function destroy($id)
    {
        // Set query
        if ($this->database->noReturnQuery('DELETE FROM sessions WHERE id = ? LIMIT 1', $id)) {
            return true;
        } else {

            return false;
        }
    }
    /**
     * Close
     */
    public function close()
    {
        // Close the database connection
        if ($this->database->dbiLink->close) {
            // Return True
            return true;
        }
        // Return False
        return false;
    }

    /**
     * Garbage Collection
     */
    public function gc($max)
    {
        // Calculate what is to be deemed old
        $old = time() - $max;

        if ($this->database->noReturnQuery('DELETE FROM sessions WHERE access < ?', $old)) {
            return true;
        } else {
            return false;
        }
    }

    public function __destruct()
    {
        $this->close();
    }
}
