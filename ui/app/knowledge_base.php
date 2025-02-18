<?php shouldNotSignin('cp'); ?><div class="knowledge-base">



<?php 

$slug = strtolower(APP_NAME);
$qna = array(

    //Gettings Started
    'getting-started' => array( 
        'what-is-' . $slug => array(
            'title' => 'What is ' . APP_NAME . '?',
            'txt' => APP_NAME . ' is a website monitoring service. We monitor website ' . APP_NAME . ' , speed, performance, multi-step transactions, SSL certificates, and more!<br />
            ' . APP_NAME . ' was founded in 2015, and we are proud to boast of reaching 10 000 users in just two years!<br />
            You are welcome to try a free 30-day trial and find out if your website could benefit from our services.'
        ),
        'How-to-setup-an-account' => array(
            'title' => 'How to setup an account?',
            'txt' => ' You can create a free ' . APP_NAME . ' account by clicking on the "Start Free Trial" button in the right-hand side corner of our website.<br />
            Then you will be redirected to our Sign up page. All we need from you is your full name, e-mail address, and password. By signing up you agree to our Terms of Service and Privacy Policy.<br />
            The last optional step is to finish our easy 3-step onboarding procedure. We just need the URL of your website(s) and your basic contact info to send the alerts.'
        ),
        'How-to-sign-in-to-my-account' => array(
            'title' => 'How to sign in to my account?',
            'txt' => 'You can sign in to your ' . APP_NAME . ' account by clicking on the "Sign In" button at the right-hand side corner of our website.<br />
            Then you will be redirected to our Sign in page. You will have to enter the e-mail address that you used when you created your account and your password. Alternatively, you can use Google, Facebook, or Github to sign in to your account.'
        ),
        'Is-' . $slug . '-free' => array(
            'title' => 'Is ' . APP_NAME . 'free?',
            'txt' => 'Yes, ' . APP_NAME . ' has a free plan, as well as paid plans. Free users can monitor 1 website, as often as every 5 minutes. More advanced tools like Transaction Monitoring, Speed Monitoring, or SSL Monitoring are not included in the free plan<br />
            You can see our <a class="tdnh" href="' . BASEURL . '/pricing">pricing</a> for more information about our paid plans.'
        ),
        'How-to-contact-'. $slug .'-support' => array(
            'title' => 'How to contact ' . APP_NAME . ' support?',
            'txt' => 'We are very happy to help you! You can contact us by sending us an e-mail to ' . EMAIL_ACCOUNT['user'] .' or filling a support ticket.'
        ),
        'How-can-' . $slug .'-help-me' => array(
            'title' => 'How can ' . APP_NAME . ' help me?',
            'txt' => '' . APP_NAME . ' can automatically check if your website is working fine and immediately alert you if there is something wrong, for example, if your website is unreachable.<br />
            Checking if your website is working fine manually can be a waste of your precious time. Also, it would be impossible to do it as often as 30 seconds, like ' . APP_NAME . '.<br />
            ' . APP_NAME . ' can also notify you if your website gets too slow, if your login, signup, or other important parts of your website are working as they should, as well as if your SSL certificate will expire soon.<br />
            You can try <a href="#" class="tdnh">' . APP_NAME . ' for free for 30 days</a>, no credit card is required. You can always contact us if you have any specific needs.'
        ),
        'How-to-monitor-my-website' => array(
            'title' => 'How to monitor my website?',
            'txt' => 'The easiest way to get started it is to sign up and enter your website in our onboarding form. We will automatically create 3 kinds of monitoring for you.<br />
            ' . APP_NAME . '  Monitoring - to check if your website is up<br />
            Speed Monitoring - to check if your website is not too slow<br />
            SSL Monitoring - to check if your SSL certificate will not expire soon<br />
            Another way is to click on the "ADD NEW MONITOR" button in the dashboard.<br />
            There you will be redirected to a page where you can choose between all of our monitoring products. Please choose the one that suits your needs the best, fill in the name and the URL, choose notification settings, and chose who will receive the alerts. '
        )
    ),

    //General Information
    'general-information' => array( 
        'How-does-website-monitoring-work' => array(
            'title' => 'How does website monitoring work?',
            'txt' => 'Website monitoring is an automatic process. ' . APP_NAME . ' uses more than 170 monitoring probes to constantly load your website and check if it is working as expected.<br />
            Once one of our probes suspects that something might be wrong, we check 3 more times from different probes to be 100% sure there is a problem with your website. We will create an incident and alert you only when all other probes confirm that there is a problem.<br />
            Automatic website monitoring has the advantage of working 24x7, 365 days a year. Checking if your website is working as expected manually would be a waste of time and energy.'
        ),
        'How-do-I-get-alerted-when-my-website-goes-down' => array(
            'title' => 'How do I get alerted when my website goes down?',
            'txt' => '' . APP_NAME . ' can alert you e-mailing you, sending an SMS, or contacting you by many 3rd party integrations we support. <br />
            The easiest way to add your basic contact information is during the onboarding, just after creating your account.<br />
            Another way is to go to "Reporting" -> "My Contacts" in the dashboard. There, you can add as many e-mail addresses and phone numbers as you need.<br />
            The last step is to choose which contacts should be alerted when your website has problems. You can do it at the very bottom of the page, where you create or edit monitoring checks.'
        ),
        'How-can-I-receive-regular-monitoring-reports-about-my-website' => array(
            'title' => 'How can I receive regular monitoring reports about my website?',
            'txt' => '' . APP_NAME . ' can send scheduled reports on daily, weekly, monthly and yearly basis.<br />
            The reports are activated to you by default after signing up. You can adjust the settings for your reports by going to "Reports" -> "Scheduled Reports" in your dashboard.<br />
            The reports include information such as how many times your website was down during the reported period, as well as total availability.<br />
            The reports are useful to prove your clients or boss that you keep the SLAs.'
        ),
        'How-many-websites-can-I-monitor' => array(
            'title' => 'How many websites can I monitor?',
            'txt' => '' . APP_NAME . ' offers different price tiers to fulfil different needs. Our most basic plan (Starter) includes 10 ' . APP_NAME . '  checks, while our most expensive plan (Enterprise) includes 500.<br />
            You can review our <a href="' . BASEURL. '/pricing">Pricing</a> page for more details.<br />
            You are always welcome to <a href="' . BASEURL . '/contact-us">contact us</a> in case 500 monitoring checks are not enough, and you need a custom plan.'
        ),
        'How-can-I-integrate-' . $slug . '-with-other-services' => array(
            'title' => 'How can I integrate ' . APP_NAME . ' with other services?',
            'txt' => '' . APP_NAME . ' seamlessly integrates with many 3rd party services, such as Slack, Discord, Telegram, and more.<br />
            For more information, go to our Integrations section in the <a class="tdnh" href="' . BASEURL . '/knowledge-base">Knowledge Base</a>.'
        ),
        'How-can-I-monitor-my-website-speed' => array(
            'title' => 'How can I monitor my website speed?',
            'txt' => 'You can monitor your website speed by using our <a href="#">Speed Monitoring</a> tool.<br />
            For more information, go to our Speed Monitoring section in the <a href="' . BASEURL . '/knowledge-base>"Knowledge Base.</a>'
        ),
        'How-can-I-monitor-multiple-step-transactions' => array(
            'title' => 'How can I monitor multiple-step transactions?',
            'txt' => 'You can monitor your website speed by using our <a href="#">Transaction Monitoring</a> tool.<br />
            For more information, go to our Transaction Monitoring section in the <a href="' . BASEURL . '/knowledge-base">Knowledge Base</a>.'
        ),
        'How-can-I-monitor-if-my-SSL-certificate-has-not-expired' => array(
            'title' => 'How can I monitor if my SSL certificate has not expired?',
            'txt' => 'You can monitor your website speed by using our SSL Monitoring tool.<br />
            For more information, go to our SSL Monitoring section in the <a href="' . BASEURL . '/knowledge-base">Knowledge Base</a>.'
        ),
        'Do-you-have-a-public-status-page' => array(
            'title' => 'Do you have a public status page?',
            'txt' => 'Yes, you can create a public status page with ' . APP_NAME . '. It allows you to share the information about your website health with your customers and communicate with them in case there is an outage.<br />
            For more information, go to our Public Status Page section in the <a href="' . BASEURL . '/knowledge-base">Knowledge Base</a>.'
        ),
        'Can-I-use-my-own-company-branding' => array(
            'title' => 'Can I use my own company branding?',
            'txt' => 'Yes, you can use your own company branding for scheduled reports and public status pages.<br />
            For more information, go to our Branding section in the <a href="' . BASEURL . '/knowledge-base">Knowledge Base</a>.'
        ),
        'How-can-I-delete-my-account' => array(
            'title' => 'How can I delete my account?',
            'txt' => 'We are truly sorry to see you go.<br />
            You can delete your account by going to "Settings" -> "Security" in your dashboard. You will find a big red button "DELETE ACCOUNT" at the bottom of this page.<br />
            Please note that this action is not reversible once you verify your password and confirm that you want to delete your account. All the data that we have gathered about you will be erased, as governed by GDPR.<br />'
        ),
        'Is-' . $slug . '-GDPR-compliant' => array(
            'title' => 'Is ' . APP_NAME . ' GDPR-compliant?',
            'txt' => 'Yes, ' . APP_NAME . ' is GDPR-compliant.<br />
            For more information, check out our <a href"#">GDPR page.</a>'
        ),
        'Do-you-have-a-public-roadmap' => array(
            'title' => 'Do you have a public roadmap?',
            'txt' => 'Yes, ' . APP_NAME . ' has a public roadmap.<br />
            Our public road map is a place where we announce our future features as well as accept your ideas.<br />
            You can find it by clicking <a href="#">here</a> or on a "Public Roadmap" link on our footer.'
        ),
    ),
    // Monitoring Dashboard
    'monitoring-dashboard' => array(
        'How-to-use-the-Dashboard' => array(
            'title' => 'How to use the Dashboard?',
            'txt' => 'The dashboard contains all the basic information about your websites you monitor. It is updated live and will reflect any changes in the status of any websites you monitor without you refreshing a page.<br />
            The picture below shows a sample dashboard with the "Box view" on.<br />
            Clicking on "Active incidents" will only show the monitoring checks who are having an incident.<br />
            Additional filters are available by clicking on "Filter".<br />
            "Table view" has been activated.<br />
            It is possible to perform basic actions, such as deleting or editing a monitoring check, straight from the dashboard.<br />
            Bulk actions are also possible."Graph view" has been activated.<br />
            Clicking on the date on the header of the dashboard will open the calendar. You can filter all of your information by date there.<br />
            Clicking on your name at the top right-hand side will open the side menu, which contains information about your account status.<br />
            Clicking on the bell icon will open the notifications box.'
        ),
        'Create-a-new-monitoring-check' => array(
            'title' => 'Create a new monitoring check',
            'txt' => 'You can create a new monitoring check by clicking on the "CREATE NEW MONITOR" button on the Dashboard or on the left-hand side menu in the "Monitoring" section.<br />
            The first step to create a monitor is to choose a type. We have multiple different types of monitoring, such as ' . APP_NAME . '  Monitoring, SSL Monitoring and Speed Monitoring. Different kinds of monitoring fulfill different needs.<br />
            The second step is to enter the basic information, such as the name and the URL of your website.<br />
            It is also possible to add a bulk list of websites by clicking on the "ADD BULK" button. Please note that you have to follow the format carefully.<br />
            The last step is to choose how often do you want your website to be checked and who will receive the alerts when something goes wrong.<br />
            Advanced options are also available. You can activate them by clicking on the "Advanced" tab.<br />
            You can assign your monitors into groups. It will be easier to filter them in the dashboard if you have hundreds of monitoring checks.<br />
            Locations tab allows you to choose between more than 170 different probes. Each probe is on a different geographic location. It is useful to choose locations if your website is available only in a specific region.'
        ),
        'What-is-a-monitoring-checkpoint' => array(
            'title' => 'What is a monitoring checkpoint?',
            'txt' => 'A monitoring checkpoint is a server in a specific geographic location. We also call it a monitoring probe. We use them to load your website in order to check if it is responding as expected.<br />
            ' . APP_NAME . ' has more than 170 monitoring checkpoints on 6 continents.'
        ),
        'How-many-checkpoints-does-' . $slug . '-have' => array(
            'title' => 'How many checkpoints does ' . APP_NAME . ' have?',
            'txt' => '' . APP_NAME . ' has more than 170 monitoring checkpoints on 6 continents. For more information, please go to our <a href="#">monitoring checkpoints page</a>, as well as visit the raw list of our <a href="">monitoring probes IP addresses </a>(useful for automatic whitelisting).'
        ),
        'How-can-I-select-which-locations-(checkpoints)-to-use' => array(
            'title' => 'How can I select which locations  (checkpoints) to use?',
            'txt' => '' . APP_NAME . ' has more than 170 monitoring checkpoints on 6 continents. We recommend using all of them, however, it is possible to choose which specific checkpoints (probes) you want to use.<br />
            You can do it by editing an existing monitoring check (or when creating a new one). You have to click on the "Locations" tab at the top of the page. There you will see a full list of our monitoring probes. We require choosing at least 6 different monitoring probes to make sure there is enough redundancy in case some of them are not available.'
        ),
        'Where-can-I-find-the-IP-addresses-for-the-monitoring-checkpoints' => array(
            'title' => 'Where can I find the IP addresses for the monitoring checkpoints?',
            'txt' => 'You can find the IP addresses of our monitoring checkpoints on <a href="#">this page</a>. You can also access a raw list <a href="#">here</a> (useful for automatic whitelisting).'
        ),
        'What-is-an-active-incident' => array(
            'title' => 'What is an active incident?',
            'txt' => 'An active incident is an unresolved problem with your website or service. ' . APP_NAME . ' creates an incident once a problem is discovered and constantly checks if it still exists.<br />
            You will find all active incidents in the Dashboard (left-hand-side menu).Clicking on the error name will display the root-cause-analysis. The information provided there is very useful to quickly resolve an incident.<br />
            An active incident will be moved to the "Incidents log" page once ' . APP_NAME . ' determines that it has been resolved and the problem no longer exists.'
        ),
        'How-can-I-find-incidents-that-have-already-been-resolved' => array(
            'title' => 'How can I find incidents that have already been resolved?',
            'txt' => 'You can find incidents that have already been resolved on the left-hand-side menu in the Dashboard.<br />
            It is possible to filter incidents by monitoring type, specific websites or services and by selecting a date on the calendar.'
        ),
        'How-can-I-access-monitoring-logs' => array(
            'title' => 'How can I access monitoring logs?',
            'txt' => 'You can find monitoring log on the left-hand side menu in the Dashboard.
            It is possible to filter logs by monitoring type, specific websites or services, locations (monitoring probes that loaded your website or service), and by selecting a date on the calendar.'
        ),
        'Can-I-add-a-bulk-list-of-websites-to-monitor' => array(
            'title' => 'Can I add a bulk list of websites to monitor?',
            'txt' => 'Yes, you can add a bulk list of websites when you use our tool to create a new monitor. It is a great way to save lots of your precious time.<br />
            In order to add a bulk list, you have to click on the "ADD BULK" button when creating a new monitor.<br />
            We accept the following format:
            "https://www.website1.com/","Website name 1"
            "https://www.website2.com/","Website name 2"    
            Each new website must be on a new line.
            We will show this list for you to verify if all of your information is correct after you click on the "CREATE NEW MONITOR" button.'
        ),
        'Can-I-group-my-websites' => array(
            'title' => 'Can I group my websites',
            'txt' => 'Yes, you can group your websites. It is very useful if you have hundreds of even more of websites and want to separate them into groups. 
            You can do it by clicking on the "Groups" tab when creating or editing a monitor.You can filter your monitors by a group in 2 ways once it is assigned to a group.
            The first way is in the dashboard. You have to click on the "Filter" button and then "Select groups".
            The second way is when viewing all of your created monitoring checks. You will find a button "Filter by group" on the left-hand-side menu.'
        ),
        'What-is-the-difference-between-a-CRITICAL-and-TROUBLE-incident-status' => array(
            'title' => 'What is the difference between a CRITICAL and TROUBLE incident status?',
            'txt' => 'There are 2 levels of incidents.
            The lower level is called TROUBLE. It means that your website or service is still running, but it needs immediate attention.
            The higher level is called CRITICAL. It means that your website or service is not available anymore.'
        ),
    ),
    // Uptime Monitoring
    $slug .'-monitoring' => array(
        'What-is-Website-' . $slug . '-Monitoring' => array(
            'title' => 'What is Website ' . APP_NAME . '  Monitoring?',
            'txt' => 'Website ' . APP_NAME . '  monitoring is the most basic and most commonly used type of monitoring. ' . APP_NAME . ' uses a synthetic monitoring probe to load your website or service and wait for a response. No real browser is used there. You can monitor services on HTTP/S, DNS, UDP, TCP, SMTP, POP3 and IMAP protocols. Applications that need JavaScript support do not work with this type of monitoring.'
        ),
        'How-to-create-' . $slug . '-Monitoring-check' => array(
            'title' => 'How to create ' . APP_NAME . '  Monitoring check?',
            'txt' => 'You can create an ' . APP_NAME . '  Monitoring check by clicking on the "CREATE NEW MONITOR" button in the Dashboard or at the left-hand-side menu in the Monitoring section.You can choose between 3 sub-options: Web, Network and Email.
            The next step is to enter the website or service name and URL (alternatively, an IP address). 
            It is also possible to check if specific content exists or does not exist on your website. Sending custom headers is possible as well.The last step is to choose who will be alerted once your website or service goes down.'
        ),
        'Which-protocols-do-you-support' => array(
            'title' => 'Which protocols do you support?',
            'txt' => '' . APP_NAME . ' supports HTTP, HTTPS, TCP, Ping, DNS, UDP, SMTP, POP3 and IMAP protocols for Website ' . APP_NAME . '  Monitoring.'
        ),
        'Can-I-check-if-specific-content-exists-on-my-website' => array(
            'title' => 'Can I check if specific content exists on my website?',
            'txt' => 'Yes, you can do it when you create a new monitoring check or edit an existing one.
            There are two possible rules for checking for content - the content MUST on a website, or it MUST NOT EXIST.'
        ),
        'Can-I-choose-which-error-types-to-report' => array(
            'title' => 'Can I choose which error types to report?',
            'txt' => 'You can choose between the following error types:<ul><li>Connection errors</li><li>Timeouts</li><li>Unknown errors</li><li>HTTP errors</li><li>Redirect errors</li><li>Keyword / expected response errors</li></ul>
            All error types are enabled by default. Unchecking one of those checkboxes will ignore those errors and will not create an incident, as well as no alerts will be sent.'
        ),
        'What-do-"backup-checks"-mean' => array(
            'title' => 'What is Website ' . APP_NAME . '  Monitoring?',
            'txt' => '' . APP_NAME . ' triple-checks the status of your website or service every time one of our monitoring probes suspects there is an error. We do this in order to avoid false-positive alerts. ' . APP_NAME . ' will alert you only if all 3 backup checks also confirm that there is a problem on a website.'
        ),
        'How-can-I-select-timeout-settings' => array(
            'title' => 'What is Website ' . APP_NAME . '  Monitoring?',
            'txt' => 'You can select timeout settings by clicking on the "Advanced" tab when creating or editing a monitoring check.<br />
            Timeout settings mean that our probes will wait for a specific number of seconds to get a response from your website or service. A website will be considered as down if it does not respond within the specified amount of time.'
        ),
    ),
    // Speed Monitoring
    'speed-monitoring' => array(
        'What-is-Website-speed-Monitoring' => array(
            'title' => 'What is Website Speed Monitoring?',
            'txt' => 'Website ' . APP_NAME . '  monitoring is the most basic and most commonly used type of monitoring. ' . APP_NAME . ' uses a synthetic monitoring probe to load your website or service and wait for a response. No real browser is used there. You can monitor services on HTTP/S, DNS, UDP, TCP, SMTP, POP3 and IMAP protocols. Applications that need JavaScript support do not work with this type of monitoring.'
        ), 
        'How-to-create-Speed-Monitoring-check' => array(
            'title' => 'How to create Speed Monitoring check?',
            'txt' => 'Website ' . APP_NAME . '  monitoring is the most basic and most commonly used type of monitoring. ' . APP_NAME . ' uses a synthetic monitoring probe to load your website or service and wait for a response. No real browser is used there. You can monitor services on HTTP/S, DNS, UDP, TCP, SMTP, POP3 and IMAP protocols. Applications that need JavaScript support do not work with this type of monitoring.'
        ), 
        'How-to-monitor-the-speed-of-my-website' => array(
            'title' => 'How to monitor the speed of my website?',
            'txt' => 'Website ' . APP_NAME . '  monitoring is the most basic and most commonly used type of monitoring. ' . APP_NAME . ' uses a synthetic monitoring probe to load your website or service and wait for a response. No real browser is used there. You can monitor services on HTTP/S, DNS, UDP, TCP, SMTP, POP3 and IMAP protocols. Applications that need JavaScript support do not work with this type of monitoring.'
        ), 
        'How-to-get-alerted-if-my-website-gets-too-slow' => array(
            'title' => 'How to get alerted if my website gets too slow?',
            'txt' => 'Website ' . APP_NAME . '  monitoring is the most basic and most commonly used type of monitoring. ' . APP_NAME . ' uses a synthetic monitoring probe to load your website or service and wait for a response. No real browser is used there. You can monitor services on HTTP/S, DNS, UDP, TCP, SMTP, POP3 and IMAP protocols. Applications that need JavaScript support do not work with this type of monitoring.'
        ), 
    ),
    // Transaction Monitoring
    'transaction-monitoring' => array(
        'What-is-Transaction-Monitoring' => array(
            'title' => 'What is Transaction Monitoring?',
            'txt' => 'Website Transaction Monitoring is a tool to monitor multi-step website transactions, such as website sign in and sign up forms, as well as e-commerce checkout forms.<br />
            You have to define a step-by-step script that our monitoring probe will follow.We use a real Google Chrome browser to fully load your website and execute the steps. You will receive an alert if our probe cannot complete all of these steps.'
        ),
        'How-to-set-up-a-multi-step-monitoring-for-my-website' => array(
            'title' => 'How to set up a multi-step monitoring for my website?',
            'txt' => 'Go to "Monitoring" (left-hand-side menu) and choose "Transaction Monitoring" as your monitoring option. Click "Add New Monitor" and you will be redirected to the tool to create or edit monitoring checks.
            <br />The next step is to define all the steps our monitoring probe has to take to check if a specific functionality of your website is working as expected.
            There are two main kinds of steps you can perform - Commands and Validations.A command is a specific action taken on a website.A validation is a way to check if a website behaves as expected.The last step is to choose how often you want the check to be performed, when to send an alert in case the check breaks, and who will be alerted.'
        ),
        'How-can-I-edit-my-transaction-monitoring-settings' => array(
            'title' => 'How can I edit my transaction monitoring settings?',
            'txt' => 'You can edit a Transaction Monitoring check by going to "Monitoring" (left-hand-side menu) and choosing "Transaction Monitoring". 
            Click on the hog icon next to the name of your monitoring check and then "Edit monitor".
            Then you will be redirected to the editing tool. You can add new steps, delete unnecessary steps and edit existing steps.
            It is highly recommended to click on the "TEST ALL STEPS" button before saving your changes to be sure everything works as expected. '
        )
    ),
    // Real User Monitoring
    'real-user-monitoring' => array(
        'What-is-Real-User-Monitoring' => array(
            'title' => 'What is Real User Monitoring?',
            'txt' => 'Real User Monitoring is a great tool to monitor how your website performs for your real visitors. Our other kinds of monitoring use a synthetic probe to load your website from our servers. Real User Monitoring tool is different because it collects user data directly from your users and sends it back to ' . APP_NAME . '.<br />
            This method of monitoring has the advantage that it can provide a lot of information, such as JavaScript errors on your website, performance between different browsers and platforms and how fast your website actually loads for your real users. '
        ),          
        'How-to-create-a-Real-User-Monitoring-check' => array(
            'title' => 'How to create a Real User Monitoring check?',
            'txt' => 'To create a new Real User Monitoring check, go to "Monitoring" (left-hand-side menu), then choose "Real User Monitoring" and click on "Add New Monitor".'
        ),          
        'How-to-track-JavaScript-errors' => array(
            'title' => 'How to track JavaScript errors?',
            'txt' => 'You can see the list of JavaScript errors under the "JavaScript Errors" tab. There are two types of ways that we collect JavaScript errors - by error name and by script name.<ul><li>Clicking on any of the errors in the by error name table will open a modal window with the detailed information which JavaScript files this error occurred in, as well as which browsers and platforms.</li><li>Alternatively, you can click on a script name in the by script name table. The modal window will display all errors that occurred in the specific script.</li></ul><br />The bottom of the modal window shows the frequency a specific error occurred in.'
        ),          
        'How-to-get-alerted-when-there-are-problems-with-my-website' => array(
            'title' => 'How to get alerted when there are problems with my website?',
            'txt' => 'There are 4 ways to get alerted for Real User Monitoring. You can edit them when you create a new Real User Monitoring check or edit an existing one.<ul><li>Outage alerting</li><li>Performance alerting</li><li>Drop in traffic alerting</li><li>JavaScript errors alerting</li></ul>'
        ),          
        'How-to-get-alerted-when-there-are-JavaScript-errors-on-my-website' => array(
            'title' => 'How to get alerted when there are JavaScript errors on my website?',
            'txt' => 'You can get alerted if there are too many JavaScript errors on your website by activating the "JavaScript errors alerting" checkbox in the Real User Monitoring check settings.'
        ),          
    ),
    // SSL Monitoring
    'ssl-monitoring' => array(
        'What-is-SSL-Monitoring' => array(
            'title' => 'What is SSL Monitoring?',
            'txt' => 'SSL Monitoring is a tool that monitors the health of your website SSL certificate. It can alert you in case ' . APP_NAME . ' detects that there is an issue with your certificate or if it will expire soon.<br />
            Forgetting to renew your SSL certificate is a common mistake website owners do, that is why our tool is very useful for anyone who runs a secure website (HTTPS).'
        ),       
        'How-to-create-an-SSL-Monitoring-check' => array(
            'title' => 'How to create an SSL Monitoring check?',
            'txt' => 'Go to "Monitoring" (left-hand-side menu) and then choose "SSL Monitoring". There you will find a button to create a new monitoring check.<br />
            Select "SSL Monitoring" as the type.<br /><ul><li>Enter the website name and the URL. Also, choose how many days before the expiration of the certificate you would like to be alerted.</li><li>The next step is to select when you would like to be notified if there is a problem with your SSL certificate and how often should we check it. We recommend keeping the default values.</li></ul><br />In the end, choose who will receive the alerts.'
        ),       
        'How-to-see-when-my-SSL-certificate-expires' => array(
            'title' => 'How to see when my SSL certificate expires?',
            'txt' => 'You can see the expiration time in days, as well as the date, at the very top of the SSL monitoring page.<br />
            In this example, apple.com certificate will expire in 268 days, valid until May 19, 2023.<br />
            ' . APP_NAME . ' will regularly load a website to update the certificate expiration date and notifies you in case it will expire soon.'
        ),       
        'How-to-get-alerted-when-there-are-problems-with-my-SSL-certificate' => array(
            'title' => 'How to get alerted when there are problems with my SSL certificate?',
            'txt' => 'You can get alerted when there are problems with your SSL certificate by creating an SSL Monitoring check and specifying who will receive the alerts in case something gets wrong.'
        ),       
        'How-to-get-alerted-when-my-SSL-certificate-is-about-to-expire' => array(
            'title' => 'How to get alerted when my SSL certificate is about to expire?',
            'txt' => 'You can get alerted when your SSL is about to expire by creating an SSL Monitoring check and specifying how many days you would like to be alerted before the certificate will expire.'
        ),     
    ),
    // Alerting & Terms
    'alerting&terms' =>  array(
        'How-can-I-get-alerted-when-there-is-a-problem-with-my-website' => array(
            'title' => 'How can I get alerted when there is a problem with my website?',
            'txt' => 'You can get alerted that there is a problem with your website by adding your contact information (such as an e-mail address or your phone number) to "My Contacts" page ("Reporting" section).<br />
            The next step is to assign your contact to monitoring checks you created. You can do it at the end of the page, where you create and edit monitoring checks.
            Alternatively, you can also edit your contact information there.'
        ), 
        'How-can-I-add-my-contact-information-for-alerting' => array(
            'title' => 'How can I add my contact information for alerting?',
            'txt' => 'You can add your contact information (such as an e-mail address or your phone number) at "My Contacts" page ("Reporting" section).<br />
            Alternatively, you can do it when you create/edit a monitoring check'
        ), 
        'What-types-of-contact-information-do-you-accept-for-alerting' => array(
            'title' => 'What types of contact information do you accept for alerting?',
            'txt' => 'Two most commonly used ways for receiving alerts are e-mail and SMS. <br />
            However, you can also integrate ' . APP_NAME . ' with your favorite services, such as Slack, Webhooks, Discord, Telegram, Pagerduty and many more. That way, you can receive notifications directly from the 3rd party services.<br />
            For more information, check our Integrations page.'
        ), 
        'How-to-setup-specific-times-for-alerting' => array(
            'title' => 'How to setup specific times for alerting?',
            'txt' => 'You can choose to be alerted only on specific days and hours. For example, if you do not work on weekdays and late in the evening, you can exclude all weekdays and choose that you only want to be alerted from 8 to 17 (8 AM to 5 PM). You will find these settings at "Reporting" (left-hand-side menu) -> "My Contacts".<br />
            In case there is an incident with one of your websites, ' . APP_NAME . ' will create an incident, but do not send any alerts if your settings forbid it. An alert will be sent immediately when your working hours start, if it still persists.'
        ), 
        'How-can-I-add-my-team-members-to-my-' . $slug . '-account' => array(
            'title' => 'How can I add my team members to my ' . APP_NAME . ' account?',
            'txt' => 'You can add new team members at "Reporting" (left-hand-side menu) -> "Users". There you will find a list of existing team members (the original owner of an account cannot be removed).
            Click on the "ADD NEW USER" button, and you will be redirected to the next step.
            Enter the full name of your new team member as well as their e-mail address. Alternatively, you can also add multiple e-mail addresses and phone numbers.
            It is also possible to set their working hours to prevent any alerts being sent outside of them.Your new team member will receive an e-mail and will have to confirm their e-mail address to start using ' . APP_NAME . '. All account info will be shared among team members.'
        ), 
        'How-can-I-group-my-team-members-into-teams-inside-of-my-account' => array(
            'title' => 'How can I get alerted when there is a problem with my website?',
            'txt' => 'You can create a new team by going to "Reporting" (left-hand-side menu) -> "Teams".<br />
            There you can click on the "CREATE NEW TEAM" button.The next step is to name the team and include the team members.<br />
            It is also possible to set specific alerting times for the whole team and override their individual settings. Team settings will only be used if the whole team is assigned to receive alerts.<br />
            Once a team is created, you can edit there at the "Teams" page.<br />
            You can assign the whole team to receive the alerts when you create or edit a monitoring check.'
        ) 
    )
);

if(isset($_PARAMS->qa)){
    $list = $qna[$_PARAMS->section];
    $qa = $list[$_PARAMS->qa];
    echo '<div class="header-tall rel flex col aic jcc" style="background: url( ' . THEME . 'images/graph-bg.svg?v=' . time() . ' ) no-repeat center;">
    <div class="qa-ans flex col">
        <h2 class="s24 b900">' . $qa['title'] . ' </h2>
        <p class="s16">' . $qa['txt'] . ' </p>';
        echo '<div class="qans-rel flex col">
        <h2 class="s18 b900">Related Articles</h2>';
            foreach($list as $k => $v):
                if($k != $_PARAMS->qa){
                    echo '<a href="' . BASEURL . 'knowledge-base/' . $_PARAMS->section . '/' . $k . '" class="tdnh s16">' . $v['title']. '</a>';
                }
            endforeach;
        echo '</div>';
    echo '</div></div>';
}else{
    echo '<div class="header-tall small rel flex col aic jcc" style="background: url( ' . THEME . 'images/graph-bg.svg?v=' . time() . ' ) no-repeat center;">
    <h1 class="s50 b900">Knowledge Base<h1>
    <div class="icon-chevron-down s30 chevron anim abs"></div>
    </div>';

    $sections = array(
        'getting-started' => 'Getting Started',
        'general-information' => 'General Information',
        'monitoring-dashboard' => 'Monitoring Dashboard',
        $slug .'-monitoring' => APP_NAME .' Monitoring',
        'speed-monitoring' => 'Speed Monitoring',
        'transaction-monitoring' => 'Transaction Monitoring',
        'real-user-monitoring' => 'Real User Monitoring',
        'ssl-monitoring' => 'SSL Monitoring',
        'alerting&terms' => 'Alerting & Terms',
    );
    echo '<div class="qa-p flex">';
    foreach($sections as $k => $v):
        echo '<div class="qa-block flex col">
            <h2 class="s24 b900">' . $sections[$k] . '</h2>';

            foreach($qna[$k] as $q => $a):
                
                echo '<a href="' . BASEURL . 'knowledge-base/' . $k . '/' . $q . '" class="tdnh s16 flex ass">' . $a['title']. '</a>';

            endforeach;

        echo '</div>';
    endforeach;
    echo '</div>';
    
}
?>
</div>