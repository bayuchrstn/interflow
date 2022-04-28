<?php  
class Firebasenotif 
{
	// url here
	private $url = 'https://fcm.googleapis.com/fcm/send';

	// key here
	function key()
	{
		return 'AAAAljvGY0s:APA91bGe_IjFou5EIGidc_wh3LbDMo7IDjN20TiGnvmxPMkooJum8y5WN5mGzS-5YpmctdwThtgABNKJxDwA2a9t6Wt4EWatAibiG0Olvdnx6qNa8NwwRbbTRywXexpZKGUcweEtJ5qc';
	}

	function notif($title='', $text='', $to='', $click_action='', $extends_data=[], $sound='', $priority='high')
	{
		$ci =& get_instance();
		// if sound is null using default sound
		if ($sound == '') {
			$sound = 'content://settings/system/notification_sound';
		}

        $hasil = [];
		// calling key
		$key = $this->key();
		// if receiver is null return false
		if ($to <> '') {
			// set the headers
			$list_header[] = "Content-Type:application/json";
			$list_header[] = "Authorization:key=".$key;

			// default parameter for firebase
			
			$parameter['notification']['title'] = $title;
			$parameter['notification']['text']  = $text;
			$parameter['notification']['click_action'] = $click_action;
			// $parameter['notification']['sound'] = $sound;
			$parameter['to'] = $to;
			$parameter['priority'] = $priority;

			// if using some data to notif
			if (! empty($extends_data)) {
				for($i = 0; $i < count($extends_data); $i++) {
					$parameter['data'] = $extends_data[$i];
				}
			}

			// send notif
			$send = $this->curl_request($this->url, $parameter, $list_header);

			// log
			// $ci->load->model('Log_Model');
			// $ci->Log_Model->log(json_encode($parameter), $send, '');
			
			// decode hasil json
			$hasil = json_decode($send, true);
			$success = isset($hasil['success']) ? $hasil['success'] : 0;
			$failure = isset($hasil['failure']) ? $hasil['failure'] : 0;

			$result = ($failure == 1) ? FALSE : TRUE;

			return $hasil;
		} else {
			return $hasil;
		}
	}

	// curl request to firebase
	function curl_request($url='', $parameter='', $header='') 
	{
		$curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 10000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($parameter),
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_FRESH_CONNECT => true
            )
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        if ($err) {
            $response = ($err);
        } else {
            $response;
        }

        return $response;
	}
}
?>