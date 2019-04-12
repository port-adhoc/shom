<?php
/**
 * This file contains the class to use Shom.
 */

namespace PortAdhoc;

use InvalidArgumentException;
use stdClass;

use RuntimeException;

use GuzzleHttp\Client;


/**
 * This class let you call an api and save the marine data from this call to a JSON file.
 */
class Shom {
    const DEFAULT_SPOT = "";
    const DEFAULT_LANG = "fr";
    const DEFAULT_UTC = 0;
    const ENDPOINT = "https://services.data.shom.fr/";

    const LANG_FR = "fr";

    /**
     * Stores the geodetic location from which to make the call and retrieve the data.
     * 
     * @var string
     */
    protected $spot;

    /**
     * Stores the lang in which to make the api call to the shom API.
     * 
     * @var string
     */
    protected $lang;

    /**
     * Stores the UTC time.
     * 
     * @var int
     */
    protected $utc;

    /**
     * Stores the file path.
     * 
     * @var string
     */
    protected $filePath;

    /**
     * Raw data returned by the SHOM API.
     * 
     * @var string
     */
    protected $data;

    /**
     * Parsed data into JSON format.
     * 
     * @var object
     */
    protected $parsedData;

    /**
     * Constructor.
     * 
     * @since 0.1.0
     */
    public function __construct() {
        $this->spot = static::DEFAULT_SPOT;
        $this->lang = static::DEFAULT_LANG;
        $this->utc = static::DEFAULT_UTC;
        $this->filePath = "";
        $this->data = "";
        $this->parsedData = new stdClass;
    }

    /**
     * Set the geodetic location from which to grab the marine data.
     * 
     * @since 0.1.0
     */
    public function setSpot(string $spot): Shom {
        if (empty(trim($spot))) {
            throw new InvalidArgumentException("expected parameter 1 not to be empty");
        }

        $this->spot = $spot;

        return $this;
    }

    /**
     * Set the lang for retrieving the data.
     * 
     * @since 0.1.0
     */
    public function setLang(string $lang): Shom {
        $supportedLangs = ["fr"];

        if (!in_array($lang, $supportedLangs)) {
            $supportedLangs = implode(", ", $supportedLangs);

            throw new InvalidArgumentException("expected parameter 1 to be one of the following: $supportedLangs");
        }

        if (empty(trim($lang))) {
            throw new InvalidArgumentException("expected parameter 1 not to be empty");
        }

        $this->lang = $lang;

        return $this;
    }

    /**
     * Set the UTC time for the api call.
     * 
     * @since 0.1.0
     */
    public function setUtc(int $utc): Shom {
        if (!(-12 <= $utc && $utc <= 14)) {
            throw new InvalidArgumentException("expected parameter 1 to be a valid UTC between -12 and 14 (both included)");
        }

        $this->utc = $utc;

        return $this;
    }

    /**
     * Set the file path, which is the file that will contain the API data.
     * 
     * @throws InvalidArgumentException If the first parameter is empty.
     * @throws InvalidArgumentException if the file is a directory.
     * @throws 
     * @since 0.1.0
     */
    public function setFilePath(string $filePath): Shom {
        if (empty(trim($filePath))) {
            throw new InvalidArgumentException("expected parameter 1 not to be empty");
        }

        if (is_dir($filePath)) {
            throw new InvalidArgumentException("expected parameter 1 not to be a directory");
        }

        $this->filePath = $filePath;

        return $this;
    }

    /**
     * Call the SHOM API and get the return data, save it.
     * 
     * @since 0.1.0
     */
    protected function setData(int $timeout = 10): Shom {
        $client = new Client([
            "base_uri" => static::ENDPOINT,
            "timeout" => $timeout
        ]);

        $response = $client->get("/oceano/render/text", [
            "query" => [
                "duration" => 4,
                "delta-date" => 0,
                "spot" => $this->spot,
                "utc" => $this->utc,
                "lang" => $this->lang
            ]
        ]);

        $responseStatusCode = $response->getStatusCode();

        if ($responseStatusCode !== 200) {
            throw new RuntimeException("received status $responseStatusCode");
        }
        
        $this->data = $response->getBody();

        return $this;
    }

    /**
     * Return the spot.
     * 
     * @since 0.1.0
     */
    public function getSpot(): string {
        return $this->spot;
    }

    /**
     * Return the lang.
     * 
     * @since 0.1.0
     */
    public function getLang(): string {
        return $this->lang;
    }

    /**
     * Return the UTC time.
     * 
     * @since 0.1.0
     */
    public function getUtc(): int {
        return $this->utc;
    }

    /**
     * Return the file path.
     * 
     * @since 0.1.0
     */
    public function getFilePath(): string {
        return $this->filePath;
    }

    /**
     * Save the data into the desired file.
     * 
     * @throws InvalidArgumentException If the file path has not been set yet.
     * @throws InvalidArgumentException if the spot has not been set yet.
     * @since 0.1.0
     */
    public function saveData(int $timeout = 10): Shom {
        if (empty(trim($this->filePath))) {
            throw new InvalidArgumentException("expected file path to be set (use Shom::setFilePath())");
        }

        if (empty(trim($this->spot))) {
            throw new InvalidArgumentException("expected spot to be set (use Shom::setSpot())");
        }

        $this->setData($timeout);
        $this->parseData();

        return $this;
    }

    /**
     * Parse the data, and return the corresponding JSON data.
     * 
     * @since 0.1.0
     */
    protected function parseData(): Shom {
        $parsedData = new stdClass;
        $separator = "";

        if ($this->lang === static::LANG_FR) {
            $separator = "# date;profondeur;valeur;source_id;";
        }

        [ $head, $data ] = explode($separator, $this->data);

        $regularExpression = "/?/";

        if ($this->lang === static::LANG_FR) {
            /**
             * @todo preg match here
             */
        }

        return $this;
    }
}