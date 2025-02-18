<?php shouldNotSignin('cp'); ?><div class="cookie">
    
    <div class="header-tall small rel flex col aic jcc" style="background: url(<?php echo THEME . 'images/graph-bg.svg?v=' . time(); ?>) no-repeat center;">

        <h1 class="s50 b900">Cookie Policy</h1>
        <div class="icon-chevron-down s30 chevron anim abs"></div>

    </div>
    <div class="cpsec">

        <div class="a flex col">
            <h1 class="s24 b900">Activities strictly necessary for the operation of <?php echo APP_NAME; ?> and delivery of the Service</h1>
            <div class="s18">
                <?php echo APP_NAME; ?> uses so-called “technical” Cookies and other similar Trackers to carry out activities that are strictly necessary for the operation or delivery of the Service.
            </div>
        </div>
        <div class="ab flex col s16">

            <h1 class="s24 b900">Locating Tracker Settings</h1>
            <h1 class="s18 b700">Users can, for example, find information about how to manage Cookies in the most commonly used browsers at the following addresses:</h1>
            
            <ul>
                <li>Google Chrome</li>
                <li>Mozilla Firefox</li>
                <li>Apple Safari</li>
                <li>Microsoft Internet Explorer</li>
                <li>Microsoft Edge</li>
                <li>Brave</li>
                <li>Opera</li>
            </ul>

            Users may also manage certain categories of Trackers used on mobile apps by opting out through relevant device settings such as the device advertising settings for mobile devices, or tracking settings in general (Users may open the device settings and look for the relevant setting).
        </div>

        <div class="presentation flex col">
        <?php 
            $list = array(
                array(
                    'title' => 'Tag Management',
                    'txt' => 'This type of service helps the Owner to manage the tags or scripts needed on ' .  APP_NAME  . ' in a centralized fashion.<br />
                    This results in the Users\' Data flowing through these services, potentially resulting in the retention of this Data.<br /><br />
                    <h1 class="s16 b900">Google Tag Manager</h1><br />
                    Google Tag Manager is a tag management service provided by Google LLC or by Google Ireland Limited, depending on how the Owner manages the Data processing.<br />
                    Personal Data processed: Trackers and Usage Data.<br />
                    Place of processing: United States – Privacy Policy; Ireland – Privacy Policy.'
                ),    
                array(
                    'title' => 'SPAM protection',
                    'txt' => 'This type of service analyzes the traffic of ' . APP_NAME . ', potentially containing Users\' Personal Data, with the purpose of filtering it from parts of traffic, messages and content that are recognized as SPAM.<br /><br />
                    <h1 class="s16 b900">Google reCAPTCHA</h1><br />
                    Google reCAPTCHA is a SPAM protection service provided by Google LLC or by Google Ireland Limited, depending on how the Owner manages the Data processing.<br />
                    The use of reCAPTCHA is subject to the Google privacy policy and terms of use.<br />
                    Personal Data processed: answers to questions, clicks, keypress events, motion sensor events, mouse movements, scroll position, touch events, Trackers and Usage Data.<br />
                    Place of processing: United States – Privacy Policy; Ireland – Privacy Policy.<br /><br />
                    Storage duration:<br />
                    <ul>
                        <li>_GRECAPTCHA: duration of the session</li>
                        <li>rc::a: indefinite</li>
                        <li>rc::b: duration of the session</li>
                        <li> rc::c: duration of the session</li>
                    </ul>'
                ),    
                array(
                    'title' => 'Interaction with data collection platforms and other third parties',
                    'txt' => 'This type of service allows Users to interact with data collection platforms or other services directly from the pages of ' . APP_NAME . ' for the purpose of saving and reusing data.<br />
                    If one of these services is installed, it may collect browsing and Usage Data in the pages where it is installed, even if the Users do not actively use the service.<br />
                    
                    Hotjar Recruit User Testers (Hotjar Ltd.)<br />
                    The Hotjar Recruit User Testers widget is a service for interacting with the Hotjar data collection platform provided by Hotjar Ltd.<br />
                    Hotjar honors generic „Do Not Track” headers. This means the browser can tell its script not to collect any of the User\'s data. This is a setting that is available in all major browsers. Find Hotjar’s opt-out information here.<br />
                    Personal Data processed: Trackers, Usage Data and various types of Data.<br />
                    
                    Place of processing: Malta – Privacy Policy – Opt Out.<br /><br />
                    
                    Storage duration:<br />
                    <ul>
                        <li>_hjAbsoluteSessionInProgress: 30 minutes</li>
                        <li>_hjCachedUserAttributes: duration of the session</li>
                        <li>_hjClosedSurveyInvites: 1 year</li>
                        <li>_hjDonePolls: 1 year</li>
                        <li>_hjFirstSeen: duration of the session</li>
                        <li>_hjIncludedInPageviewSample: 30 minutes</li>
                        <li>_hjIncludedInSessionSample: 30 minutes</li>
                        <li>_hjLocalStorageTest: duration of the session</li>
                        <li>_hjMinimizedPolls: 1 year</li>
                        <li>_hjRecordingEnabled: duration of the session</li>
                        <li>_hjRecordingLastActivity: duration of the session</li>
                        <li>_hjSession*: 30 minutes</li>
                        <li>_hjSessionRejected: duration of the session</li>
                        <li>_hjSessionResumed: duration of the session</li>
                        <li>_hjSessionTooLarge: 1 hour</li>
                        <li>_hjSessionUser*: 1 year</li>
                        <li>_hjShownFeedbackMessage: 1 year</li>
                        <li>_hjTLDTest: duration of the session</li>
                        <li>_hjUserAttributesHash: duration of the session</li>
                        <li>_hjViewportId: duration of the session</li>
                        <li>_hjid: 1 year</li>
                    </ul>'
                ),
                array(
                    'title' => 'Analytics',
                    'txt' => 'The services contained in this section enable the Owner to monitor and analyze web traffic and can be used to keep track of User behavior.<br />
                    <br /><br />
                    <h1 class="s16 b900">Google Analytics</h1><br />
                    Google Analytics is a web analysis service provided by Google LLC or by Google Ireland Limited, depending on how the Owner manages the Data processing, (“Google”). Google utilizes the Data collected to track and examine the use of ' . APP_NAME . ', to prepare reports on its activities and share them with other Google services.<br />
                    Google may use the Data collected to contextualize and personalize the ads of its own advertising network.<br />
                    Personal Data processed: Trackers and Usage Data.<br /><br />
                    Place of processing: United States – Privacy Policy – Opt Out; Ireland – Privacy Policy – Opt Out.<br />
                    <br /><br />
                    Storage duration:
                    <ul>
                        <li>AMP_TOKEN: 1 hour</li>
                        <li>_ga: 2 years</li>
                        <li>_gac*: 3 months</li>
                        <li>_gat: 1 minute</li>
                        <li>_gid: 1 day</li>
                    </ul><br /><br />
                    <h1 class="s16 b900">Google Ads conversion tracking</h1><br />    
                    Google Ads conversion tracking is an analytics service provided by Google LLC or by Google Ireland Limited, depending on how the Owner manages the Data processing, that connects data from the Google Ads advertising network with actions performed on ' . APP_NAME . '.<br />
                    Personal Data processed: Trackers and Usage Data.<br />
                    Place of processing: United States – Privacy Policy; Ireland – Privacy Policy.<br />
                    Storage duration:<br />
                    <ul>
                        <li>IDE: 2 years</li>
                        <li>test_cookie: 15 minutes</li>
                    </ul>'
                ),
                array(
                    'title' => 'Heat mapping and session recording',
                    'txt' => 'Heat mapping services are used to display the areas of ' . APP_NAME . ' that Users interact with most frequently. This shows where the points of interest are. These services make it possible to monitor and analyze web traffic and keep track of User behavior.<br />
                    Some of these services may record sessions and make them available for later visual playback.<br />
                    Hotjar Heat Maps & Recordings (Hotjar Ltd.)<br />
                    Hotjar is a session recording and heat mapping service provided by Hotjar Ltd.<br />
                    Hotjar honors generic „Do Not Track” headers. This means the browser can tell its script not to collect any of the User\'s data. This is a setting that is available in all major browsers. Find Hotjar’s opt-out information here.<br />
                    Personal Data processed: Trackers, Usage Data and various types of Data as specified in the privacy policy of the service.<br />
                    
                    Place of processing: Malta – Privacy Policy – Opt Out.<br /><br />
                    
                    Storage duration:<br />
                    <ul>
                        <li>_hjAbsoluteSessionInProgress: 30 minutes</li>
                        <li>_hjCachedUserAttributes: duration of the session</li>
                        <li>_hjClosedSurveyInvites: 1 year</li>
                        <li>_hjDonePolls: 1 year</li>
                        <li>_hjFirstSeen: duration of the session</li>
                        <li>_hjIncludedInPageviewSample: 30 minutes</li>
                        <li>_hjIncludedInSessionSample: 30 minutes</li>
                        <li>_hjLocalStorageTest: duration of the session</li>
                        <li>_hjLocalStorageTest: duration of the session</li>
                        <li>_hjMinimizedPolls: 1 year</li>
                        <li>_hjRecordingEnabled: duration of the session</li>
                        <li>_hjRecordingLastActivity: duration of the session</li>
                        <li>_hjSession*: 30 minutes</li>
                        <li>_hjSession*: 30 minutes</li>
                        <li>_hjSessionRejected: duration of the session</li>
                        <li>_hjSessionResumed: duration of the session</li>
                        <li>_hjSessionTooLarge: 1 hour</li>
                        <li>_hjSessionUser*: 1 year</li>
                        <li>_hjShownFeedbackMessage: 1 year</li>
                        <li>_hjTLDTest: duration of the session</li>
                        <li>_hjUserAttributesHash: duration of the session</li>
                        <li>_hjViewportId: duration of the session</li>
                        <li>_hjid: 1 year</li>
                    </ul> <br /><br /><br />            
                    Microsoft Clarity (Microsoft Corporation)<br />
                    Microsoft Clarity is a session recording and heat mapping service provided by Microsoft Corporation.<br />
                    Microsoft processes or receives Personal Data via Microsoft Clarity, which in turn may be used for any purpose in accordance with the Microsoft Privacy Statement, including improving and providing Microsoft Advertising.<br />
                    Personal Data processed: clicks, country, custom events, device information, diagnostic events, interaction events, layout details, mouse movements, page events, positional information, scroll-to-page interactions, session duration, time zone, Trackers and Usage Data.<br />
                    Place of processing: United States – Privacy Policy.<br /><br />
                    
                    Storage duration:<br />
                    <ul>
                        <li>ANONCHK: 10 minutes</li>
                        <li>CLID: 1 year</li>
                        <li>MR: 7 days</li>
                        <li>MUID: 1 year</li>
                        <li>SM: duration of the session</li>
                        <li_clck: 1 year></li>
                        <li>_clsk: 1 day</li>
                    </ul>'
                ),
                array(
                    'title' => 'Definitions and legal references',
                    'txt' => '<h1 class="s16 b900">Personal Data (or Data)</h1><br />
                    Any information that directly, indirectly, or in connection with other information — including a personal identification number — allows for the identification or identifiability of a natural person.<br /><br />
                    <br /><h1 class="s16 b900">Usage Data</h1><br />
                    Information collected automatically through ' . APP_NAME . ' (or third-party services employed in ' . APP_NAME . '), which can include: the IP addresses or domain names of the computers utilized by the Users who use ' . APP_NAME . ', the URI addresses (Uniform Resource Identifier), the time of the request, the method utilized to submit the request to the server, the size of the file received in response, the numerical code indicating the status of the server\'s answer (successful outcome, error, etc.), the country of origin, the features of the browser and the operating system utilized by the User, the various time details per visit (e.g., the time spent on each page within the Application) and the details about the path followed within the Application with special reference to the sequence of pages visited, and other parameters about the device operating system and/or the User\'s IT environment.<br />
                    <br /><h1 class="s16 b900">User</h1><br />
                    The individual using ' . APP_NAME . ' who, unless otherwise specified, coincides with the Data Subject.<br />
                    <br /><h1 class="s16 b900">Data Subject</h1><br />
                    The natural person to whom the Personal Data refers.<br />
                    <br /><h1 class="s16 b900">Data Processor (or Processor)</h1><br />
                    The natural or legal person, public authority, agency or other body which processes Personal Data on behalf of the Controller, as described in this privacy policy.<br />
                    <br /><h1 class="s16 b900">Data Controller (or Owner)</h1><br />
                    The natural or legal person, public authority, agency or other body which, alone or jointly with others, determines the purposes and means of the processing of Personal Data, including the security measures concerning the operation and use of ' . APP_NAME . '. The Data Controller, unless otherwise specified, is the Owner of ' . APP_NAME . '.<br />
                    <br /><h1 class="s16 b900">' . APP_NAME . ' (or this Application)</h1><br />
                    The means by which the Personal Data of the User is collected and processed.<br />
                    <br /><h1 class="s16 b900">Service</h1><br />
                    The service provided by ' . APP_NAME . ' as described in the relative terms (if available) and on this site/application.<br />
                    <br /><h1 class="s16 b900">European Union (or EU)</h1><br />
                    Unless otherwise specified, all references made within this document to the European Union include all current member states to the European Union and the European Economic Area.<br />
                    <br /><h1 class="s16 b900">Cookie</h1><br />
                    Cookies are Trackers consisting of small sets of data stored in the User\'s browser.<br />
                    <br /><h1 class="s16 b900">Tracker</h1><br />
                    Tracker indicates any technology - e.g Cookies, unique identifiers, web beacons, embedded scripts, e-tags and fingerprinting - that enables the tracking of Users, for example by accessing or storing information on the User’s device.'
                )
            );
            foreach($list as $k => $v):
                echo '<div class="li flex col">
                    <div class="li-hed s20 b700 pointer flex jcb aic">
                        ' . $v['title'] . '
                        <div class="icon-chevron-down anim"></div>
                    </div>
                    <div class="li-ans s18 hide">' . $v['txt'] . '</div>
                </div>';
            endforeach;
        ?>
        </div>

        

    </div>

</div>