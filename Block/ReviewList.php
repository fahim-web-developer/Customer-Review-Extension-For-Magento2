<?php
namespace Fahim\CustomerReview\Block;

use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Review\Model\ResourceModel\Review\CollectionFactory;
use Lof\CustomerAvatar\Block\Attributes\Avatar;

class ReviewList extends \Magento\Framework\View\Element\Template
{

  public function __construct(
    StoreManagerInterface $storeManagerInterface,
    CollectionFactory $collectionFactory,
    Avatar $avatar,
    Context $context

  ) {
    $this->storeManagerInterface = $storeManagerInterface;
    $this->collectionFactory = $collectionFactory;
    $this->avatar = $avatar;
    parent::__construct($context);
  }


  public function getreviews(){
 
    $currentStoreId = $this->storeManagerInterface->getStore()->getId();
    $reviewCollectionFactory = $this->collectionFactory->create();

    $reviewsCollection = $reviewCollectionFactory->addFieldToSelect('*')->addStoreFilter($currentStoreId)->addStatusFilter(\Magento\Review\Model\Review::STATUS_APPROVED)->setDateOrder()->addRateVotes();


    // $data = array();

    // foreach ($reviewsCollection AS $review){
    //   $data[] = array("customerId"=>$review->getCustomerId(),"nickname"=>$review->getNickname(),"avatar"=>$this->avatar->getCustomerAvatarById($review->getCustomerId()));
    // }
    return $reviewsCollection;
  }

  public function getCustomerAvatarById($id){
    return $this->avatar->getCustomerAvatarById($id);
  }
}