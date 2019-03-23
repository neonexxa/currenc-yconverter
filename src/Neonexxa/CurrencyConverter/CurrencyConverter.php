<?php 
namespace Neonexxa\CurrencyConverter;
class CurrencyConverter {

  private $host = 'https://free.currencyconverterapi.com/api/v6/convert';
  private $data = array();
  private $api_key = '';
  private $currency = '';
  private $ch;
  private $sep = '/';
  private $ints = '?';

  function __construct( $data = array() ){
    if (is_array($data) && (count($data) > 0)) {
      if (isset($data['api_key'])) $this->api_key = $data['api_key'];
      if (isset($data['host'])) $this->host = $data['host'];
      if (isset($data['currency'])) $this->currency = $data['currency'];
    }
  }
  // function set_data($data, $data2 = null) {
  //  if (is_array($data)) {
  //    foreach($data as $key => $value){
  //      $this->data[$key] = $value;
  //    }
  //  } else if ($data2 !== null) {
  //    $this->data[$data] = $data2;
  //  }
  // }
  function convert($value)
    {
        $get_data = $this->callAPI('GET', $this->host.$this->ints.'q='.$this->currency.'&compact=ultra&apiKey='.$this->api_key, false);
        $response = json_decode($get_data, true);
        return $value*$response[$this->currency];
    }
  function callAPI($method, $url, $data){
        if ($this->api_key == '') {
            $this->error = 'API key was not set';
            return false;
        }
        if ($this->currency == '') {
            $this->error = 'currency was not set';
            return false;
        }


    // curl_setopt($this->ch, CURLOPT_HEADER, 1);
    // curl_setopt($this->ch, CURLOPT_USERPWD, $this->api_key . ":");
    // curl_setopt($this->ch, CURLOPT_TIMEOUT, 30);
    // curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);

    // if (count($this->data) > 0) {
    //  curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->data );
    // }

    // $r = curl_exec($this->ch);
    // curl_close($this->ch);
       $curl = curl_init();

       switch ($method){
          case "POST":
             curl_setopt($curl, CURLOPT_POST, 1);
             if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
             break;
          case "PUT":
             curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
             if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);                              
             break;
          default:
             if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
       }

       // OPTIONS:
       curl_setopt($curl, CURLOPT_URL, $url);
       curl_setopt($curl, CURLOPT_HTTPHEADER, array(
          'APIKEY: 111111111111111111111',
          'Content-Type: application/json',
       ));
       curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

       // EXECUTE:
       $result = curl_exec($curl);
       if(!$result){die("Connection Failure");}
       curl_close($curl);
       return $result;
  }
}
