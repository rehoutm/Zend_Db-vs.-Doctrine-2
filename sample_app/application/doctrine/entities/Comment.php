<?php

/**
 * @Entity
 */
class Comment {
	
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
     * @ManyToOne(targetEntity="Article", inversedBy="comments")
     * @var Article
     */
    protected $article;

    
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
	
}