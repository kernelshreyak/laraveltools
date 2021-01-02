<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Url;

use Illuminate\Http\Request;

/**
* URL Shortener for Unstabnet
*/
class URLShortener extends Controller
{

	public function index()
	{
		return view('urlshortener');
	}

	private function generateRandomString($length = 4) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	public function shortify(Request $request)
	{
		$url = $request->input('url');

		// check if already shortened
		$urldata = Url::where(['longurl' => $url])->first();

		if ($urldata) {
			echo "SHORT:".$urldata->shorturl;
			$request->session()->flash('shorturl',$urldata->shorturl);	
		}
		else{
			// shorten the given URL
			$shorturl = $this->generateRandomString();
			if(!empty($url)){

				$urldata = new Url;
				$urldata->longurl = $url;
				$urldata->shorturl = $shorturl;
				$urldata->save();
				$request->session()->flash('shorturl',$shorturl);
				$request->session()->flash('successmsg', 'URL shortened successfully!');
			}
			else{
				$request->session()->flash('errormsg', 'Invalid input provided!');
			}
		}
			
		return redirect('/urlshortener');
	}

	public function longify($shorturl)
	{
		$urldata = Url::where(['shorturl' => $shorturl])->first();
		if ($urldata) {
			return redirect($urldata->longurl);
		}
		else{
			echo "<h3>ERROR: Invalid Short URL!</h3>";
		}
	}	


}