<?php
class User
{
    public function insertData()
    {
        $secure = new CheckData();
        $context=new Context(new DataEntry());
        $secure->enterData();
        $context->algorithm($secure->setEntry());
    }
    public function findData()
    {
        $secure = new CheckData();
        $context=new Context(new SearchData());
        $secure->conductSearch();
        $context->algorithm($secure->setEntry());
    }
    public function showAll()
    {
        $dummy = array(0);
        $context=new Context(new DisplayData());
        $context->algorithm($dummy);
    }
    public function changeData()
    {
        $secure = new CheckData();
        $context=new Context(new UpdateData());
        $secure->makeChange();
        $context->algorithm($secure->setEntry());
    }
    public function delete()
    {
        $secure=new CheckData();
        $context=new Context(new DeleteData());
        $secure->removeRecord();
        $context->algorithm($secure->setEntry());

    }
}
?>
