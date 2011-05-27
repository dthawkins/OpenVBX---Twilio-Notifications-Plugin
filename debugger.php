<?php

$ci = &get_instance();
require_once( APPPATH . 'libraries/twilio.php');

$debug = 0;

Function GetNotifications( $ci, $params) {

        if ( empty($params) ) {
                return FALSE;
        }
        
        # init connection
        $ci->twilio = new TwilioRestClient(
                $ci->twilio_sid,
                $ci->twilio_token,
                $ci->twilio_endpoint);
        # send request
        $res = $ci->twilio->request(
                "Accounts/{$ci->twilio_sid}/Notifications",
                'GET',
                $params);

        if ( $res->IsError ) {
                # shit!
                return FALSE;
        }

        $xml = $res->ResponseXml;
        return $xml;
}

Function GetErrorDef( $code) {
        switch ( $code ) {
	case '10001':
                return "Account is not active";
                break;
	case '10002':
                return "Trial account does not support this feature";
                break;
	case '10003':
                return "Incoming call rejected due to inactive account";
                break;
	case '11100':
                return "Invalid URL format";
                break;
	case '11200':
                return "HTTP retrieval failure";
                break;
	case '11205':
                return "HTTP connection failure";
                break;
	case '11206': 
                return "HTTP protocol violation";
                break;
	case '11210': 
                return "HTTP bad host name";
                break;
	case '11215': 
                return "HTTP too many redirects";
                break;
	case '12100': 
                return "Document parse failure";
                break;
	case '12101': 
                return "Invalid Twilio Markup XML version";
                break;
	case '12102': 
                return "The root element must be Response";
                break;
	case '12200': 
                return "Schema validation warning";
                break;
	case '12300': 
                return "Invalid Content-Type";
                break;
	case '12400': 
                return "Internal Failure";
                break;
	case '13201': 
                return "Dial: Cannot Dial out from a Dial Call Segment";
                break;
	case '13210': 
                return "Dial: Invalid method value";
                break;
	case '13212': 
                return "Dial: Invalid timeout value";
                break;
	case '13213': 
                return "Dial: Invalid hangupOnStar value";
                break;
	case '13214': 
                return "Dial: Invalid callerId value";
                break;
	case '13215': 
                return "Dial: Invalid nested element";
                break;
	case '13216': 
                return "Dial: Invalid timeLimit value";
                break;
	case '13221': 
                return "Dial->Number: Invalid method value";
                break;
	case '13222': 
                return "Dial->Number: Invalid sendDigits value";
                break;
	case '13223': 
                return "Dial: Invalid phone number format";
                break;
	case '13224': 
                return "Dial: Invalid phone number";
                break;
	case '13225': 
                return "Dial: Forbidden phone number";
                break;
	case '13230': 
                return "Dial->Conference: Invalid muted value";
                break;
	case '13231':
                return "Dial->Conference: Invalid endConferenceOnExit value";
                break;
	case '13232': 
                $err =<<<EOT
Dial->Conference: Invalid startConferenceOnEnter value
EOT;
                return $err;
                break;
	case '13233': 
                return "Dial->Conference: Invalid waitUrl";
                break;
	case '13234': 
                return "Dial->Conference: Invalid waitMethod";
                break;
	case '13235': 
                return "Dial->Conference: Invalid beep value";
                break;
	case '13236': 
                return "Dial->Conference: Invalid Conference Sid";
                break;
	case '13237': 
                return "Dial->Conference: Invalid Conference Name";
                break;
	case '13238': 
                return "Dial->Conference: Invalid Verb used in waitUrl TwiML";
                break;
	case '13310': 
                return "Gather: Invalid finishOnKey value";
                break;
	case '13312': 
                return "Gather: Invalid method value";
                break;
	case '13313': 
                return "Gather: Invalid timeout value";
                break;
	case '13314': 
                return "Gather: Invalid numDigits value";
                break;
	case '13320': 
                return "Gather: Invalid nested verb";
                break;
	case '13321': 
                return "Gather->Say: Invalid voice value";
                break;
	case '13322': 
                return "Gather->Say: Invalid loop value";
                break;
	case '13325': 
                return "Gather->Play: Invalid Content-Type";
                break;
	case '13410': 
                return "Play: Invalid loop value";
                break;
	case '13420': 
                return "Play: Invalid Content-Type";
                break;
	case '13510': 
                return "Say: Invalid loop value";
                break;
	case '13511': 
                return "Say: Invalid voice value";
                break;
	case '13520': 
                return "Say: Invalid text";
                break;
	case '13610': 
                return "Record: Invalid method value";
                break;
	case '13611': 
                return "Record: Invalid timeout value";
                break;
	case '13612': 
                return "Record: Invalid maxLength value";
                break;
	case '13613': 
                return "Record: Invalid finishOnKey value";
                break;
        case '13614':
                return "Record: Invalid transcribe value";
                break;
        case '13615':
                return "Record: maxLength too high for transcription";
                break;
        case '13616':
                return "Record: playBeep must be true or false";
                break;
	case '13710': 
                return "Redirect: Invalid method value";
                break;
	case '13910': 
                return "Pause: Invalid length value";
                break;
	case '14101': 
                return "Invalid 'To' attribute";
                break;
	case '14102': 
                return "Invalid 'From' attribute";
                break;
	case '14103': 
                return "Invalid Body";
                break;
	case '14104': 
                return "Invalid Method attribute";
                break;
	case '14105': 
                return "Invalid statusCallback attribute";
                break;
	case '14106': 
                return "Document retrieval limit reached";
                break;
	case '14107': 
                return "SMS send rate limit exceeded";
                break;
	case '14108': 
                return "From phone number not SMS capable";
                break;
	case '14109': 
                return "SMS Reply message limit exceeded";
                break;
	case '14110': 
                return "Invalid Verb for SMS Reply";
                break;
	case '14111': 
                return "Invalid To phone number for Trial mode";
                break;
	case '20001': 
                return "Unknown parameters";
                break;
	case '20002': 
                return "Invalid FriendlyName";
                break;
	case '20003': 
                return "Permission Denied";
                break;
	case '20004': 
                return "Method not allowed";
                break;
	case '20005': 
                return "Account not active";
                break;
	case '21201': 
                return "No Called number specified";
                break;
	case '21202': 
                return "Called number is a premium number";
                break;
	case '21203': 
                return "International calling not enabled";
                break;
	case '21205': 
                return "Invalid URL";
                break;
	case '21206': 
                return "Invalid SendDigits";
                break;
	case '21207': 
                return "Invalid IfMachine";
                break;
	case '21208': 
                return "Invalid Timeout";
                break;
	case '21209': 
                return "Invalid Method";
                break;
	case '21210': 
                return "Caller phone number not verified";
                break;
	case '21211': 
                return "Invalid Called Phone Number";
                break;
	case '21212': 
                return "Invalid Caller Phone Number";
                break;
	case '21213': 
                return "Caller phone number is required";
                break;
	case '21220': 
                return "Invalid call state";
                break;
	case '21401': 
                return "Invalid Phone Number";
                break;
	case '21402': 
                return "Invalid Url";
                break;
	case '21403': 
                return "Invalid Method";
                break;
	case '21404': 
                return "Inbound Phone number not available to trial account";
                break;
	case '21405': 
                return "Cannot set VoiceFallbackUrl without setting Url";
                break;
	case '21406': 
                return "Cannot set SmsFallbackUrl without setting SmsUrl";
                break;
	case '21407': 
                return "This Phone Number type does not support SMS";
                break;
	case '21450': 
                return "Phone number already validated on your account";
                break;
	case '21451': 
                return "Invalid area code";
                break;
	case '21452': 
                return "No phone numbers found in area code";
                break;
	case '21453': 
                return "Phone number already validated on another account";
                break;
	case '21454': 
                return "Invalid CallDelay";
                break;
	case '21501': 
                return "Resource not available";
                break;
	case '21502': 
                return "Invalid callback url";
                break;
	case '21503': 
                return "Invalid transcription type";
                break;
	case '21504': 
                return "RecordingSid is required";
                break;
	case '21601':
                $err =<<<EOT
Phone number is not a valid SMS-capable inbound phone number
EOT;
                return $err;
                break; 
	case '21602': 
                return "Message body is required";
                break;
	case '21603':
                $err =<<<EOT
The source 'from' phone number is required to send an SMS
EOT;
                return $err;
                break;
	case '21604':
                $err =<<<EOT
The destination 'to' phone number is required to send an SMS
EOT;
                return $err;
                break;
	case '21605':
                return "Maximum SMS body length is 160 characters";
                break;
	case '21606':
                $err =<<<EOT
The "From" phone number provided is not a valid, 
SMS-capable inbound phone number for your account
EOT;
                return $err;
                break;
	case '21608':
                $err=<<<EOT
The Sandbox number can send messages only to verified numbers
EOT;
                return $err;
                break;
        default:
                return "Unknown Error";
                break;
        }
}

echo <<<EOT
<div class="vbx-plugin">
<h3>Twilio Account Debugger</h3>
<form name="debugger_search" method="GET">
From Date <input type="text" name="DateFrom" size="10">&nbsp;&nbsp;&nbsp;
To Date <input type="text" name="DateTo" size="10">&nbsp;&nbsp;&nbsp;
Errors Only <input type="checkbox" name="errors" value="1" >&nbsp;&nbsp;&nbsp;
<input type="submit" value="search">
</form>

EOT;

$params = array();

$MessageDateFrom = $ci->input->get('DateFrom');
$MessageDateTo = $ci->input->get('DateTo');

if ( !empty($MessageDateFrom) ) {
        $params['MessageDate>'] = date( 'Y-m-d', strtotime($MessageDateFrom));
        if ( !empty($MessageDateTo) ) {
                $params['MessageDate<'] = date('Y-m-d',
                                strtotime( "{$MessageDateTo} +1 days"));
        } else {
                $params['MessageDate<']
                                = date('Y-m-d', strtotime('today +1 days'));
        }
} else if ( !empty($MessageDateTo) ) {
        $params['MessageDate>'] = date('Y-m-d');
        $params['MessageDate<'] = date('Y-m-d',
                                strtotime( "{$MessageDateTo} +1 days"));
} else {
        # show all
}

$errors = (int)$ci->input->get('errors');
# default to ALL notifications
$params['Log'] = '';
if ( !empty($errors) ) {
        # errors only
        $params['Log'] = 0;
}

# current page
$params['Page'] = (int)end($ci->uri->segments);

# page size
$params['PageSize'] = 25;

if ( !$res = GetNotifications( $ci, $params) ) {
        echo <<<EOT
<strong>System Error</strong>

EOT;
}

/*
Notifications Attributes ( 2010-04-01 API )

page
numpages
pagesize
total
start
end
uri
firstpageuri 
previouspageuri
nextpageuri 
lastpageuri

Notification Properties ( 2010-04-01 API )
<Notification>
        <Sid/>
        <AccountSid/>
        <CallSid/>
        <Log/>
        <ErrorCode/>
        <MoreInfo/>
        <MessageText/>
        <MessageDate/>
        <ResponseBody/>
        <RequestMethod/>
        <RequestUrl/>
        <RequestVariables/>
        <ResponseHeaders/>
        <DateCreated/>
        <ApiVersion/>
        <DateUpdated/>
        <Uri/>
</Notification>
*/

echo <<<EOT
<table>
<thead>
  <tr>
    <th style="width: 100px;">Date/Time</th>
    <th style="width: 75px;">Level</th>
    <th style="width: auto;">Error</th>
    <th style="width: 60px;"><!-- permalink --></th>
  </tr>
</thead>
<tbody>

EOT;

foreach ( $res->Notifications->Notification as $note ) {
        $DateTime = date( 'Y-m-d H:i:s', strtotime($note->MessageDate));
        switch ( $note->Log ) {
        case 0:
                $Level = 'ERROR';
                $color = '#821';
                break;
        case 1:
                $Level = 'Warning';
                $color = '#000099';
                break;
        default:
                $Level = 'Unknown';
                $color = '#000000';
                break;
        }
        $PermaLink =<<<EOT
https://www.twilio.com/user/account/log/view-error?sid={$note->Sid}
EOT;

        $Error = GetErrorDef($note->ErrorCode);
        if ( FALSE !== stripos( 'unknown', $Error) ) {
                $note->MoreInfo =<<<EOT
http://www.twilio.com/docs/errors/reference
EOT;
                $note->ErrorCode = '?????';
        }
               
        echo <<<EOT
  <tr>
    <td>{$DateTime}</td>
    <td style="font-weight: bold; color: {$color};">{$Level}</td>
    <td><a href="{$note->MoreInfo}" target="_blank">
        {$note->ErrorCode}</a>: {$Error}</td>
    <td><a href="{$PermaLink}" target="_blank">More Detail</a></td>
  </tr>

EOT;
}

echo <<<EOT
</tbody>
</table>

EOT;

# PAGINATION

$plugin_url = site_url("p/debugger");
$first = 0;
$last = ( (int)$res->Notifications['numpages'] - 1 );
$page = (int)$res->Notifications['page'];
if ( $first < $page ) {
        $prev = ($page - 1);
} else {
        $prev = $first;
}

if ( $last > $page ) {
        $next = ($page + 1);
} else {
        $next = $last;
}

if ( !empty($_SERVER['QUERY_STRING']) ) {
        $_SERVER['QUERY_STRING'] = '?' . $_SERVER['QUERY_STRING'];
}

if ( $last != $first ) {
        echo <<<EOT
<div class="log_pagination" style="text-align: right;">

EOT;
        if ( 0 < $page ) {
                echo <<<EOT
<a href="{$plugin_url}/{$first}{$_SERVER['QUERY_STRING']}">First</a>
<a href="{$plugin_url}/{$prev}{$_SERVER['QUERY_STRING']}">Previous</a>

EOT;
        }
        if ( $page < $last ) {
                echo <<<EOT
<a href="{$plugin_url}/{$next}{$_SERVER['QUERY_STRING']}">Next</a>
<a href="{$plugin_url}/{$last}{$_SERVER['QUERY_STRING']}">Last</a>

EOT;
        }

echo <<<EOT
</div>

EOT;
}

echo <<<EOT
</div>

EOT;

if ( $debug ) {
        var_dump($res);
}

?>
