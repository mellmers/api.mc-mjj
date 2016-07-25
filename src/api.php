<?php

/**
 * @SWG\Swagger(
 *     basePath="/api",
 *     host="127.0.0.1",
 *     schemes={"http"},
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="Project-X",
 *         @SWG\Contact(name="wordnik api team", url="http://developer.wordnik.com"),
 *         @SWG\License(name="Creative Commons 4.0 International", url="http://creativecommons.org/licenses/by/4.0/")
 *     ),
 *     @SWG\Definition(
 *         definition="Error",
 *         required={"code", "message"},
 *         @SWG\Property(
 *             property="code",
 *             type="integer",
 *             format="int32"
 *         ),
 *         @SWG\Property(
 *             property="message",
 *             type="string"
 *         )
 *     )
 * )
 */
