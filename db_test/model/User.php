<?php
namespace model;


class User
{
    private $id;
    private $username;
    private $password;
    private $email;
    private $profile_pic;

    public function __construct($username, $password, $email){
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }


    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $profile_pic
     */
    public function setProfilePic($profile_pic)
    {
        $this->profile_pic = $profile_pic;
    }

    /**
     * @return mixed
     */
    public function getProfilePic()
    {
        return $this->profile_pic;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }
}