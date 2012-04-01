<?php
/**
 * User: Costin
 * Date: 24.05.2010
 * Time: 23:14:21
 */

namespace Entities;

/**
 * @Entity
 */
class Store
{
    /**
     * @Id @Column(type="integer", name="store_id")
     * @GeneratedValue
     */
    protected $id;

    /**
     * @Column(length=32, nullable=TRUE)
     */
    protected $ext_code;

    /**
     * @Column(length=64)
     */
    protected $name;

    /**
     * @Column(length=8)
     */
    protected $status;

    /**
     * @Column(type="datetime")
     */
    protected $create_ts;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getExtCode() {
        return $this->ext_code;
    }

    public function setExtCode($ext_code) {
        $this->ext_code = $ext_code;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getCreateTs() {
        return $this->create_ts;
    }

    public function setCreateTs($create_ts) {
        $this->create_ts = $create_ts;
    }

}
?>
