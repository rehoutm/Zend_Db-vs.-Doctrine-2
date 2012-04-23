<?php

/**
 * @Entity
 */
class Article {
    
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     * 
     * @var int
     */
    protected $id;
    
    /**
     * @Column(type="text")
     * 
     * @var string
     */
    protected $title;
    
    /**
     * @Column(type="text")
     * 
     * @var string
     */
    protected $text;
    
    /**
     * @Column(type="boolean")
     * 
     * @var bool
     */
    protected $isPublished;

    /**
     * @Column(type="datetime")
     * 
     * @var DateTime
     */    
    protected $timeOfPublish;
    
    /**
     * @OneToMany(targetEntity="Comment", mappedBy="article")
     * 
     * @var ArrayCollection
     */
    protected $comments;
    
    public function __construct() {
        $this->comments = new ArrayCollection;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getText() {
        return $this->text;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function getIsPublished() {
        return $this->isPublished;
    }

    public function setIsPublished($isPublished) {
        $this->isPublished = $isPublished;
    }

    public function getTimeOfPublish() {
        return $this->timeOfPublish;
    }

    public function setTimeOfPublish($timeOfPublish) {
        $this->timeOfPublish = $timeOfPublish;
    }

    public function getComments() {
        return $this->comments;
    }

    public function setComments($comments) {
        $this->comments = $comments;
    }
    
}