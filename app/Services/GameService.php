<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GameService
{
    protected $operator_code;
    protected $secret_key;
    protected $api_url;
    protected $log_url;
    protected $password;

    public function __construct()
    {
        $this->operator_code = config('gamingsoft.operator_code');
        $this->secret_key = config('gamingsoft.secret_key');
        $this->api_url = config('gamingsoft.api_url');
        $this->log_url = config('gamingsoft.log_url');
        $this->password = $this->generateUserPassword();
    }

    public function memberCreate($username)
    {
        $signature = strtoupper(md5($this->operator_code.$username.$this->secret_key));
        $response = Http::acceptJson()->get(''.$this->api_url.'createMember.aspx?operatorcode='.$this->operator_code.'&username='.$username.'&signature='.$signature.'');
        $result = json_decode($response, true);

        return $result;
    }

    public function checkMember($provider_code, $username)
    {
        $signature = strtoupper(md5($this->operator_code.$provider_code.$username.$this->secret_key));
        $response = Http::acceptJson()->get(''.$this->api_url.'checkMemberProductUsername.ashx?operatorcode='.$this->operator_code.'&providercode='.$provider_code.'&username='.$username.'&signature='.$signature.'');
        $result = json_decode($response, true);
        
        return $result;
    }

    public function transferUserBalance($amount, $type, $provider_code, $username)
    {
        $reference_id = $this->generateReferenceId();
        $signature = strtoupper(md5($amount.$this->operator_code.$this->password.$provider_code.$reference_id.$type.$username.$this->secret_key));

        $response = Http::acceptJson()->get(''.$this->api_url.'makeTransfer.aspx?operatorcode='.$this->operator_code.'&providercode='.$provider_code.'&username='.$username.'&password='.$this->password.'&referenceid='.$reference_id.'&type='.$type.'&amount='.$amount.'&signature='.$signature.'');
        $result = json_decode($response, true);

        return $result;
    }

    public function getBalance($provider_code, $username)
    {
        $signature = strtoupper(md5($this->operator_code.$this->password.$provider_code.$username.$this->secret_key));

        $response = Http::acceptJson()->get(''.$this->api_url.'getBalance.aspx?operatorcode='.$this->operator_code.'&providercode='.$provider_code.'&username='.$username.'&password='.$this->password.'&signature='.$signature.'');
        $result = json_decode($response, true);

        return $result;
    }

    public function gamesByProvider($provider_code)
    {
        $signature = strtoupper(md5($this->operator_code.$provider_code.$this->secret_key));
        $response = Http::acceptJson()->get(''.$this->api_url.'getGameList.ashx?operatorcode='.$this->operator_code.'&providercode='.$provider_code.'&lang=en&html=0&reformatjson=yes&signature='.$signature.'');
        $result = json_decode($response['gamelist'], true);

        return $result;
    }

    public function launchGame($provider_code, $type, $username)
    {
        $signature = strtoupper(md5($this->operator_code.$this->password.$provider_code.$type.$username.$this->secret_key));

        $response = Http::acceptJson()->get(''.$this->api_url.'launchGames.aspx?operatorcode='.$this->operator_code.'&providercode='.$provider_code.'&username='.$username.'&password='.$this->password.'&type='.$type.'&lang=en&html5=xxx&signature='.$signature.'');
        $result = json_decode($response, true);
        return $result;
    }

    public function agentCredit()
    {
        $signature = strtoupper(md5($this->operator_code.$this->secret_key));
        $response = Http::acceptJson()->get(''.$this->api_url.'checkAgentCredit.aspx?operatorcode='.$this->operator_code.'&signature='.$signature.'');
        $result = json_decode($response, true);

        return $result;
    }

    public function bettingLogs()
    {
        $signature = strtoupper(md5($this->operator_code.$this->secret_key));
        $response = Http::acceptJson()->get(''.$this->log_url.'fetchbykey.aspx?operatorcode='.$this->operator_code.'&versionkey=1&signature='.$signature.'');
        $result = json_decode($response, true);

        return $result;
    }

    public function generateUserPassword()
    {
        return Str::password(12, true, true, false, false);
    }

    public function generateReferenceId()
    {
        return Str::random(20);
    }
}