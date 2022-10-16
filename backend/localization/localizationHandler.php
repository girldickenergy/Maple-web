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

    function GetLocalizedDate($date)
    {
        if (GetLanguage() == "ru")
        {
            $formatter = new IntlDateFormatter('ru_RU', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
            return $formatter->format(strtotime($date));
        }

        return $date;
    }
?>