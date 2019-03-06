<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AppAssert;

/**
 * Person
 * @UniqueEntity("email")
 * @ORM\Table(name="person")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonRepository")
 */
class Person
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="firstname", type="string", length=100)
     */
    private $firstname;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="lastname", type="string", length=100)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     * @Assert\Length(
     *      min = 5,
     *      max = 5,
     *      exactMessage = "Zipcode should have exactly {{ limit }} characters."
     * )
     * @ORM\Column(name="zipcode", type="string", length=5, nullable=true)
     */
    private $zipcode;

    /**
     * @var string
     * @Assert\Length(
     *      min = 2,
     *      max= 100,
     *      minMessage = "City must be at least {{ limit }} characters long",
     *      maxMessage = "City cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(name="city", type="string", length=100, nullable=true)
     */
    private $city;

    /**
     * @var string
     * @Assert\Country
     * @ORM\Column(name="country", type="string", length=100, nullable=true)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=20, nullable=true)
     */
    private $phone;

    /**
     * @var string A "Y-m-d" formatted value
     * @Assert\Date()
     * @AppAssert\Birthday()
     * @ORM\Column(name="birthday", type="string", length=10, nullable=true)
     */
    private $birthday;

    /**
     * @var string
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     * @ORM\Column(name="email", type="string", length=100, unique=true)
     */
    private $email;

    /**
     * @var string
     * @Assert\Image()
     * @ORM\Column(name="picture", type="string", length=255, nullable=true)
     */
    private $picture;

    public function getId(): int
    {
        return $this->id;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    public function getZipcode()
    {
        return $this->zipcode;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    public function getBirthday()
    {
        return $this->birthday;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    public function getPicture()
    {
        return $this->picture;
    }
}
