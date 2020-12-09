<?php


namespace app\models;


class User
{
    private ?int $id;
    private string $email;
    private ?string $passwordHash;
    private ?string $registrationTime;

    /**
     * User constructor.
     * @param int|null $id
     * @param string $email
     * @param string $passwordHash
     * @param string|null $registrationTime
     */
    public function __construct(?int $id, string $email, ?string $passwordHash, ?string $registrationTime)
    {
        $this->id = $id;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->registrationTime = $registrationTime;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    /**
     * @return string
     */
    public function getRegistrationTime(): string
    {
        return $this->registrationTime;
    }


}