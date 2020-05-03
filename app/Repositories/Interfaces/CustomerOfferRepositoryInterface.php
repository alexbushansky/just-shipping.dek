<?php


namespace App\Repositories\Interfaces;



interface CustomerOfferRepositoryInterface
{

    public function getAllOffers($title,$countryFrom,$regionFrom,$cityFrom,$countryTo,$regionTo,$cityTo,
                                 $price,$capacity,$weight,$typeCargo);
    public function createOffer($nameOfOrder,$description,$addressFirst,$addressSecond,$weight,$pricePerKm,
                                $dateFinish,$customerId,$types,$photos,$addressFrom,$addressTo,$capacity);
    public function acceptedOffer($customerOfferId, $driverId);
    public function completeOffer($id);
    public function showCompletedDriverOrders($driver);
    public function showCompletedCustomerOrders($customer);
    public function getCompletedOrder(int $id);


}
