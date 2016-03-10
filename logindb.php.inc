<?php

require_once("error.php.inc");
class localDB
{
    private $db;
    private $salt;	
    private $logger;
    public function __construct($iniFile){
	$ini = parse_ini_file($iniFile,true);
        $this->logger = new errorLogger("/var/log/it202.log");
	$this->db = new mysqli(
		$ini['loginDB']['host'],
		$ini['loginDB']["user"],
		$ini['loginDB']["password"],
		$ini['loginDB']["db"]);
	$this->salt = $ini['loginDB']['salt'];
	if ($this->db->connect_errno > 0 )
	{
		$this->logger->log(__FILE__.__LINE__."failed to connect to database re: ".$this->db->connect_error);
		exit(0);
	}
    }
    public function __destruct()
    {
	$this->db->close();
    }

    public function getUserId($username)
    {
	$query = "select userId from fantasysport where userName = '$username';";
	$results = $this->db->query($query);
	if (!$results)
	{
	    $this->logger->log("error with results: ".$this->db->error);
	    return 0;
	}
        $client = $results->fetch_assoc();
	if (isset($client['userId']))
	{
	    return $client['userId'];
	}
	return 0;
    }

    private function saltPassword($password)
    {
	return $this->db->real_escape_string(sha1($password.$this->salt));
    }

    public function validateUser($username,$password)
    {
	if ($this->getUserId($username) == 0)
        {
	    return array("success"=>false,
		"message"=>"user does not exist");
	}
	$query = "select * from fantasysport where userName='$username';";
	$results = $this->db->query($query);
	if (!$results)
	{
	    return array("success"=>false,
		"message"=>"db failure");
	}
        $client = $results->fetch_assoc();
        {
	    if ($client['userPW'] == $this->saltPassword($password))
	    {
		return array("success"=>true);
	    }
        }
        return array("success"=>false,"message"=>"failed to match password");
    }

    public function addNewUser($username,$password, $firstName, $lastName, $emailAd)
    {
	if ($this->getUserId($username) != 0)
        {
	    $this->logger->log("user $username already exists!!!!!");
	    $response = array(
		"message"=>"user $username already exists!",
		"success"=>false
		);
	    return $response;
	}
        $now = date("Y-m-d h:i:s",time());
        $name = $this->db->real_escape_string($username);
	$password = $this->saltPassword($password);
        $addQuery = "insert into fantasysport (userName, userPW, firstName, lastName, emailAd, activeSession, lastLogin) values ('$username', '$password', '$firstName', '$lastName', '$emailAd','$now','$now');";
        $results = $this->db->query($addQuery);
	if (!$results)
	{
	    $this->logger->log("error: ".$this->db->error);
	}
	return array("success"=>true);
    }

}
// at this point db is connected
?>
