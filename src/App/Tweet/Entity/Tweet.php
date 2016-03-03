<?php
/**
 * Created by PhpStorm.
 * User: Ricardo Fiorani
 * Date: 02/03/2016
 * Time: 21:46
 */

namespace App\Tweet\Entity;

/**
 * @Entity (repositoryClass="\App\Tweet\Repository\TweetRepository")
 **/
class Tweet
{
    /**
     * @var string
     * @Column(type="guid")
     * @Id
     * @GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @Column(type="string",unique=true)
     **/
    protected $tweetId;

    /**
     * @Column(type="boolean")
     */
    protected $replied;

    /**
     * Tweet constructor.
     * @param $tweetId
     */
    public function __construct($tweetId)
    {
        $this->tweetId = $tweetId;
        $this->replied = false;
    }

    /**
     * @return string
     */
    public function getTweetId()
    {
        return $this->tweetId;
    }

    /**
     * @return mixed
     */
    public function isReplied()
    {
        return $this->replied;
    }

    /**
     * Sets replied
     */
    public function setReplied()
    {
        $this->replied = true;
    }

}
