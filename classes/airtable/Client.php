<?php namespace Renick\AirTable\Classes\AirTable;

use Http;
use Zadorin\Airtable\Client as ThirdPartyClient;

class Client
{
    protected ThirdPartyClient $client;
    protected string $personalAccessToken;
    protected string $selectedDatabaseId;
    protected const BASE_URL = "https://api.airtable.com/v0/"; // with ending slash

    public function __construct(string $personalAccessToken, string $selectedDatabaseId)
    {
        $this->personalAccessToken = $personalAccessToken;
        $this->selectedDatabaseId = $selectedDatabaseId;

        // This can also write, update, and delete records in your tables.
        // So using this third party client makes sense, till all the features are implemented.
        $this->client = new ThirdPartyClient($this->personalAccessToken, $this->selectedDatabaseId);
    }

    protected function makeRequest(): \Illuminate\Http\Client\PendingRequest
    {
        return Http::withHeaders([
            'Authorization' => "Bearer {$this->personalAccessToken}"
        ]);
    }

    protected function get(string $path, array $queryParams = []): \Illuminate\Http\Client\Response
    {
        $queryParams = array_filter($queryParams, static function($value) {
            return $value !== null;
        });

        return $this->makeRequest()->get(self::BASE_URL . $path, $queryParams);
    }

}
