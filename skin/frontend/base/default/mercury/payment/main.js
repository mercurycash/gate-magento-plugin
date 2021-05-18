jQuery("document").ready(function() {
    let merParam = {};

    jQuery('body').on('click', 'input[id$=method_mercurypayment]', function() {
        if (typeof mercuryParam != "undefined") {
            merParam = mercuryParam;
        }

        let sdk = new MercurySDK({
            staticUrl: merParam.url,
            checkoutUrl: merParam.pathCreateTransaction,
            statusUrl: merParam.pathCheckTransaction,
            checkStatusInterval: parseInt(merParam.time, 2),
            mount: "#mercury-cash",
            lang: "en",
            limits: {
                BTC: merParam.btc,
                ETH: merParam.eth,
                DASH: merParam.dash
            }
        });

        sdk.checkout(merParam.cart_price, merParam.currency, merParam.email);

        sdk.on("close", (obj) => {
            if (obj.status && (obj.status === "TRANSACTION_APROVED")) {
                jQuery('#payment-buttons-container button').trigger('click');
            } else {
                location.reload();
            }
        });
    });
});
