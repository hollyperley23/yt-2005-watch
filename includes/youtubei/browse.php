<?php
function requestBrowse($brid)
{
    // endpoint: /youtubei/v1/browse

    include("includes/config.inc.php");
    $req_arr = json_encode(
        array(
            'context' =>
            array(
                'client' =>
                array(
                    'hl' => 'en',
                    'gl' => 'MY',
                    'remoteHost' => '2001:e68:5418:cf5d:9daa:1106:dd70:103e',
                    'deviceMake' => 'Apple',
                    'deviceModel' => '',
                    'visitorData' => 'Cgtjc1hsUzJrS2tlWSiBnYaNBg%3D%3D',
                    'userAgent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.14; rv:94.0) Gecko/20100101 Firefox/94.0,gzip(gfe)',
                    'clientName' => 'WEB',
                    'clientVersion' => '2.20211124.00.00',
                    'osName' => 'Macintosh',
                    'osVersion' => '10.14',
                    'originalUrl' => 'https://www.youtube.com/feed/explore',
                    'platform' => 'DESKTOP',
                    'clientFormFactor' => 'UNKNOWN_FORM_FACTOR',
                    'configInfo' =>
                    array(
                        'appInstallData' => 'CIGdho0GELDUrQUQl-qtBRCT6q0FEJLXrQUQt8utBRCU_vwSENi-rQUQkfj8Eg%3D%3D',
                    ),
                    'userInterfaceTheme' => 'USER_INTERFACE_THEME_DARK',
                    'timeZone' => 'Asia/Kuala_Lumpur',
                    'browserName' => 'Firefox',
                    'browserVersion' => '94.0',
                    'screenWidthPoints' => 1438,
                    'screenHeightPoints' => 889,
                    'screenPixelDensity' => 1,
                    'screenDensityFloat' => 1,
                    'utcOffsetMinutes' => 480,
                    'mainAppWebInfo' =>
                    array(
                        'graftUrl' => '/feed/subscriptions',
                        'webDisplayMode' => 'WEB_DISPLAY_MODE_BROWSER',
                        'isWebNativeShareAvailable' => false,
                    ),
                ),
                'user' =>
                array(
                    'lockedSafetyMode' => false,
                ),
                'request' =>
                array(
                    'useSsl' => true,
                    'internalExperimentFlags' =>
                    array(),
                    'consistencyTokenJars' =>
                    array(),
                ),
                'clickTracking' =>
                array(
                    'clickTrackingParams' => 'CGUQtSwYAiITCKzE2sa2t_QCFcj8OAYdOUsJuA==',
                ),
                'adSignalsInfo' =>
                array(
                    'params' =>
                    array(
                        0 =>
                        array(
                            'key' => 'dt',
                            'value' => '1637977730876',
                        ),
                        1 =>
                        array(
                            'key' => 'flash',
                            'value' => '0',
                        ),
                        2 =>
                        array(
                            'key' => 'frm',
                            'value' => '0',
                        ),
                        3 =>
                        array(
                            'key' => 'u_tz',
                            'value' => '480',
                        ),
                        4 =>
                        array(
                            'key' => 'u_his',
                            'value' => '1',
                        ),
                        5 =>
                        array(
                            'key' => 'u_h',
                            'value' => '1080',
                        ),
                        6 =>
                        array(
                            'key' => 'u_w',
                            'value' => '1920',
                        ),
                        7 =>
                        array(
                            'key' => 'u_ah',
                            'value' => '974',
                        ),
                        8 =>
                        array(
                            'key' => 'u_aw',
                            'value' => '1920',
                        ),
                        9 =>
                        array(
                            'key' => 'u_cd',
                            'value' => '24',
                        ),
                        10 =>
                        array(
                            'key' => 'bc',
                            'value' => '31',
                        ),
                        11 =>
                        array(
                            'key' => 'bih',
                            'value' => '889',
                        ),
                        12 =>
                        array(
                            'key' => 'biw',
                            'value' => '1423',
                        ),
                        13 =>
                        array(
                            'key' => 'brdim',
                            'value' => '0,23,0,23,1920,23,1920,974,1438,889',
                        ),
                        14 =>
                        array(
                            'key' => 'vis',
                            'value' => '1',
                        ),
                        15 =>
                        array(
                            'key' => 'wgl',
                            'value' => 'true',
                        ),
                        16 =>
                        array(
                            'key' => 'ca_type',
                            'value' => 'image',
                        ),
                    ),
                ),
            ),
            'browseId' => $brid,
        )
    );

    // echo $brid;  // left this in oops
    $ch = curl_init();
    // otherwise unsupported browser
    $ua = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.14; rv:100.0) Gecko/20100101 Firefox/100.0";
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // so that the 1 doesnt show
    curl_setopt($ch, CURLOPT_COOKIEFILE, "../../cookies.txt");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: ",
        "Content-Type: application/json",
        "X-Goog-AuthUser: 0",
        "X-Origin: https://www.youtube.com"
    ));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $req_arr);
    curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_URL, "https://www.youtube.com/youtubei/v1/browse?key=AIzaSyAO_FJ2SlqU8Q4STEHLGCilw_Y9_11qcW8");

    $result = curl_exec($ch);
    return $result;
}
function requestChannel($channelId, $type)
{
    // first get browse endpoints, form a request to normal browse
    $getEp = json_decode(requestBrowse($channelId));
    if ($getEp) {
        $ep = $getEp->contents->twoColumnBrowseResultsRenderer->tabs;
        switch ($type) {
            case "videos":
                $brEp = $ep[1]->tabRenderer->endpoint->browseEndpoint->params;
                break;
            case "channels":
                $brEp = $ep[3]->tabRenderer->endpoint->browseEndpoint->params;
                break; //LMAO forgot
            case "about":
                $brEp = $ep[4]->tabRenderer->endpoint->browseEndpoint->params;
                break;
            default:
                $brEp = $ep[4]->tabRenderer->endpoint->browseEndpoint->params;
                break;
        }
    }
    // more advanced functions for browse
    include("includes/config.inc.php");
    $req_arr = json_encode(
        array(
            'context' =>
            array(
                'client' =>
                array(
                    'hl' => 'en',
                    'gl' => 'MY',
                    'remoteHost' => '2001:e68:5418:cf5d:9daa:1106:dd70:103e',
                    'deviceMake' => 'Apple',
                    'deviceModel' => '',
                    'visitorData' => 'Cgtjc1hsUzJrS2tlWSiBnYaNBg%3D%3D',
                    'userAgent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.14; rv:94.0) Gecko/20100101 Firefox/94.0,gzip(gfe)',
                    'clientName' => 'WEB',
                    'clientVersion' => '2.20211124.00.00',
                    'osName' => 'Macintosh',
                    'osVersion' => '10.14',
                    'originalUrl' => 'https://www.youtube.com/feed/explore',
                    'platform' => 'DESKTOP',
                    'clientFormFactor' => 'UNKNOWN_FORM_FACTOR',
                    'configInfo' =>
                    array(
                        'appInstallData' => 'CIGdho0GELDUrQUQl-qtBRCT6q0FEJLXrQUQt8utBRCU_vwSENi-rQUQkfj8Eg%3D%3D',
                    ),
                    'userInterfaceTheme' => 'USER_INTERFACE_THEME_DARK',
                    'timeZone' => 'Asia/Kuala_Lumpur',
                    'browserName' => 'Firefox',
                    'browserVersion' => '94.0',
                    'screenWidthPoints' => 1438,
                    'screenHeightPoints' => 889,
                    'screenPixelDensity' => 1,
                    'screenDensityFloat' => 1,
                    'utcOffsetMinutes' => 480,
                    'mainAppWebInfo' =>
                    array(
                        'graftUrl' => '/feed/subscriptions',
                        'webDisplayMode' => 'WEB_DISPLAY_MODE_BROWSER',
                        'isWebNativeShareAvailable' => false,
                    ),
                ),
                'user' =>
                array(
                    'lockedSafetyMode' => false,
                ),
                'request' =>
                array(
                    'useSsl' => true,
                    'internalExperimentFlags' =>
                    array(),
                    'consistencyTokenJars' =>
                    array(),
                ),
                'clickTracking' =>
                array(
                    'clickTrackingParams' => 'CGUQtSwYAiITCKzE2sa2t_QCFcj8OAYdOUsJuA==',
                ),
                'adSignalsInfo' =>
                array(
                    'params' =>
                    array(
                        0 =>
                        array(
                            'key' => 'dt',
                            'value' => '1637977730876',
                        ),
                        1 =>
                        array(
                            'key' => 'flash',
                            'value' => '0',
                        ),
                        2 =>
                        array(
                            'key' => 'frm',
                            'value' => '0',
                        ),
                        3 =>
                        array(
                            'key' => 'u_tz',
                            'value' => '480',
                        ),
                        4 =>
                        array(
                            'key' => 'u_his',
                            'value' => '1',
                        ),
                        5 =>
                        array(
                            'key' => 'u_h',
                            'value' => '1080',
                        ),
                        6 =>
                        array(
                            'key' => 'u_w',
                            'value' => '1920',
                        ),
                        7 =>
                        array(
                            'key' => 'u_ah',
                            'value' => '974',
                        ),
                        8 =>
                        array(
                            'key' => 'u_aw',
                            'value' => '1920',
                        ),
                        9 =>
                        array(
                            'key' => 'u_cd',
                            'value' => '24',
                        ),
                        10 =>
                        array(
                            'key' => 'bc',
                            'value' => '31',
                        ),
                        11 =>
                        array(
                            'key' => 'bih',
                            'value' => '889',
                        ),
                        12 =>
                        array(
                            'key' => 'biw',
                            'value' => '1423',
                        ),
                        13 =>
                        array(
                            'key' => 'brdim',
                            'value' => '0,23,0,23,1920,23,1920,974,1438,889',
                        ),
                        14 =>
                        array(
                            'key' => 'vis',
                            'value' => '1',
                        ),
                        15 =>
                        array(
                            'key' => 'wgl',
                            'value' => 'true',
                        ),
                        16 =>
                        array(
                            'key' => 'ca_type',
                            'value' => 'image',
                        ),
                    ),
                ),
            ),
            'browseId' => $channelId,
            'params' => $brEp,
        )
    );

    // echo $brid;  // left this in oops
    $ch = curl_init();
    // otherwise unsupported browser
    $ua = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.14; rv:100.0) Gecko/20100101 Firefox/100.0";
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // so that the 1 doesnt show
    curl_setopt($ch, CURLOPT_COOKIEFILE, "../../cookies.txt");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: ",
        "Content-Type: application/json",
        "X-Goog-AuthUser: 0",
        "X-Origin: https://www.youtube.com"
    ));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $req_arr);
    curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_URL, "https://www.youtube.com/youtubei/v1/browse?key=AIzaSyAO_FJ2SlqU8Q4STEHLGCilw_Y9_11qcW8");

    $result = curl_exec($ch);
    return $result;
}
