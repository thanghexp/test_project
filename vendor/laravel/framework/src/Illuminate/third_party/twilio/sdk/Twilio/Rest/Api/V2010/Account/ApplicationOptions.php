<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account;

use Twilio\Options;
use Twilio\Values;

abstract class ApplicationOptions {
    /**
     * @param string $apiVersion The API version to use
     * @param string $voiceUrl URL Twilio will make requests to when relieving a
     *                         call
     * @param string $voiceMethod HTTP method to use with the URL
     * @param string $voiceFallbackUrl Fallback URL
     * @param string $voiceFallbackMethod HTTP method to use with the fallback url
     * @param string $statusCallback URL to hit with status updates
     * @param string $statusCallbackMethod HTTP method to use with the status
     *                                     callback
     * @param string $voiceCallerIdLookup True or False
     * @param string $smsUrl URL Twilio will request when receiving an SMS
     * @param string $smsMethod HTTP method to use with sms_url
     * @param string $smsFallbackUrl Fallback URL if there's an error parsing TwiML
     * @param string $smsFallbackMethod HTTP method to use with sms_fallback_method
     * @param string $smsStatusCallback URL Twilio with request with status updates
     * @param string $messageStatusCallback URL to make requests to with status
     *                                      updates
     * @return CreateApplicationOptions Options builder
     */
    public static function create($apiVersion = Values::NONE, $voiceUrl = Values::NONE, $voiceMethod = Values::NONE, $voiceFallbackUrl = Values::NONE, $voiceFallbackMethod = Values::NONE, $statusCallback = Values::NONE, $statusCallbackMethod = Values::NONE, $voiceCallerIdLookup = Values::NONE, $smsUrl = Values::NONE, $smsMethod = Values::NONE, $smsFallbackUrl = Values::NONE, $smsFallbackMethod = Values::NONE, $smsStatusCallback = Values::NONE, $messageStatusCallback = Values::NONE) {
        return new CreateApplicationOptions($apiVersion, $voiceUrl, $voiceMethod, $voiceFallbackUrl, $voiceFallbackMethod, $statusCallback, $statusCallbackMethod, $voiceCallerIdLookup, $smsUrl, $smsMethod, $smsFallbackUrl, $smsFallbackMethod, $smsStatusCallback, $messageStatusCallback);
    }

    /**
     * @param string $friendlyName Filter by friendly name
     * @return ReadApplicationOptions Options builder
     */
    public static function read($friendlyName = Values::NONE) {
        return new ReadApplicationOptions($friendlyName);
    }

    /**
     * @param string $friendlyName Human readable description of this resource
     * @param string $apiVersion The API version to use
     * @param string $voiceUrl URL Twilio will make requests to when relieving a
     *                         call
     * @param string $voiceMethod HTTP method to use with the URL
     * @param string $voiceFallbackUrl Fallback URL
     * @param string $voiceFallbackMethod HTTP method to use with the fallback url
     * @param string $statusCallback URL to hit with status updates
     * @param string $statusCallbackMethod HTTP method to use with the status
     *                                     callback
     * @param string $voiceCallerIdLookup True or False
     * @param string $smsUrl URL Twilio will request when receiving an SMS
     * @param string $smsMethod HTTP method to use with sms_url
     * @param string $smsFallbackUrl Fallback URL if there's an error parsing TwiML
     * @param string $smsFallbackMethod HTTP method to use with sms_fallback_method
     * @param string $smsStatusCallback URL Twilio with request with status updates
     * @param string $messageStatusCallback URL to make requests to with status
     *                                      updates
     * @return UpdateApplicationOptions Options builder
     */
    public static function update($friendlyName = Values::NONE, $apiVersion = Values::NONE, $voiceUrl = Values::NONE, $voiceMethod = Values::NONE, $voiceFallbackUrl = Values::NONE, $voiceFallbackMethod = Values::NONE, $statusCallback = Values::NONE, $statusCallbackMethod = Values::NONE, $voiceCallerIdLookup = Values::NONE, $smsUrl = Values::NONE, $smsMethod = Values::NONE, $smsFallbackUrl = Values::NONE, $smsFallbackMethod = Values::NONE, $smsStatusCallback = Values::NONE, $messageStatusCallback = Values::NONE) {
        return new UpdateApplicationOptions($friendlyName, $apiVersion, $voiceUrl, $voiceMethod, $voiceFallbackUrl, $voiceFallbackMethod, $statusCallback, $statusCallbackMethod, $voiceCallerIdLookup, $smsUrl, $smsMethod, $smsFallbackUrl, $smsFallbackMethod, $smsStatusCallback, $messageStatusCallback);
    }
}

class CreateApplicationOptions extends Options {
    /**
     * @param string $apiVersion The API version to use
     * @param string $voiceUrl URL Twilio will make requests to when relieving a
     *                         call
     * @param string $voiceMethod HTTP method to use with the URL
     * @param string $voiceFallbackUrl Fallback URL
     * @param string $voiceFallbackMethod HTTP method to use with the fallback url
     * @param string $statusCallback URL to hit with status updates
     * @param string $statusCallbackMethod HTTP method to use with the status
     *                                     callback
     * @param string $voiceCallerIdLookup True or False
     * @param string $smsUrl URL Twilio will request when receiving an SMS
     * @param string $smsMethod HTTP method to use with sms_url
     * @param string $smsFallbackUrl Fallback URL if there's an error parsing TwiML
     * @param string $smsFallbackMethod HTTP method to use with sms_fallback_method
     * @param string $smsStatusCallback URL Twilio with request with status updates
     * @param string $messageStatusCallback URL to make requests to with status
     *                                      updates
     */
    public function __construct($apiVersion = Values::NONE, $voiceUrl = Values::NONE, $voiceMethod = Values::NONE, $voiceFallbackUrl = Values::NONE, $voiceFallbackMethod = Values::NONE, $statusCallback = Values::NONE, $statusCallbackMethod = Values::NONE, $voiceCallerIdLookup = Values::NONE, $smsUrl = Values::NONE, $smsMethod = Values::NONE, $smsFallbackUrl = Values::NONE, $smsFallbackMethod = Values::NONE, $smsStatusCallback = Values::NONE, $messageStatusCallback = Values::NONE) {
        $this->options['apiVersion'] = $apiVersion;
        $this->options['voiceUrl'] = $voiceUrl;
        $this->options['voiceMethod'] = $voiceMethod;
        $this->options['voiceFallbackUrl'] = $voiceFallbackUrl;
        $this->options['voiceFallbackMethod'] = $voiceFallbackMethod;
        $this->options['statusCallback'] = $statusCallback;
        $this->options['statusCallbackMethod'] = $statusCallbackMethod;
        $this->options['voiceCallerIdLookup'] = $voiceCallerIdLookup;
        $this->options['smsUrl'] = $smsUrl;
        $this->options['smsMethod'] = $smsMethod;
        $this->options['smsFallbackUrl'] = $smsFallbackUrl;
        $this->options['smsFallbackMethod'] = $smsFallbackMethod;
        $this->options['smsStatusCallback'] = $smsStatusCallback;
        $this->options['messageStatusCallback'] = $messageStatusCallback;
    }

    /**
     * Requests to this application will start a new TwiML session with this API version.
     * 
     * @param string $apiVersion The API version to use
     * @return $this Fluent Builder
     */
    public function setApiVersion($apiVersion) {
        $this->options['apiVersion'] = $apiVersion;
        return $this;
    }

    /**
     * The URL Twilio will request when a phone number assigned to this application receives a call.
     * 
     * @param string $voiceUrl URL Twilio will make requests to when relieving a
     *                         call
     * @return $this Fluent Builder
     */
    public function setVoiceUrl($voiceUrl) {
        $this->options['voiceUrl'] = $voiceUrl;
        return $this;
    }

    /**
     * The HTTP method Twilio will use when requesting the above `Url`. Either `GET` or `POST`.
     * 
     * @param string $voiceMethod HTTP method to use with the URL
     * @return $this Fluent Builder
     */
    public function setVoiceMethod($voiceMethod) {
        $this->options['voiceMethod'] = $voiceMethod;
        return $this;
    }

    /**
     * The URL that Twilio will request if an error occurs retrieving or executing the TwiML requested by `Url`.
     * 
     * @param string $voiceFallbackUrl Fallback URL
     * @return $this Fluent Builder
     */
    public function setVoiceFallbackUrl($voiceFallbackUrl) {
        $this->options['voiceFallbackUrl'] = $voiceFallbackUrl;
        return $this;
    }

    /**
     * The HTTP method Twilio will use when requesting the `VoiceFallbackUrl`. Either `GET` or `POST`.
     * 
     * @param string $voiceFallbackMethod HTTP method to use with the fallback url
     * @return $this Fluent Builder
     */
    public function setVoiceFallbackMethod($voiceFallbackMethod) {
        $this->options['voiceFallbackMethod'] = $voiceFallbackMethod;
        return $this;
    }

    /**
     * The URL that Twilio will request to pass status parameters (such as call ended) to your application.
     * 
     * @param string $statusCallback URL to hit with status updates
     * @return $this Fluent Builder
     */
    public function setStatusCallback($statusCallback) {
        $this->options['statusCallback'] = $statusCallback;
        return $this;
    }

    /**
     * The HTTP method Twilio will use to make requests to the `StatusCallback` URL. Either `GET` or `POST`.
     * 
     * @param string $statusCallbackMethod HTTP method to use with the status
     *                                     callback
     * @return $this Fluent Builder
     */
    public function setStatusCallbackMethod($statusCallbackMethod) {
        $this->options['statusCallbackMethod'] = $statusCallbackMethod;
        return $this;
    }

    /**
     * Look up the caller's caller-ID name from the CNAM database (additional charges apply). Either `true` or `false`.
     * 
     * @param string $voiceCallerIdLookup True or False
     * @return $this Fluent Builder
     */
    public function setVoiceCallerIdLookup($voiceCallerIdLookup) {
        $this->options['voiceCallerIdLookup'] = $voiceCallerIdLookup;
        return $this;
    }

    /**
     * The URL Twilio will request when a phone number assigned to this application receives an incoming SMS message.
     * 
     * @param string $smsUrl URL Twilio will request when receiving an SMS
     * @return $this Fluent Builder
     */
    public function setSmsUrl($smsUrl) {
        $this->options['smsUrl'] = $smsUrl;
        return $this;
    }

    /**
     * The HTTP method Twilio will use when making requests to the `SmsUrl`. Either `GET` or `POST`.
     * 
     * @param string $smsMethod HTTP method to use with sms_url
     * @return $this Fluent Builder
     */
    public function setSmsMethod($smsMethod) {
        $this->options['smsMethod'] = $smsMethod;
        return $this;
    }

    /**
     * The URL that Twilio will request if an error occurs retrieving or executing the TwiML from `SmsUrl`.
     * 
     * @param string $smsFallbackUrl Fallback URL if there's an error parsing TwiML
     * @return $this Fluent Builder
     */
    public function setSmsFallbackUrl($smsFallbackUrl) {
        $this->options['smsFallbackUrl'] = $smsFallbackUrl;
        return $this;
    }

    /**
     * The HTTP method Twilio will use when requesting the above URL. Either `GET` or `POST`.
     * 
     * @param string $smsFallbackMethod HTTP method to use with sms_fallback_method
     * @return $this Fluent Builder
     */
    public function setSmsFallbackMethod($smsFallbackMethod) {
        $this->options['smsFallbackMethod'] = $smsFallbackMethod;
        return $this;
    }

    /**
     * The URL that Twilio will `POST` to when a message is sent via the `/SMS/Messages` endpoint if you specify the `Sid` of this application on an outgoing SMS request.
     * 
     * @param string $smsStatusCallback URL Twilio with request with status updates
     * @return $this Fluent Builder
     */
    public function setSmsStatusCallback($smsStatusCallback) {
        $this->options['smsStatusCallback'] = $smsStatusCallback;
        return $this;
    }

    /**
     * Twilio will make a `POST` request to this URL to pass status parameters (such as sent or failed) to your application if you use the `/Messages` endpoint to send the message and specify this application's `Sid` as the `ApplicationSid` on an outgoing SMS request.
     * 
     * @param string $messageStatusCallback URL to make requests to with status
     *                                      updates
     * @return $this Fluent Builder
     */
    public function setMessageStatusCallback($messageStatusCallback) {
        $this->options['messageStatusCallback'] = $messageStatusCallback;
        return $this;
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Api.V2010.CreateApplicationOptions ' . implode(' ', $options) . ']';
    }
}

class ReadApplicationOptions extends Options {
    /**
     * @param string $friendlyName Filter by friendly name
     */
    public function __construct($friendlyName = Values::NONE) {
        $this->options['friendlyName'] = $friendlyName;
    }

    /**
     * Only return application resources with friendly names that match exactly with this name
     * 
     * @param string $friendlyName Filter by friendly name
     * @return $this Fluent Builder
     */
    public function setFriendlyName($friendlyName) {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Api.V2010.ReadApplicationOptions ' . implode(' ', $options) . ']';
    }
}

class UpdateApplicationOptions extends Options {
    /**
     * @param string $friendlyName Human readable description of this resource
     * @param string $apiVersion The API version to use
     * @param string $voiceUrl URL Twilio will make requests to when relieving a
     *                         call
     * @param string $voiceMethod HTTP method to use with the URL
     * @param string $voiceFallbackUrl Fallback URL
     * @param string $voiceFallbackMethod HTTP method to use with the fallback url
     * @param string $statusCallback URL to hit with status updates
     * @param string $statusCallbackMethod HTTP method to use with the status
     *                                     callback
     * @param string $voiceCallerIdLookup True or False
     * @param string $smsUrl URL Twilio will request when receiving an SMS
     * @param string $smsMethod HTTP method to use with sms_url
     * @param string $smsFallbackUrl Fallback URL if there's an error parsing TwiML
     * @param string $smsFallbackMethod HTTP method to use with sms_fallback_method
     * @param string $smsStatusCallback URL Twilio with request with status updates
     * @param string $messageStatusCallback URL to make requests to with status
     *                                      updates
     */
    public function __construct($friendlyName = Values::NONE, $apiVersion = Values::NONE, $voiceUrl = Values::NONE, $voiceMethod = Values::NONE, $voiceFallbackUrl = Values::NONE, $voiceFallbackMethod = Values::NONE, $statusCallback = Values::NONE, $statusCallbackMethod = Values::NONE, $voiceCallerIdLookup = Values::NONE, $smsUrl = Values::NONE, $smsMethod = Values::NONE, $smsFallbackUrl = Values::NONE, $smsFallbackMethod = Values::NONE, $smsStatusCallback = Values::NONE, $messageStatusCallback = Values::NONE) {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['apiVersion'] = $apiVersion;
        $this->options['voiceUrl'] = $voiceUrl;
        $this->options['voiceMethod'] = $voiceMethod;
        $this->options['voiceFallbackUrl'] = $voiceFallbackUrl;
        $this->options['voiceFallbackMethod'] = $voiceFallbackMethod;
        $this->options['statusCallback'] = $statusCallback;
        $this->options['statusCallbackMethod'] = $statusCallbackMethod;
        $this->options['voiceCallerIdLookup'] = $voiceCallerIdLookup;
        $this->options['smsUrl'] = $smsUrl;
        $this->options['smsMethod'] = $smsMethod;
        $this->options['smsFallbackUrl'] = $smsFallbackUrl;
        $this->options['smsFallbackMethod'] = $smsFallbackMethod;
        $this->options['smsStatusCallback'] = $smsStatusCallback;
        $this->options['messageStatusCallback'] = $messageStatusCallback;
    }

    /**
     * A human readable descriptive text for this resource, up to 64 characters long.
     * 
     * @param string $friendlyName Human readable description of this resource
     * @return $this Fluent Builder
     */
    public function setFriendlyName($friendlyName) {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * Requests to this application will start a new TwiML session with this API version.
     * 
     * @param string $apiVersion The API version to use
     * @return $this Fluent Builder
     */
    public function setApiVersion($apiVersion) {
        $this->options['apiVersion'] = $apiVersion;
        return $this;
    }

    /**
     * The URL Twilio will request when a phone number assigned to this application receives a call.
     * 
     * @param string $voiceUrl URL Twilio will make requests to when relieving a
     *                         call
     * @return $this Fluent Builder
     */
    public function setVoiceUrl($voiceUrl) {
        $this->options['voiceUrl'] = $voiceUrl;
        return $this;
    }

    /**
     * The HTTP method Twilio will use when requesting the above `Url`. Either `GET` or `POST`.
     * 
     * @param string $voiceMethod HTTP method to use with the URL
     * @return $this Fluent Builder
     */
    public function setVoiceMethod($voiceMethod) {
        $this->options['voiceMethod'] = $voiceMethod;
        return $this;
    }

    /**
     * The URL that Twilio will request if an error occurs retrieving or executing the TwiML requested by `Url`.
     * 
     * @param string $voiceFallbackUrl Fallback URL
     * @return $this Fluent Builder
     */
    public function setVoiceFallbackUrl($voiceFallbackUrl) {
        $this->options['voiceFallbackUrl'] = $voiceFallbackUrl;
        return $this;
    }

    /**
     * The HTTP method Twilio will use when requesting the `VoiceFallbackUrl`. Either `GET` or `POST`.
     * 
     * @param string $voiceFallbackMethod HTTP method to use with the fallback url
     * @return $this Fluent Builder
     */
    public function setVoiceFallbackMethod($voiceFallbackMethod) {
        $this->options['voiceFallbackMethod'] = $voiceFallbackMethod;
        return $this;
    }

    /**
     * The URL that Twilio will request to pass status parameters (such as call ended) to your application.
     * 
     * @param string $statusCallback URL to hit with status updates
     * @return $this Fluent Builder
     */
    public function setStatusCallback($statusCallback) {
        $this->options['statusCallback'] = $statusCallback;
        return $this;
    }

    /**
     * The HTTP method Twilio will use to make requests to the `StatusCallback` URL. Either `GET` or `POST`.
     * 
     * @param string $statusCallbackMethod HTTP method to use with the status
     *                                     callback
     * @return $this Fluent Builder
     */
    public function setStatusCallbackMethod($statusCallbackMethod) {
        $this->options['statusCallbackMethod'] = $statusCallbackMethod;
        return $this;
    }

    /**
     * Look up the caller's caller-ID name from the CNAM database (additional charges apply). Either `true` or `false`.
     * 
     * @param string $voiceCallerIdLookup True or False
     * @return $this Fluent Builder
     */
    public function setVoiceCallerIdLookup($voiceCallerIdLookup) {
        $this->options['voiceCallerIdLookup'] = $voiceCallerIdLookup;
        return $this;
    }

    /**
     * The URL Twilio will request when a phone number assigned to this application receives an incoming SMS message.
     * 
     * @param string $smsUrl URL Twilio will request when receiving an SMS
     * @return $this Fluent Builder
     */
    public function setSmsUrl($smsUrl) {
        $this->options['smsUrl'] = $smsUrl;
        return $this;
    }

    /**
     * The HTTP method Twilio will use when making requests to the `SmsUrl`. Either `GET` or `POST`.
     * 
     * @param string $smsMethod HTTP method to use with sms_url
     * @return $this Fluent Builder
     */
    public function setSmsMethod($smsMethod) {
        $this->options['smsMethod'] = $smsMethod;
        return $this;
    }

    /**
     * The URL that Twilio will request if an error occurs retrieving or executing the TwiML from `SmsUrl`.
     * 
     * @param string $smsFallbackUrl Fallback URL if there's an error parsing TwiML
     * @return $this Fluent Builder
     */
    public function setSmsFallbackUrl($smsFallbackUrl) {
        $this->options['smsFallbackUrl'] = $smsFallbackUrl;
        return $this;
    }

    /**
     * The HTTP method Twilio will use when requesting the above URL. Either `GET` or `POST`.
     * 
     * @param string $smsFallbackMethod HTTP method to use with sms_fallback_method
     * @return $this Fluent Builder
     */
    public function setSmsFallbackMethod($smsFallbackMethod) {
        $this->options['smsFallbackMethod'] = $smsFallbackMethod;
        return $this;
    }

    /**
     * The URL that Twilio will `POST` to when a message is sent via the `/SMS/Messages` endpoint if you specify the `Sid` of this application on an outgoing SMS request.
     * 
     * @param string $smsStatusCallback URL Twilio with request with status updates
     * @return $this Fluent Builder
     */
    public function setSmsStatusCallback($smsStatusCallback) {
        $this->options['smsStatusCallback'] = $smsStatusCallback;
        return $this;
    }

    /**
     * Twilio will make a `POST` request to this URL to pass status parameters (such as sent or failed) to your application if you use the `/Messages` endpoint to send the message and specify this application's `Sid` as the `ApplicationSid` on an outgoing SMS request.
     * 
     * @param string $messageStatusCallback URL to make requests to with status
     *                                      updates
     * @return $this Fluent Builder
     */
    public function setMessageStatusCallback($messageStatusCallback) {
        $this->options['messageStatusCallback'] = $messageStatusCallback;
        return $this;
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Api.V2010.UpdateApplicationOptions ' . implode(' ', $options) . ']';
    }
}