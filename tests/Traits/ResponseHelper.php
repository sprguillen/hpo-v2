<?php

namespace Tests\Traits;

/**
 * Response helper traits for getting data from response
 *
 * @author goper
 */
trait ResponseHelper {

    /**
     * Get response body on `GET` request
     *
     * @param  [type] $response [description]
     * @return [type]           [description]
     */
    public function getResponseData($response)
    {
        return $response->getOriginalContent()->getData();
    }

    /**
     * Get reponse on POST request
     *
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public function getPostResponse($response)
    {
        return json_decode($response->getContent());
    }

    /**
     * Test response data if pagination or not
     *
     * @author goper
     * @param  object $data
     * @return void
     */
    public function paginationTest($data)
    {
        $this->assertObjectHasAttribute('current_page', $data);
        $this->assertObjectHasAttribute('first_page_url', $data);
        $this->assertObjectHasAttribute('total', $data);
        $this->assertTrue(is_array($data->data));

    }
}
