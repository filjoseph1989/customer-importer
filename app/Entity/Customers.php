<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\DBAL\Types\Types;

#[Entity]
#[Table(name: 'customers')]
class Customers
{
	#[ORM\Id]
	#[Column(type: 'integer')]
	#[GeneratedValue]
	private int|null $id=null;

	#[Column(type: Types::STRING)]
	private string $first;

	#[Column(type: Types::STRING)]
	private string $last;

	#[Column(type: Types::STRING)]
	private string $email;

	#[Column(type: Types::STRING)]
	private string $phone;

	#[Column(type: Types::STRING)]
	private string $gender;

	#[Column(type: Types::STRING)]
	private string $username;

	#[Column(type: Types::STRING)]
	private string $password;

	#[Column(type: Types::STRING)]
	private string $city;

	#[Column(type: Types::STRING)]
	private string $country;

	/**
	 * Get id.
	 *
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 *
	 * @return mixed
	 */
	public function getFirst()
    {
		return $this->first;
	}

	/**
	 *
	 * @param mixed $first
	 * @return self
	 */
	public function setFirst($first): self
    {
		$this->first = $first;
		return $this;
	}

	/**
	 *
	 * @return mixed
	 */
	public function getLast() {
		return $this->last;
	}

	/**
	 *
	 * @param mixed $last
	 * @return self
	 */
	public function setLast($last): self {
		$this->last = $last;
		return $this;
	}

	/**
	 *
	 * @return mixed
	 */
	public function getEmail()
    {
		return $this->email;
	}

	/**
	 *
	 * @param mixed $email
	 * @return self
	 */
	public function setEmail($email): self
    {
		$this->email = $email;
		return $this;
	}

	/**
	 *
	 * @return mixed
	 */
	public function getPhone()
    {
		return $this->phone;
	}

	/**
	 *
	 * @param mixed $phone
	 * @return self
	 */
	public function setPhone($phone): self
    {
		$this->phone = $phone;
		return $this;
	}

	/**
	 *
	 * @return mixed
	 */
	public function getGender()
    {
		return $this->gender;
	}

	/**
	 *
	 * @param mixed $gender
	 * @return self
	 */
	public function setGender($gender): self
    {
		$this->gender = $gender;
		return $this;
	}

	/**
	 *
	 * @return mixed
	 */
	public function getUsername()
    {
		return $this->username;
	}

	/**
	 *
	 * @param mixed $username
	 * @return self
	 */
	public function setUsername($username): self
    {
		$this->username = $username;
		return $this;
	}

	/**
	 *
	 * @return mixed
	 */
	public function getPassword()
    {
		return $this->password;
	}

	/**
	 *
	 * @param mixed $password
	 * @return self
	 */
	public function setPassword($password): self
    {
		$this->password = $password;
		return $this;
	}

	/**
	 *
	 * @return mixed
	 */
	public function getCity()
    {
		return $this->city;
	}

	/**
	 *
	 * @param mixed $city
	 * @return self
	 */
	public function setCity($city): self
    {
		$this->city = $city;
		return $this;
	}

	/**
	 *
	 * @return mixed
	 */
	public function getCountry()
    {
		return $this->country;
	}

	/**
	 *
	 * @param mixed $country
	 * @return self
	 */
	public function setCountry($country): self
    {
		$this->country = $country;
		return $this;
	}
}