<?php


namespace app\models;


class Answer
{
    private int $id;
    private ?int $id_question;
    private int $id_registered_user;
    private string $message;
    private string $vote_number;
    private string $submission_time;

    /**
     * Question constructor.
     * @param int $id
     * @param int $id_question
     * @param int $id_registered_user
     * @param string $message
     * @param int $vote_number
     * @param string $submission_time
     */
    public function __construct(int $id, int $id_question, int $id_registered_user, string $message, int $vote_number, string $submission_time)
    {
        $this->id = $id;
        $this->id_question = $id_question;
        $this->id_registered_user = $id_registered_user;
        $this->message = $message;
        $this->vote_number = $vote_number;
        $this->submission_time = $submission_time;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getIdQuestion(): ?int
    {
        return $this->id_question;
    }

    /**
     * @return int
     */
    public function getIdRegisteredUser(): int
    {
        return $this->id_registered_user;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return int|string
     */
    public function getVoteNumber()
    {
        return $this->vote_number;
    }

    /**
     * @return int|string
     */
    public function getSubmissionTime()
    {
        return $this->submission_time;
    }


}