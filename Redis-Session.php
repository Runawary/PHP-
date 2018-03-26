
//使用Redis代替文件储存Session...
<?php

class sessionmanager
{
	private $redis;
	private $seesionsavepath;
	private $sessionname;

	public function __construct ()
	{
		$this->redis = new Redis();
		$this->redis->connect('10.116.19.14',6400);
		$reval = session_set_save_handler(
	            array($this,"open"), 
		    array($this,"close"),
		    array($this,"read"),
		    array($this,"write"),
		    array($this,"destroy"),
		    array($this,"gc"))
	    );
        session_start();
	}

	public function open ($patn,$name) 
	{
		return true;
	}
	public function close () 
	{
		return true;
	}
	public function read ($id)
	{
		$value = $this->redis->get($id);
		if ($value)
		{
			return $value;
		}
		else
		{
			return false;
		}
	}
	public function write ($id,$data)
	{
		if ($this->redis->set($id,$data))
		{
			$this->redis->expire($id,60);
			return true;
		}
		else
		{
			return false;
		}
	}
	public function destroy ($id)
	{
		if ($this->redis->delete($id))
		{
			return true;
		}
		return false;
	}
	public function gc ($maxfiletime)
	{
		return true;
	}
	public function __destruct ()
	{
		session_write_close();
		//TODO: Implement__destruct() method.
	}
}
