<?php

class ArticleFacade implements IArticleFacade {
    
    protected $entityManager;
    
    public function __construct($em) {
        $this->entityManager = $em;
    }

    /**
     * @param ind $articleId
     * @param DateTime $time
     */    
    public function publish($articleId, $time) {
        $this->find($articleId)->setPuslished($time);
        $this->entityManager->flush();
    }
    
    /**
     * @param ind $articleId
     */
    public function delete($articleId) {
        $this->entityManager->remove($this->find($articleId));
    }
    
    /**
     * @param string $title
     * @param string $text
     * 
     * @return Article
     */
    public function newArticle($title, $text) {
        $article = new Article;
        $this->entityManager->persist($article);
        $article->setTitle($title);
        $article->setText($text);
        $this->entityManager->flush;
        return $article;
    }
    
    /**
     * @param string $title
     * @param string $text
     * @param int $articleId
     * 
     * @return Article
     */
    public function update($title, $text, $articleId) {
        $article = $this->find($articleId);
        $article->setTitle($title);
        $article->setText($text);
        $this->entityManager->flush();
        return $article;
    }
    
    /**
     * @param int $articleId
     * 
     * @return Article
     */
    protected function find($articleId) {
        return $this->entityManager->getRepository('Article')->find($articleId);
    }

	/**
	 * Adds a new comment to an article
	 *     
	 * @param int $articleId
	 * @param string $commentTitle
	 * @param string $commentText
	 * @return Comment
	 */
	public function addComment($articleId, $commentTitle, $commentText) {
	    $comment = new Comment;
	    $comment->setTitle($commentTitle);
	    $comment->setText($commentText);
	    $this->entityManager->persist($comment);
	    $comment->setArticle($this->find($articleId));
	    $this->entityManager->flush();
	    return $comment;
	}
    
}