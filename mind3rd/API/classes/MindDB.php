<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MindDB
 *
 * @author felipe
 */
class MindDB {
	private $db= null;
	public $lastInsertedId= 0;

	public function query($qr)
	{
		$ret= sqlite_query($this->db, $qr);
		$ar_ret= Array();
		while($tuple= sqlite_fetch_array($ret, SQLITE_ASSOC))
		{
			$ar_ret[]= $tuple;
		}
		return $ar_ret;
	}

	public function execute($command)
	{
		$ret= sqlite_exec($this->db, $command);
		$this->lastInsertedId= sqlite_last_insert_rowid($this->db);
		return ;
	}

    public function  __construct()
	{
		if(!$db = sqlite_open(_MINDSRC_.'/mind3rd/SQLite/mind'))
		{
			Mind::message('Database', '[Fail]');
			return false;
		}
		$this->db= $db;
		return $this;
	}
}
?>
