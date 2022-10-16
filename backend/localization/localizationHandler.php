<?php
    $availableLanguages = array("en", "ru");

    $en_strings = [
        "GAME" => "Game",
        "CHEAT" => "Cheat",
        "PLAN" => "Plan",

        "TITLE_HOME" => "Home",
        "TITLE_LOG_IN" => "Log in",
        "TITLE_SIGN_UP" => "Sign up",
        "TITLE_PENDING_ACTIVATION" => "Pending activation",
        "TITLE_ACCOUNT_ACTIVATION" => "Account activation",
        "TITLE_PASSWORD_RECOVERY" => "Password recovery",
        "TITLE_PASSWORD_RESET" => "Password recovery",
        "TITLE_PROFILE" => "Profile",
        "TITLE_STORE" => "Store",
        "TITLE_RESELLERS" => "Resellers",
        "TITLE_SETTINGS" => "Settings",
        "TITLE_STATUS" => "Status",
        "TITLE_CONTACTS" => "Contacts",
        "TITLE_TERMS_OF_SERVICE" => "Terms of Service",
        "TITLE_PRIVACY_POLICY" => "Privacy policy",
        "TITLE_COOKIE_USAGE" => "Cookie usage",
        "TITLE_HELP" => "Help",
        "TITLE_GETTING_STARTED" => "Getting started",
        "TITLE_FEATURES" => "Features",
        "TITLE_FAQ" => "Frequently asked questions",
        "TITLE_PAYMENT_ISSUES" => "Payment issues",
        "TITLE_SOFTWARE_ISSUES" => "Software issues",
        "TITLE_REPORT_A_BUG" => "Report a bug",
        "TITLE_SUGGEST_A_FEATURE" => "Suggest a feature",
        "TITLE_CONTACT_US" => "Contact us",

        "HEADER_HOME" => "Home",
        "HEADER_HELP" => "Help",
        "HEADER_HELP_GETTING_STARTED" => "Getting started",
        "HEADER_HELP_FEATURES" => "Features",
        "HEADER_HELP_FAQ" => "FAQ",
        "HEADER_HELP_PAYMENT_ISSUES" => "Payment issues",
        "HEADER_HELP_SOFTWARE_ISSUES" => "Software issues",
        "HEADER_HELP_REPORT_A_BUG" => "Report a bug",
        "HEADER_HELP_SUGGEST_A_FEATURE" => "Suggest a feature",
        "HEADER_HELP_CONTACT_SUPPORT" => "No, really, I need help!",
        "HEADER_LANGUAGE_SELECTOR_ENGLISH" => "English",
        "HEADER_LANGUAGE_SELECTOR_RUSSIAN" => "Russian",
        "HEADER_LOG_IN" => "Log in",
        "HEADER_SIGN_UP" => "Sign up",
        "HEADER_DASHBOARD" => "Dashboard",
        "HEADER_LOG_OUT" => "Log out",

        "FOOTER_TERMS_OF_SERVICE" => "Terms of Service",
        "FOOTER_PRIVACY_POLICY" => "Privacy Policy",
        "FOOTER_CONTACTS" => "Contacts",

        "HOME_HEADER_WHY_MAPLE" => "Why Maple?",
        "HOME_HEADER_PRICING" => "Pricing",
        "HOME_HEADER_TESTIMONIALS" => "Testimonials",

        "HOME_MOTTO" => "Become a top player in your favorite games with ease and lots of fun",
        "HOME_DESCRIPTION" => "Maple is the leading provider in the cheating industry, we provide the smoothest legit cheating experience, and we're making it even more accessible to others with our simple and modern user interface.<br><br>Start your journey to the top today with our software!",
        "HOME_PURCHASE_NOW" => "Purchase now",

        "HOME_WHY_MAPLE_DESCRIPTION" => "Well we don't know. But here's a list of cool stuff we provide:",
        "HOME_WHY_MAPLE_RICH_FUNCTIONALITY" => "Rich functionality",
        "HOME_WHY_MAPLE_RICH_FUNCTIONALITY_DESCRIPTION" => "Maple provides a lot of features to play with (more than anyone else on the market!)",
        "HOME_WHY_MAPLE_FREQUENT_UPDATES" => "Frequent updates",
        "HOME_WHY_MAPLE_FREQUENT_UPDATES_DESCRIPTION" => "User satisfaction comes first for us, and we're trying to release updates with new features, fixes, etc. as frequently as possible.",
        "HOME_WHY_MAPLE_BIG_EXPERIENCE" => "Big experience",
        "HOME_WHY_MAPLE_BIG_EXPERIENCE_DESCRIPTION" => "Our team has been working in this area long before Maple.",
        "HOME_WHY_MAPLE_RELIABLE_SECURITY" => "Reliable security",
        "HOME_WHY_MAPLE_RELIABLE_SECURITY_DESCRIPTION" => "We care about our user's accounts, and we're trying our best to protect them from any detections.",
        "HOME_WHY_MAPLE_USER_FRIENDLY_UI" => "User-friendly interface",
        "HOME_WHY_MAPLE_USER_FRIENDLY_UI_DESCRIPTION" => "Our UI is aimed at maximum user convenience and provides a perfect and enjoyable experience.",
        "HOME_WHY_MAPLE_SUPPORT" => "24/7 Support",
        "HOME_WHY_MAPLE_SUPPORT_DESCRIPTION" => "Our team is ready to help you with any problems day and night.",

        "HOME_PRICING_DESCRIPTION" => "Choose your subscription plan below and start your journey to the top today!",

        "HOME_TESTIMONIALS" => "Recent testimonials",
        "HOME_TESTIMONIALS_DESCRIPTION" => "See what others think about Maple",
        "HOME_TESTIMONIALS_NONE" => "None yet!",
        "HOME_TESTIMONIALS_CREATED_ON" => "On",
        "HOME_TESTIMONIALS_ADD_TESTIMONY" => "If you want to add your testimony, please <a href='help/contact-us'>contact us</a>.",

        "AUTH_LOG_IN" => "Log in",
        "AUTH_LOG_IN_USERNAME" => "Username",
        "AUTH_LOG_IN_PASSWORD" => "Password",
        "AUTH_LOG_IN_FORGOT_PASSWORD" => "Forgot your password?",
        "AUTH_LOG_IN_BUTTON" => "Log in",
        "AUTH_LOG_IN_NEED_AN_ACCOUNT" => "Need an account? <a href='signup'>Sign up</a>",
        "AUTH_LOG_IN_CAPTCHA_FAILURE" => "We were unable to verify that you are human",
        "AUTH_LOG_IN_INCORRECT_CREDENTIALS" => "Incorrect username or password",

        "AUTH_SIGN_UP" => "Sign up",
        "AUTH_SIGN_UP_USERNAME" => "Username",
        "AUTH_SIGN_UP_EMAIL" => "Email address",
        "AUTH_SIGN_UP_PASSWORD" => "Password",
        "AUTH_SIGN_UP_PASSWORD_CONFIRM" => "Confirm your password",
        "AUTH_SIGN_UP_TERMS_OF_SERVICE" => "I agree to the <a href='../legal/terms-of-service'>Terms of Service</a>",
        "AUTH_SIGN_UP_BUTTON" => "Sign up",
        "AUTH_SIGN_UP_INVALID_USERNAME" => "Invalid username",
        "AUTH_SIGN_UP_USERNAME_IN_USE" => "This username is already in use",
        "AUTH_SIGN_UP_INVALID_EMAIL" => "Invalid email",
        "AUTH_SIGN_UP_EMAIL_IN_USE" => "This email is already in use",
        "AUTH_SIGN_UP_PASSWORD_MISMATCH" => "Passwords don't match",
        "AUTH_SIGN_UP_CAPTCHA_FAILURE" => "We were unable to verify that you are human",
        "AUTH_SIGN_UP_INVALID_INPUT" => "Please provide a valid input",
        "AUTH_SIGN_UP_UNKNOWN_ERROR" => "Unknown error occurred",

        "AUTH_PENDING_ACTIVATION" => "Account pending activation",
        "AUTH_PENDING_ACTIVATION_DESCRIPTION" => "<p>Your account has been created!</p> <p>Please verify it by clicking the activation link that has been sent to your email.</p> <p>If you're having troubles receiving the link, you can request another activation email at any time.</p>",
        "AUTH_PENDING_ACTIVATION_EMAIL" => "Email address",
        "AUTH_PENDING_ACTIVATION_RESEND" => "Resend",
        "AUTH_PENDING_ACTIVATION_EMAIL_HAS_BEEN_RESENT" => "Activation email has been resent",
        "AUTH_PENDING_ACTIVATION_EMAIL_IN_USE" => "This email is already in use",
        "AUTH_PENDING_ACTIVATION_INVALID_EMAIL" => "Invalid email",
        "AUTH_PENDING_ACTIVATION_UNKNOWN_ERROR" => "Unknown error occurred",

        "AUTH_ACCOUNT_ACTIVATION" => "Account activation",
        "AUTH_ACCOUNT_ACTIVATION_SUCCESS" => "<p>Your account has been successfully activated!</p> <p>You can now access <a href='../dashboard'>dashboard</a>. Thank you for your interest in Maple!</p>",
        "AUTH_ACCOUNT_ACTIVATION_FAIL" => "<p>Sorry, we couldn't find a pending verification matching your request.</p> <p>Make sure you're following a valid link and try again.</p>",

        "AUTH_PASSWORD_RECOVERY" => "Password recovery",
        "AUTH_PASSWORD_RECOVERY_SUCCESS" => "<p>Your password reset request was successful.</p> <p>We have sent you an email with further instructions to recover your account.</p> <p>Check your email including any junk or spam folders.</p>",
        "AUTH_PASSWORD_RECOVERY_EMAIL" => "Email address",
        "AUTH_PASSWORD_RECOVERY_RECOVER" => "Recover password",
        "AUTH_PASSWORD_RECOVERY_ACCOUNT_NOT_FOUND" => "We could not find an account with this email address.",
        "AUTH_PASSWORD_RECOVERY_UNKNOWN_ERROR" => "Unknown error occurred",

        "AUTH_PASSWORD_RESET" => "Password recovery",
        "AUTH_PASSWORD_RESET_SUCCESS" => "<p>Your password has been successfully reset!</p> <p>You can now <a href='login'>log into your account</a>.</p>",
        "AUTH_PASSWORD_RESET_FAIL" => "<p>Sorry, we couldn't find a pending password reset request.</p> <p>Make sure you're following a valid link and try again.</p>",
        "AUTH_PASSWORD_RESET_NEW_PASSWORD" => "New password",
        "AUTH_PASSWORD_RESET_NEW_PASSWORD_CONFIRM" => "Confirm your password",
        "AUTH_PASSWORD_RESET_RECOVER" => "Recover password",
        "AUTH_PASSWORD_RESET_PASSWORD_MISMATCH" => "Passwords don't match",

        "DASHBOARD_HEADER_PROFILE" => "Profile",
        "DASHBOARD_HEADER_STORE" => "Store",
        "DASHBOARD_HEADER_SETTINGS" => "Settings",
        "DASHBOARD_HEADER_STATUS" => "Status",

        "DASHBOARD_PROFILE_WELCOME_BACK" => "Welcome back",
        "DASHBOARD_PROFILE_JOINED_ON" => "Joined on",
        "DASHBOARD_PROFILE_SUBSCRIPTION_STATUS" => "Subscription status",
        "DASHBOARD_PROFILE_SUBSCRIPTION_STATUS_NONE" => "None, <a href='store'>subscribe now!</a>",
        "DASHBOARD_PROFILE_SUBSCRIPTION_STATUS_EXPIRES_ON" => "Expires on",
        "DASHBOARD_PROFILE_SUBSCRIPTION_STATUS_DOWNLOAD_LOADER" => "Download loader",

        "DASHBOARD_STORE" => "Store",
        "DASHBOARD_STORE_CHECKOUT" => "Checkout",
        "DASHBOARD_STORE_CHECKOUT_DEBIT_CREDIT" => "Debit/Credit Card",
        "DASHBOARD_STORE_CHECKOUT_CRYPTOCURRENCY" => "Cryptocurrency",
        "DASHBOARD_STORE_CHECKOUT_RESELLER" => "Reseller",
        "DASHBOARD_STORE_CHECKOUT_BUY_FOR_SOMEONE_ELSE" => "Buy for someone else",
        "DASHBOARD_STORE_CHECKOUT_BUTTON" => "Checkout",
        "DASHBOARD_STORE_PAYMENT_METHOD_NOT_AVAILABLE" => "This payment method is not available yet, check back later!",
        "DASHBOARD_STORE_INVALID_USER_ID" => "Please specify who you want to make a purchase for!",
        "DASHBOARD_STORE_UNKNOWN_PAYMENT_METHOD" => "Unknown payment method!",
        "DASHBOARD_STORE_INTERNAL_ERROR" => "An internal error occurred.",
        "DASHBOARD_STORE_PLAN_NOT_AVAILABLE" => "This product is not available yet.",
        "DASHBOARD_STORE_USER_NOT_FOUND" => "User not found!",
        "DASHBOARD_STORE_TRANSACTION_SUCCESS" => "Your transaction has been completed successfully!",
        "DASHBOARD_STORE_TRANSACTION_CANCELLED" => "Transaction cancelled!",
        "DASHBOARD_STORE_TRANSACTION_FAILED" => "Transaction failed!",

        "DASHBOARD_STORE_RESELLERS" => "Resellers",
        "DASHBOARD_STORE_RESELLERS_NOTE" => "<p>Please don't spam our resellers if they didn't respond as fast as you'd wanted to. Wait patiently for a response instead. They have lives too.</p> <p>If you think one of our resellers is charging way too much (more than the original amount + their fee), please <a href='../../help/contact-us'>report this</a> immediately.</p> <p class='m-0'>Also please triple check reseller's discord handle and ID before proceeding with the payment. We are not responsible for scams done by unofficial resellers.</p>",
        "DASHBOARD_STORE_RESELLERS_PAYMENT_METHODS" => "Payment Methods",
        "DASHBOARD_STORE_RESELLERS_FEE" => "Fee",
        "DASHBOARD_STORE_RESELLERS_TIMEZONE" => "Timezone",

        "DASHBOARD_SETTINGS" => "Settings",
        "DASHBOARD_SETTINGS_SESSIONS" => "Sessions",
        "DASHBOARD_SETTINGS_SESSIONS_SHOW_ALL_SESSIONS" => "Show all sessions",
        "DASHBOARD_SETTINGS_SESSIONS_TERMINATE_ALL_SESSIONS" => "Terminate all sessions",
        "DASHBOARD_SETTINGS_SESSIONS_ACTIVE_SESSIONS" => "Active sessions",
        "DASHBOARD_SETTINGS_SESSIONS_LAST_ACTIVITY" => "Last activity",
        "DASHBOARD_SETTINGS_SESSIONS_TERMINATE" => "Terminate",
        "DASHBOARD_SETTINGS_SESSIONS_CURRENT" => "Current",

        "DASHBOARD_SETTINGS_DISCORD_INTEGRATION" => "Discord integration",
        "DASHBOARD_SETTINGS_DISCORD_INTEGRATION_NO_ACCOUNT_LINKED" => "No account linked",
        "DASHBOARD_SETTINGS_DISCORD_INTEGRATION_LINK" => "Link",
        "DASHBOARD_SETTINGS_DISCORD_INTEGRATION_UNLINK" => "Unlink",

        "DASHBOARD_SETTINGS_PASSWORD" => "Password",
        "DASHBOARD_SETTINGS_PASSWORD_CURRENT_PASSWORD" => "Current password",
        "DASHBOARD_SETTINGS_PASSWORD_NEW_PASSWORD" => "New password",
        "DASHBOARD_SETTINGS_PASSWORD_CONFIRM_NEW_PASSWORD" => "Confirm new password",
        "DASHBOARD_SETTINGS_PASSWORD_CHANGE_PASSWORD" => "Change password",
        "DASHBOARD_SETTINGS_PASSWORD_WRONG_PASSWORD" => "Wrong password",
        "DASHBOARD_SETTINGS_PASSWORD_PASSWORD_MISMATCH" => "Passwords don't match",

        "DASHBOARD_SETTINGS_SESSION_TERMINATED" => "Session has been terminated.",
        "DASHBOARD_SETTINGS_ALL_SESSIONS_TERMINATED" => "All sessions except this one have been terminated.",
        "DASHBOARD_SETTINGS_PASSWORD_CHANGED" => "Your password has been updated.",

        "DASHBOARD_STATUS" => "Status",
        "DASHBOARD_STATUS_LAST_STATUS_UPDATE" => "Last status update",
        "DASHBOARD_STATUS_ANTICHEAT_INFO" => "Anti-cheat info",
        "DASHBOARD_STATUS_ANTICHEAT_INFO_NAME" => "Name",
        "DASHBOARD_STATUS_ANTICHEAT_INFO_FILE_NAME" => "File name",
        "DASHBOARD_STATUS_ANTICHEAT_INFO_FILE_SIZE" => "File size",
        "DASHBOARD_STATUS_ANTICHEAT_INFO_FILE_CHECKSUM" => "File checksum",
        "DASHBOARD_STATUS_ANTICHEAT_INFO_LAST_UPDATE" => "Last update",
        "DASHBOARD_STATUS_ANTICHEAT_INFO_LAST_CHECK" => "Last check",

        "LEGAL_TERMS_OF_SERVICE" => "Terms of Service",
        "LEGAL_TERMS_OF_SERVICE_CONTENT" => "
            <p>By accessing this website, you are agreeing to be bound by this site’s Terms and Conditions of Use, all applicable laws and regulations, and agree that you are responsible for compliance with any applicable local laws. If you do not agree with any of these terms, you are prohibited from using or accessing this site’s content. This website is only available to users who are at least 13 years old. If you are younger than this, please do not register for this site. If you register for this site, you represent that you are this age or older.</p>
            <h4 class='fw-bold'>Use License</h4>
            <p>Permission is granted to temporarily download one copy of the materials (information or software) on this website for personal, noncommercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not</p>
            <ul>
                <li>Use the materials of this website for any commercial purpose.</li>
                <li>Use our services if you, or someone you are in connection with, are associated with anti-cheat development.</li>
                <li>Attempt to decompile, crack, path, debug or reverse engineer any software contained on this website.</li>
                <li>Share your account with a 3rd-party or sell it to a 3rd-party.</li>
            </ul>
            <p>Each copy of the materials is private for the user that acquires it. In case that we find a borrowed/stolen copy, we will invalidate that copy for future updates.</p>
            <p>This license shall automatically terminate if you violate any of these restrictions and may be terminated by the administrator of this website at any time.</p>
            <h4 class='fw-bold'>Product delivery</h4>
            <p>All purchases on this website are automatic.</p>
            <p class='mt-0'>You'll be able to download the software from your <a href='../dashboard'>dashboard</a> as soon as you make the payment.</p>
            <h4 class='fw-bold'>Refund Policy</h4>
            <p>You have the right to request a refund in the event that you are unable to run the software due to an error, a bug or a compatibility issue that cannot be fixed on your end (without the intervention of the developers and a software update). In this case, the administrator will ask you to showcase the issue before proceeding with the refund.</p>
            <p class='mt-0'>Additionally, we will compensate you for the time during which you could not use our products. Such incidents include, but are not limited to technical maintenance, software detections, etc.</p>
            <p class='m-0'>If you wish to request a refund and if you're eligible to do so, please <a href='../help/contact-us.php'>contact us</a>.</p>
            <p class='fw-bold m-0 pt-4'>Updated on October 16th, 2022</p>
        ",

        "LEGAL_PRIVACY_POLICY" => "Privacy policy",
        "LEGAL_PRIVACY_POLICY_CONTENT" => "
            <p>We are Maple ('we', 'our', 'us'). We’re committed to protecting and respecting your privacy. If you have questions about your personal information please <a href='../help/contact-us'>contact us</a>.</p>
            <h4 class='fw-bold'>What information we hold about you</h4>
            <p>The type of data that we collect and process includes:</p>
            <ul>
                <li>Your name or username.</li>
                <li>Your email address.</li>
                <li>Your IP address.</li>
            </ul>
            <p>We collect some or all of this information in the following cases:</p>
            <ul>
                <li>You register as a member on this site.</li>
                <li>You browse this site. See 'Cookie policy' below.</li>
                <li>You fill out fields on your profile.</li>
            </ul>
            <h4 class='fw-bold'>How your personal information is used</h4>
            <p>We may use your personal information in the following ways:</p>
            <ul>
                <li>For the purposes of making you a registered member of our site.</li>
                <li>We may use your email address to inform you of activity on our site.</li>
                <li>Your IP address is recorded when you perform certain actions on our site. Your IP address is never publicly visible.</li>
            </ul>
            <h4 class='fw-bold'>Other ways we may use your personal information.</h4>
            <p>In addition to notifying you of activity on our site which may be relevant to you, from time to time we may wish to communicate with all members any important information such as newsletters or announcements by email. You can opt-in to or opt-out of such emails in your profile.</p>
            <p>We may collect non-personally identifiable information about you in the course of your interaction with our site. This information may include technical information about the browser or type of device you're using. This information will be used purely for the purposes of analytics and tracking the number of visitors to our site.</p>
            <h4 class='fw-bold'>Keeping your data secure</h4>
            <p>We are committed to ensuring that any information you provide to us is secure. In order to prevent unauthorized access or disclosure, we have put in place suitable measures and procedures to safeguard and secure the information that we collect.</p>
            <h4 class='fw-bold'>Cookie policy</h4>
            <p>Cookies are small text files which are set by us on your computer which allow us to provide certain functionality on our site, such as being able to log in, or remembering certain preferences.</p>
            <p>We have a detailed cookie policy and more information about the cookies that we set on <a href='cookie-usage'>this page</a>.</p>
            <h4 class='fw-bold'>Rights</h4>
            <p>You have a right to access the personal data we hold about you or obtain a copy of it. To do so please <a href='../help/contact-us'>contact us</a>. If you believe that the information we hold for you is incomplete or inaccurate, you may <a href='../help/contact-us'>contact us</a> to ask us to complete or correct that information.</p>
            <p>You also have the right to request the erasure of your personal data. Please <a href='../help/contact-us'>contact us</a> if you would like us to remove your personal data.</p>
            <h4 class='fw-bold'>Acceptance of this policy</h4>
            <p>Continued use of our site signifies your acceptance of this policy. If you do not accept the policy then please do not use this site. When registering we will further request your explicit acceptance of the privacy policy.</p>
            <h4 class='fw-bold'>Changes to this policy</h4>
            <p>We may make changes to this policy at any time. You may be asked to review and re-accept the information in this policy if it changes in the future.</p>
            <h4 class='fw-bold'>CAPTCHA Policy</h4>
            <p class='m-0'>This site is protected by reCAPTCHA and the Google <a href='https://policies.google.com/privacy'>privacy policy</a> and <a href='https://policies.google.com/terms'>terms of service</a> apply.</p>
        ",

        "LEGAL_COOKIE_USAGE" => "Cookie usage",
        "LEGAL_COOKIE_USAGE_CONTENT" => "
            <p>This page discusses how cookies are used by this site. If you continue to use this site, you are consenting to our use of cookies.</p>
            <h4 class='fw-bold'>What are cookies?</h4>
            <p>Cookies are small text files stored on your computer by your web browser at the request of a site you're viewing. This allows the site you're viewing to remember things about you, such as your preferences and history or to keep you logged in.</p>
            <p>Cookies may be stored on your computer for a short time (such as only while your browser is open) or for an extended period of time, even years. Cookies not set by this site will not be accessible to us.</p>
            <h4 class='fw-bold'>Our cookie usage</h4>
            <p>This site uses cookies for numerous things, including:</p>
            <ul>
                <li>Registration and maintaining your preferences. This includes ensuring that you can stay logged in and keeping the site in the language or appearance that you requested.</li>
                <li>Analytics. This allows us to determine how people are using the site and improve it.</li>
            </ul>
            <h4 class='fw-bold'>Standard cookies we set</h4>
            <p>These are the main cookies we set during normal operation of the software.</p>
            <ul>
                <li>
                    <b>m_Session</b>
                    <ul>
                        <li>Stores a key, unique to you, which allows us to keep you logged in as you navigate from page to page.</li>
                    </ul>
                </li>
                <li>
                    <b>m_Language</b>
                    <ul>
                        <li>Stores a language you've selected on this website.</li>
                    </ul>
                </li>
            </ul>
            <h4 class='fw-bold'>Additional cookies and those set by third parties</h4>
            <p>Additional cookies may be set during the use of the site to remember information as certain actions are being performed, or remembering certain preferences.</p>
            <p>Other cookies may be set by third party service providers which may provide information such as tracking anonymously which users are visiting the site, or set by content embedded into some pages, such as YouTube or other media service providers.</p>
            <h4 class='fw-bold'>Removing/disabling cookies</h4>
            <p>Managing your cookies and cookie preferences must be done from within your browser's options/preferences. Here is a list of guides on how to do this for popular browser software:</p>
            <ul>
                <li><a href='https://support.microsoft.com/en-gb/help/17442/windows-internet-explorer-delete-manage-cookies'>Microsoft Internet Explorer</a></li>
                <li><a href='https://privacy.microsoft.com/en-us/windows-10-microsoft-edge-and-privacy'>Microsoft Edge</a></li>
                <li><a href='https://support.mozilla.org/en-US/kb/cookies-information-websites-store-on-your-computer'>Mozilla Firefox</a></li>
                <li><a href='https://support.google.com/chrome/answer/95647?hl=en'>Google Chrome</a></li>
                <li><a href='https://support.apple.com/en-gb/guide/safari/manage-cookies-and-website-data-sfri11471/mac'>Safari for macOS</a></li>
                <li><a href='https://support.apple.com/en-gb/HT201265'>Safari for iOS</a></li>
            </ul>
            <h4 class='fw-bold'>More information about cookies</h4>
            <p class='m-0'>To learn more about cookies, and find more information about blocking certain types of cookies, please visit the <a href='https://ico.org.uk/for-the-public/online/cookies/'>ICO website Cookies page</a>.</p>
        ",

        "LEGAL_CONTACTS" => "Contacts",
        "LEGAL_CONTACTS_CONTENT" => "
            <h4 class='fw-bold'>Contacts</h4>
            <p><b>SP</b> Cherepanov Mikhail Denisovich</p>
            <p><b>TIN:</b> 673108418544</p>
            <p><b>PSRN:</b> 322673300016180</p>
            <p><b>Email:</b> mrflashstudio@gmail.com</p>
            <p>Russia, Smolensk</p>
            
            <h4 class='fw-bold pt-4'>We accept</h4>
            <img class='m-0' src='../assets/web/images/contacts/visa.svg' width='64' height='32'>
            <img class='m-0' src='../assets/web/images/contacts/mc.svg' width='54' height='64'>
            <img class='m-0' src='../assets/web/images/contacts/btc.svg' width='32' height='32'>
            <img class='m-0' src='../assets/web/images/contacts/ltc.svg' width='32' height='32'>
            <p class='m-0'>Automatic purchase. You will be able to download the product from your dashboard immediately after you make the purchase.</p>
        ",

        "HELP" => "Help",
        "HELP_CONTENT" => "
            <h4 class='fw-bold'>Need help? This section will help you find out the answers to all important questions.</h4>
            <h4 class='fw-bold'><a href='getting-started'>Getting started</a></h4>
            <p>A detailed guide to buying and launching Maple.</p>
            <h4 class='fw-bold'><a href='features'>Features</a></h4>
            <p>Take a look at what we have to offer.</p>
            <h4 class='fw-bold'><a href='faq'>F.A.Q</a></h4>
            <p>Frequently asked questions.</p>
            <h4 class='fw-bold'><a href='payment-issues'>Payment issues</a></h4>
            <p>Having trouble buying Maple? We have solutions to various payment issues.</p>
            <h4 class='fw-bold'><a href='software-issues'>Software issues</a></h4>
            <p>Can't use Maple for some reason? We have solutions to various issues that may occur at launch or during gameplay.</p>
            <h4 class='fw-bold'><a href='report-a-bug'>Report a bug</a></h4>
            <p>Found a bug and want to report it? Feel free to do so!</p>
            <h4 class='fw-bold'><a href='suggest-a-feature'>Suggest a feature</a></h4>
            <p>Got some cool feature in mind? Feel free to let us know about it!</p>
            <h4 class='fw-bold'><a href='contact-us'>No, really, I need help!</a></h4>
            <p class='m-0'>Didn't find a solution to your problem? Feel free to contact us!</p>
        ",

        "HELP_GETTING_STARTED" => "Getting started",
        "HELP_GETTING_STARTED_CONTENT" => "
            <h4 class='fw-bold'>Creating an account</h4>
            <p>You can create an account on <a href='../auth/signup'>this page</a>.</p>
            <h4 class='fw-bold'>Getting a subscription</h4>
            <p>Once you've created an account, go to the <a href='../dashboard/store'>store page</a>. Select the desired subscription plan and payment method and proceed to payment.</p>
            <h4 class='fw-bold'>Downloading the loader</h4>
            <p>Once you've made the payment, you'll be able to download Maple Loader from your <a href='../dashboard'>dashboard</a>.</p>
            <h4 class='fw-bold'>Running Maple</h4>
            <p>Launch Maple Loader, enter your credentials and click <b>Login</b>. Now, select the cheat you want to load, click <b>Load</b> and wait for it to inject.</p>
            <h4 class='fw-bold'>Requirements</h4>
            <ul class='m-0'>
                <li>You antivirus may flag our loader as a virus, so please disable it.</li>
                <li>Windows 10 or newer. (21H2 or older)</li>
                <li><a href='https://aka.ms/vs/17/release/vc_redist.x64.exe'>Visual C++ Redistributable x64</a> and <a href='https://aka.ms/vs/17/release/vc_redist.x86.exe'>Visual C++ Redistributable x86</a>.</li>
                <li><a href='https://dotnet.microsoft.com/en-us/download/dotnet-framework/net48'>Latest .net framework</a>.</li>
            </ul>
        ",

        "HELP_FEATURES" => "Features",

        "HELP_FAQ" => "Frequently asked questions",
        "HELP_FAQ_CONTENT" => "
            <h4 class='fw-bold'>Who founded the Maple project?</h4>
            <p>Maple was founded by <b>Maple Syrup</b> and <b>Azuki</b>.</p>
            <h4 class='fw-bold'>When will Maple Full be released?</h4>
            <p>Release date of Maple Full is TBA, sorry. Please wait patiently.</p>
            <h4 class='fw-bold'>Can I have a trial for Maple before buying it?</h4>
            <p>We do not offer trials.</p>
            <h4 class='fw-bold'>Can I get banned?</h4>
            <p>Any cheat can get you banned, Maple can get detected by osu!'s anti-cheat measures at any point in time. However, we're doing our best to prevent this from happening.</p>
            <h4 class='fw-bold'>What will happen if Maple gets detected?</h4>
            <p>We'll update detection status in loader and make an announcement on our <a href='../discord'>discord server</a>. All users will be compensated after we push a fix.</p>
            <h4 class='fw-bold'>osu! got an update, can I still use Maple?</h4>
            <p>Maple is developed in a way that it can still be used after most updates. However, if it gets outdated, we will try our best to fix it as quickly as possible and will compensate everyone for the wait.</p>
            <h4 class='fw-bold'>Can I request a refund?</h4>
            <p class='m-0'>Yes! But please read our <a href='../legal/terms-of-service'>Terms of Service</a> before proceeding.</p>
        ",

        "HELP_PAYMENT_ISSUES" => "Payment issues",
        "HELP_PAYMENT_ISSUES_CONTENT" => "
            <h4 class='fw-bold'>What payment methods can I use?</h4>
            <p>You can use Debit/Credit Cards, Bitcoin, Litecoin and a bunch of other payment methods that our <a href='../dashboard/store/resellers'>resellers</a> accept.</p>
            <h4 class='fw-bold'>I didn't receive my subscription after I made the payment!</h4>
            <p class='m-0'>In cases like this, please <a href='contact-us'>contact us</a> and include the following information:</p>
            <ul class='m-0'>
                <li>The payment method you used.</li>
                <li>The date and time of the transaction.</li>
                <li>The product you've bought.</li>
                <li>Your User ID.</li>
            </ul>
        ",

        "HELP_SOFTWARE_ISSUES" => "Software issues",
        "HELP_SOFTWARE_ISSUES_CONTENT" => "
            <h4 class='fw-bold'>MSVCP140.dll was not found</h4>
            <p>Install <a href='https://aka.ms/vs/17/release/vc_redist.x64.exe'>Visual C++ Redistributable x64</a> and <a href='https://aka.ms/vs/17/release/vc_redist.x86.exe'>Visual C++ Redistributable x86</a>. Reboot and try again.</p>
            <h4 class='fw-bold'>d3dx9_43.dll was not found</h4>
            <p>Install <a href='https://www.microsoft.com/en-us/download/details.aspx?id=35'>DirectX End-User Runtime</a>. Reboot and try again.</p>
            <h4 class='fw-bold'>'Fatal error occurred: your time is our of sync!'</h4>
            <p>Sync your system time.</p>
            <video class='w-75' controls>
                <source src='../assets/web/videos/help/timesync.mp4?v1.1' type='video/mp4'>
            </video>
            <h4 class='fw-bold'>Injection failed after 3 retries</h4>
            <p>Reboot and try again. If it still happens, please <a href='contact-us'>contact us</a> and tell us the error code.</p>
            <h4 class='fw-bold'>The game crashes on injection</h4>
            <p>
            <ul>
                <li> Disable your antivirus and everything in <b>Windows Defender's</b> <b>Exploit Protection</b> and <b>Core Isolation</b> settings. </li>
                <li>Disable kernel-level anticheats (e.g. <b>Vanguard</b>).</li>
                <li>Reboot and try again.</li>
            </ul>
            </p>
            <h4 class='fw-bold'>The game crashes while playing</h4>
            <p>Disable kernel-level anticheats (e.g. <b>Vanguard</b>).</p>
            <h4 class='fw-bold'>The menu doesn't show up after injection</h4>
            <p class='m-0'>Disable <b>all</b> 3rd-party overlays (e.g. <b>Discord</b>, <b>Steam</b>, <b>Overwolf</b>, <b>RivaTuner (MSI Afterburner overlay)</b>, <b>Xbox Game Bar</b>, <b>Geforce Experience overlay</b>).</p>
        ",

        "HELP_REPORT_A_BUG" => "Report a bug",
        "HELP_REPORT_A_BUG_CONTENT" => "
            <h4 class='fw-bold'>How can I report a bug?</h4>
            <p>
                You can report a bug by opening a new issue in our <a href='https://github.com/maplesyrupuwu/Maple-tracker-for-osu'>GitHub repository</a>. Alternatively you can also do so in the <b>#bug-reports</b> channel on our <a href='../discord'>discord server</a>, but we highly encourage everyone to use <b>GitHub</b> instead because it's much more organized.
            </p>
            <p>
                When making a bug report, please use the following format:
                <ul>
                    <li>A clear and concise description of what the bug is.</li>
                    <li>
                        Steps we can use to reproduce the bug, for example:
                        <ul>
                            <li>Go to <b>X</b>.</li>
                            <li>Enable <b>Y</b>.</li>
                            <li>Do <b>Z</b>.</li>
                            <li>etc.</li>
                        </ul>
                    </li>
                    <li>
                        Additional information. This can be a video and/or a screenshot showing the issue. You can also attach game and Event Viewer logs (we really appreciate that so please attach them if possible!). Of course, feel free to leave out any sensitive or personal information.
                    </li>
                </ul>
            </p>
            <h4 class='fw-bold'>How do I get the game logs? (osu!)</h4>
            <p>
                <b>Note: you should do all of this BEFORE the crash, because osu! clears the log files on each launch.</b>
                <ul>
                    <li>Launch osu!.</li>
                    <li>Go to the <b>Options</b> and click <b>Open osu! folder</b> button.</li>
                    <li>Find the <b>Logs</b> directory in the window that opens.</li>
                    <li><b>runtime.log</b> file is the log you need to include.</li>
                </ul>
            </p>
            <h4 class='fw-bold'>How do I get the Event Viewer logs? (osu!)</h4>
            <ul class='m-0'>
                <li>After osu! has crashed, press <b>Win</b> + <b>R</b> to open the run box.</li>
                <li>In the run box type <b><i>eventvwr</i></b> and press <b>Enter</b>. This will open the Event Viewer.</li>
                <li>In Event Viewer, on the left, click <b>Windows Logs</b> and then <b>Application</b>.</li>
                <li>On the right, click <b>Filter current log</b>.</li>
                <li>On the filter window that opens, make sure you have the <b>Error</b> box checked and click <b>OK</b>.</li>
                <li>Press <b>Ctrl</b> + <b>F</b> and type osu! in the find box. It will find the first crash log from osu!.</li>
                <li>Go into the <b>Details</b> tab, expand <b>System</b> and <b>Event Data</b> by clicking on each of them.</li>
                <li>Copy the text from there and paste it into your bug report.</li>
            </ul>
        ",

        "HELP_SUGGEST_A_FEATURE" => "Suggest a feature",
        "HELP_SUGGEST_A_FEATURE_CONTENT" => "
            <h4 class='fw-bold'>How can I suggest a feature?</h4>
            <p class='m-0'>
                You can suggest a feature by opening a new issue in our <a href='https://github.com/maplesyrupuwu/Maple-tracker-for-osu'>GitHub repository</a>. Alternatively you can also do so in the <b>#suggestions</b> channel on our <a href='../discord'>discord server</a>, but we highly encourage everyone to use <b>GitHub</b> instead because it's much more organized.
            </p>
        ",

        "HELP_CONTACT_US" => "Contact us",
        "HELP_CONTACT_US_CONTENT" => "
            <h4 class='fw-bold'>You can reach out to us</h4>
            <ul class='m-0'>
                <li>on <a href='../discord'>our discord server</a></li>
                <li>in one of administrator's Discord DMs: <b>Maple Syrup#1011</b> or <b>Azuki#7911</b></li>
                <li>or by shooting an email at <b><a href='mailto:support@maple.software'>support@maple.software</a></b></li>
            </ul>
        "
    ];

    $ru_strings = [
        "GAME" => "Игра",
        "CHEAT" => "Чит",
        "PLAN" => "План",

        "TITLE_HOME" => "Главная",
        "TITLE_LOG_IN" => "Вход",
        "TITLE_SIGN_UP" => "Регистрация",
        "TITLE_PENDING_ACTIVATION" => "Требуется активация аккаунта",
        "TITLE_ACCOUNT_ACTIVATION" => "Активация аккаунта",
        "TITLE_PASSWORD_RECOVERY" => "Восстановление пароля",
        "TITLE_PASSWORD_RESET" => "Восстановление пароля",
        "TITLE_PROFILE" => "Профиль",
        "TITLE_STORE" => "Магазин",
        "TITLE_RESELLERS" => "Реселлеры",
        "TITLE_SETTINGS" => "Настройки",
        "TITLE_STATUS" => "Статус",
        "TITLE_CONTACTS" => "Контакты",
        "TITLE_TERMS_OF_SERVICE" => "Условия использования",
        "TITLE_PRIVACY_POLICY" => "Условия конфиденциальности",
        "TITLE_COOKIE_USAGE" => "Использование файлов cookie",
        "TITLE_HELP" => "Помощь",
        "TITLE_GETTING_STARTED" => "Инструкция",
        "TITLE_FEATURES" => "Функционал",
        "TITLE_FAQ" => "Часто задаваемые вопросы",
        "TITLE_PAYMENT_ISSUES" => "Проблемы с платежами",
        "TITLE_SOFTWARE_ISSUES" => "Проблемы с ПО",
        "TITLE_REPORT_A_BUG" => "Сообщить о баге",
        "TITLE_SUGGEST_A_FEATURE" => "Предложить функционал",
        "TITLE_CONTACT_US" => "Связатсья с нами",

        "HEADER_HOME" => "Домой",
        "HEADER_HELP" => "Помощь",
        "HEADER_HELP_GETTING_STARTED" => "Инструкция",
        "HEADER_HELP_FEATURES" => "Функционал",
        "HEADER_HELP_FAQ" => "Часто задаваемые вопросы",
        "HEADER_HELP_PAYMENT_ISSUES" => "Проблемы с платежами",
        "HEADER_HELP_SOFTWARE_ISSUES" => "Проблемы с ПО",
        "HEADER_HELP_REPORT_A_BUG" => "Сообщить о баге",
        "HEADER_HELP_SUGGEST_A_FEATURE" => "Предложить функционал",
        "HEADER_HELP_CONTACT_SUPPORT" => "Нет, серьезно, мне нужна помощь!",
        "HEADER_LANGUAGE_SELECTOR_ENGLISH" => "Английский",
        "HEADER_LANGUAGE_SELECTOR_RUSSIAN" => "Русский",
        "HEADER_LOG_IN" => "Войти",
        "HEADER_SIGN_UP" => "Зарегистрироваться",
        "HEADER_DASHBOARD" => "Профиль",
        "HEADER_LOG_OUT" => "Выйти",

        "FOOTER_TERMS_OF_SERVICE" => "Условия использования",
        "FOOTER_PRIVACY_POLICY" => "Политика конфиденциальности",
        "FOOTER_CONTACTS" => "Контакты",

        "HOME_HEADER_WHY_MAPLE" => "Почему Maple?",
        "HOME_HEADER_PRICING" => "Цена",
        "HOME_HEADER_TESTIMONIALS" => "Отзывы",

        "HOME_MOTTO" => "Станьте лучшим игроком в своих любимых играх легко и с удовольствием",
        "HOME_DESCRIPTION" => "Maple – ведущий разработчик читов. Мы обеспечиваем наилучший опыт легитной игры и делаем его еще более доступным для других благодаря простому и современному пользовательскому интерфейсу.<br><br>Начните свое путешествие к вершине сегодня с нашими продуктами!",
        "HOME_PURCHASE_NOW" => "Приобрести",

        "HOME_WHY_MAPLE_DESCRIPTION" => "Вообще-то мы и сами не знаем. Но вот список крутых вещей, которые мы можем предложить:",
        "HOME_WHY_MAPLE_RICH_FUNCTIONALITY" => "Богатый функционал",
        "HOME_WHY_MAPLE_RICH_FUNCTIONALITY_DESCRIPTION" => "Maple предоставляет огромный функционал (больше, чем кто-либо другой на рынке!)",
        "HOME_WHY_MAPLE_FREQUENT_UPDATES" => "Частые обновления",
        "HOME_WHY_MAPLE_FREQUENT_UPDATES_DESCRIPTION" => "Удовлетворенность пользователей стоит для нас на первом месте, поэтому мы стараемся выпускать обновления с новыми функциями, исправлениями и т.д. как можно чаще.",
        "HOME_WHY_MAPLE_BIG_EXPERIENCE" => "Большой опыт",
        "HOME_WHY_MAPLE_BIG_EXPERIENCE_DESCRIPTION" => "Наша команда работала в этой области задолго до Maple.",
        "HOME_WHY_MAPLE_RELIABLE_SECURITY" => "Надежная защита",
        "HOME_WHY_MAPLE_RELIABLE_SECURITY_DESCRIPTION" => "Мы заботимся об игровых аккаунтах наших пользователей и делаем все возможное, чтобы защитить их от блокировок.",
        "HOME_WHY_MAPLE_USER_FRIENDLY_UI" => "Удобный интерфейс",
        "HOME_WHY_MAPLE_USER_FRIENDLY_UI_DESCRIPTION" => "Наш пользовательский интерфейс направлен на максимальное удобство пользователя и обеспечивает идеальный и приятный опыт.",
        "HOME_WHY_MAPLE_SUPPORT" => "Поддержка 24/7",
        "HOME_WHY_MAPLE_SUPPORT_DESCRIPTION" => "Наша команда готова помочь вам с любыми проблемами днем и ночью.",

        "HOME_PRICING_DESCRIPTION" => "Выберите план подписки ниже и начните свой путь к вершине уже сегодня!",

        "HOME_TESTIMONIALS" => "Последние отзывы",
        "HOME_TESTIMONIALS_DESCRIPTION" => "Посмотрите, что другие думают о Maple",
        "HOME_TESTIMONIALS_NONE" => "Здесь пока пусто. Будьте первым!",
        "HOME_TESTIMONIALS_CREATED_ON" => "Добавлен",
        "HOME_TESTIMONIALS_ADD_TESTIMONY" => "Если вы хотите добавить свой отзыв, пожалуйста, <a href='help/contact-us'>свяжитесь с нами</a>.",

        "AUTH_LOG_IN" => "Вход",
        "AUTH_LOG_IN_USERNAME" => "Имя пользователя",
        "AUTH_LOG_IN_PASSWORD" => "Пароль",
        "AUTH_LOG_IN_FORGOT_PASSWORD" => "Забыли пароль?",
        "AUTH_LOG_IN_BUTTON" => "Войти",
        "AUTH_LOG_IN_NEED_AN_ACCOUNT" => "Нет учетной записи? <a href='signup'>Зарегистрироваться</a>",
        "AUTH_LOG_IN_CAPTCHA_FAILURE" => "Мы не смогли убедиться в том, что вы человек",
        "AUTH_LOG_IN_INCORRECT_CREDENTIALS" => "Неверное имя пользователя или пароль",

        "AUTH_SIGN_UP" => "Регистрация",
        "AUTH_SIGN_UP_USERNAME" => "Имя пользователя",
        "AUTH_SIGN_UP_EMAIL" => "Адрес электронной почты",
        "AUTH_SIGN_UP_PASSWORD" => "Пароль",
        "AUTH_SIGN_UP_PASSWORD_CONFIRM" => "Подтверждение пароля",
        "AUTH_SIGN_UP_TERMS_OF_SERVICE" => "Я согласен(на) с <a href='../legal/terms-of-service'>условиями использования</a>",
        "AUTH_SIGN_UP_BUTTON" => "Зарегистрироваться",
        "AUTH_SIGN_UP_INVALID_USERNAME" => "Некорректное имя пользователя",
        "AUTH_SIGN_UP_USERNAME_IN_USE" => "Это имя пользователя уже используется",
        "AUTH_SIGN_UP_INVALID_EMAIL" => "Некорректный адрес электронной почты",
        "AUTH_SIGN_UP_EMAIL_IN_USE" => "Этот адрес электронной почты уже используется",
        "AUTH_SIGN_UP_PASSWORD_MISMATCH" => "Пароли не совпадают",
        "AUTH_SIGN_UP_CAPTCHA_FAILURE" => "Нам не удалось убедиться в том, что вы человек",
        "AUTH_SIGN_UP_INVALID_INPUT" => "Пожалуйста введите корректные данные",
        "AUTH_SIGN_UP_UNKNOWN_ERROR" => "Произошла неизвестная ошибка",

        "AUTH_PENDING_ACTIVATION" => "Требуется подтверждение аккаунта",
        "AUTH_PENDING_ACTIVATION_DESCRIPTION" => "<p>Ваш аккаунт был успешно создан!</p> <p>Пожалуйста, подтвердите его перейдя по ссылке, которую мы прислали вам на электронную почту.</p> <p>Вы можете запросить повторное письмо активации в любое время, если вы его не получили.</p>",
        "AUTH_PENDING_ACTIVATION_EMAIL" => "Адрес электронной почты",
        "AUTH_PENDING_ACTIVATION_RESEND" => "Отправить",
        "AUTH_PENDING_ACTIVATION_EMAIL_HAS_BEEN_RESENT" => "Письмо было отправлено",
        "AUTH_PENDING_ACTIVATION_EMAIL_IN_USE" => "Этот адрес электронной почты уже используется",
        "AUTH_PENDING_ACTIVATION_INVALID_EMAIL" => "Некорректный адрес электронной почты",
        "AUTH_PENDING_ACTIVATION_UNKNOWN_ERROR" => "Произошла неизвестная ошибка",

        "AUTH_ACCOUNT_ACTIVATION" => "Активация аккаунта",
        "AUTH_ACCOUNT_ACTIVATION_SUCCESS" => "<p>Ваш аккаунт был успешно активирован!</p> <p>Теперь вы можете перейти в свой <a href='../dashboard'>профиль</a>. Мы благодарим вас за ваш интерес в Maple!</p>",
        "AUTH_ACCOUNT_ACTIVATION_FAIL" => "<p>Простите, мы не смогли найти аккаунт, требующий активации, подходящий под ваш запрос.</p> <p>Убедитесь в том, что вы переходите по правильной ссылке и попробуйте еще раз.</p>",

        "AUTH_PASSWORD_RECOVERY" => "Восстановление пароля",
        "AUTH_PASSWORD_RECOVERY_SUCCESS" => "<p>Запрос на восстановление пароля был успешно отправлен.</p> <p>Мы отправили письмо с дальнейшими инструкциями на вашу электронную почту.</p> <p>Проверьте папку спам если вы не можете найти письмо.</p>",
        "AUTH_PASSWORD_RECOVERY_EMAIL" => "Адрес электронной почты",
        "AUTH_PASSWORD_RECOVERY_RECOVER" => "Восстановить пароль",
        "AUTH_PASSWORD_RECOVERY_ACCOUNT_NOT_FOUND" => "Аккаунт, к которому привязана указанная вами почта, не найден.",
        "AUTH_PASSWORD_RECOVERY_UNKNOWN_ERROR" => "Произошла неизвестная ошибка",

        "AUTH_PASSWORD_RESET" => "Восстановление пароля",
        "AUTH_PASSWORD_RESET_SUCCESS" => "<p>Ваш пароль был успешо восстановлен!</p> <p>Теперь вы можете <a href='login'>войти в ваш аккаунт</a>.</p>",
        "AUTH_PASSWORD_RESET_FAIL" => "<p>Простите, мы не смогли найти запрос на восстановление пароля.</p> <p>Убедитесь в том, что вы переходите по правильной ссылке и попробуйте еще раз.</p>",
        "AUTH_PASSWORD_RESET_NEW_PASSWORD" => "Новый пароль",
        "AUTH_PASSWORD_RESET_NEW_PASSWORD_CONFIRM" => "Подтверждение пароля",
        "AUTH_PASSWORD_RESET_RECOVER" => "Восстановить пароль",
        "AUTH_PASSWORD_RESET_PASSWORD_MISMATCH" => "Пароли не совпадают",

        "DASHBOARD_HEADER_PROFILE" => "Профиль",
        "DASHBOARD_HEADER_STORE" => "Магазин",
        "DASHBOARD_HEADER_SETTINGS" => "Настройки",
        "DASHBOARD_HEADER_STATUS" => "Статус",

        "DASHBOARD_PROFILE_WELCOME_BACK" => "Добро пожаловать",
        "DASHBOARD_PROFILE_JOINED_ON" => "Присоединился",
        "DASHBOARD_PROFILE_SUBSCRIPTION_STATUS" => "Подписки",
        "DASHBOARD_PROFILE_SUBSCRIPTION_STATUS_NONE" => "Здесь пока пусто. <a href='store'>Подпишитесь</a> сейчас!",
        "DASHBOARD_PROFILE_SUBSCRIPTION_STATUS_EXPIRES_ON" => "Истекает",
        "DASHBOARD_PROFILE_SUBSCRIPTION_STATUS_DOWNLOAD_LOADER" => "Скачать loader",

        "DASHBOARD_STORE" => "Магазин",
        "DASHBOARD_STORE_CHECKOUT" => "Оплата",
        "DASHBOARD_STORE_CHECKOUT_DEBIT_CREDIT" => "Дебитовая/Кредитная Карта",
        "DASHBOARD_STORE_CHECKOUT_CRYPTOCURRENCY" => "Криптовалюта",
        "DASHBOARD_STORE_CHECKOUT_RESELLER" => "Реселлер",
        "DASHBOARD_STORE_CHECKOUT_BUY_FOR_SOMEONE_ELSE" => "Купить для другого пользователя",
        "DASHBOARD_STORE_CHECKOUT_BUTTON" => "Оплатить",
        "DASHBOARD_STORE_PAYMENT_METHOD_NOT_AVAILABLE" => "Этот способ оплаты пока недоступен, попробуйте еще раз позднее!",
        "DASHBOARD_STORE_INVALID_USER_ID" => "Пожалуйста, укажите, для кого вы хотите сделать покупку!",
        "DASHBOARD_STORE_UNKNOWN_PAYMENT_METHOD" => "Неизвестный способ оплаты!",
        "DASHBOARD_STORE_INTERNAL_ERROR" => "Произошла внутренняя ошибка.",
        "DASHBOARD_STORE_PLAN_NOT_AVAILABLE" => "Этот продукт недоступен.",
        "DASHBOARD_STORE_USER_NOT_FOUND" => "Пользователь не найден!",
        "DASHBOARD_STORE_TRANSACTION_SUCCESS" => "Оплата прошла успешно!",
        "DASHBOARD_STORE_TRANSACTION_CANCELLED" => "Оплата отменена!",
        "DASHBOARD_STORE_TRANSACTION_FAILED" => "Оплата не удалась!",

        "DASHBOARD_STORE_RESELLERS" => "Реселлеры",
        "DASHBOARD_STORE_RESELLERS_NOTE" => "<p>Пожалуйста, не спамьте нашим реселлерам если они вам не отвечают настолько быстро, насколько вам хотелось бы. Вместо этого терпеливо подождите пока они не ответят. У них тоже есть своя жизнь.</p> <p>Если вы считаете, что какой-то из наших реселлеров просит вас заплатить слишком много (больше, чем изначальная цена продукта + комиссия реселлера), немедленно <a href='../../help/contact-us'>сообщите об этом</a>.</p> <p class='m-0'>Также, пожалуйста, трижды проверьте Discord Handle и Discord ID реселлера, прежде чем приступить к оплате. Мы не несем ответственности за мошенничество со стороны неофициальных реселлеров.</p>",
        "DASHBOARD_STORE_RESELLERS_PAYMENT_METHODS" => "Способы Оплаты",
        "DASHBOARD_STORE_RESELLERS_FEE" => "Комиссия",
        "DASHBOARD_STORE_RESELLERS_TIMEZONE" => "Часовой Пояс",

        "DASHBOARD_SETTINGS" => "Настройки",
        "DASHBOARD_SETTINGS_SESSIONS" => "Сеансы",
        "DASHBOARD_SETTINGS_SESSIONS_SHOW_ALL_SESSIONS" => "Показать все сеансы",
        "DASHBOARD_SETTINGS_SESSIONS_TERMINATE_ALL_SESSIONS" => "Завершить все сеансы",
        "DASHBOARD_SETTINGS_SESSIONS_ACTIVE_SESSIONS" => "Активные сеансы",
        "DASHBOARD_SETTINGS_SESSIONS_LAST_ACTIVITY" => "Последняя активность",
        "DASHBOARD_SETTINGS_SESSIONS_TERMINATE" => "Завершить",
        "DASHBOARD_SETTINGS_SESSIONS_CURRENT" => "Текущий",

        "DASHBOARD_SETTINGS_DISCORD_INTEGRATION" => "Интеграция с Discord",
        "DASHBOARD_SETTINGS_DISCORD_INTEGRATION_NO_ACCOUNT_LINKED" => "Аккаунт не привязан",
        "DASHBOARD_SETTINGS_DISCORD_INTEGRATION_LINK" => "Привязать",
        "DASHBOARD_SETTINGS_DISCORD_INTEGRATION_UNLINK" => "Отвязать",

        "DASHBOARD_SETTINGS_PASSWORD" => "Пароль",
        "DASHBOARD_SETTINGS_PASSWORD_CURRENT_PASSWORD" => "Текущий пароль",
        "DASHBOARD_SETTINGS_PASSWORD_NEW_PASSWORD" => "Новый пароль",
        "DASHBOARD_SETTINGS_PASSWORD_CONFIRM_NEW_PASSWORD" => "Подтверждение нового пароля",
        "DASHBOARD_SETTINGS_PASSWORD_CHANGE_PASSWORD" => "Сменить пароль",
        "DASHBOARD_SETTINGS_PASSWORD_WRONG_PASSWORD" => "Неверный пароль",
        "DASHBOARD_SETTINGS_PASSWORD_PASSWORD_MISMATCH" => "Пароли не совпадают",

        "DASHBOARD_SETTINGS_SESSION_TERMINATED" => "Сеанс был завершен.",
        "DASHBOARD_SETTINGS_ALL_SESSIONS_TERMINATED" => "Все сеансы кроме этого были завершены.",
        "DASHBOARD_SETTINGS_PASSWORD_CHANGED" => "Ваш пароль был обновлен.",

        "DASHBOARD_STATUS" => "Статус",
        "DASHBOARD_STATUS_LAST_STATUS_UPDATE" => "Последнее обновление статуса",
        "DASHBOARD_STATUS_ANTICHEAT_INFO" => "Информация об античите",
        "DASHBOARD_STATUS_ANTICHEAT_INFO_NAME" => "Название",
        "DASHBOARD_STATUS_ANTICHEAT_INFO_FILE_NAME" => "Имя файла",
        "DASHBOARD_STATUS_ANTICHEAT_INFO_FILE_SIZE" => "Размер файла",
        "DASHBOARD_STATUS_ANTICHEAT_INFO_FILE_CHECKSUM" => "Контрольная сумма файла",
        "DASHBOARD_STATUS_ANTICHEAT_INFO_LAST_UPDATE" => "Последнее обновление",
        "DASHBOARD_STATUS_ANTICHEAT_INFO_LAST_CHECK" => "Последняя проверка",

        "LEGAL_TERMS_OF_SERVICE" => "Условия использования",
        "LEGAL_TERMS_OF_SERVICE_CONTENT" => "
            <p>Заходя на этот веб-сайт, вы соглашаетесь соблюдать условия использования этого сайта, все применимые законы и правила, а также соглашаетесь с тем, что вы несете ответственность за соблюдение любых применимых местных законов. Если вы не согласны с каким-либо из этих условий, вам запрещено использовать или получать доступ к содержимому этого сайта. Этот веб-сайт доступен только для пользователей, достигших 13 лет. Если вам меньше 13 лет, пожалуйста, не регистрируйтесь на этом сайте. Регистрируясь на этом сайте, вы заявляете, что вам 13 лет или более.</p>
            <h4 class='fw-bold'>Условия использования</h4>
            <p>Вам разрешается временно загрузить одну копию материалов (информации или программного обеспечения) на этом веб-сайте только для личного некоммерческого временного просмотра. Это предоставление лицензии, а не передача права собственности, и согласно этой лицензии вы не можете</p>
            <ul>
                <li>Использовать материалы данного сайта в любых коммерческих целях.</li>
                <li>Пользоваться нашими услугами, если вы (непосредственно или косвенно) связаны с разработкой античитов</li>
                <li>Пытаться декомпилировать, патчить, отлаживать или использовать другие методы для обратного инжениринга любого программного обеспечения, содержащегося на этом веб-сайте.</li>
                <li>Делиться свой учетной записью с третьими лицами или продавать ее третьим лицам.</li>
            </ul>
            <p>Каждая копия материалов является частной для приобретающего ее пользователя. В случае, если мы найдем заимствованную/украденную копию, мы аннулируем эту копию для будущих обновлений.</p>
            <p>Эта лицензия автоматически прекращает свое действие, если вы нарушите какое-либо из этих ограничений, и может быть прекращена администратором этого веб-сайта в любое время.</p>
            <h4 class='fw-bold'>Доставка товара</h4>
            <p>Все покупки на этом веб-сайте автоматические.</p>
            <p class='mt-0'>Вы сможете загрузить приобретенный продукт из своего <a href='../dashboard'>личного кабинета</a> сразу после оплаты.</p>
            <h4 class='fw-bold'>Политика возврата</h4>
            <p>У вас есть право запросить возврат средств в том случае, если вы не можете запустить программное обеспечение из-за ошибки, бага или проблемы совместимости, которые не могут быть исправлены на вашей стороне (без вмешательства разработчиков и обновления ПО). В этом случае администратор попросит вас продемонстрировать проблему, прежде чем приступить к возврату средств.</p>
            <p class='mt-0'>Кроме того, мы компенсируем вам время, в течение которого вы не могли пользоваться нашими продуктами. Такие случаи в себя включают, но не ограничиваются техническими работами, обнаружениями ПО и т.д.</p>
            <p class='mt-0'>Если вы хотите запросить возврат средств и имеете на это право, пожалуйста, <a href='../help/contact-us.php'>свяжитесь с нами</a>.</p>
            <p class='fw-bold m-0 pt-4'>Обновлено 16 октября 2022 г.</p>
        ",

        "LEGAL_PRIVACY_POLICY" => "Политика конфиденциальности",
        "LEGAL_PRIVACY_POLICY_CONTENT" => "
            <p>Мы стремимся защищать и уважать вашу конфиденциальность. Если у вас есть вопросы о вашей личной информации, пожалуйста, <a href='../help/contact-us'>свяжитесь с нами</a>.</p>
            <h4 class='fw-bold'>Какую информацию о вас мы храним</h4>
            <p>Данные, которые мы собираем и обрабатываем, включают:</p>
            <ul>
                <li>Ваше имя пользователя.</li>
                <li>Ваш адрес электронной почты.</li>
                <li>Ваш IP адрес.</li>
                <li>Уникальный идентификатор вашего ПК.</li>
            </ul>
            <p>Мы собираем часть или всю эту информацию в следующих случаях:</p>
            <ul>
                <li>Вы регистрируетесь на этом сайте.</li>
                <li>Вы просматриваете этот сайт. См. раздел «Политика в отношении файлов cookie» ниже.</li>
                <li>Вы используете наше программное обеспечение.</li>
            </ul>
            <h4 class='fw-bold'>Как используется ваша личная информация</h4>
            <p>Мы можем использовать вашу личную информацию следующими способами:</p>
            <ul>
                <li>Для того, чтобы сделать вас зарегистрированным пользователем нашего сайта.</li>
                <li>Мы можем использовать ваш адрес электронной почты, чтобы информировать вас об активности на нашем сайте.</li>
                <li>Ваш IP-адрес записывается, когда вы выполняете определенные действия на нашем сайте. Ваш IP-адрес никогда не будет виден публично.</li>
            </ul>
            <h4 class='fw-bold'>Другие способы, которыми мы можем использовать вашу личную информацию</h4>
            <p>В дополнение к уведомлению вас о деятельности на нашем сайте, которая может иметь отношение к вам, время от времени мы можем сообщать всем участникам любую важную информацию, такую как новости или объявления по электронной почте. Вы можете подписаться на такие электронные письма или отказаться от них в своем профиле.</p>
            <p>Мы можем собирать не идентифицирующую личность информацию о вас в ходе вашего взаимодействия с нашим сайтом. Эта информация может включать техническую информацию о браузере или типе используемого вами устройства. Эта информация будет использоваться исключительно в целях аналитики и отслеживания количества посетителей нашего сайта.</p>
            <h4 class='fw-bold'>Обеспечение безопасности ваших данных</h4>
            <p>Мы стремимся обеспечить безопасность любой информации, которую вы нам предоставляете. Чтобы предотвратить несанкционированный доступ или раскрытие информации, мы внедрили соответствующие меры и процедуры для защиты информации, которую мы собираем.</p>
            <h4 class='fw-bold'>Политика в отношении файлов cookie</h4>
            <p>Файлы cookie — это небольшие текстовые файлы, которые мы устанавливаем на вашем компьютере и которые позволяют нам предоставлять определенные функции на нашем сайте, такие как возможность входа в систему или запоминание определенных предпочтений.</p>
            <p>У нас есть подробная политика использования файлов cookie и дополнительная информация о файлах cookie, которые мы устанавливаем на <a href='cookie-usage'>этой странице</a>.</p>
            <h4 class='fw-bold'>Права</h4>
            <p>У вас есть право на доступ к личным данным, которые мы храним о вас, или на получение их копии. Для этого <a href='../help/contact-us'>свяжитесь с нами</a>. Если вы считаете, что информация, которую мы храним для вас, является неполной или неточной, вы можете <a href='../help/contact-us'>связаться с нами</a>, чтобы попросить нас дополнить или исправить эту информацию.</p>
            <p>Вы также имеете право запросить удаление ваших личных данных. Пожалуйста, <a href='../help/contact-us'>свяжитесь с нами</a>, если вы хотите, чтобы мы удалили ваши личные данные.</p>
            <h4 class='fw-bold'>Принятие этой политики</h4>
            <p>Продолжение использования нашего сайта означает ваше согласие с этой политикой. Если вы не принимаете политику, пожалуйста, не используйте этот сайт. При регистрации мы дополнительно запросим ваше явное согласие с политикой конфиденциальности.</p>
            <h4 class='fw-bold'>Изменения в этой политике</h4>
            <p>Мы можем вносить изменения в эту политику в любое время. Вас могут попросить просмотреть и повторно принять информацию в этой политике, если она изменится в будущем.</p>
            <h4 class='fw-bold'>Политика CAPTCHA</h4>
            <p class='m-0'>Этот сайт защищен reCAPTCHA, к нему применяются <a href='https://policies.google.com/privacy'>политика конфиденциальности</a> и <a href='https://policies.google.com/terms'>условия обслуживания</a> Google.</p>
        ",

        "LEGAL_COOKIE_USAGE" => "Использование файлов cookie",
        "LEGAL_COOKIE_USAGE_CONTENT" => "
            <p>На этой странице обсуждается, как файлы cookie используются этим сайтом. Если вы продолжаете использовать этот сайт, вы соглашаетесь на использование нами файлов cookie.</p>
            <h4 class='fw-bold'>Что такое файлы cookie?</h4>
            <p>Файлы cookie — это небольшие текстовые файлы, сохраняемые на вашем компьютере вашим веб-браузером по запросу просматриваемого вами сайта. Это позволяет сайту, который вы просматриваете, запоминать информацию о вас, например ваши предпочтения и историю, или держать вас в авторизованным системе.</p>
            <p>Cookies may be stored on your computer for a short time (such as only while your browser is open) or for an extended period of time, even years. Cookies not set by this site will not be accessible to us.</p>
            <h4 class='fw-bold'>Наше использование файлов cookie</h4>
            <p>Этот сайт использует файлы cookie для многих целей, в том числе:</p>
            <ul>
                <li>Регистрация и сохранение ваших предпочтений. Это включает в себя обеспечение того, чтобы вы могли оставаться в системе, а также сохранение языка или внешнего вида сайта, которые вы запрашивали.</li>
                <li>Аналитика. Это позволяет нам определить, как люди используют сайт, и улучшить его.</li>
            </ul>
            <h4 class='fw-bold'>Стандартные файлы cookie, которые мы устанавливаем</h4>
            <p>Это основные файлы cookie, которые мы устанавливаем при нормальной работе программного обеспечения.</p>
            <ul>
                <li>
                    <b>m_Session</b>
                    <ul>
                        <li>Хранит уникальный для вас ключ, который позволяет вам оставаться в системе при переходе со страницы на страницу.</li>
                    </ul>
                </li>
                <li>
                    <b>m_Language</b>
                    <ul>
                        <li>Хранит язык, который вы выбрали на этом веб-сайте.</li>
                    </ul>
                </li>
            </ul>
            <h4 class='fw-bold'>Дополнительные файлы cookie и файлы, установленные третьими лицами</h4>
            <p>Дополнительные файлы cookie могут быть установлены во время использования сайта для запоминания информации при выполнении определенных действий или запоминания определенных предпочтений.</p>
            <p>Другие файлы cookie могут устанавливаться сторонними поставщиками услуг, которые могут предоставлять такую ​​информацию, как анонимное отслеживание того, какие пользователи посещают сайт, или устанавливаться с помощью контента, встроенного в некоторые страницы, такие как YouTube или другие поставщики медиа-услуг.</p>
            <h4 class='fw-bold'>Удаление/отключение файлов cookie</h4>
            <p>Управление вашими файлами cookie и настройками файлов cookie должно осуществляться в настройках/параметрах вашего браузера. Вот список руководств о том, как это сделать в популярных браузерах:</p>
            <ul>
                <li><a href='https://support.microsoft.com/en-gb/help/17442/windows-internet-explorer-delete-manage-cookies'>Microsoft Internet Explorer</a></li>
                <li><a href='https://privacy.microsoft.com/en-us/windows-10-microsoft-edge-and-privacy'>Microsoft Edge</a></li>
                <li><a href='https://support.mozilla.org/en-US/kb/cookies-information-websites-store-on-your-computer'>Mozilla Firefox</a></li>
                <li><a href='https://support.google.com/chrome/answer/95647?hl=en'>Google Chrome</a></li>
                <li><a href='https://support.apple.com/en-gb/guide/safari/manage-cookies-and-website-data-sfri11471/mac'>Safari for macOS</a></li>
                <li><a href='https://support.apple.com/en-gb/HT201265'>Safari for iOS</a></li>
            </ul>
            <h4 class='fw-bold'>Дополнительная информация о файлах cookie</h4>
            <p class='m-0'>Чтобы узнать больше о файлах cookie и найти дополнительную информацию о блокировании определенных типов файлов cookie, посетите <a href='https://ico.org.uk/for-the-public/online/cookies/'>ICO website Cookies page</a>.</p>
        ",

        "LEGAL_CONTACTS" => "Контакты",
        "LEGAL_CONTACTS_CONTENT" => "
            <h4 class='fw-bold'>Контакты</h4>
            <p><b>ИП</b> Черепанов Михаил Денисович</p>
            <p><b>ИНН:</b> 673108418544</p>
            <p><b>ОГРНИП:</b> 322673300016180</p>
            <p><b>Email:</b> mrflashstudio@gmail.com</p>
            <p>Россия, Смоленск</p>
            
            <h4 class='fw-bold pt-4'>Мы принимаем</h4>
            <img class='m-0' src='../assets/web/images/contacts/visa.svg' width='64' height='32'>
            <img class='m-0' src='../assets/web/images/contacts/mc.svg' width='54' height='64'>
            <img class='m-0' src='../assets/web/images/contacts/btc.svg' width='32' height='32'>
            <img class='m-0' src='../assets/web/images/contacts/ltc.svg' width='32' height='32'>
            <p class='m-0'>Автоматическая покупка. Вы сможете загрузить приобретенный продукт из своего личного кабинета сразу после оплаты.</p>
        ",

        "HELP" => "Помощь",
        "HELP_CONTENT" => "
            <h4 class='fw-bold'>Нужна помощь? Этот раздел поможет вам узнать ответы на все важные вопросы.</h4>
            <h4 class='fw-bold'><a href='getting-started'>Инструкция</a></h4>
            <p>Подробное руководство по покупке и запуску Maple.</p>
            <h4 class='fw-bold'><a href='features'>Функционал</a></h4>
            <p>Взгляните на то, что мы можем предложить.</p>
            <h4 class='fw-bold'><a href='faq'>Часто задаваемые вопросы</a></h4>
            <p>Часто задаваемые вопросы.</p>
            <h4 class='fw-bold'><a href='payment-issues'>Проблемы с платежами</a></h4>
            <p>Возникли проблемы с покупкой Maple? У нас есть решения для различных проблем с оплатой.</p>
            <h4 class='fw-bold'><a href='software-issues'>Проблемы с ПО</a></h4>
            <p>Не можете использовать Maple по какой-то причине? У нас есть решения различных проблем, которые могут возникнуть при запуске или во время игры.</p>
            <h4 class='fw-bold'><a href='report-a-bug'>Сообщить о баге</a></h4>
            <p>Нашли баг и хотите сообщить о нем? Смело делайте это!</p>
            <h4 class='fw-bold'><a href='suggest-a-feature'>Предложить функционал</a></h4>
            <p>Придумали какую-нибудь крутую функцию? Не стесняйтесь, дайте нам знать об этом!</p>
            <h4 class='fw-bold'><a href='contact-us'>Нет, серьезно, мне нужна помощь!</a></h4>
            <p class='m-0'>Не нашли решение своей проблемы? Не стесняйтесь связаться с нами!</p>
        ",

        "HELP_GETTING_STARTED" => "Getting started",
        "HELP_GETTING_STARTED_CONTENT" => "
            <h4 class='fw-bold'>Создание учетной записи</h4>
            <p>Вы можете создать учетную запись на <a href='../auth/signup'>этой странице</a>.</p>
            <h4 class='fw-bold'>Получение подписки</h4>
            <p>После создания учетной записи перейдите на <a href='../dashboard/store'>страницу магазина</a>. Выберите нужный план подписки и способ оплаты и перейдите к оплате.</p>
            <h4 class='fw-bold'>Загрузка Loader'a</h4>
            <p>После оплаты вы сможете загрузить Maple Loader из своего <a href='../dashboard'>профиля</a>.</p>
            <h4 class='fw-bold'>Запуск Maple</h4>
            <p>Запустите Maple Loader, введите свои учетные данные и нажмите <b>Login</b>. Теперь выберите чит, который хотите загрузить, нажмите <b>Load</b> и дождитесь окончания загрузки.</p>
            <h4 class='fw-bold'>Требования</h4>
            <ul class='m-0'>
                <li>Ваш антивирус может пометить Maple Loader как вирус, поэтому отключите его.</li>
                <li>Windows 10 или новее. (21H2 или старше)</li>
                <li><a href='https://aka.ms/vs/17/release/vc_redist.x64.exe'>Visual C++ Redistributable x64</a> и <a href='https://aka.ms/vs/17/release/vc_redist.x86.exe'>Visual C++ Redistributable x86</a>.</li>
                <li><a href='https://dotnet.microsoft.com/en-us/download/dotnet-framework/net48'>Последний .net framework</a>.</li>
            </ul>
        ",

        "HELP_FEATURES" => "Функционал",

        "HELP_FAQ" => "Часто задаваемые вопросы",
        "HELP_FAQ_CONTENT" => "
            <h4 class='fw-bold'>Кто основал проект Maple?</h4>
            <p>Maple был основан <b>Maple Syrup</b> и <b>Azuki</b>.</p>
            <h4 class='fw-bold'>Когда выйдет Maple Full?</h4>
            <p>Дата выпуска Maple Full уточняется, извините. Пожалуйста, подождите терпеливо.</p>
            <h4 class='fw-bold'>Могу ли я получить пробную версию Maple перед покупкой?</h4>
            <p>Мы не предлагаем пробные версии.</p>
            <h4 class='fw-bold'>Могу ли я получить бан?</h4>
            <p>Любой чит может привести к бану, Maple может быть обнаружен мерами античита osu! в любой момент времени. Однако мы делаем все возможное, чтобы этого не произошло.</p>
            <h4 class='fw-bold'>Что произойдет, если Maple будет обнаружен?</h4>
            <p>Мы обновим статус обнаружения в загрузчике и сделаем объявление на нашем <a href='../discord'>Discord сервере</a>. Все пользователи получат компенсацию после того, как мы выпустим исправление.</p>
            <h4 class='fw-bold'>osu! обновился, могу ли я по-прежнему использовать Maple?</h4>
            <p>Maple разработан таким образом, что его можно использовать после большинства обновлений. Однако, если все таки что-то сломается, мы постараемся выпустить исправление как можно быстрее и компенсируем всем ожидание.</p>
            <h4 class='fw-bold'>Могу ли я запросить возврат средств?</h4>
            <p class='m-0'>Да! Но, пожалуйста, ознакомьтесь с нашими <a href='../legal/terms-of-service'>Условиями обслуживания</a>, прежде чем продолжить.</p>
        ",

        "HELP_PAYMENT_ISSUES" => "Проблемы с платежами",
        "HELP_PAYMENT_ISSUES_CONTENT" => "
            <h4 class='fw-bold'>Какие способы оплаты я могу использовать?</h4>
            <p>Вы можете использовать дебетовые/кредитные карты, Bitcoin, Litecoin и множество других способов оплаты, которые принимают наши <a href='../dashboard/store/resellers'>реселлеры</a>.</p>
            <h4 class='fw-bold'>Я не получил подписку после оплаты!</h4>
            <p class='m-0'>В таких случаях, пожалуйста, <a href='contact-us'>свяжитесь с нами</a> и предоставьте следующую информацию:</p>
            <ul class='m-0'>
                <li>Способ оплаты, который вы использовали.</li>
                <li>Дата и время транзакции.</li>
                <li>Продукт, который вы купили.</li>
                <li>Ваш User ID.</li>
            </ul>
        ",

        "HELP_SOFTWARE_ISSUES" => "Проблемы с ПО",
        "HELP_SOFTWARE_ISSUES_CONTENT" => "
            <h4 class='fw-bold'>Не найден MSVCP140.dll</h4>
            <p>Установите <a href='https://aka.ms/vs/17/release/vc_redist.x64.exe'>Visual C++ Redistributable x64</a> и <a href='https://aka.ms/vs/17/release/vc_redist.x86.exe'>Visual C++ Redistributable x86</a>. Перезагрузите компьютер и попробуйте еще раз.</p>
            <h4 class='fw-bold'>Не найден d3dx9_43.dll</h4>
            <p>Установите <a href='https://www.microsoft.com/en-us/download/details.aspx?id=35'>DirectX End-User Runtime</a>. Перезагрузите компьютер и попробуйте еще раз.</p>
            <h4 class='fw-bold'>'Fatal error occurred: your time is our of sync!'</h4>
            <p>Синхронизуйте время на вашем компьютере.</p>
            <video class='w-75' controls>
                <source src='../assets/web/videos/help/timesync.mp4?v1.1' type='video/mp4'>
            </video>
            <h4 class='fw-bold'>Injection failed after 3 retries</h4>
            <p>Перезагрузите компьютер и попробуйте еще раз. Если это все еще происходит, пожалуйста, <a href='contact-us'>свяжитесь с нами</a> и сообщите нам код ошибки.</p>
            <h4 class='fw-bold'>Игра вылетает при загрузке</h4>
            <p>
            <ul>
                <li> Отключите антивирус и все остальное в настройках <b>Защиты от эксплойтов</b> и <b>Изоляции ядра</b> <b>Защитника Windows</b>.</li>
                <li>Отключите античиты на уровне ядра (например, <b>Vanguard</b>).</li>
                <li>Перезагрузите компьютер и попробуйте еще раз.</li>
            </ul>
            </p>
            <h4 class='fw-bold'>Игра вылетает во время игры</h4>
            <p>Отключите античиты на уровне ядра (например, <b>Vanguard</b>).</p>
            <h4 class='fw-bold'>Меню не появляется после загрузки</h4>
            <p class='m-0'>Отключите <b>все</b> сторонние оверлеи (например, <b>Discord</b>, <b>Steam</b>, <b>Overwolf</b>, <b>RivaTuner (MSI Afterburner overlay)</b>, <b>Xbox Game Bar</b>, <b>Geforce Experience overlay</b>).</p>
        ",

        "HELP_REPORT_A_BUG" => "Сообщить о баге",
        "HELP_REPORT_A_BUG_CONTENT" => "
            <h4 class='fw-bold'>Как я могу сообщить о баге?</h4>
            <p>
                Вы можете сообщить об ошибке, открыв новую проблему в нашем <a href='https://github.com/maplesyrupuwu/Maple-tracker-for-osu'>репозитории GitHub</a>. В качестве альтернативы вы также можете сделать это в канале <b>#bug-reports</b> на нашем <a href='../discord'>Discord сервере</a>, но мы настоятельно рекомендуем всем вместо этого использовать <b>GitHub</b>, потому что он гораздо более организован.
            </p>
            <p>
                При создании отчета о баге используйте следующий формат:
                <ul>
                    <li>Четкое и краткое описание бага.</li>
                    <li>
                        Шаги, которые мы можем использовать для воспроизведения бага, например:
                        <ul>
                            <li>Зайдите в <b>X</b>.</li>
                            <li>Включите <b>Y</b>.</li>
                            <li>Сделайте <b>Z</b>.</li>
                            <li>и т.п.</li>
                        </ul>
                    </li>
                    <li>
                        Дополнительная информация. Это может быть видео и/или снимок экрана, демонстрирующий проблему. Вы также можете прикрепить логи игры и Event Viewer'a (мы очень ценим это, поэтому, если возможно, прикрепите их!). Конечно, не стесняйтесь опускать любую конфиденциальную или личную информацию.
                    </li>
                </ul>
            </p>
            <h4 class='fw-bold'>Как получить логи игры? (osu!)</h4>
            <p>
                <b>Примечание: все это нужно делать ДО вылета, потому что osu! очищает логи при каждом запуске.</b>
                <ul>
                    <li>Запустите osu!.</li>
                    <li>Перейдите в <b>Настройки</b> и нажмите на кнопку <b>Открыть папку osu!</b>.</li>
                    <li>Найдите папку <b>Logs</b> в открывшемся окне.</li>
                    <li>Файл <b>runtime.log</b> - это лог, который вам нужен.</li>
                </ul>
            </p>
            <h4 class='fw-bold'>Как получить логи Event Viewer'a? (osu!)</h4>
            <ul class='m-0'>
                <li>После того, как osu! вылетела, нажите <b>Win</b> + <b>R</b> чтобы открыть окно <b>Выполнить</b>.</li>
                <li>В открывшемся окне введите <b><i>eventvwr</i></b> и нажмите <b>Enter</b>. Эти действия откроют Event Viewer.</li>
                <li>В Event Viewer, слева, нажмите на <b>Журналы Windows</b>, а затем на <b>Приложение</b>.</li>
                <li>Справа, нажмите на <b>Фильтр текущего журнала</b>.</li>
                <li>В открывшемся окне фильтра убедитесь, что у вас установлен флажок <b>Ошибка</b>, и нажмите <b>ОК</b>.</li>
                <li>Нажмите <b>Ctrl</b> + <b>F</b> и введите osu! в поле поиска. Это действие найдет первый лог вылета osu!</li>
                <li>Перейдите на вкладку <b>Подробности</b>, разверните <b>System</b> и <b>Event Data</b> щелкнув по каждому из них.</li>
                <li>Скопируйте текст оттуда и вставьте в свой отчет о баге.</li>
            </ul>
        ",

        "HELP_SUGGEST_A_FEATURE" => "Предложить функционал",
        "HELP_SUGGEST_A_FEATURE_CONTENT" => "
            <h4 class='fw-bold'>Как я могу предложить функцию/улучшение?</h4>
            <p class='m-0'>
                Вы можете предложить функцию, открыв новый issue в нашем <a href='https://github.com/maplesyrupuwu/Maple-tracker-for-osu'>репозитории GitHub</a>. В качестве альтернативы вы также можете сделать это на канале <b>#suggestions</b> на нашем <a href='../discord'>Discord сервере</a>, но мы настоятельно рекомендуем всем вместо этого использовать <b>GitHub</b>, потому что он гораздо более организован.stions</b>
            </p>
        ",

        "HELP_CONTACT_US" => "Свяжитесь с нами",
        "HELP_CONTACT_US_CONTENT" => "
            <h4 class='fw-bold'>Вы можете связаться с нами</h4>
            <ul class='m-0'>
                <li>на <a href='../discord'>нашем Discord сервере</a></li>
                <li>через личные сообщения Discord с одним из наших администраторов: <b>Maple Syrup#1011</b> или <b>Azuki#7911</b></li>
                <li>или отправив нам электронное письмо на <b><a href='mailto:support@maple.software'>support@maple.software</a></b></li>
            </ul>
        "
    ];

    function GetLanguage()
    {
        return $_COOKIE["m_Language"] ?? "en";
    }

    function SetLanguage($languageString)
    {
        global $availableLanguages;

        if (in_array($languageString, $availableLanguages))
            setcookie("m_Language", $languageString, time() + 60 * 60 * 24 * 365 * 2, "/", NULL, true);
    }

    function GetLocalizedString($str)
    {
        global $en_strings;
        global $ru_strings;

        if (GetLanguage() == "ru")
            return $ru_strings[$str] ?? $en_strings[$str];

        return $en_strings[$str];
    }

    function GetLocalizedDate($date) // i fucking hate this shit
    {
        if (GetLanguage() == "ru")
        {
            if ($date == "just now")
                return "только что";

            $formatter = new IntlDateFormatter('ru_RU', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
            return $formatter->format(strtotime($date));
        }

        return $date;
    }
?>