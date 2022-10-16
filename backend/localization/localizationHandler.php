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