<?php
/**
 * SourcesService
 * PHP version 5
 *
 * @category Class
 * @package  InfluxDB2
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * InfluxDB OSS API Service
 *
 * The InfluxDB v2 API provides a programmatic interface for all interactions with InfluxDB. Access the InfluxDB API using the `/api/v2/` endpoint.
 *
 * OpenAPI spec version: 2.0.0
 * 
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 3.3.4
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace InfluxDB2\Service;

use InfluxDB2\DefaultApi;
use InfluxDB2\HeaderSelector;
use InfluxDB2\ObjectSerializer;

/**
 * SourcesService Class Doc Comment
 *
 * @category Class
 * @package  InfluxDB2
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class SourcesService
{
    /**
     * @var DefaultApi
     */
    protected $defaultApi;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @param DefaultApi $defaultApi
     * @param HeaderSelector  $selector
     */
    public function __construct(DefaultApi $defaultApi)
    {
        $this->defaultApi = $defaultApi;
        $this->headerSelector = new HeaderSelector();
    }


    /**
     * Operation deleteSourcesID
     *
     * Delete a source
     *
     * @param  string $source_id The source ID. (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     *
     * @throws \InfluxDB2\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteSourcesID($source_id, $zap_trace_span = null)
    {
        $this->deleteSourcesIDWithHttpInfo($source_id, $zap_trace_span);
    }

    /**
     * Operation deleteSourcesIDWithHttpInfo
     *
     * Delete a source
     *
     * @param  string $source_id The source ID. (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     *
     * @throws \InfluxDB2\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteSourcesIDWithHttpInfo($source_id, $zap_trace_span = null)
    {
        $request = $this->deleteSourcesIDRequest($source_id, $zap_trace_span);

        $response = $this->defaultApi->sendRequest($request);

        return [null, $response->getStatusCode(), $response->getHeaders()];
    }

    /**
     * Create request for operation 'deleteSourcesID'
     *
     * @param  string $source_id The source ID. (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     *
     * @throws \InvalidArgumentException
     * @return \Psr\Http\Message\RequestInterface
     */
    protected function deleteSourcesIDRequest($source_id, $zap_trace_span = null)
    {
        // verify the required parameter 'source_id' is set
        if ($source_id === null || (is_array($source_id) && count($source_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $source_id when calling deleteSourcesID'
            );
        }

        $resourcePath = '/api/v2/sources/{sourceID}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($zap_trace_span !== null) {
            $headerParams['Zap-Trace-Span'] = ObjectSerializer::toHeaderValue($zap_trace_span);
        }

        // path params
        if ($source_id !== null) {
            $resourcePath = str_replace(
                '{' . 'sourceID' . '}',
                ObjectSerializer::toPathValue($source_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($_tempBody));
            } else {
                $httpBody = $_tempBody;
            }
        }

        $headers = array_merge(
            $headerParams,
            $headers
        );

        return $this->defaultApi->createRequest('DELETE', $resourcePath, $httpBody, $headers, $queryParams);
    }

    /**
     * Operation getSources
     *
     * List all sources
     *
     * @param  string $zap_trace_span OpenTracing span context (optional)
     * @param  string $org The name of the organization. (optional)
     *
     * @throws \InfluxDB2\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \InfluxDB2\Model\Sources|\InfluxDB2\Model\Error
     */
    public function getSources($zap_trace_span = null, $org = null)
    {
        list($response) = $this->getSourcesWithHttpInfo($zap_trace_span, $org);
        return $response;
    }

    /**
     * Operation getSourcesWithHttpInfo
     *
     * List all sources
     *
     * @param  string $zap_trace_span OpenTracing span context (optional)
     * @param  string $org The name of the organization. (optional)
     *
     * @throws \InfluxDB2\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \InfluxDB2\Model\Sources|\InfluxDB2\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function getSourcesWithHttpInfo($zap_trace_span = null, $org = null)
    {
        $request = $this->getSourcesRequest($zap_trace_span, $org);

        $response = $this->defaultApi->sendRequest($request);

        $returnType = '\InfluxDB2\Model\Sources';
        $responseBody = $response->getBody();
        if ($returnType === '\SplFileObject') {
            $content = $responseBody; //stream goes to serializer
        } else {
            $content = $responseBody->getContents();
        }

        return [
            ObjectSerializer::deserialize($content, $returnType, []),
            $response->getStatusCode(),
            $response->getHeaders()
        ];
    }

    /**
     * Create request for operation 'getSources'
     *
     * @param  string $zap_trace_span OpenTracing span context (optional)
     * @param  string $org The name of the organization. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \Psr\Http\Message\RequestInterface
     */
    protected function getSourcesRequest($zap_trace_span = null, $org = null)
    {

        $resourcePath = '/api/v2/sources';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($org !== null) {
            $queryParams['org'] = ObjectSerializer::toQueryValue($org);
        }
        // header params
        if ($zap_trace_span !== null) {
            $headerParams['Zap-Trace-Span'] = ObjectSerializer::toHeaderValue($zap_trace_span);
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($_tempBody));
            } else {
                $httpBody = $_tempBody;
            }
        }

        $headers = array_merge(
            $headerParams,
            $headers
        );

        return $this->defaultApi->createRequest('GET', $resourcePath, $httpBody, $headers, $queryParams);
    }

    /**
     * Operation getSourcesID
     *
     * Retrieve a source
     *
     * @param  string $source_id The source ID. (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     *
     * @throws \InfluxDB2\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \InfluxDB2\Model\Source|\InfluxDB2\Model\Error|\InfluxDB2\Model\Error
     */
    public function getSourcesID($source_id, $zap_trace_span = null)
    {
        list($response) = $this->getSourcesIDWithHttpInfo($source_id, $zap_trace_span);
        return $response;
    }

    /**
     * Operation getSourcesIDWithHttpInfo
     *
     * Retrieve a source
     *
     * @param  string $source_id The source ID. (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     *
     * @throws \InfluxDB2\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \InfluxDB2\Model\Source|\InfluxDB2\Model\Error|\InfluxDB2\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function getSourcesIDWithHttpInfo($source_id, $zap_trace_span = null)
    {
        $request = $this->getSourcesIDRequest($source_id, $zap_trace_span);

        $response = $this->defaultApi->sendRequest($request);

        $returnType = '\InfluxDB2\Model\Source';
        $responseBody = $response->getBody();
        if ($returnType === '\SplFileObject') {
            $content = $responseBody; //stream goes to serializer
        } else {
            $content = $responseBody->getContents();
        }

        return [
            ObjectSerializer::deserialize($content, $returnType, []),
            $response->getStatusCode(),
            $response->getHeaders()
        ];
    }

    /**
     * Create request for operation 'getSourcesID'
     *
     * @param  string $source_id The source ID. (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     *
     * @throws \InvalidArgumentException
     * @return \Psr\Http\Message\RequestInterface
     */
    protected function getSourcesIDRequest($source_id, $zap_trace_span = null)
    {
        // verify the required parameter 'source_id' is set
        if ($source_id === null || (is_array($source_id) && count($source_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $source_id when calling getSourcesID'
            );
        }

        $resourcePath = '/api/v2/sources/{sourceID}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($zap_trace_span !== null) {
            $headerParams['Zap-Trace-Span'] = ObjectSerializer::toHeaderValue($zap_trace_span);
        }

        // path params
        if ($source_id !== null) {
            $resourcePath = str_replace(
                '{' . 'sourceID' . '}',
                ObjectSerializer::toPathValue($source_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($_tempBody));
            } else {
                $httpBody = $_tempBody;
            }
        }

        $headers = array_merge(
            $headerParams,
            $headers
        );

        return $this->defaultApi->createRequest('GET', $resourcePath, $httpBody, $headers, $queryParams);
    }

    /**
     * Operation getSourcesIDBuckets
     *
     * Get buckets in a source
     *
     * @param  string $source_id The source ID. (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     * @param  string $org The name of the organization. (optional)
     *
     * @throws \InfluxDB2\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \InfluxDB2\Model\Buckets|\InfluxDB2\Model\Error|\InfluxDB2\Model\Error
     */
    public function getSourcesIDBuckets($source_id, $zap_trace_span = null, $org = null)
    {
        list($response) = $this->getSourcesIDBucketsWithHttpInfo($source_id, $zap_trace_span, $org);
        return $response;
    }

    /**
     * Operation getSourcesIDBucketsWithHttpInfo
     *
     * Get buckets in a source
     *
     * @param  string $source_id The source ID. (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     * @param  string $org The name of the organization. (optional)
     *
     * @throws \InfluxDB2\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \InfluxDB2\Model\Buckets|\InfluxDB2\Model\Error|\InfluxDB2\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function getSourcesIDBucketsWithHttpInfo($source_id, $zap_trace_span = null, $org = null)
    {
        $request = $this->getSourcesIDBucketsRequest($source_id, $zap_trace_span, $org);

        $response = $this->defaultApi->sendRequest($request);

        $returnType = '\InfluxDB2\Model\Buckets';
        $responseBody = $response->getBody();
        if ($returnType === '\SplFileObject') {
            $content = $responseBody; //stream goes to serializer
        } else {
            $content = $responseBody->getContents();
        }

        return [
            ObjectSerializer::deserialize($content, $returnType, []),
            $response->getStatusCode(),
            $response->getHeaders()
        ];
    }

    /**
     * Create request for operation 'getSourcesIDBuckets'
     *
     * @param  string $source_id The source ID. (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     * @param  string $org The name of the organization. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \Psr\Http\Message\RequestInterface
     */
    protected function getSourcesIDBucketsRequest($source_id, $zap_trace_span = null, $org = null)
    {
        // verify the required parameter 'source_id' is set
        if ($source_id === null || (is_array($source_id) && count($source_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $source_id when calling getSourcesIDBuckets'
            );
        }

        $resourcePath = '/api/v2/sources/{sourceID}/buckets';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($org !== null) {
            $queryParams['org'] = ObjectSerializer::toQueryValue($org);
        }
        // header params
        if ($zap_trace_span !== null) {
            $headerParams['Zap-Trace-Span'] = ObjectSerializer::toHeaderValue($zap_trace_span);
        }

        // path params
        if ($source_id !== null) {
            $resourcePath = str_replace(
                '{' . 'sourceID' . '}',
                ObjectSerializer::toPathValue($source_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($_tempBody));
            } else {
                $httpBody = $_tempBody;
            }
        }

        $headers = array_merge(
            $headerParams,
            $headers
        );

        return $this->defaultApi->createRequest('GET', $resourcePath, $httpBody, $headers, $queryParams);
    }

    /**
     * Operation getSourcesIDHealth
     *
     * Get the health of a source
     *
     * @param  string $source_id The source ID. (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     *
     * @throws \InfluxDB2\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \InfluxDB2\Model\HealthCheck|\InfluxDB2\Model\HealthCheck|\InfluxDB2\Model\Error
     */
    public function getSourcesIDHealth($source_id, $zap_trace_span = null)
    {
        list($response) = $this->getSourcesIDHealthWithHttpInfo($source_id, $zap_trace_span);
        return $response;
    }

    /**
     * Operation getSourcesIDHealthWithHttpInfo
     *
     * Get the health of a source
     *
     * @param  string $source_id The source ID. (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     *
     * @throws \InfluxDB2\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \InfluxDB2\Model\HealthCheck|\InfluxDB2\Model\HealthCheck|\InfluxDB2\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function getSourcesIDHealthWithHttpInfo($source_id, $zap_trace_span = null)
    {
        $request = $this->getSourcesIDHealthRequest($source_id, $zap_trace_span);

        $response = $this->defaultApi->sendRequest($request);

        $returnType = '\InfluxDB2\Model\HealthCheck';
        $responseBody = $response->getBody();
        if ($returnType === '\SplFileObject') {
            $content = $responseBody; //stream goes to serializer
        } else {
            $content = $responseBody->getContents();
        }

        return [
            ObjectSerializer::deserialize($content, $returnType, []),
            $response->getStatusCode(),
            $response->getHeaders()
        ];
    }

    /**
     * Create request for operation 'getSourcesIDHealth'
     *
     * @param  string $source_id The source ID. (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     *
     * @throws \InvalidArgumentException
     * @return \Psr\Http\Message\RequestInterface
     */
    protected function getSourcesIDHealthRequest($source_id, $zap_trace_span = null)
    {
        // verify the required parameter 'source_id' is set
        if ($source_id === null || (is_array($source_id) && count($source_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $source_id when calling getSourcesIDHealth'
            );
        }

        $resourcePath = '/api/v2/sources/{sourceID}/health';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($zap_trace_span !== null) {
            $headerParams['Zap-Trace-Span'] = ObjectSerializer::toHeaderValue($zap_trace_span);
        }

        // path params
        if ($source_id !== null) {
            $resourcePath = str_replace(
                '{' . 'sourceID' . '}',
                ObjectSerializer::toPathValue($source_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($_tempBody));
            } else {
                $httpBody = $_tempBody;
            }
        }

        $headers = array_merge(
            $headerParams,
            $headers
        );

        return $this->defaultApi->createRequest('GET', $resourcePath, $httpBody, $headers, $queryParams);
    }

    /**
     * Operation patchSourcesID
     *
     * Update a Source
     *
     * @param  string $source_id The source ID. (required)
     * @param  \InfluxDB2\Model\Source $source Source update (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     *
     * @throws \InfluxDB2\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \InfluxDB2\Model\Source|\InfluxDB2\Model\Error|\InfluxDB2\Model\Error
     */
    public function patchSourcesID($source_id, $source, $zap_trace_span = null)
    {
        list($response) = $this->patchSourcesIDWithHttpInfo($source_id, $source, $zap_trace_span);
        return $response;
    }

    /**
     * Operation patchSourcesIDWithHttpInfo
     *
     * Update a Source
     *
     * @param  string $source_id The source ID. (required)
     * @param  \InfluxDB2\Model\Source $source Source update (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     *
     * @throws \InfluxDB2\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \InfluxDB2\Model\Source|\InfluxDB2\Model\Error|\InfluxDB2\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function patchSourcesIDWithHttpInfo($source_id, $source, $zap_trace_span = null)
    {
        $request = $this->patchSourcesIDRequest($source_id, $source, $zap_trace_span);

        $response = $this->defaultApi->sendRequest($request);

        $returnType = '\InfluxDB2\Model\Source';
        $responseBody = $response->getBody();
        if ($returnType === '\SplFileObject') {
            $content = $responseBody; //stream goes to serializer
        } else {
            $content = $responseBody->getContents();
        }

        return [
            ObjectSerializer::deserialize($content, $returnType, []),
            $response->getStatusCode(),
            $response->getHeaders()
        ];
    }

    /**
     * Create request for operation 'patchSourcesID'
     *
     * @param  string $source_id The source ID. (required)
     * @param  \InfluxDB2\Model\Source $source Source update (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     *
     * @throws \InvalidArgumentException
     * @return \Psr\Http\Message\RequestInterface
     */
    protected function patchSourcesIDRequest($source_id, $source, $zap_trace_span = null)
    {
        // verify the required parameter 'source_id' is set
        if ($source_id === null || (is_array($source_id) && count($source_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $source_id when calling patchSourcesID'
            );
        }
        // verify the required parameter 'source' is set
        if ($source === null || (is_array($source) && count($source) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $source when calling patchSourcesID'
            );
        }

        $resourcePath = '/api/v2/sources/{sourceID}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($zap_trace_span !== null) {
            $headerParams['Zap-Trace-Span'] = ObjectSerializer::toHeaderValue($zap_trace_span);
        }

        // path params
        if ($source_id !== null) {
            $resourcePath = str_replace(
                '{' . 'sourceID' . '}',
                ObjectSerializer::toPathValue($source_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;
        if (isset($source)) {
            $_tempBody = $source;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($_tempBody));
            } else {
                $httpBody = $_tempBody;
            }
        }

        $headers = array_merge(
            $headerParams,
            $headers
        );

        return $this->defaultApi->createRequest('PATCH', $resourcePath, $httpBody, $headers, $queryParams);
    }

    /**
     * Operation postSources
     *
     * Create a source
     *
     * @param  \InfluxDB2\Model\Source $source Source to create (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     *
     * @throws \InfluxDB2\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \InfluxDB2\Model\Source|\InfluxDB2\Model\Error
     */
    public function postSources($source, $zap_trace_span = null)
    {
        list($response) = $this->postSourcesWithHttpInfo($source, $zap_trace_span);
        return $response;
    }

    /**
     * Operation postSourcesWithHttpInfo
     *
     * Create a source
     *
     * @param  \InfluxDB2\Model\Source $source Source to create (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     *
     * @throws \InfluxDB2\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \InfluxDB2\Model\Source|\InfluxDB2\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function postSourcesWithHttpInfo($source, $zap_trace_span = null)
    {
        $request = $this->postSourcesRequest($source, $zap_trace_span);

        $response = $this->defaultApi->sendRequest($request);

        $returnType = '\InfluxDB2\Model\Source';
        $responseBody = $response->getBody();
        if ($returnType === '\SplFileObject') {
            $content = $responseBody; //stream goes to serializer
        } else {
            $content = $responseBody->getContents();
        }

        return [
            ObjectSerializer::deserialize($content, $returnType, []),
            $response->getStatusCode(),
            $response->getHeaders()
        ];
    }

    /**
     * Create request for operation 'postSources'
     *
     * @param  \InfluxDB2\Model\Source $source Source to create (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     *
     * @throws \InvalidArgumentException
     * @return \Psr\Http\Message\RequestInterface
     */
    protected function postSourcesRequest($source, $zap_trace_span = null)
    {
        // verify the required parameter 'source' is set
        if ($source === null || (is_array($source) && count($source) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $source when calling postSources'
            );
        }

        $resourcePath = '/api/v2/sources';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($zap_trace_span !== null) {
            $headerParams['Zap-Trace-Span'] = ObjectSerializer::toHeaderValue($zap_trace_span);
        }


        // body params
        $_tempBody = null;
        if (isset($source)) {
            $_tempBody = $source;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($_tempBody));
            } else {
                $httpBody = $_tempBody;
            }
        }

        $headers = array_merge(
            $headerParams,
            $headers
        );

        return $this->defaultApi->createRequest('POST', $resourcePath, $httpBody, $headers, $queryParams);
    }

}
