<?php

class MyFunction
{
    private $wbFinasToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNDFhYzNiODkwZWUyYTU0MTA2MmVjMGVhNTQ5YWNhYTNiMjBlOGRkYmVlNjA1NDIzZjNlM2IyODdkMzYyYjg2NWYyNWVjMTNkMmE2YWFjMmYiLCJpYXQiOjE2ODE5OTAyNjguOTE3MTc1LCJuYmYiOjE2ODE5OTAyNjguOTE3MTgzLCJleHAiOjE3MTM2MTI2NjguOTEyMTc1LCJzdWIiOiIxMCIsInNjb3BlcyI6W119.pG-iIlGpqre8wl7Rz1cMzg5Ndp1tqPhj-nekvNfvLLQ_tkzU6NJOXGEF8MAvJkOHPjuGUpwGA8ARFttG7kmz80ge_H1v54iHWBhVxrmLnJR2oOgOpj89xTMR7Yxtz_n95SaBs9MPhOunzRQ_AADhWVN5CTys_J2uKMJqB9GCdFb-kgFCkp1PWOiYdAqWjxyoNgtHdV2H5TFTEvuEcprQVh5C-6FmkVGzmh_0lAH3uA5EKf3YIx4KC_ZnTauufIl0_v6WKwQ0fvVu1YizsZsQZguPt8iHQ2EJzXna3XmrcVHHsPZF7kHDY7d8gdkrSzflM-7-Tx-aZsJmwvG9kVIRGalhJIy6W-CDQPal9e2YONzzMAx2ZN1X-Vw8pZyk_JCcm7WmkN5rPyArWa3Q5S1HrkzXN1wcTIiQbiJWxGwvi9LB1-u7VRaQHS9vnIlA2yLq-JwQVlztnGTrHYfg0LZZkDRRnHIO4Es6n5C6NhPfym0CKsEK67AUdBw9vU-IPzy6qqZTX5mnnjQv_6x4U8yVkcjsAQQJQUb2hf68D1Ut-j9HIrDGlRsRTDl86EUXvFsTpJIfqKCCWsZPTqqLArKXweXi2KO8x15S_jgV5rORC7yvSeo2xpLqBMu-T_0ONlBAnHgoDxXOMkjdnDHGj1P8L44vxheX-cVI3Op_vdMpWoA';

    public function wbFinasToken()
    {
        return  $this->wbFinasToken;
    }

    public function setCurl($method, $url, $headerList, $data, $ctimeout = 10, $timeout = 20)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $ctimeout);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        $headers =  [];
        foreach ($headerList as  $header) {
            $headers[] = $header;
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
      //  print_r($result );
        if (curl_error($ch)) {
            $resultData = ["success" => 'false', "message" => "curl işleminde hata oluştu -'.curl_error($ch).'"];
        } else {
            $resultData = ["success" => 'true', "message" => "", "data" => json_decode($result)];
        }
        curl_close($ch);
        return $resultData;
    }
}
