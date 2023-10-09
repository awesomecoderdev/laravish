<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentService
{
    protected $license;
    protected $lastMessage=null;

    public function setLicense($lic) {
        $this->license=$lic;
    }

    public function getLastMessage():String {
        return $this->lastMessage;
    }
    public function validate(): bool
    {
        $response = Http::withBasicAuth(config("licensemanager.user"), config("licensemanager.secret"))->withHeaders([
        ])
            ->withOptions(["verify" => false])
            ->get(config("licensemanager.url") . "/validate/" . $this->license);
        $resBody=$response->body();
        $resArray=json_decode($resBody, true);
        if (isset($resArray["message"])) {
            $this->lastMessage = $resArray["message"];
        }
        if ($response->successful()) {
            Log::info('License validated valid');
            return true;
        } else {
            Log::warning('License validated invalid, server response was '.$resBody);
            return false;
        }
    }

    public function consume(): bool
    {
        $response = Http::withBasicAuth(config("licensemanager.user"), config("licensemanager.secret"))->withHeaders([
        ])
            ->withOptions(["verify" => false])
            ->get(config("licensemanager.url") . "/activate/".$this->license);
        $resBody=$response->body();
        $resArray=json_decode($resBody, true);
        if (isset($resArray["message"])) {
            $this->lastMessage = $resArray["message"];
        }

        if (!$response->successful()) {
            Log::info('License failed');
            return false;
        } else {

            Log::debug('License successfully validated');
            return true;
        }

    }

    public function getExtensionDate($baseTimestamp=null):String
    {
        $prolongation = "";
        if (strpos($this->license, "FAS1") === 0) {
            $prolongation = "+1 year";
        } else if (strpos($this->license, "FAS5") === 0) {
            $prolongation = "+5 years";
        } else if (strpos($this->license, "ID5") === 0) {
            $prolongation = "+5 years";
        } else if (strpos($this->license, "ID10") === 0) {
            $prolongation = "+10 years";
        } else if (strpos($this->license, "ID1") === 0) {
            $prolongation = "+1 year";
        }
        $expired = strftime("%Y-%m-%d %H:%M:%S", strtotime($prolongation, $baseTimestamp));
        return $expired;
    }
}
