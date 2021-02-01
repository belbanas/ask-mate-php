<?php


namespace app\models;


class Question
{
    private ?int $id;
    private ?int $idImage;
    private ?int $idRegisteredUser;
    private ?string $title;
    private ?string $message;
    private ?int $voteNumber;
    private ?string $submissionTime;
    private ?array $tags;

    /**
     * Question constructor.
     * @param int|null $id
     * @param int|null $idImage
     * @param int|null $idRegisteredUser
     * @param string|null $title
     * @param string|null $message
     * @param int|null $voteNumber
     * @param string|null $submissionTime
     * @param null $
     */
    public function __construct(?int $id, ?int $idImage, ?int $idRegisteredUser, ?string $title, ?string $message, ?int $voteNumber, ?string $submissionTime, ?array $tags = [])
    {
        $this->id = $id;
        $this->idImage = $idImage;
        $this->idRegisteredUser = $idRegisteredUser;
        $this->title = $title;
        $this->message = $message;
        $this->voteNumber = $voteNumber;
        $this->submissionTime = $submissionTime;
        $this->tags = $tags;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getIdImage(): ?int
    {
        return $this->idImage;
    }

    /**
     * @return int
     */
    public function getIdRegisteredUser(): int
    {
        return $this->idRegisteredUser;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return int
     */
    public function getVoteNumber(): int
    {
        return $this->voteNumber;
    }


    /**
     * @return string
     */
    public function getSubmissionTime(): ?string
    {
        return $this->submissionTime;
    }


    /**
     * @return array|null
     */
    public function getTags(): ?array
    {
        return $this->tags;
    }
}