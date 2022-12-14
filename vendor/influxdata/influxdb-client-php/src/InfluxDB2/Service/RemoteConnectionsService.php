<?php
/**
 * RemoteConnectionsService
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
 * RemoteConnectionsService Class Doc Comment
 *
 * @category Class
 * @package  InfluxDB2
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class RemoteConnectionsService
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
     * Operation deleteRemoteConnectionByID
     *
     * Delete a remote connection
     *
     * @param  string $remote_id remote_id (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     *
     * @throws \InfluxDB2\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteRemoteConnectionByID($remote_id, $zap_trace_span = null)
    {
        $this->deleteRemoteConnectionByIDWithHttpInfo($remote_id, $zap_trace_span);
    }

    /**
     * Operation deleteRemoteConnectionByIDWithHttpInfo
     *
     * Delete a remote connection
     *
     * @param  string $remote_id (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     *
     * @throws \InfluxDB2\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteRemoteConnectionByIDWithHttpInfo($remote_id, $zap_trace_span = null)
    {
        $request = $this->deleteRemoteConnectionByIDRequest($remote_id, $zap_trace_span);

        $response = $this->defaultApi->sendRequest($request);

        return [null, $response->getStatusCode(), $response->getHeaders()];
    }

    /**
     * Create request for operation 'deleteRemoteConnectionByID'
     *
     * @param  string $remote_id (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     *
     * @throws \InvalidArgumentException
     * @return \Psr\Http\Message\RequestInterface
     */
    protected function deleteRemoteConnectionByIDRequest($remote_id, $zap_trace_span = null)
    {
        // verify the required parameter 'remote_id' is set
        if ($remote_id === null || (is_array($remote_id) && count($remote_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $remote_id when calling deleteRemoteConnectionByID'
            );
        }

        $resourcePath = '/api/v2/remotes/{remoteID}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($zap_trace_span !== null) {
            $headerParams['Zap-Trace-Span'] = ObjectSerializer::toHeaderValue($zap_trace_span);
        }

        // path params
        if ($remote_id !== null) {
            $resourcePath = str_replace(
                '{' . 'remoteID' . '}',
                ObjectSerializer::toPathValue($remote_id),
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
     * Operation getRemoteConnectionByID
     *
     * Retrieve a remote connection
     *
     * @param  string $remote_id remote_id (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     *
     * @throws \InfluxDB2\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \InfluxDB2\Model\RemoteConnection|string|string
     */
    public function getRemoteConnectionByID($remote_id, $zap_trace_span = null)
    {
        list($response) = $this->getRemoteConnectionByIDWithHttpInfo($remote_id, $zap_trace_span);
        return $response;
    }

    /**
     * Operation getRemoteConnectionByIDWithHttpInfo
     *
     * Retrieve a remote connection
     *
     * @param  string $remote_id (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     *
     * @throws \InfluxDB2\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \InfluxDB2\Model\RemoteConnection|string|string, HTTP status code, HTTP response headers (array of strings)
     */
    public function getRemoteConnectionByIDWithHttpInfo($remote_id, $zap_trace_span = null)
    {
        $request = $this->getRemoteConnectionByIDRequest($remote_id, $zap_trace_span);

        $response = $this->defaultApi->sendRequest($request);

        $returnType = '\InfluxDB2\Model\RemoteConnection';
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
     * Create request for operation 'getRemoteConnectionByID'
     *
     * @param  string $remote_id (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     *
     * @throws \InvalidArgumentException
     * @return \Psr\Http\Message\RequestInterface
     */
    protected function getRemoteConnectionByIDRequest($remote_id, $zap_trace_span = null)
    {
        // verify the required parameter 'remote_id' is set
        if ($remote_id === null || (is_array($remote_id) && count($remote_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $remote_id when calling getRemoteConnectionByID'
            );
        }

        $resourcePath = '/api/v2/remotes/{remoteID}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($zap_trace_span !== null) {
            $headerParams['Zap-Trace-Span'] = ObjectSerializer::toHeaderValue($zap_trace_span);
        }

        // path params
        if ($remote_id !== null) {
            $resourcePath = str_replace(
                '{' . 'remoteID' . '}',
                ObjectSerializer::toPathValue($remote_id),
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
     * Operation getRemoteConnections
     *
     * List all remote connections
     *
     * @param  string $org_id The organization ID. (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     * @param  string $name name (optional)
     * @param  string $remote_url remote_url (optional)
     *
     * @throws \InfluxDB2\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \InfluxDB2\Model\RemoteConnections|string|string
     */
    public function getRemoteConnections($org_id, $zap_trace_span = null, $name = null, $remote_url = null)
    {
        list($response) = $this->getRemoteConnectionsWithHttpInfo($org_id, $zap_trace_span, $name, $remote_url);
        return $response;
    }

    /**
     * Operation getRemoteConnectionsWithHttpInfo
     *
     * List all remote connections
     *
     * @param  string $org_id The organization ID. (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     * @param  string $name (optional)
     * @param  string $remote_url (optional)
     *
     * @throws \InfluxDB2\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \InfluxDB2\Model\RemoteConnections|string|string, HTTP status code, HTTP response headers (array of strings)
     */
    public function getRemoteConnectionsWithHttpInfo($org_id, $zap_trace_span = null, $name = null, $remote_url = null)
    {
        $request = $this->getRemoteConnectionsRequest($org_id, $zap_trace_span, $name, $remote_url);

        $response = $this->defaultApi->sendRequest($request);

        $returnType = '\InfluxDB2\Model\RemoteConnections';
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
     * Create request for operation 'getRemoteConnections'
     *
     * @param  string $org_id The organization ID. (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     * @param  string $name (optional)
     * @param  string $remote_url (optional)
     *
     * @throws \InvalidArgumentException
     * @return \Psr\Http\Message\RequestInterface
     */
    protected function getRemoteConnectionsRequest($org_id, $zap_trace_span = null, $name = null, $remote_url = null)
    {
        // verify the required parameter 'org_id' is set
        if ($org_id === null || (is_array($org_id) && count($org_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $org_id when calling getRemoteConnections'
            );
        }

        $resourcePath = '/api/v2/remotes';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($org_id !== null) {
            $queryParams['orgID'] = ObjectSerializer::toQueryValue($org_id);
        }
        // query params
        if ($name !== null) {
            $queryParams['name'] = ObjectSerializer::toQueryValue($name);
        }
        // query params
        if ($remote_url !== null) {
            $queryParams['remoteURL'] = ObjectSerializer::toQueryValue($remote_url);
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
     * Operation patchRemoteConnectionByID
     *
     * Update a remote connection
     *
     * @param  string $remote_id remote_id (required)
     * @param  \InfluxDB2\Model\RemoteConnectionUpdateRequest $remote_connection_update_request remote_connection_update_request (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     *
     * @throws \InfluxDB2\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \InfluxDB2\Model\RemoteConnection|string|string|string
     */
    public function patchRemoteConnectionByID($remote_id, $remote_connection_update_request, $zap_trace_span = null)
    {
        list($response) = $this->patchRemoteConnectionByIDWithHttpInfo($remote_id, $remote_connection_update_request, $zap_trace_span);
        return $response;
    }

    /**
     * Operation patchRemoteConnectionByIDWithHttpInfo
     *
     * Update a remote connection
     *
     * @param  string $remote_id (required)
     * @param  \InfluxDB2\Model\RemoteConnectionUpdateRequest $remote_connection_update_request (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     *
     * @throws \InfluxDB2\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \InfluxDB2\Model\RemoteConnection|string|string|string, HTTP status code, HTTP response headers (array of strings)
     */
    public function patchRemoteConnectionByIDWithHttpInfo($remote_id, $remote_connection_update_request, $zap_trace_span = null)
    {
        $request = $this->patchRemoteConnectionByIDRequest($remote_id, $remote_connection_update_request, $zap_trace_span);

        $response = $this->defaultApi->sendRequest($request);

        $returnType = '\InfluxDB2\Model\RemoteConnection';
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
     * Create request for operation 'patchRemoteConnectionByID'
     *
     * @param  string $remote_id (required)
     * @param  \InfluxDB2\Model\RemoteConnectionUpdateRequest $remote_connection_update_request (required)
     * @param  string $zap_trace_span OpenTracing span context (optional)
     *
     * @throws \InvalidArgumentException
     * @return \Psr\Http\Message\RequestInterface
     */
    protected function patchRemoteConnectionByIDRequest($remote_id, $remote_connection_update_request, $zap_trace_span = null)
    {
        // verify the required parameter 'remote_id' is set
        if ($remote_id === null || (is_array($remote_id) && count($remote_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $remote_id when calling patchRemoteConnectionByID'
            );
        }
        // verify the required parameter 'remote_connection_update_request' is set
        if ($remote_connection_update_request === null || (is_array($remote_connection_update_request) && count($remote_connection_update_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $remote_connection_update_request when calling patchRemoteConnectionByID'
            );
        }

        $resourcePath = '/api/v2/remotes/{remoteID}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($zap_trace_span !== null) {
            $headerParams['Zap-Trace-Span'] = ObjectSerializer::toHeaderValue($zap_trace_span);
        }

        // path params
        if ($remote_id !== null) {
            $resourcePath = str_replace(
                '{' . 'remoteID' . '}',
                ObjectSerializer::toPathValue($remote_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;
        if (isset($remote_connection_update_request)) {
            $_tempBody = $remote_connection_update_request;
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
     * Operation postRemoteConnection
     *
     * Register a new remote connection
     *
     * @param  \InfluxDB2\Model\RemoteConnectionCreationRequest $remote_connection_creation_request remote_connection_creation_request (required)
     *
     * @throws \InfluxDB2\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \InfluxDB2\Model\RemoteConnection|string|string
     */
    public function postRemoteConnection($remote_connection_creation_request)
    {
        list($response) = $this->postRemoteConnectionWithHttpInfo($remote_connection_creation_request);
        return $response;
    }

    /**
     * Operation postRemoteConnectionWithHttpInfo
     *
     * Register a new remote connection
     *
     * @param  \InfluxDB2\Model\RemoteConnectionCreationRequest $remote_connection_creation_request (required)
     *
     * @throws \InfluxDB2\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \InfluxDB2\Model\RemoteConnection|string|string, HTTP status code, HTTP response headers (array of strings)
     */
    public function postRemoteConnectionWithHttpInfo($remote_connection_creation_request)
    {
        $request = $this->postRemoteConnectionRequest($remote_connection_creation_request);

        $response = $this->defaultApi->sendRequest($request);

        $returnType = '\InfluxDB2\Model\RemoteConnection';
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
     * Create request for operation 'postRemoteConnection'
     *
     * @param  \InfluxDB2\Model\RemoteConnectionCreationRequest $remote_connection_creation_request (required)
     *
     * @throws \InvalidArgumentException
     * @return \Psr\Http\Message\RequestInterface
     */
    protected function postRemoteConnectionRequest($remote_connection_creation_request)
    {
        // verify the required parameter 'remote_connection_creation_request' is set
        if ($remote_connection_creation_request === null || (is_array($remote_connection_creation_request) && count($remote_connection_creation_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $remote_connection_creation_request when calling postRemoteConnection'
            );
        }

        $resourcePath = '/api/v2/remotes';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // body params
        $_tempBody = null;
        if (isset($remote_connection_creation_request)) {
            $_tempBody = $remote_connection_creation_request;
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
