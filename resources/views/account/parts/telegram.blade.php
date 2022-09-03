<div class="col-sm-12 text-center" style="padding: 16px;">
    <h4>Get info about your order in telegram!</h4>
    <br>
    <script async
            src="https://telegram.org/js/telegram-widget.js?19"
            data-telegram-login="{{ config('services.telegram-bot-api.name') }}"
            data-size="large"
            data-radius="0"
            data-auth-url="{{ route('account.telegram.callback') }}"
            data-request-access="write"
    ></script>
</div>
