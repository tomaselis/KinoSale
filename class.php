<?php

class ClientsNew
{
    private $firstName;
    private $lastName;
    private $DOB;
    private $telephone;
    private $email;



    public function __construct($firstName, $lastName, $DOB, $telephone, $email)
    {
        $this->setName($firstName);
        $this->setLastName($lastName);
        $this->setDob($DOB);
        $this->setTelephone($telephone);
        $this->setEmail($email);
    }

    public function getName() // first name
    {
    return $this->firstName;
    }

    public function setName($fName)
    {
        $this->firstName = $fName;
    }

    public function getLastName() // last name
    {
        return $this->lastName;
    }

    public function setLastName($lName)
    {
        $this->lastName = $lName;
    }

    public function getDob() // date of birth
    {
        return $this->DOB;
    }

    public function setDob($dOBirth)
    {
        $this->DOB = $dOBirth;
    }

    public function getTelephone() // Telephone
    {
        return $this->telephone;
    }

    public function setTelephone($tel)
    {
        $this->telephone = $tel;
    }

    public function getEmail() // Email
    {
        return $this->email;
    }

    public function setEmail($mail)
    {
        $this->email = $mail;
    }
}

class Helper{
    public function formatFullName($name, $lastName){
        return $name.' '.$lastName;
    }
}



$clientOne = new ClientsNew('tomas', 'Sabaliauskis', '171283', '867007576', 'tsabal@gmail.com' );
$helper = new Helper();

echo $helper->formatFullName($clientOne->getName(), $clientOne->getLastName());

//echo $clientOne->getName();
//echo '<br>';
//echo $clientOne->getLastName();
echo '<br>';
echo $clientOne->getDob();
echo '<br>';
echo $clientOne->getTelephone();
echo '<br>';
echo $clientOne->getEmail();