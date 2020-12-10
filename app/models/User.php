<?php


namespace app\models;


class User
{
    private ?int $id;
    private string $email;
    private ?string $passwordHash;
    private ?string $registrationTime;
    private ?int $numberOfQuestions;
    private ?int $numberOfAnswers;

    /**
     * User constructor.
     * @param int|null $id
     * @param string $email
     * @param string|null $passwordHash
     * @param string|null $registrationTime
     * @param int|null $numberOfQuestions
     * @param int|null $numberOfAnswers
     */
    public function __construct(?int $id, string $email, ?string $passwordHash, ?string $registrationTime, ?int $numberOfQuestions=NULL, ?int $numberOfAnswers=NULL)
    {
        $this->id = $id;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->registrationTime = $registrationTime;
        $this->numberOfQuestions = $numberOfQuestions;
        $this->numberOfAnswers = $numberOfAnswers;
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

    /**
     * @return int|null
     */
    public function getNumberOfQuestions(): ?int
    {
        return $this->numberOfQuestions;
    }

    /**
     * @return int|null
     */
    public function getNumberOfAnswers(): ?int
    {
        return $this->numberOfAnswers;
    }




}