
<?php



class Rajaongkir
{
   public function __construct(){

   }
    private $key      = 'f286c6e4cbcb3435907d35f08c1aac8c'; 
   
    private $cost_url = 'https://pro.rajaongkir.com/api/cost'; 

    function getCost($origin,$originType, $destination,$destinationType, $weight, $courir)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->cost_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin={$origin}&originType={$originType}&destination={$destination}&destinationType={$destinationType}&weight={$weight}&courier=$courir",
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: {$this->key}"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            $arry  = array('status' => false, 'message' => $err);
            return $arry;
        } else {
            $arry = array('status'=>true,'output'=>$response);
            return $arry;
        }
    }
    function getWaybill($waybill,$courier){
        $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://pro.rajaongkir.com/api/waybill",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "waybill={$waybill}&courier={$courier}",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: {$this->key}"
            ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                $arr = array('status'=>false,'output'=>null);
                
            } else {
                $arr = array('status'=>true,'output'=>$response);
            }
            return $arr;
    }

}